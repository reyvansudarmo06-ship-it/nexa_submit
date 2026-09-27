<x-app-layout>

    <div class="nexa-page">

        <div class="nexa-glow glow-1"></div>
        <div class="nexa-glow glow-2"></div>

        <div class="nexa-container">

            {{-- ========================================================= --}}
            {{-- TOP HEADER --}}
            {{-- ========================================================= --}}

            <div class="page-header">

                <div>

                    <div class="eyebrow">
                        <span class="eyebrow-dot"></span>
                        TEACHER · SUBMISSION REVIEW
                    </div>

                    <h1 class="page-title">
                        Detail Pengumpulan
                    </h1>

                    <p class="page-description">
                        Periksa tugas, jalankan analisis NEXA AI, dan berikan penilaian kepada siswa.
                    </p>

                </div>

                <div class="header-actions">

                    <a
                        href="{{ route('teacher.submissions.index', $submission->assignment) }}"
                        class="back-button"
                    >
                        ← Kembali
                    </a>

                    <a
                        href="{{ route('teacher.submissions.download', $submission) }}"
                        class="download-button"
                    >
                        ↓ Download File
                    </a>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- ASSIGNMENT HERO --}}
            {{-- ========================================================= --}}

            <div class="assignment-hero">

                <div class="hero-icon">
                    📚
                </div>

                <div class="hero-content">

                    <span class="hero-label">
                        ASSIGNMENT
                    </span>

                    <h2>
                        {{ $submission->assignment->title }}
                    </h2>

                    <div class="hero-meta">

                        <span>
                            📘 {{ $submission->assignment->subject }}
                        </span>

                        <span class="meta-dot"></span>

                        <span>
                            👥 {{ $submission->assignment->class_name }}
                        </span>

                    </div>

                </div>

                <div class="hero-status">
                    <span></span>
                    SUBMITTED
                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- STUDENT + TIME --}}
            {{-- ========================================================= --}}

            <div class="info-grid">

                <div class="info-card">

                    <div class="info-icon student-icon">
                        👤
                    </div>

                    <div class="info-content">

                        <span>
                            SISWA
                        </span>

                        <strong>
                            {{ $submission->student->name }}
                        </strong>

                        <small>
                            {{ $submission->student->email }}
                        </small>

                    </div>

                </div>


                <div class="info-card">

                    <div class="info-icon time-icon">
                        🕐
                    </div>

                    <div class="info-content">

                        <span>
                            WAKTU PENGUMPULAN
                        </span>

                        <strong>
                            {{ $submission->created_at->format('d M Y H:i') }}
                        </strong>

                        <small>
                            Submission timestamp
                        </small>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- FILE + NOTE --}}
            {{-- ========================================================= --}}

            <div class="content-grid">

                {{-- FILE --}}
                <div class="glass-card">

                    <div class="section-heading">

                        <div class="section-icon blue">
                            📄
                        </div>

                        <div>
                            <span>
                                SUBMISSION FILE
                            </span>

                            <h3>
                                File Tugas
                            </h3>
                        </div>

                    </div>

                    <div class="file-display">

                        <div class="file-large-icon">
                            📄
                        </div>

                        <div class="file-details">

                            <strong>
                                {{ $submission->file_name }}
                            </strong>

                            <span>
                                File yang dikirim oleh siswa
                            </span>

                        </div>

                    </div>

                </div>


                {{-- NOTE --}}
                <div class="glass-card">

                    <div class="section-heading">

                        <div class="section-icon purple">
                            💬
                        </div>

                        <div>
                            <span>
                                STUDENT NOTE
                            </span>

                            <h3>
                                Catatan Siswa
                            </h3>
                        </div>

                    </div>

                    <div class="note-box">
                        {{ $submission->note ?: 'Tidak ada catatan dari siswa.' }}
                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- AI ANALYSIS --}}
            {{-- ========================================================= --}}

            <div class="ai-section">

                <div class="ai-header">

                    <div class="ai-title-wrapper">

                        <div class="ai-logo">
                            ✦
                        </div>

                        <div>

                            <div class="ai-eyebrow">
                                NEXA INTELLIGENCE
                            </div>

                            <h2>
                                NEXA AI Cek Tugas
                            </h2>

                            <p>
                                Analisis otomatis terhadap file submission siswa.
                            </p>

                        </div>

                    </div>

                    <button
                        type="button"
                        id="analyzeAiButton"
                        onclick="analyzeSubmission()"
                        class="ai-button"
                    >
                        <span>✦</span>
                        Analisis dengan NEXA AI
                    </button>

                </div>


                {{-- LOADING --}}

                <div
                    id="aiLoading"
                    class="hidden ai-loading"
                >

                    <div class="ai-loader"></div>

                    <div>
                        <strong>
                            NEXA sedang menganalisis...
                        </strong>

                        <span>
                            AI sedang membaca dan mengevaluasi submission.
                        </span>
                    </div>

                </div>


                {{-- ERROR --}}

                <div
                    id="aiError"
                    class="hidden ai-error"
                ></div>


                {{-- AI RESULT --}}

                <div
                    id="aiResult"
                    class="hidden ai-result"
                >

                    {{-- SCORE --}}
                    <div class="ai-score-card">

                        <div class="score-top">

                            <div>

                                <span>
                                    AI SCORE
                                </span>

                                <h3>
                                    Nilai Analisis
                                </h3>

                            </div>

                            <div class="score-icon">
                                ✦
                            </div>

                        </div>

                        <div class="score-number-row">

                            <strong id="aiScore">
                                -
                            </strong>

                            <span>
                                / 100
                            </span>

                        </div>

                        <div class="score-bar">
                            <div id="aiScoreBar"></div>
                        </div>

                    </div>


                    {{-- DEADLINE --}}
                    <div class="result-card">

                        <div class="result-icon yellow">
                            ⏰
                        </div>

                        <span>
                            STATUS DEADLINE
                        </span>

                        <strong id="aiDeadlineStatus">
                            -
                        </strong>

                    </div>


                    {{-- COMPLETENESS --}}
                    <div class="result-card">

                        <div class="result-icon blue">
                            📦
                        </div>

                        <span>
                            KELENGKAPAN
                        </span>

                        <strong id="aiCompleteness">
                            -
                        </strong>

                    </div>


                    {{-- QUALITY --}}
                    <div class="result-card">

                        <div class="result-icon purple">
                            ✨
                        </div>

                        <span>
                            KUALITAS
                        </span>

                        <strong id="aiQuality">
                            -
                        </strong>

                    </div>


                    {{-- SCORE BREAKDOWN --}}
                    <div class="score-breakdown-box">

                        <div class="analysis-label">
                            <span>06</span>
                            BREAKDOWN NILAI NEXA AI
                        </div>

                        <div class="score-breakdown-grid">

                            <div class="score-breakdown-item">
                                <div>
                                    <span>🎯 Kesesuaian Instruksi</span>
                                    <strong id="aiInstructionScore">- / 30</strong>
                                </div>

                                <div class="breakdown-track">
                                    <div
                                        id="aiInstructionBar"
                                        class="breakdown-fill"
                                        style="width: 0%"
                                    ></div>
                                </div>
                            </div>


                            <div class="score-breakdown-item">
                                <div>
                                    <span>📦 Kelengkapan</span>
                                    <strong id="aiCompletenessScore">- / 25</strong>
                                </div>

                                <div class="breakdown-track">
                                    <div
                                        id="aiCompletenessBar"
                                        class="breakdown-fill"
                                        style="width: 0%"
                                    ></div>
                                </div>
                            </div>


                            <div class="score-breakdown-item">
                                <div>
                                    <span>✨ Kualitas</span>
                                    <strong id="aiQualityScore">- / 25</strong>
                                </div>

                                <div class="breakdown-track">
                                    <div
                                        id="aiQualityBar"
                                        class="breakdown-fill"
                                        style="width: 0%"
                                    ></div>
                                </div>
                            </div>


                            <div class="score-breakdown-item">
                                <div>
                                    <span>🧹 Kerapian</span>
                                    <strong id="aiNeatnessScore">- / 10</strong>
                                </div>

                                <div class="breakdown-track">
                                    <div
                                        id="aiNeatnessBar"
                                        class="breakdown-fill"
                                        style="width: 0%"
                                    ></div>
                                </div>
                            </div>


                            <div class="score-breakdown-item">
                                <div>
                                    <span>⏰ Deadline</span>
                                    <strong id="aiDeadlineScore">- / 10</strong>
                                </div>

                                <div class="breakdown-track">
                                    <div
                                        id="aiDeadlineBar"
                                        class="breakdown-fill"
                                        style="width: 0%"
                                    ></div>
                                </div>
                            </div>

                        </div>

                    </div>


                    {{-- SUMMARY --}}
                    <div class="analysis-box full">

                        <div class="analysis-label">
                            <span>01</span>
                            RINGKASAN
                        </div>

                        <p id="aiSummary"></p>

                    </div>


                    {{-- INSTRUCTION --}}
                    <div class="analysis-box full">

                        <div class="analysis-label">
                            <span>02</span>
                            KESESUAIAN DENGAN INSTRUKSI
                        </div>

                        <p id="aiInstructionMatch"></p>

                    </div>


                    {{-- STRENGTHS --}}
                    <div class="analysis-box success-box">

                        <div class="analysis-label">
                            <span>03</span>
                            YANG SUDAH BAIK
                        </div>

                        <p id="aiStrengths"></p>

                    </div>


                    {{-- WEAKNESSES --}}
                    <div class="analysis-box warning-box">

                        <div class="analysis-label">
                            <span>04</span>
                            YANG PERLU DIPERBAIKI
                        </div>

                        <p id="aiWeaknesses"></p>

                    </div>


                    {{-- SUGGESTIONS --}}
                    <div class="analysis-box full">

                        <div class="analysis-label">
                            <span>05</span>
                            SARAN NEXA AI
                        </div>

                        <p id="aiSuggestions"></p>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- TEACHER REVIEW --}}
            {{-- ========================================================= --}}

            <div class="review-section">

                <div class="review-header">

                    <div class="review-title-wrapper">

                        <div class="review-icon">
                            📝
                        </div>

                        <div>

                            <div class="review-eyebrow">
                                TEACHER EVALUATION
                            </div>

                            <h2>
                                Teacher Review
                            </h2>

                            <p>
                                @if($submission->teacherReview)
                                    Penilaian guru sudah disimpan dan dikunci.
                                @else
                                    Berikan nilai akhir dan feedback untuk siswa.
                                @endif
                            </p>

                        </div>

                    </div>

                </div>


                @if(session('success'))

                    <div class="success-alert">

                        <span>✓</span>

                        <div>

                            <strong>
                                Penilaian berhasil disimpan
                            </strong>

                            <p>
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                @endif


                {{-- ===================================================== --}}
                {{-- SUDAH DINILAI --}}
                {{-- ===================================================== --}}

                @if($submission->teacherReview)

                    <div class="locked-review">

                        <div class="locked-review-header">

                            <div class="locked-icon">
                                🔒
                            </div>

                            <div>

                                <span>
                                    PENILAIAN TERKUNCI
                                </span>

                                <strong>
                                    Penilaian guru sudah final
                                </strong>

                            </div>

                        </div>


                        <div class="locked-score">

                            <div>

                                <span>
                                    NILAI AKHIR
                                </span>

                                <strong>
                                    {{ $submission->teacherReview->score }}
                                </strong>

                            </div>

                            <small>
                                / 100
                            </small>

                        </div>


                        <div class="locked-comment">

                            <div class="locked-comment-label">
                                KOMENTAR GURU
                            </div>

                            <div class="locked-comment-content">
                                {{ $submission->teacherReview->comment ?: 'Tidak ada komentar dari guru.' }}
                            </div>

                        </div>


                        <div class="locked-info">
                            🔒 Nilai dan feedback sudah disimpan dan tidak dapat diedit lagi.
                        </div>

                    </div>

                @else

                    {{-- ================================================= --}}
                    {{-- BELUM DINILAI --}}
                    {{-- ================================================= --}}

                    <form
                        action="{{ route('teacher.reviews.store', $submission) }}"
                        method="POST"
                        class="review-form"
                    >

                        @csrf


                        {{-- SCORE --}}

                        <div class="form-group">

                            <label for="score">
                                NILAI AKHIR
                            </label>

                            <div class="score-input-wrapper">

                                <input
                                    type="number"
                                    name="score"
                                    id="score"
                                    min="0"
                                    max="100"
                                    required
                                    placeholder="0 - 100"
                                    value="{{ old('score') }}"
                                >

                                <span>
                                    / 100
                                </span>

                            </div>

                            @error('score')

                                <p class="form-error">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- COMMENT --}}

                        <div class="form-group comment-group">

                            <label for="comment">
                                KOMENTAR GURU
                            </label>

                            <textarea
                                name="comment"
                                id="comment"
                                rows="6"
                                maxlength="5000"
                                placeholder="Tuliskan komentar atau feedback untuk siswa..."
                            >{{ old('comment') }}</textarea>

                            <div class="textarea-footer">
                                Maksimal 5000 karakter
                            </div>

                            @error('comment')

                                <p class="form-error">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <div class="review-submit-row">

                            <p>
                                💡 Setelah disimpan, penilaian akan dikunci.
                            </p>

                            <button
                                type="submit"
                                class="save-review-button"
                            >
                                <span>✓</span>
                                Simpan Penilaian
                            </button>

                        </div>

                    </form>

                @endif

            </div>


            {{-- ========================================================= --}}
            {{-- BOTTOM ACTION --}}
            {{-- ========================================================= --}}

            <div class="bottom-actions">

                <a
                    href="{{ route('teacher.submissions.index', $submission->assignment) }}"
                    class="bottom-back"
                >
                    ← Kembali ke Pengumpulan
                </a>

                <a
                    href="{{ route('teacher.submissions.download', $submission) }}"
                    class="bottom-download"
                >
                    ↓ Download File
                </a>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT AI --}}
    {{-- ========================================================= --}}

    <script>

        function setBreakdown(id, value, max) {

            const scoreElement =
                document.getElementById(id + 'Score');

            const barElement =
                document.getElementById(id + 'Bar');

            if (scoreElement) {

                scoreElement.innerText =
                    value !== null &&
                    value !== undefined
                        ? value + ' / ' + max
                        : '- / ' + max;

            }

            if (barElement) {

                const numericValue =
                    Number(value ?? 0);

                const percentage =
                    Math.max(
                        0,
                        Math.min(
                            100,
                            (numericValue / max) * 100
                        )
                    );

                barElement.style.width =
                    percentage + '%';

            }

        }


        async function analyzeSubmission() {

            const button =
                document.getElementById('analyzeAiButton');

            const loading =
                document.getElementById('aiLoading');

            const error =
                document.getElementById('aiError');

            const result =
                document.getElementById('aiResult');

            const scoreBar =
                document.getElementById('aiScoreBar');


            button.disabled = true;

            button.innerHTML =
                '<span class="button-spinner"></span> Menganalisis...';


            loading.classList.remove('hidden');

            error.classList.add('hidden');

            result.classList.add('hidden');


            try {

                const response = await fetch(
                    "{{ route('ai.analyze', $submission) }}",
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    }
                );


                const data = await response.json();


                if (!response.ok || !data.success) {

                    throw new Error(
                        data.message ||
                        'Analisis AI gagal dilakukan.'
                    );

                }


                const analysis = data.analysis;


                // SCORE

                const score =
                    analysis.score !== null &&
                    analysis.score !== undefined
                        ? analysis.score
                        : null;


                document.getElementById('aiScore').innerText =
                    score !== null
                        ? score
                        : '-';


                if (scoreBar) {

                    scoreBar.style.width =
                        score !== null
                            ? Math.max(
                                0,
                                Math.min(100, score)
                            ) + '%'
                            : '0%';

                }


                // BREAKDOWN

                setBreakdown(
                    'aiInstruction',
                    analysis.instruction_score,
                    30
                );

                setBreakdown(
                    'aiCompleteness',
                    analysis.completeness_score,
                    25
                );

                setBreakdown(
                    'aiQuality',
                    analysis.quality_score,
                    25
                );

                setBreakdown(
                    'aiNeatness',
                    analysis.neatness_score,
                    10
                );

                setBreakdown(
                    'aiDeadline',
                    analysis.deadline_score,
                    10
                );


                // COMPLETENESS

                document.getElementById('aiCompleteness').innerText =
                    analysis.completeness || '-';


                // QUALITY

                document.getElementById('aiQuality').innerText =
                    analysis.quality || '-';


                // DEADLINE

                document.getElementById('aiDeadlineStatus').innerText =
                    analysis.deadline_status || '-';


                // SUMMARY

                document.getElementById('aiSummary').innerText =
                    analysis.summary || '-';


                // INSTRUCTION MATCH

                document.getElementById('aiInstructionMatch').innerText =
                    analysis.instruction_match || '-';


                // STRENGTHS

                document.getElementById('aiStrengths').innerText =
                    analysis.strengths || '-';


                // WEAKNESSES

                document.getElementById('aiWeaknesses').innerText =
                    analysis.weaknesses || '-';


                // SUGGESTIONS

                document.getElementById('aiSuggestions').innerText =
                    analysis.suggestions || '-';


                result.classList.remove('hidden');


            } catch (err) {

                error.innerText =
                    err.message;

                error.classList.remove('hidden');


            } finally {

                loading.classList.add('hidden');

                button.disabled = false;

                button.innerHTML =
                    '<span>✦</span> Analisis dengan NEXA AI';

            }

        }

    </script>


    {{-- ========================================================= --}}
    {{-- STYLE --}}
    {{-- ========================================================= --}}

    <style>

        /* ========================================================= */
        /* HIDDEN ELEMENT */
        /* ========================================================= */

        .hidden {
            display: none !important;
        }


        * {
            box-sizing: border-box;
        }


        .nexa-page {
            position: relative;
            min-height: calc(100vh - 70px);
            padding: 42px 30px 65px;
            overflow: hidden;

            background:
                radial-gradient(
                    circle at 8% 8%,
                    rgba(124,58,237,.18),
                    transparent 29%
                ),
                radial-gradient(
                    circle at 92% 80%,
                    rgba(37,99,235,.13),
                    transparent 31%
                );
        }


        .nexa-container {
            position: relative;
            z-index: 2;
            max-width: 1180px;
            margin: auto;
        }


        .nexa-glow {
            position: fixed;
            width: 430px;
            height: 430px;
            border-radius: 50%;
            filter: blur(125px);
            pointer-events: none;
            opacity: .11;
        }


        .glow-1 {
            background: #7c3aed;
            top: 90px;
            left: -190px;
        }


        .glow-2 {
            background: #2563eb;
            right: -170px;
            bottom: -180px;
        }


        /* HEADER */

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 25px;
            margin-bottom: 27px;
        }


        .eyebrow,
        .ai-eyebrow,
        .review-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #a78bfa;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .16em;
        }


        .eyebrow {
            margin-bottom: 10px;
        }


        .eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #8b5cf6;
            box-shadow: 0 0 13px #8b5cf6;
        }


        .page-title {
            margin: 0;
            color: #f8fafc;
            font-size: clamp(29px, 4vw, 42px);
            line-height: 1.05;
            font-weight: 900;
            letter-spacing: -.045em;
        }


        .page-description {
            margin: 10px 0 0;
            color: #94a3b8;
            font-size: 13px;
        }


        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }


        .back-button,
        .download-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 15px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 750;
            transition: .2s ease;
        }


        .back-button {
            color: #cbd5e1;
            border: 1px solid rgba(148,163,184,.13);
            background: rgba(15,23,42,.65);
        }


        .back-button:hover {
            background: rgba(51,65,85,.5);
            color: white;
        }


        .download-button {
            color: white;
            background: linear-gradient(
                135deg,
                #7c3aed,
                #2563eb
            );
            box-shadow: 0 10px 25px rgba(79,70,229,.22);
        }


        .download-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 32px rgba(79,70,229,.3);
        }


        /* ASSIGNMENT HERO */

        .assignment-hero {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 21px;
            margin-bottom: 20px;
            border: 1px solid rgba(148,163,184,.13);
            border-radius: 22px;
            background:
                linear-gradient(
                    135deg,
                    rgba(30,41,59,.88),
                    rgba(15,23,42,.72)
                );
            box-shadow:
                0 20px 60px rgba(0,0,0,.17),
                inset 0 1px rgba(255,255,255,.03);
            backdrop-filter: blur(22px);
        }


        .hero-icon {
            width: 58px;
            height: 58px;
            flex: 0 0 58px;
            display: grid;
            place-items: center;
            border-radius: 17px;
            background:
                linear-gradient(
                    135deg,
                    rgba(124,58,237,.28),
                    rgba(37,99,235,.2)
                );
            border: 1px solid rgba(139,92,246,.22);
            font-size: 25px;
        }


        .hero-content {
            flex: 1;
            min-width: 0;
        }


        .hero-label {
            color: #64748b;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .15em;
        }


        .hero-content h2 {
            margin: 4px 0 7px;
            color: #f8fafc;
            font-size: 20px;
            font-weight: 850;
        }


        .hero-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #94a3b8;
            font-size: 11px;
        }


        .meta-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #475569;
        }


        .hero-status {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border: 1px solid rgba(34,197,94,.13);
            border-radius: 999px;
            color: #86efac;
            background: rgba(34,197,94,.07);
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .1em;
        }


        .hero-status span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 9px rgba(34,197,94,.8);
        }


        /* INFO */

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 17px;
            margin-bottom: 17px;
        }


        .info-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
            border: 1px solid rgba(148,163,184,.11);
            border-radius: 19px;
            background: rgba(15,23,42,.68);
            backdrop-filter: blur(20px);
        }


        .info-icon {
            width: 46px;
            height: 46px;
            flex: 0 0 46px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            font-size: 18px;
        }


        .student-icon {
            background: rgba(124,58,237,.13);
            border: 1px solid rgba(139,92,246,.15);
        }


        .time-icon {
            background: rgba(37,99,235,.12);
            border: 1px solid rgba(59,130,246,.14);
        }


        .info-content span {
            display: block;
            color: #64748b;
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .13em;
        }


        .info-content strong {
            display: block;
            margin-top: 4px;
            color: #f1f5f9;
            font-size: 13px;
        }


        .info-content small {
            display: block;
            margin-top: 3px;
            color: #64748b;
            font-size: 10px;
        }


        /* CONTENT */

        .content-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 17px;
            margin-bottom: 20px;
        }


        .glass-card {
            padding: 22px;
            border: 1px solid rgba(148,163,184,.11);
            border-radius: 21px;
            background: rgba(15,23,42,.7);
            box-shadow: 0 18px 55px rgba(0,0,0,.13);
            backdrop-filter: blur(22px);
        }


        .section-heading {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 18px;
        }


        .section-icon {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            font-size: 16px;
        }


        .section-icon.blue {
            background: rgba(37,99,235,.13);
            border: 1px solid rgba(59,130,246,.15);
        }


        .section-icon.purple {
            background: rgba(124,58,237,.13);
            border: 1px solid rgba(139,92,246,.15);
        }


        .section-heading span {
            display: block;
            color: #64748b;
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .14em;
        }


        .section-heading h3 {
            margin: 3px 0 0;
            color: #f1f5f9;
            font-size: 15px;
            font-weight: 800;
        }


        .file-display {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px;
            border: 1px solid rgba(148,163,184,.08);
            border-radius: 14px;
            background: rgba(2,6,23,.3);
        }


        .file-large-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            flex: 0 0 43px;
            border-radius: 12px;
            background: rgba(59,130,246,.1);
            font-size: 19px;
        }


        .file-details {
            min-width: 0;
        }


        .file-details strong {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #e2e8f0;
            font-size: 12px;
        }


        .file-details span {
            display: block;
            margin-top: 4px;
            color: #64748b;
            font-size: 10px;
        }


        .note-box {
            min-height: 86px;
            padding: 14px;
            border: 1px solid rgba(148,163,184,.08);
            border-radius: 14px;
            background: rgba(2,6,23,.3);
            color: #cbd5e1;
            font-size: 12px;
            line-height: 1.7;
            white-space: pre-wrap;
        }


        /* AI */

        .ai-section {
            margin-bottom: 20px;
            padding: 25px;
            border: 1px solid rgba(139,92,246,.17);
            border-radius: 24px;
            background:
                radial-gradient(
                    circle at 100% 0%,
                    rgba(124,58,237,.13),
                    transparent 35%
                ),
                rgba(15,23,42,.76);
            box-shadow:
                0 25px 70px rgba(0,0,0,.18),
                inset 0 1px rgba(255,255,255,.035);
            backdrop-filter: blur(24px);
        }


        .ai-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }


        .ai-title-wrapper,
        .review-title-wrapper {
            display: flex;
            align-items: center;
            gap: 13px;
        }


        .ai-logo {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 15px;
            color: #ddd6fe;
            background:
                linear-gradient(
                    135deg,
                    rgba(124,58,237,.3),
                    rgba(37,99,235,.25)
                );
            border: 1px solid rgba(139,92,246,.25);
            font-size: 22px;
            box-shadow: 0 0 28px rgba(124,58,237,.12);
        }


        .ai-eyebrow {
            margin-bottom: 3px;
            font-size: 8px;
        }


        .ai-header h2 {
            margin: 0;
            color: #f8fafc;
            font-size: 19px;
            font-weight: 850;
        }


        .ai-header p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 11px;
        }


        .ai-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 17px;
            border: 0;
            border-radius: 12px;
            color: white;
            background: linear-gradient(
                135deg,
                #7c3aed,
                #2563eb
            );
            box-shadow: 0 12px 28px rgba(79,70,229,.24);
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }


        .ai-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 35px rgba(79,70,229,.3);
        }


        .ai-button:disabled {
            opacity: .65;
            cursor: wait;
            transform: none;
        }


        .button-spinner {
            width: 12px;
            height: 12px;
            border: 2px solid rgba(255,255,255,.35);
            border-top-color: white;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }


        .ai-loading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-top: 20px;
            padding: 16px;
            border: 1px solid rgba(139,92,246,.12);
            border-radius: 14px;
            background: rgba(2,6,23,.32);
        }


        .ai-loader {
            width: 23px;
            height: 23px;
            border: 2px solid rgba(139,92,246,.25);
            border-top-color: #8b5cf6;
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }


        .ai-loading strong {
            display: block;
            color: #e2e8f0;
            font-size: 12px;
        }


        .ai-loading span {
            display: block;
            margin-top: 3px;
            color: #64748b;
            font-size: 10px;
        }


        .ai-error {
            margin-top: 18px;
            padding: 13px 15px;
            border: 1px solid rgba(239,68,68,.17);
            border-radius: 13px;
            color: #fca5a5;
            background: rgba(127,29,29,.15);
            font-size: 11px;
        }


        .ai-result {
            display: grid;
            grid-template-columns: 1.35fr repeat(3, 1fr);
            gap: 13px;
            margin-top: 20px;
        }


        .ai-score-card,
        .result-card,
        .analysis-box,
        .score-breakdown-box {
            border: 1px solid rgba(148,163,184,.09);
            border-radius: 16px;
            background: rgba(2,6,23,.3);
        }


        .ai-score-card {
            padding: 18px;
        }


        .score-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }


        .score-top span {
            color: #a78bfa;
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .12em;
        }


        .score-top h3 {
            margin: 4px 0 0;
            color: #e2e8f0;
            font-size: 12px;
        }


        .score-icon {
            width: 33px;
            height: 33px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            color: #c4b5fd;
            background: rgba(124,58,237,.13);
        }


        .score-number-row {
            display: flex;
            align-items: baseline;
            gap: 5px;
            margin-top: 15px;
        }


        .score-number-row strong {
            color: #f8fafc;
            font-size: 40px;
            line-height: 1;
            font-weight: 900;
        }


        .score-number-row span {
            color: #64748b;
            font-size: 11px;
        }


        .score-bar {
            height: 5px;
            margin-top: 15px;
            overflow: hidden;
            border-radius: 99px;
            background: rgba(51,65,85,.6);
        }


        #aiScoreBar {
            width: 0%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(
                90deg,
                #7c3aed,
                #3b82f6
            );
            transition: width .7s ease;
        }


        .result-card {
            padding: 17px;
        }


        .result-icon {
            width: 35px;
            height: 35px;
            display: grid;
            place-items: center;
            margin-bottom: 14px;
            border-radius: 10px;
        }


        .result-icon.yellow {
            background: rgba(234,179,8,.1);
        }


        .result-icon.blue {
            background: rgba(59,130,246,.1);
        }


        .result-icon.purple {
            background: rgba(124,58,237,.1);
        }


        .result-card > span {
            display: block;
            color: #64748b;
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .1em;
        }


        .result-card > strong {
            display: block;
            margin-top: 6px;
            color: #e2e8f0;
            font-size: 12px;
            line-height: 1.5;
        }


        .score-breakdown-box {
            grid-column: 1 / -1;
            padding: 18px;
        }


        .score-breakdown-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 15px;
        }


        .score-breakdown-item {
            padding: 14px;
            border: 1px solid rgba(148,163,184,.07);
            border-radius: 13px;
            background: rgba(255,255,255,.018);
        }


        .score-breakdown-item > div:first-child {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }


        .score-breakdown-item span {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
        }


        .score-breakdown-item strong {
            color: #e2e8f0;
            font-size: 11px;
            white-space: nowrap;
        }


        .breakdown-track {
            height: 6px;
            margin-top: 10px;
            overflow: hidden;
            border-radius: 99px;
            background: rgba(51,65,85,.55);
        }


        .breakdown-fill {
            width: 0%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(
                90deg,
                #7c3aed,
                #3b82f6
            );
            transition: width .6s ease;
        }


        .analysis-box {
            grid-column: span 2;
            padding: 18px;
        }


        .analysis-box.full {
            grid-column: 1 / -1;
        }


        .analysis-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .11em;
        }


        .analysis-label span {
            display: inline-grid;
            place-items: center;
            width: 21px;
            height: 21px;
            border-radius: 7px;
            color: #a78bfa;
            background: rgba(124,58,237,.1);
            font-size: 8px;
        }


        .analysis-box p {
            margin: 11px 0 0;
            color: #cbd5e1;
            font-size: 12px;
            line-height: 1.75;
            white-space: pre-wrap;
        }


        .success-box {
            border-color: rgba(34,197,94,.1);
        }


        .success-box .analysis-label {
            color: #86efac;
        }


        .success-box .analysis-label span {
            color: #86efac;
            background: rgba(34,197,94,.08);
        }


        .warning-box {
            border-color: rgba(249,115,22,.1);
        }


        .warning-box .analysis-label {
            color: #fdba74;
        }


        .warning-box .analysis-label span {
            color: #fdba74;
            background: rgba(249,115,22,.08);
        }


        /* REVIEW */

        .review-section {
            margin-bottom: 20px;
            border: 1px solid rgba(148,163,184,.11);
            border-radius: 23px;
            background: rgba(15,23,42,.72);
            box-shadow: 0 25px 70px rgba(0,0,0,.17);
            backdrop-filter: blur(23px);
            overflow: hidden;
        }


        .review-header {
            padding: 24px 25px;
            border-bottom: 1px solid rgba(148,163,184,.08);
        }


        .review-icon {
            width: 47px;
            height: 47px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: rgba(37,99,235,.11);
            border: 1px solid rgba(59,130,246,.14);
            font-size: 19px;
        }


        .review-eyebrow {
            color: #60a5fa;
            margin-bottom: 3px;
            font-size: 8px;
        }


        .review-header h2 {
            margin: 0;
            color: #f8fafc;
            font-size: 19px;
            font-weight: 850;
        }


        .review-header p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 11px;
        }


        .success-alert {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            margin: 20px 25px 0;
            padding: 14px;
            border: 1px solid rgba(34,197,94,.14);
            border-radius: 14px;
            color: #86efac;
            background: rgba(34,197,94,.07);
        }


        .success-alert > span {
            width: 25px;
            height: 25px;
            display: grid;
            place-items: center;
            flex: 0 0 25px;
            border-radius: 8px;
            background: rgba(34,197,94,.12);
            font-weight: 900;
        }


        .success-alert strong {
            display: block;
            font-size: 11px;
        }


        .success-alert p {
            margin: 3px 0 0;
            color: #94a3b8;
            font-size: 10px;
        }


        /* LOCKED REVIEW */

        .locked-review {
            margin: 25px;
            padding: 20px;
            border: 1px solid rgba(34,197,94,.12);
            border-radius: 17px;
            background:
                linear-gradient(
                    135deg,
                    rgba(34,197,94,.055),
                    rgba(37,99,235,.035)
                );
        }


        .locked-review-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 17px;
            border-bottom: 1px solid rgba(148,163,184,.08);
        }


        .locked-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: rgba(34,197,94,.1);
            border: 1px solid rgba(34,197,94,.13);
            font-size: 18px;
        }


        .locked-review-header span {
            display: block;
            color: #86efac;
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .12em;
        }


        .locked-review-header strong {
            display: block;
            margin-top: 4px;
            color: #e2e8f0;
            font-size: 13px;
        }


        .locked-score {
            display: flex;
            align-items: baseline;
            gap: 7px;
            margin-top: 20px;
        }


        .locked-score span {
            display: block;
            color: #64748b;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .12em;
        }


        .locked-score strong {
            display: block;
            margin-top: 4px;
            color: #f8fafc;
            font-size: 42px;
            line-height: 1;
            font-weight: 900;
        }


        .locked-score small {
            color: #64748b;
            font-size: 12px;
        }


        .locked-comment {
            margin-top: 20px;
        }


        .locked-comment-label {
            color: #64748b;
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .12em;
        }


        .locked-comment-content {
            margin-top: 8px;
            padding: 14px;
            border: 1px solid rgba(148,163,184,.08);
            border-radius: 13px;
            background: rgba(2,6,23,.3);
            color: #cbd5e1;
            font-size: 12px;
            line-height: 1.7;
            white-space: pre-wrap;
        }


        .locked-info {
            margin-top: 15px;
            padding: 11px 13px;
            border-radius: 11px;
            color: #86efac;
            background: rgba(34,197,94,.055);
            font-size: 10px;
        }


        .review-form {
            padding: 25px;
        }


        .form-group {
            margin-bottom: 20px;
        }


        .form-group label {
            display: block;
            margin-bottom: 9px;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .12em;
        }


        .score-input-wrapper {
            position: relative;
        }


        .score-input-wrapper input {
            width: 100%;
            height: 52px;
            padding: 0 70px 0 15px;
            outline: none;
            border: 1px solid rgba(148,163,184,.13);
            border-radius: 13px;
            color: #f8fafc;
            background: rgba(2,6,23,.38);
            font-size: 15px;
            font-weight: 700;
            transition: .2s ease;
        }


        .score-input-wrapper input:focus,
        .review-form textarea:focus {
            border-color: rgba(139,92,246,.55);
            box-shadow: 0 0 0 3px rgba(124,58,237,.08);
        }


        .score-input-wrapper span {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 11px;
        }


        .review-form textarea {
            width: 100%;
            min-height: 135px;
            resize: vertical;
            padding: 14px 15px;
            outline: none;
            border: 1px solid rgba(148,163,184,.13);
            border-radius: 13px;
            color: #f8fafc;
            background: rgba(2,6,23,.38);
            font-size: 12px;
            line-height: 1.65;
            transition: .2s ease;
        }


        .review-form textarea::placeholder,
        .score-input-wrapper input::placeholder {
            color: #475569;
        }


        .textarea-footer {
            margin-top: 6px;
            color: #475569;
            font-size: 9px;
            text-align: right;
        }


        .form-error {
            margin: 6px 0 0;
            color: #fca5a5;
            font-size: 10px;
        }


        .review-submit-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding-top: 4px;
        }


        .review-submit-row p {
            margin: 0;
            color: #64748b;
            font-size: 10px;
        }


        .save-review-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 18px;
            border: 0;
            border-radius: 12px;
            color: white;
            background: linear-gradient(
                135deg,
                #2563eb,
                #7c3aed
            );
            box-shadow: 0 12px 27px rgba(37,99,235,.18);
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }


        .save-review-button:hover {
            transform: translateY(-1px);
        }


        .save-review-button span {
            font-size: 14px;
        }


        /* BOTTOM */

        .bottom-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }


        .bottom-back,
        .bottom-download {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 17px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 750;
            transition: .2s ease;
        }


        .bottom-back {
            color: #94a3b8;
            border: 1px solid rgba(148,163,184,.12);
            background: rgba(15,23,42,.58);
        }


        .bottom-back:hover {
            color: white;
            background: rgba(51,65,85,.4);
        }


        .bottom-download {
            color: white;
            background: linear-gradient(
                135deg,
                #7c3aed,
                #2563eb
            );
        }


        /* ANIMATION */

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }


        /* RESPONSIVE */

        @media(max-width: 900px) {

            .nexa-page {
                padding: 30px 18px 50px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .header-actions {
                width: 100%;
            }

            .back-button,
            .download-button {
                flex: 1;
            }

            .ai-result {
                grid-template-columns: repeat(2, 1fr);
            }

            .ai-score-card {
                grid-column: 1 / -1;
            }

            .score-breakdown-box {
                grid-column: 1 / -1;
            }

            .analysis-box,
            .analysis-box.full {
                grid-column: 1 / -1;
            }

        }


        @media(max-width: 680px) {

            .nexa-page {
                padding: 24px 13px 40px;
            }

            .page-title {
                font-size: 30px;
            }

            .assignment-hero {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .hero-content {
                width: calc(100% - 78px);
            }

            .hero-status {
                margin-left: 76px;
            }

            .info-grid,
            .content-grid {
                grid-template-columns: 1fr;
            }

            .ai-section {
                padding: 18px;
            }

            .ai-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .ai-button {
                width: 100%;
                justify-content: center;
            }

            .ai-result {
                grid-template-columns: 1fr;
            }

            .ai-score-card {
                grid-column: auto;
            }

            .score-breakdown-box {
                grid-column: auto;
            }

            .score-breakdown-grid {
                grid-template-columns: 1fr;
            }

            .analysis-box,
            .analysis-box.full {
                grid-column: auto;
            }

            .review-submit-row {
                align-items: stretch;
                flex-direction: column;
            }

            .save-review-button {
                width: 100%;
                justify-content: center;
            }

            .locked-review {
                margin: 18px;
            }

        }


        @media(max-width: 450px) {

            .header-actions {
                flex-direction: column;
            }

            .back-button,
            .download-button {
                width: 100%;
            }

            .hero-meta {
                flex-wrap: wrap;
            }

            .bottom-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .bottom-back,
            .bottom-download {
                width: 100%;
            }

            .locked-score strong {
                font-size: 36px;
            }

        }

    </style>

</x-app-layout>