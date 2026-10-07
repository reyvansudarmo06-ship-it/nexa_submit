from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity


class NexaAnalyzer:

    def __init__(self):
        self.vectorizer = TfidfVectorizer(
            lowercase=True,
            ngram_range=(1, 2),
            max_features=5000
        )

    def similarity(self, instruction, submission):
        documents = [
            instruction,
            submission
        ]

        matrix = self.vectorizer.fit_transform(documents)

        score = cosine_similarity(
            matrix[0:1],
            matrix[1:2]
        )[0][0]

        return round(score * 100, 2)

    def analyze(self, instruction, submission):

        similarity_score = self.similarity(
            instruction,
            submission
        )

        instruction_score = min(
            round(similarity_score),
            100
        )

        completeness_score = self.calculate_completeness(
            submission
        )

        quality_score = self.calculate_quality(
            submission
        )

        neatness_score = self.calculate_neatness(
            submission
        )

        return {
            "instruction_score": instruction_score,
            "completeness_score": completeness_score,
            "quality_score": quality_score,
            "neatness_score": neatness_score,
            "overall_score": round(
                (
                    instruction_score
                    + completeness_score
                    + quality_score
                    + neatness_score
                ) / 4
            )
        }

    def calculate_completeness(self, submission):

        if not submission.strip():
            return 0

        words = len(
            submission.split()
        )

        if words >= 500:
            return 100

        if words >= 300:
            return 90

        if words >= 200:
            return 80

        if words >= 100:
            return 70

        if words >= 50:
            return 60

        return 40

    def calculate_quality(self, submission):

        if not submission.strip():
            return 0

        sentences = submission.count(".")
        words = len(submission.split())

        if words == 0:
            return 0

        if sentences >= 10 and words >= 300:
            return 90

        if sentences >= 7 and words >= 200:
            return 80

        if sentences >= 4 and words >= 100:
            return 70

        return 60

    def calculate_neatness(self, submission):

        if not submission.strip():
            return 0

        lines = submission.splitlines()

        empty_lines = sum(
            1 for line in lines
            if not line.strip()
        )

        if len(lines) == 0:
            return 0

        empty_ratio = (
            empty_lines / len(lines)
        )

        if empty_ratio > 0.5:
            return 60

        if empty_ratio > 0.3:
            return 75

        return 90


if __name__ == "__main__":

    analyzer = NexaAnalyzer()

    instruction = """
    Buat aplikasi CRUD menggunakan Laravel.
    Aplikasi harus memiliki login,
    database, tambah data,
    edit data, hapus data,
    dan halaman untuk menampilkan data.
    """

    submission = """
    Saya membuat aplikasi Laravel.
    Aplikasi memiliki halaman login
    dan database untuk menyimpan data siswa.

    Pengguna dapat menambahkan data,
    melihat data,
    mengubah data,
    dan menghapus data.

    Aplikasi juga memiliki dashboard
    untuk menampilkan data.
    """

    result = analyzer.analyze(
        instruction,
        submission
    )

    print("=== NEXA AI ANALYSIS ===")

    for key, value in result.items():
        print(
            f"{key}: {value}"
        )