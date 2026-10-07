from flask import Flask, request, jsonify
import pickle
from pathlib import Path
import sys


# =========================================================
# NEXA AI PATH
# =========================================================

BASE_DIR = Path(__file__).resolve().parent.parent
ENGINE_DIR = BASE_DIR / "engine"
MODEL_PATH = BASE_DIR / "models" / "nexa_model.pkl"

sys.path.insert(0, str(ENGINE_DIR))


# =========================================================
# SUGGESTION ENGINE
# =========================================================

from suggestion import generate_suggestions
from parser import parse_file

# =========================================================
# FLASK APP
# =========================================================

app = Flask(__name__)


# =========================================================
# LOAD MODEL
# =========================================================

if not MODEL_PATH.exists():
    raise FileNotFoundError(
        f"Model NEXA AI tidak ditemukan: {MODEL_PATH}"
    )

with open(MODEL_PATH, "rb") as file:
    model = pickle.load(file)


# =========================================================
# HEALTH CHECK
# =========================================================

@app.get("/health")
def health():

    return jsonify({
        "success": True,
        "service": "NEXA AI",
        "status": "online"
    })


# =========================================================
# ANALYZE
# =========================================================

@app.post("/analyze")
def analyze():

    data = request.get_json(silent=True) or {}

    instruction = data.get("instruction", "")
    answer = data.get("answer", "")

    if not instruction or not answer:

        return jsonify({
            "success": False,
            "message": "instruction dan answer wajib diisi."
        }), 400


    # Gabungkan instruksi + jawaban
    text = instruction + " " + answer


    # Prediksi menggunakan model lokal
    prediction = model.predict([text])[0]


    instruction_score = round(
        float(prediction[0]), 2
    )

    completeness_score = round(
        float(prediction[1]), 2
    )

    quality_score = round(
        float(prediction[2]), 2
    )

    neatness_score = round(
        float(prediction[3]), 2
    )


    # Generate evaluasi tambahan
    suggestions = generate_suggestions(
        instruction_score,
        completeness_score,
        quality_score,
        neatness_score
    )


    # Nilai keseluruhan
    overall_score = round(
        (
            instruction_score
            + completeness_score
            + quality_score
            + neatness_score
        ) / 4,
        2
    )


    return jsonify({

        "success": True,

        "scores": {

            "instruction":
                instruction_score,

            "completeness":
                completeness_score,

            "quality":
                quality_score,

            "neatness":
                neatness_score,

            "overall":
                overall_score
        },

        "strengths":
            suggestions["strengths"],

        "weaknesses":
            suggestions["weaknesses"],

        "suggestions":
            suggestions["suggestions"]
    })

# =========================================================
# ANALYZE FILE
# =========================================================

@app.post("/analyze-file")
def analyze_file():

    data = request.get_json(silent=True) or {}

    file_path = data.get("file_path", "")
    instruction = data.get("instruction", "")

    if not file_path:
        return jsonify({
            "success": False,
            "message": "file_path wajib diisi."
        }), 400

    try:

        # Baca isi file menggunakan parser NEXA AI
        answer = parse_file(file_path)

        if not answer or not answer.strip():
            return jsonify({
                "success": False,
                "message": "Isi file tidak dapat dibaca."
            }), 422

        # Gabungkan instruksi + isi file
        text = instruction + " " + answer

        # Prediksi model
        prediction = model.predict([text])[0]

        instruction_score = round(
            float(prediction[0]), 2
        )

        completeness_score = round(
            float(prediction[1]), 2
        )

        quality_score = round(
            float(prediction[2]), 2
        )

        neatness_score = round(
            float(prediction[3]), 2
        )

        suggestions = generate_suggestions(
            instruction_score,
            completeness_score,
            quality_score,
            neatness_score
        )

        overall_score = round(
            (
                instruction_score
                + completeness_score
                + quality_score
                + neatness_score
            ) / 4,
            2
        )

        return jsonify({

            "success": True,

            "scores": {
                "instruction": instruction_score,
                "completeness": completeness_score,
                "quality": quality_score,
                "neatness": neatness_score,
                "overall": overall_score
            },

            "strengths":
                suggestions["strengths"],

            "weaknesses":
                suggestions["weaknesses"],

            "suggestions":
                suggestions["suggestions"],

            "content_length":
                len(answer),

            "content_preview":
                answer[:1000]
        })

    except Exception as e:

        return jsonify({
            "success": False,
            "message": str(e)
        }), 500

# =========================================================
# CHAT
# =========================================================
@app.post("/chat")
def chat():
    data = request.get_json(silent=True) or {}

    instruction = data.get("instruction", "")
    message = data.get("message", "")

    if not message:
        return jsonify({
            "success": False,
            "message": "message wajib diisi."
        }), 400

    try:
        import requests

        prompt = f"""
Kamu adalah NEXA AI, asisten AI untuk siswa.
Jawab dengan bahasa Indonesia yang jelas, natural, dan mudah dipahami.
Bantu pengguna memahami pelajaran, tugas, pemrograman, teknologi,
merangkum teks, dan pertanyaan umum.

Jangan mengaku sebagai manusia.
Jika tidak yakin terhadap suatu informasi, katakan bahwa kamu tidak yakin.

Konteks tugas:
{instruction}

Pertanyaan pengguna:
{message}
"""

        response = requests.post(
            "http://127.0.0.1:11434/api/generate",
            json={
                "model": "qwen2.5:3b",
                "prompt": prompt,
                "stream": False
            },
            timeout=120
        )

        response.raise_for_status()

        result = response.json()

        return jsonify({
            "success": True,
            "response": result.get("response", "").strip()
        })

    except Exception as e:
        return jsonify({
            "success": False,
            "message": "NEXA AI gagal memproses chat.",
            "error": str(e)
        }), 500

# =========================================================
# START SERVER
# =========================================================

if __name__ == "__main__":

    print()
    print("========================================")
    print("        NEXA AI LOCAL ENGINE")
    print("========================================")
    print("Model :", MODEL_PATH)
    print("Host  : http://127.0.0.1:5001")
    print("Status: ONLINE")
    print("========================================")
    print()

    app.run(
        host="127.0.0.1",
        port=5001,
        debug=False
    )