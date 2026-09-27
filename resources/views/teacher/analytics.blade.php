<x-app-layout>

    <style>
        .nexa-analytics {
            min-height: calc(100vh - 80px);
            padding: 34px;
            color: #f8fafc;
            background:
                radial-gradient(circle at 85% 0%, rgba(99,102,241,.18), transparent 28%),
                radial-gradient(circle at 10% 85%, rgba(6,182,212,.08), transparent 30%),
                #070a12;
        }

        .nexa-analytics-container {
            max-width: 1250px;
            margin: 0 auto;
        }

        /* HERO */

        .analytics-hero {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 28px;
        }

        .analytics-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(99,102,241,.10);
            border: 1px solid rgba(129,140,248,.22);
            color: #a5b4fc;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .7px;
            margin-bottom: 13px;
        }

        .analytics-hero h1 {
            margin: 0;
            font-size: 34px;
            line-height: 1.15;
            font-weight: 850;
            letter-spacing: -.8px;
        }

        .analytics-hero p {
            margin: 9px 0 0;
            color: #94a3b8;
            font-size: 14px;
            max-width: 700px;
        }

        .analytics-status {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 10px 14px;
            border-radius: 14px;
            background: rgba(15,23,42,.65);
            border: 1px solid rgba(148,163,184,.12);
            color: #94a3b8;
            font-size: 11px;
            white-space: nowrap;
        }

        .analytics-status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 12px rgba(34,197,94,.8);
        }

        /* STATISTICS */

        .analytics-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 17px;
            margin-bottom: 22px;
        }

        .analytics-stat {
            position: relative;
            overflow: hidden;
            padding: 21px;
            border-radius: 19px;
            background:
                linear-gradient(
                    145deg,
                    rgba(18,25,43,.92),
                    rgba(10,14,25,.88)
                );
            border: 1px solid rgba(148,163,184,.12);
            box-shadow: 0 16px 45px rgba(0,0,0,.16);
        }

        .analytics-stat::after {
            content: "";
            position: absolute;
            width: 100px;
            height: 100px;
            right: -45px;
            top: -45px;
            border-radius: 50%;
            background: rgba(99,102,241,.10);
            filter: blur(4px);
        }

        .analytics-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .analytics-stat-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: rgba(99,102,241,.12);
            border: 1px solid rgba(129,140,248,.18);
            font-size: 19px;
        }

        .analytics-stat-tag {
            color: #475569;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .6px;
        }

        .analytics-stat-label {
            color: #94a3b8;
            font-size: 12px;
        }

        .analytics-stat-value {
            margin-top: 4px;
            font-size: 29px;
            font-weight: 850;
            letter-spacing: -.5px;
        }

        /* MAIN GRID */

        .analytics-main-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* CARD */

        .nexa-analytics-card {
            overflow: hidden;
            padding: 23px;
            border-radius: 22px;
            background: rgba(11,16,29,.82);
            border: 1px solid rgba(148,163,184,.12);
            box-shadow: 0 25px 70px rgba(0,0,0,.20);
            backdrop-filter: blur(18px);
        }

        .analytics-card-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 6px;
        }

        .analytics-card-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(
                135deg,
                rgba(99,102,241,.18),
                rgba(6,182,212,.10)
            );
            border: 1px solid rgba(129,140,248,.16);
        }

        .analytics-card-title {
            font-size: 17px;
            font-weight: 800;
        }

        .analytics-card-subtitle {
            color: #64748b;
            font-size: 11px;
            margin-bottom: 20px;
        }

        /* SCORE */

        .analytics-score-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .score-card {
            padding: 18px;
            border-radius: 16px;
            background: #090f1c;
            border: 1px solid rgba(148,163,184,.09);
        }

        .score-card-label {
            color: #64748b;
            font-size: 10px;
            margin-bottom: 9px;
        }

        .score-card-value {
            font-size: 26px;
            font-weight: 850;
        }

        .score-average {
            color: #a5b4fc;
        }

        .score-high {
            color: #4ade80;
        }

        .score-low {
            color: #f87171;
        }

        /* STATUS */

        .submission-status-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .submission-status {
            padding: 16px;
            border-radius: 16px;
            background: #090f1c;
            border: 1px solid rgba(148,163,184,.09);
        }

        .submission-status-label {
            color: #64748b;
            font-size: 10px;
            margin-bottom: 7px;
        }

        .submission-status-value {
            font-size: 24px;
            font-weight: 850;
        }

        .status-reviewed {
            color: #4ade80;
        }

        .status-pending {
            color: #facc15;
        }

        .status-late {
            color: #f87171;
        }

        .status-total {
            color: #60a5fa;
        }

        /* ASSIGNMENT */

        .assignment-analytics {
            margin-top: 0;
        }

        .assignment-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .assignment-item {
            padding: 16px;
            border-radius: 16px;
            background: #090f1c;
            border: 1px solid rgba(148,163,184,.08);
            transition: border-color .2s ease,
                        background .2s ease;
        }

        .assignment-item:hover {
            background: rgba(99,102,241,.045);
            border-color: rgba(129,140,248,.17);
        }

        .assignment-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .assignment-name {
            color: #e2e8f0;
            font-size: 14px;
            font-weight: 700;
        }

        .assignment-percent {
            padding: 5px 9px;
            border-radius: 999px;
            background: rgba(99,102,241,.10);
            color: #a5b4fc;
            font-size: 10px;
            font-weight: 800;
        }

        .assignment-meta {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
            color: #64748b;
            font-size: 10px;
        }

        .progress-track {
            height: 7px;
            margin-top: 11px;
            overflow: hidden;
            border-radius: 999px;
            background: #172033;
        }

        .progress-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(
                90deg,
                #6366f1,
                #06b6d4
            );
            box-shadow: 0 0 12px rgba(99,102,241,.22);
        }

        /* EMPTY */

        .analytics-empty {
            padding: 50px 20px;
            text-align: center;
            color: #64748b;
        }

        .analytics-empty-icon {
            width: 55px;
            height: 55px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            background: rgba(99,102,241,.08);
            border: 1px solid rgba(129,140,248,.12);
            font-size: 22px;
        }

        .analytics-empty-title {
            color: #e2e8f0;
            font-size: 15px;
            font-weight: 750;
        }

        .analytics-empty-text {
            margin-top: 5px;
            font-size: 11px;
        }

        /* RESPONSIVE */

        @media (max-width: 1050px) {

            .analytics-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .analytics-main-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {

            .nexa-analytics {
                padding: 20px 14px;
            }

            .analytics-hero {
                flex-direction: column;
                align-items: flex-start;
            }

            .analytics-hero h1 {
                font-size: 27px;
            }

            .analytics-stats {
                grid-template-columns: 1fr;
            }

            .analytics-score-grid {
                grid-template-columns: 1fr;
            }

            .submission-status-grid {
                grid-template-columns: 1fr 1fr;
            }

            .nexa-analytics-card {
                padding: 18px;
            }
        }

        @media (max-width: 430px) {

            .submission-status-grid {
                grid-template-columns: 1fr;
            }

            .assignment-top {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>


    <div class="nexa-analytics">

        <div class="nexa-analytics-container">

            {{-- HERO --}}

            <div class="analytics-hero">

                <div>

                    <div class="analytics-eyebrow">
                        📊 NEXA TEACHER ANALYTICS
                    </div>

                    <h1>
                        Analytics Kelas
                    </h1>

                    <p>
                        Pantau aktivitas tugas, pengumpulan siswa,
                        evaluasi AI, dan review guru dalam satu dashboard.
                    </p>

                </div>

                <div class="analytics-status">
                    <span class="analytics-status-dot"></span>
                    Analytics Aktif
                </div>

            </div>


            {{-- STATISTICS --}}

            <div class="analytics-stats">

                <div class="analytics-stat">

                    <div class="analytics-stat-top">

                        <div class="analytics-stat-icon">
                            👥
                        </div>

                        <span class="analytics-stat-tag">
                            STUDENTS
                        </span>

                    </div>

                    <div class="analytics-stat-label">
                        Total Siswa
                    </div>

                    <div class="analytics-stat-value">
                        {{ $totalStudents }}
                    </div>

                </div>


                <div class="analytics-stat">

                    <div class="analytics-stat-top">

                        <div class="analytics-stat-icon">
                            📚
                        </div>

                        <span class="analytics-stat-tag">
                            ACTIVE
                        </span>

                    </div>

                    <div class="analytics-stat-label">
                        Tugas Aktif
                    </div>

                    <div class="analytics-stat-value">
                        {{ $totalAssignments }}
                    </div>

                </div>


                <div class="analytics-stat">

                    <div class="analytics-stat-top">

                        <div class="analytics-stat-icon">
                            📤
                        </div>

                        <span class="analytics-stat-tag">
                            SUBMISSIONS
                        </span>

                    </div>

                    <div class="analytics-stat-label">
                        Total Submission
                    </div>

                    <div class="analytics-stat-value">
                        {{ $totalSubmissions }}
                    </div>

                </div>


                <div class="analytics-stat">

                    <div class="analytics-stat-top">

                        <div class="analytics-stat-icon">
                            🤖
                        </div>

                        <span class="analytics-stat-tag">
                            NEXA AI
                        </span>

                    </div>

                    <div class="analytics-stat-label">
                        Dianalisis AI
                    </div>

                    <div class="analytics-stat-value">
                        {{ $totalAiAnalyzed }}
                    </div>

                </div>

            </div>


            {{-- MAIN ANALYTICS --}}

            <div class="analytics-main-grid">

                {{-- AI EVALUATION --}}

                <div class="nexa-analytics-card">

                    <div class="analytics-card-heading">

                        <div class="analytics-card-icon">
                            🤖
                        </div>

                        <div class="analytics-card-title">
                            AI Evaluation
                        </div>

                    </div>

                    <div class="analytics-card-subtitle">
                        Statistik hasil evaluasi NEXA AI
                    </div>


                    <div class="analytics-score-grid">

                        <div class="score-card">

                            <div class="score-card-label">
                                Rata-rata Score
                            </div>

                            <div class="score-card-value score-average">
                                {{ $averageAiScore !== null ? number_format($averageAiScore, 1) : '-' }}
                            </div>

                        </div>


                        <div class="score-card">

                            <div class="score-card-label">
                                Score Tertinggi
                            </div>

                            <div class="score-card-value score-high">
                                {{ $highestAiScore ?? '-' }}
                            </div>

                        </div>


                        <div class="score-card">

                            <div class="score-card-label">
                                Score Terendah
                            </div>

                            <div class="score-card-value score-low">
                                {{ $lowestAiScore ?? '-' }}
                            </div>

                        </div>

                    </div>

                </div>


                {{-- SUBMISSION STATUS --}}

                <div class="nexa-analytics-card">

                    <div class="analytics-card-heading">

                        <div class="analytics-card-icon">
                            📋
                        </div>

                        <div class="analytics-card-title">
                            Submission Status
                        </div>

                    </div>

                    <div class="analytics-card-subtitle">
                        Kondisi pengumpulan tugas siswa
                    </div>


                    <div class="submission-status-grid">

                        <div class="submission-status">

                            <div class="submission-status-label">
                                Sudah Direview
                            </div>

                            <div class="submission-status-value status-reviewed">
                                {{ $totalReviewed }}
                            </div>

                        </div>


                        <div class="submission-status">

                            <div class="submission-status-label">
                                Menunggu Review
                            </div>

                            <div class="submission-status-value status-pending">
                                {{ $pendingReview }}
                            </div>

                        </div>


                        <div class="submission-status">

                            <div class="submission-status-label">
                                Terlambat
                            </div>

                            <div class="submission-status-value status-late">
                                {{ $lateSubmissions }}
                            </div>

                        </div>


                        <div class="submission-status">

                            <div class="submission-status-label">
                                Total Submission
                            </div>

                            <div class="submission-status-value status-total">
                                {{ $totalSubmissions }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ASSIGNMENT ANALYTICS --}}

            <div class="nexa-analytics-card assignment-analytics">

                <div class="analytics-card-heading">

                    <div class="analytics-card-icon">
                        📚
                    </div>

                    <div class="analytics-card-title">
                        Aktivitas Tugas
                    </div>

                </div>

                <div class="analytics-card-subtitle">
                    Jumlah submission pada setiap tugas aktif
                </div>


                @if($assignmentStats->count() > 0)

                    <div class="assignment-list">

                        @foreach($assignmentStats as $assignment)

                            @php
                                $percentage = $totalStudents > 0
                                    ? min(
                                        100,
                                        ($assignment->submissions_count / $totalStudents) * 100
                                    )
                                    : 0;
                            @endphp

                            <div class="assignment-item">

                                <div class="assignment-top">

                                    <div class="assignment-name">
                                        {{ $assignment->title }}
                                    </div>

                                    <div class="assignment-percent">
                                        {{ number_format($percentage, 0) }}%
                                    </div>

                                </div>


                                <div class="assignment-meta">

                                    <span>
                                        {{ $assignment->submissions_count }}
                                        submission
                                    </span>

                                    <span>
                                        dari {{ $totalStudents }} siswa
                                    </span>

                                </div>


                                <div class="progress-track">

                                    <div
                                        class="progress-fill"
                                        style="width: {{ $percentage }}%;"
                                    ></div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="analytics-empty">

                        <div class="analytics-empty-icon">
                            📚
                        </div>

                        <div class="analytics-empty-title">
                            Belum Ada Tugas Aktif
                        </div>

                        <div class="analytics-empty-text">
                            Belum ada aktivitas tugas yang dapat dianalisis.
                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>