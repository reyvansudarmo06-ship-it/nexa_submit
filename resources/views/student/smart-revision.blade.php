<x-app-layout>

    <x-slot name="header">
        <div>
            <div class="revision-eyebrow">
                <span class="revision-dot"></span>
                NEXA SMART SYSTEM
            </div>

            <h2 class="revision-title">
                Smart Revision
            </h2>

            <p class="revision-subtitle">
                Rekomendasi perbaikan berdasarkan analisis AI dan feedback guru.
            </p>
        </div>
    </x-slot>


    <style>
        .revision-page {
            min-height: calc(100vh - 80px);
            padding: 30px 0 70px;
        }

        .revision-container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 25px;
        }

        .revision-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #a393ff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.8px;
            margin-bottom: 6px;
        }

        .revision-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #7c5cff;
            box-shadow: 0 0 14px rgba(124,92,255,.9);
        }

        .revision-title {
            margin: 0;
            color: #f2f4ff;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.6px;
        }

        .revision-subtitle {
            margin-top: 5px;
            color: #778198;
            font-size: 12px;
        }

        .revision-stack {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .revision-card {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            background:
                linear-gradient(
                    145deg,
                    rgba(24,30,53,.98),
                    rgba(11,15,29,.99)
                );
            border: 1px solid rgba(137,149,193,.13);
            box-shadow:
                0 20px 60px rgba(0,0,0,.27),
                inset 0 1px 0 rgba(255,255,255,.025);
        }

        .revision-card::before {
            content: "";
            position: absolute;
            width: 330px;
            height: 330px;
            right: -150px;
            top: -200px;
            border-radius: 50%;
            background: rgba(124,92,255,.13);
            filter: blur(70px);
            pointer-events: none;
        }

        .revision-card-top {
            position: relative;
            padding: 22px 25px;
            border-bottom: 1px solid rgba(255,255,255,.06);
            background:
                linear-gradient(
                    120deg,
                    rgba(124,92,255,.09),
                    rgba(245,158,11,.035)
                );
        }

        .revision-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .revision-assignment {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .revision-icon {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-size: 21px;
            background: linear-gradient(135deg,#7055ed,#4776e6);
            box-shadow: 0 10px 28px rgba(85,76,210,.25);
        }

        .revision-label {
            color: #a092ff;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .revision-assignment-title {
            margin-top: 5px;
            color: #edf0fb;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.35;
        }

        .revision-subject {
            margin-top: 4px;
            color: #707a92;
            font-size: 10px;
        }

        .score-box {
            min-width: 80px;
            text-align: center;
            padding: 10px 13px;
            border-radius: 14px;
            background: rgba(245,158,11,.055);
            border: 1px solid rgba(245,158,11,.12);
        }

        .score-label {
            color: #777f93;
            font-size: 8px;
            font-weight: 800;
            letter-spacing: .8px;
        }

        .score-number {
            margin-top: 2px;
            color: #f3a94e;
            font-size: 25px;
            line-height: 1;
            font-weight: 800;
        }

        .revision-body {
            position: relative;
            padding: 25px;
        }

        .no-analysis {
            padding: 38px 25px;
            text-align: center;
            border-radius: 18px;
            background: rgba(255,255,255,.02);
            border: 1px solid rgba(255,255,255,.055);
        }

        .no-analysis-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            background: rgba(245,158,11,.06);
            border: 1px solid rgba(245,158,11,.10);
            font-size: 23px;
        }

        .no-analysis-title {
            color: #dfe3f0;
            font-size: 12px;
            font-weight: 700;
        }

        .no-analysis-text {
            margin-top: 5px;
            color: #68728a;
            font-size: 10px;
        }

        .revision-grid {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 14px;
        }

        .revision-panel {
            padding: 19px;
            border-radius: 17px;
            background: rgba(255,255,255,.022);
            border: 1px solid rgba(255,255,255,.055);
        }

        .panel-red {
            background: rgba(239,68,68,.035);
            border-color: rgba(239,68,68,.13);
        }

        .panel-green {
            background: rgba(34,197,94,.035);
            border-color: rgba(34,197,94,.13);
        }

        .panel-blue {
            background: rgba(37,99,235,.035);
            border-color: rgba(37,99,235,.13);
        }

        .panel-purple {
            background: rgba(124,58,237,.035);
            border-color: rgba(124,58,237,.13);
        }

        .panel-head {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 15px;
        }

        .panel-icon {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: rgba(255,255,255,.045);
            font-size: 15px;
        }

        .panel-title {
            color: #e7eaf5;
            font-size: 12px;
            font-weight: 800;
        }

        .panel-description {
            margin-top: 3px;
            color: #636d83;
            font-size: 9px;
        }

        .panel-content {
            color: #cfd4e1;
            font-size: 11px;
            line-height: 1.75;
        }

        .empty-content {
            color: #646e84;
        }

        .teacher-panel {
            margin-top: 15px;
            padding: 20px;
            border-radius: 18px;
            background:
                linear-gradient(
                    145deg,
                    rgba(6,182,212,.045),
                    rgba(255,255,255,.018)
                );
            border: 1px solid rgba(6,182,212,.14);
        }

        .teacher-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .teacher-title-wrap {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .teacher-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(6,182,212,.08);
            font-size: 16px;
        }

        .teacher-title {
            color: #e8ebf6;
            font-size: 12px;
            font-weight: 800;
        }

        .teacher-description {
            margin-top: 3px;
            color: #647087;
            font-size: 9px;
        }

        .teacher-score {
            text-align: right;
        }

        .teacher-score-label {
            color: #647087;
            font-size: 8px;
            font-weight: 700;
        }

        .teacher-score-number {
            color: #65d4e8;
            font-size: 24px;
            font-weight: 800;
        }

        .teacher-comment {
            margin-top: 17px;
            padding: 15px;
            border-radius: 13px;
            background: rgba(3,8,18,.32);
            border: 1px solid rgba(255,255,255,.045);
            color: #cdd2df;
            font-size: 11px;
            line-height: 1.7;
        }

        .no-feedback {
            color: #626c82;
            font-size: 10px;
        }

        .revision-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 19px;
            padding-top: 19px;
            border-top: 1px solid rgba(255,255,255,.055);
        }

        .revision-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 16px;
            border-radius: 11px;
            color: white;
            text-decoration: none;
            font-size: 10px;
            font-weight: 800;
            transition: .2s ease;
        }

        .revision-button:hover {
            color: white;
            transform: translateY(-1px);
        }

        .button-primary {
            background: linear-gradient(135deg,#7055ed,#4776e6);
            box-shadow: 0 9px 22px rgba(84,76,210,.22);
        }

        .button-secondary {
            background: rgba(255,255,255,.045);
            border: 1px solid rgba(255,255,255,.08);
        }

        .empty-card {
            padding: 55px 25px;
            text-align: center;
            border-radius: 24px;
            background:
                linear-gradient(
                    145deg,
                    rgba(24,30,53,.98),
                    rgba(11,15,29,.99)
                );
            border: 1px solid rgba(137,149,193,.13);
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: rgba(124,92,255,.07);
            border: 1px solid rgba(124,92,255,.13);
            font-size: 28px;
        }

        .empty-title {
            color: #edf0fb;
            font-size: 18px;
            font-weight: 800;
        }

        .empty-text {
            max-width: 450px;
            margin: 8px auto 0;
            color: #707a91;
            font-size: 11px;
            line-height: 1.7;
        }

        .assignment-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
            padding: 12px 18px;
            border-radius: 12px;
            color: white;
            background: linear-gradient(135deg,#7055ed,#4776e6);
            text-decoration: none;
            font-size: 11px;
            font-weight: 800;
            box-shadow: 0 10px 25px rgba(84,76,210,.23);
            transition: .2s ease;
        }

        .assignment-button:hover {
            color: white;
            transform: translateY(-1px);
        }

        @media (max-width: 850px) {
            .revision-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            .revision-container {
                padding: 0 15px;
            }

            .revision-card-top,
            .revision-body {
                padding: 18px;
            }

            .revision-top-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .score-box {
                align-self: flex-start;
            }

            .revision-assignment-title {
                font-size: 16px;
            }

            .revision-actions {
                flex-direction: column;
            }

            .revision-button {
                width: 100%;
            }
        }
    </style>


    <div class="revision-page">

        <div class="revision-container">

            @if ($submissions->isEmpty())

                {{-- EMPTY STATE --}}
                <div class="empty-card">

                    <div class="empty-icon">
                        🔧
                    </div>

                    <div class="empty-title">
                        Belum Ada Data
                    </div>

                    <p class="empty-text">
                        Kumpulkan tugas terlebih dahulu untuk mendapatkan rekomendasi revisi.
                    </p>

                    <a
                        href="{{ route('student.assignments') }}"
                        class="assignment-button"
                    >
                        📚 Lihat Tugas
                    </a>

                </div>

            @else

                <div class="revision-stack">

                    @foreach ($submissions as $submission)

                        @php

                            $ai = $submission->aiAnalysis;
                            $review = $submission->teacherReview;

                            $hasRevision =
                                $ai ||
                                $review;

                        @endphp


                        <div class="revision-card">

                            {{-- HEADER --}}
                            <div class="revision-card-top">

                                <div class="revision-top-row">

                                    <div class="revision-assignment">

                                        <div class="revision-icon">
                                            🔧
                                        </div>

                                        <div>

                                            <div class="revision-label">
                                                Smart Revision
                                            </div>

                                            <div class="revision-assignment-title">
                                                {{ $submission->assignment?->title ?? 'Tugas' }}
                                            </div>

                                            <div class="revision-subject">
                                                {{ $submission->assignment?->subject ?? '-' }}
                                            </div>

                                        </div>

                                    </div>


                                    @if ($ai && $ai->score !== null)

                                        <div class="score-box">

                                            <div class="score-label">
                                                AI SCORE
                                            </div>

                                            <div class="score-number">
                                                {{ $ai->score }}
                                            </div>

                                        </div>

                                    @endif

                                </div>

                            </div>


                            {{-- BODY --}}
                            <div class="revision-body">

                                @if (!$hasRevision)

                                    <div class="no-analysis">

                                        <div class="no-analysis-icon">
                                            ⏳
                                        </div>

                                        <div class="no-analysis-title">
                                            Belum ada hasil AI atau feedback guru.
                                        </div>

                                        <div class="no-analysis-text">
                                            Data revisi akan muncul setelah submission mendapatkan evaluasi.
                                        </div>

                                    </div>

                                @else

                                    <div class="revision-grid">

                                        {{-- WEAKNESSES --}}
                                        <div class="revision-panel panel-red">

                                            <div class="panel-head">

                                                <div class="panel-icon">
                                                    ⚠️
                                                </div>

                                                <div>

                                                    <div class="panel-title">
                                                        Yang Perlu Diperbaiki
                                                    </div>

                                                    <div class="panel-description">
                                                        Berdasarkan analisis AI
                                                    </div>

                                                </div>

                                            </div>

                                            @if ($ai && $ai->weaknesses)

                                                <div class="panel-content">
                                                    {{ $ai->weaknesses }}
                                                </div>

                                            @else

                                                <div class="panel-content empty-content">
                                                    Belum ada catatan AI.
                                                </div>

                                            @endif

                                        </div>


                                        {{-- SUGGESTIONS --}}
                                        <div class="revision-panel panel-green">

                                            <div class="panel-head">

                                                <div class="panel-icon">
                                                    💡
                                                </div>

                                                <div>

                                                    <div class="panel-title">
                                                        Saran Perbaikan
                                                    </div>

                                                    <div class="panel-description">
                                                        Rekomendasi dari AI
                                                    </div>

                                                </div>

                                            </div>

                                            @if ($ai && $ai->suggestions)

                                                <div class="panel-content">
                                                    {{ $ai->suggestions }}
                                                </div>

                                            @else

                                                <div class="panel-content empty-content">
                                                    Belum ada saran AI.
                                                </div>

                                            @endif

                                        </div>


                                        {{-- COMPLETENESS --}}
                                        <div class="revision-panel panel-blue">

                                            <div class="panel-head">

                                                <div class="panel-icon">
                                                    📋
                                                </div>

                                                <div>

                                                    <div class="panel-title">
                                                        Kelengkapan
                                                    </div>

                                                    <div class="panel-description">
                                                        Pemeriksaan isi tugas
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="panel-content">
                                                {{ $ai?->completeness ?? 'Belum dianalisis.' }}
                                            </div>

                                        </div>


                                        {{-- QUALITY --}}
                                        <div class="revision-panel panel-purple">

                                            <div class="panel-head">

                                                <div class="panel-icon">
                                                    ✨
                                                </div>

                                                <div>

                                                    <div class="panel-title">
                                                        Kualitas
                                                    </div>

                                                    <div class="panel-description">
                                                        Evaluasi kualitas hasil
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="panel-content">
                                                {{ $ai?->quality ?? 'Belum dianalisis.' }}
                                            </div>

                                        </div>

                                    </div>


                                    {{-- TEACHER FEEDBACK --}}
                                    <div class="teacher-panel">

                                        <div class="teacher-head">

                                            <div class="teacher-title-wrap">

                                                <div class="teacher-icon">
                                                    👨‍🏫
                                                </div>

                                                <div>

                                                    <div class="teacher-title">
                                                        Feedback Guru
                                                    </div>

                                                    <div class="teacher-description">
                                                        Catatan revisi dan penilaian dari guru
                                                    </div>

                                                </div>

                                            </div>


                                            @if ($review && $review->score !== null)

                                                <div class="teacher-score">

                                                    <div class="teacher-score-label">
                                                        NILAI
                                                    </div>

                                                    <div class="teacher-score-number">
                                                        {{ $review->score }}
                                                    </div>

                                                </div>

                                            @endif

                                        </div>


                                        <div class="teacher-comment">

                                            @if ($review && $review->comment)

                                                {{ $review->comment }}

                                            @else

                                                <span class="no-feedback">
                                                    Belum ada feedback dari guru.
                                                </span>

                                            @endif

                                        </div>

                                    </div>


                                    {{-- ACTIONS --}}
                                    <div class="revision-actions">

                                        <a
                                            href="{{ route('student.assignments.show', $submission->assignment) }}"
                                            class="revision-button button-primary"
                                        >
                                            🔎 Lihat Submission
                                        </a>

                                        <a
                                            href="{{ route('student.submission-passport') }}"
                                            class="revision-button button-secondary"
                                        >
                                            🪪 Buka Passport
                                        </a>

                                    </div>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    </div>

</x-app-layout>