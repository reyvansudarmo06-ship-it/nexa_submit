def generate_suggestions(
    instruction_score,
    completeness_score,
    quality_score,
    neatness_score
):
    strengths = []
    weaknesses = []
    suggestions = []

    if instruction_score >= 80:
        strengths.append(
            "Tugas sudah cukup sesuai dengan instruksi."
        )
    else:
        weaknesses.append(
            "Tugas belum sepenuhnya sesuai dengan instruksi."
        )
        suggestions.append(
            "Periksa kembali setiap poin yang diminta pada instruksi tugas."
        )

    if completeness_score >= 80:
        strengths.append(
            "Isi tugas tergolong lengkap."
        )
    else:
        weaknesses.append(
            "Masih terdapat bagian tugas yang belum lengkap."
        )
        suggestions.append(
            "Lengkapi bagian atau fitur yang belum dikerjakan."
        )

    if quality_score >= 80:
        strengths.append(
            "Kualitas isi tugas tergolong baik."
        )
    else:
        weaknesses.append(
            "Kualitas isi tugas masih dapat ditingkatkan."
        )
        suggestions.append(
            "Perjelas isi, struktur, dan penjelasan tugas."
        )

    if neatness_score >= 80:
        strengths.append(
            "Penyajian tugas cukup rapi."
        )
    else:
        weaknesses.append(
            "Penyajian tugas masih kurang rapi."
        )
        suggestions.append(
            "Rapikan struktur dan susunan tugas."
        )

    return {
        "strengths": strengths,
        "weaknesses": weaknesses,
        "suggestions": suggestions
    }