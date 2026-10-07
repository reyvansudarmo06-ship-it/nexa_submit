from flask import Flask, request, jsonify
import pickle

from pathlib import Path
import sys


BASE_DIR = Path(__file__).resolve().parent.parent
ENGINE_DIR = BASE_DIR / "engine"
MODEL_PATH = BASE_DIR / "models" / "nexa_model.pkl"

sys.path.insert(0, str(ENGINE_DIR))

from suggestion import generate_suggestions


app = Flask(__name__)


with open(MODEL_PATH, "rb") as file:
    model = pickle.load(file)


@app.get("/health")
def health():
    return jsonify({
        "success": True,
        "service": "NEXA AI",
        "status": "online"
    })


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

    text = instruction + " " + answer

    prediction = model.predict([text])[0]

    instruction_score = round(float(prediction[0]), 2)
    completeness_score = round(float(prediction[1]), 2)
    quality_score = round(float(prediction[2]), 2)
    neatness_score = round(float(prediction[3]), 2)

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
        "strengths": suggestions["strengths"],
        "weaknesses": suggestions["weaknesses"],
        "suggestions": suggestions["suggestions"]
    })


if __name__ == "__main__":
    app.run(
        host="127.0.0.1",
        port=5001,
        debug=False
    )