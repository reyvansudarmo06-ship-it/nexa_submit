import csv
import pickle

from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.multioutput import MultiOutputRegressor
from sklearn.ensemble import RandomForestRegressor
from sklearn.pipeline import Pipeline


DATASET = "nexa-ai/dataset/training.csv"
MODEL_PATH = "nexa-ai/models/nexa_model.pkl"


texts = []
scores = []


with open(
    DATASET,
    "r",
    encoding="utf-8"
) as file:

    reader = csv.DictReader(file)

    for row in reader:

        text = (
            row["instruction"]
            + " "
            + row["answer"]
        )

        texts.append(text)

        scores.append([
            float(row["instruction_score"]),
            float(row["completeness_score"]),
            float(row["quality_score"]),
            float(row["neatness_score"]),
        ])


model = Pipeline([
    (
        "tfidf",
        TfidfVectorizer(
            lowercase=True,
            ngram_range=(1, 2),
            max_features=5000
        )
    ),
    (
        "regressor",
        MultiOutputRegressor(
            RandomForestRegressor(
                n_estimators=100,
                random_state=42
            )
        )
    )
])


print("NEXA AI: mulai training...")
print(f"Dataset: {len(texts)} data")


model.fit(
    texts,
    scores
)


with open(
    MODEL_PATH,
    "wb"
) as file:

    pickle.dump(
        model,
        file
    )


print("Training selesai.")
print(f"Model tersimpan di: {MODEL_PATH}")