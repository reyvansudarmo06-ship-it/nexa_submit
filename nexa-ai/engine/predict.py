import pickle

from suggestion import generate_suggestions


MODEL_PATH = "nexa-ai/models/nexa_model.pkl"


with open(MODEL_PATH, "rb") as file:
    model = pickle.load(file)


instruction = """
Buat aplikasi CRUD Laravel dengan login,
database, create, read, update, dan delete.
"""

answer = """
Saya membuat aplikasi Laravel dengan login.
Saya juga membuat database dan fitur tambah,
lihat, edit, dan hapus data siswa.
"""


text = instruction + " " + answer


prediction = model.predict([text])[0]


instruction_score = round(prediction[0], 2)
completeness_score = round(prediction[1], 2)
quality_score = round(prediction[2], 2)
neatness_score = round(prediction[3], 2)


result = generate_suggestions(
    instruction_score,
    completeness_score,
    quality_score,
    neatness_score
)


print("=== NEXA AI ANALYSIS ===")
print()

print(f"Instruction Score : {instruction_score}")
print(f"Completeness Score: {completeness_score}")
print(f"Quality Score     : {quality_score}")
print(f"Neatness Score    : {neatness_score}")

print()
print("=== STRENGTHS ===")

for item in result["strengths"]:
    print(f"- {item}")

print()
print("=== WEAKNESSES ===")

for item in result["weaknesses"]:
    print(f"- {item}")

print()
print("=== SUGGESTIONS ===")

for item in result["suggestions"]:
    print(f"- {item}")