<x-app-layout>

    <x-slot name="header">
        <div>
            <div class="passport-eyebrow">
                <span class="passport-dot"></span>
                NEXA DIGITAL RECORD
            </div>

            <h2 class="passport-title">
                Submission Passport
            </h2>

            <p class="passport-subtitle">
                Identitas digital dan riwayat evaluasi setiap tugas yang kamu kumpulkan.
            </p>
        </div>
    </x-slot>


    <style>
        .passport-page {
            min-height: calc(100vh - 80px);
            padding: 30px 0 70px;
        }

        .passport-container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 25px;
        }

        .passport-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #9d8fff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.8px;
            margin-bottom: 6px;
        }

        .passport-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #7c5cff;
            box-shadow: 0 0 13px rgba(124,92,255,.9);
        }

        .passport-title {
            margin: 0;
            color: #f3f5ff;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.6px;
        }

        .passport-subtitle {
            margin-top: 5px;
            color: #7c859d;
            font-size: 12px;
        }

        .passport-count {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 13px;
            border-radius: 11px;
            color: #aaa0ff;
            background: rgba(124,92,255,.08);
            border: 1px solid rgba(124,92,255,.15);
            font-size: 10px;
            font-weight: 800;
        }

        .passport-card {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            background:
                linear-gradient(
                    145deg,
                    rgba(24,30,53,.98),
                    rgba(12,16,30,.99)
                );
            border: 1px solid rgba(137,149,193,.13);
            box-shadow:
                0 20px 60px rgba(0,0,0,.28),
                inset 0 1px 0 rgba(255,255,255,.025);
        }

        .passport-card::before {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            right: -120px;
            top: -190px;
            border-radius: 50%;
            background: rgba(105,81,255,.15);
            filter: blur(65px);
            pointer-events: none;
        }

        .passport-top {
            position: relative;
            padding: 23px 25px;
            border-bottom: 1px solid rgba(255,255,255,.065);
            background:
                linear-gradient(
                    120deg,
                    rgba(91,75,221,.13),
                    rgba(48,91,210,.04)
                );
        }

        .passport-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .passport-identity {
            display: flex;
            align-items: center;
            gap: 15px;
            min-width: 0;
        }

        .passport-icon {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            color: white;
            background: linear-gradient(135deg,#7055ed,#4776e6);
            box-shadow: 0 10px 28px rgba(85,76,210,.28);
            font-size: 22px;
        }

        .passport-label {
            color: #978aff;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .passport-assignment-title {
            margin-top: 5px;
            color: #eef0fb;
            font-size: 19px;
            font-weight: 800;
            line-height: 1.3;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 12px;
            border-radius: 11px;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-submitted {
            color: #68dda5;
            background: rgba(103,221,165,.07);
            border: 1px solid rgba(103,221,165,.12);
        }

        .status-other {
            color: #e6ba65;
            background: rgba(230,186,101,.07);
            border: 1px solid rgba(230,186,101,.12);
        }

        .status-circle {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            box-shadow: 0 0 8px currentColor;
        }

        .passport-body {
            position: relative;
            padding: 25px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 14px;
        }

        .info-card {
            padding: 19px;
            border-radius: 17px;
            background: rgba(255,255,255,.025);
            border: 1px solid rgba(255,255,255,.06);
        }

        .info-heading {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #e8ebf8;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 17px;
        }

        .info-heading-icon {
            color: #9b8eff;
        }

        .info-row {
            padding: 10px 0;
            border-top: 1px solid rgba(255,255,255,.045);
        }

        .info-label {
            color: #606a83;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .info-value {
            margin-top: 4px;
            color: #e2e5f1;
            font-size: 11px;
            line-height: 1.5;
        }

        .info-value.mono {
            color: #a99cff;
            font-family: monospace;
        }

        .deadline-green {
            color: #67dda5;
        }

        .deadline-red {
            color: #ff7d88;
        }

        .deadline-gray {
            color: #8790a6;
        }

        .timeline-card,
        .evaluation-card,
        .review-card {
            margin-top: 16px;
            padding: 21px;
            border-radius: 18px;
            background: rgba(255,255,255,.022);
            border: 1px solid rgba(255,255,255,.06);
        }

        .section-title {
            color: #e9ecf8;
            font-size: 13px;
            font-weight: 800;
        }

        .section-description {
            margin-top: 3px;
            color: #68728a;
            font-size: 10px;
        }

        .timeline {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 12px;
            margin-top: 20px;
        }

        .timeline-item {
            position: relative;
            padding: 15px;
            border-radius: 14px;
            background: rgba(0,0,0,.12);
            border: 1px solid rgba(255,255,255,.045);
        }

        .timeline-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin-bottom: 11px;
            background: rgba(124,92,255,.08);
            font-size: 14px;
        }

        .timeline-label {
            color: #606a82;
            font-size: 9px;
            font-weight: 700;
        }

        .timeline-value {
            margin-top: 5px;
            color: #e3e6f3;
            font-size: 11px;
            font-weight: 700;
        }

        .completed {
            color: #67dda5;
        }

        .pending {
            color: #e4b65f;
        }

        .complete {
            color: #68caff;
        }

        .evaluation-card {
            border-color: rgba(124,92,255,.15);
            background:
                linear-gradient(
                    145deg,
                    rgba(124,92,255,.055),
                    rgba(255,255,255,.018)
                );
        }

        .evaluation-header,
        .review-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .score-box {
            text-align: right;
        }

        .score-label {
            color: #606a82;
            font-size: 9px;
        }

        .score-number {
            margin-top: 2px;
            color: #a496ff;
            font-size: 27px;
            font-weight: 800;
        }

        .evaluation-grid {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 12px;
            margin-top: 19px;
        }

        .evaluation-item,
        .text-result {
            padding: 15px;
            border-radius: 13px;
            background: rgba(5,8,18,.35);
            border: 1px solid rgba(255,255,255,.045);
        }

        .result-label {
            color: #626c83;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .result-value {
            margin-top: 6px;
            color: #dfe3ef;
            font-size: 11px;
            line-height: 1.6;
        }

        .text-grid {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 12px;
            margin-top: 12px;
        }

        .wide-result {
            margin-top: 12px;
        }

        .pending-box {
            margin-top: 18px;
            padding: 15px;
            border-radius: 13px;
            background: rgba(230,182,72,.05);
            border: 1px solid rgba(230,182,72,.13);
        }

        .pending-title {
            color: #e7bb67;
            font-size: 11px;
            font-weight: 700;
        }

        .pending-text {
            margin-top: 4px;
            color: #727c92;
            font-size: 10px;
        }

        .review-card {
            border-color: rgba(70,137,255,.14);
            background:
                linear-gradient(
                    145deg,
                    rgba(49,108,226,.055),
                    rgba(255,255,255,.018)
                );
        }

        .teacher-score {
            color: #70a8ff;
        }

        .feedback {
            margin-top: 18px;
        }

        .feedback-box {
            margin-top: 7px;
            padding: 15px;
            border-radius: 13px;
            color: #d3d7e4;
            background: rgba(4,8,18,.38);
            border: 1px solid rgba(255,255,255,.045);
            font-size: 11px;
            line-height: 1.7;
        }

        .passport-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 19px;
            padding-top: 19px;
            border-top: 1px solid rgba(255,255,255,.06);
        }

        .passport-id-label {
            color: #5f6981;
            font-size: 9px;
        }

        .passport-id {
            margin-top: 4px;
            color: #a69aff;
            font-family: monospace;
            font-size: 11px;
        }

        .detail-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 16px;
            border-radius: 11px;
            color: #e8eaff;
            background: rgba(255,255,255,.045);
            border: 1px solid rgba(255,255,255,.08);
            text-decoration: none;
            font-size: 10px;
            font-weight: 800;
            transition: .2s ease;
        }

        .detail-button:hover {
            color: white;
            background: rgba(255,255,255,.08);
            transform: translateY(-1px);
        }

        .empty-card {
            padding: 55px 25px;
            text-align: center;
            border-radius: 24px;
            background:
                linear-gradient(
                    145deg,
                    rgba(24,30,53,.98),
                    rgba(12,16,30,.99)
                );
            border: 1px solid rgba(137,149,193,.13);
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: rgba(124,92,255,.08);
            border: 1px solid rgba(124,92,255,.13);
            font-size: 28px;
        }

        .empty-title {
            color: #edf0fb;
            font-size: 18px;
            font-weight: 800;
        }

        .empty-text {
            max-width: 460px;
            margin: 8px auto 0;
            color: #737d95;
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
            box-shadow: 0 10px 25px rgba(84,76,210,.24);
            transition: .2s ease;
        }

        .assignment-button:hover {
            color: white;
            transform: translateY(-1px);
        }

        .passport-stack {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        @media (max-width: 950px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .timeline {
                grid-template-columns: repeat(2,1fr);
            }

            .evaluation-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            .passport-container {
                padding: 0 15px;
            }

            .passport-body {
                padding: 17px;
            }

            .passport-top {
                padding: 19px;
            }

            .passport-top-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .passport-assignment-title {
                font-size: 17px;
            }

            .timeline {
                grid-template-columns: 1fr;
            }

            .text-grid {
                grid-template-columns: 1fr;
            }

            .passport-footer {
                align-items: stretch;
                flex-direction: column;
            }

            .detail-button {
                width: 100%;
            }
        }
    </style>


    <div class="passport-page">

        <div class="passport-container">

            {{-- TOP PAGE INFO --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                <div></div>

                <div class="passport-count">
                    <span>●</span>
                    {{ $submissions->count() }} Submission
                </div>

            </div>


            @if ($submissions->isEmpty())

                {{-- EMPTY STATE --}}
                <div class="empty-card">

                    <div class="empty-icon">
                        🪪
                    </div>

                    <div class="empty-title">
                        Belum Ada Submission
                    </div>

                    <p class="empty-text">
                        Kamu belum memiliki tugas yang dikumpulkan.
                        Setelah mengumpulkan tugas, Submission Passport akan muncul di sini.
                    </p>

                    <a
                        href="{{ route('student.assignments') }}"
                        class="assignment-button"
                    >
                        📚 Lihat Tugas
                    </a>

                </div>

            @else

                <div class="passport-stack">

                    @foreach ($submissions as $submission)

                        @php

                            $assignment = $submission->assignment;
                            $ai = $submission->aiAnalysis;
                            $review = $submission->teacherReview;

                            $deadline = $assignment?->deadline;
                            $submittedAt = $submission->created_at;

                            if (!$deadline) {

                                $deadlineLabel = 'Deadline tidak ditentukan';
                                $deadlineClass = 'deadline-gray';
                                $deadlineIcon = '⚪';

                            } elseif ($submittedAt->lessThanOrEqualTo($deadline)) {

                                $deadlineLabel = 'Dikumpulkan tepat waktu';
                                $deadlineClass = 'deadline-green';
                                $deadlineIcon = '🟢';

                            } else {

                                $deadlineLabel = 'Dikumpulkan terlambat';
                                $deadlineClass = 'deadline-red';
                                $deadlineIcon = '🔴';

                            }

                        @endphp


                        <div class="passport-card">

                            {{-- CARD TOP --}}
                            <div class="passport-top">

                                <div class="passport-top-row">

                                    <div class="passport-identity">

                                        <div class="passport-icon">
                                            🪪
                                        </div>

                                        <div>

                                            <div class="passport-label">
                                                Submission Passport
                                            </div>

                                            <div class="passport-assignment-title">
                                                {{ $assignment?->title ?? 'Tugas' }}
                                            </div>

                                        </div>

                                    </div>


                                    @if ($submission->status === 'submitted')

                                        <div class="status-badge status-submitted">
                                            <span class="status-circle"></span>
                                            Submitted
                                        </div>

                                    @else

                                        <div class="status-badge status-other">
                                            <span class="status-circle"></span>
                                            {{ ucfirst($submission->status) }}
                                        </div>

                                    @endif

                                </div>

                            </div>


                            {{-- BODY --}}
                            <div class="passport-body">


                                {{-- INFORMATION --}}
                                <div class="info-grid">

                                    {{-- IDENTITY --}}
                                    <div class="info-card">

                                        <div class="info-heading">
                                            <span class="info-heading-icon">👤</span>
                                            Identitas Siswa
                                        </div>

                                        <div class="info-row">

                                            <div class="info-label">
                                                Nama
                                            </div>

                                            <div class="info-value">
                                                {{ auth()->user()->name }}
                                            </div>

                                        </div>

                                        <div class="info-row">

                                            <div class="info-label">
                                                Email
                                            </div>

                                            <div class="info-value">
                                                {{ auth()->user()->email }}
                                            </div>

                                        </div>

                                        <div class="info-row">

                                            <div class="info-label">
                                                Submission ID
                                            </div>

                                            <div class="info-value mono">
                                                #{{ str_pad($submission->id, 6, '0', STR_PAD_LEFT) }}
                                            </div>

                                        </div>

                                    </div>


                                    {{-- ASSIGNMENT --}}
                                    <div class="info-card">

                                        <div class="info-heading">
                                            <span class="info-heading-icon">📚</span>
                                            Informasi Tugas
                                        </div>

                                        <div class="info-row">

                                            <div class="info-label">
                                                Mata Pelajaran
                                            </div>

                                            <div class="info-value">
                                                {{ $assignment?->subject ?? '-' }}
                                            </div>

                                        </div>

                                        <div class="info-row">

                                            <div class="info-label">
                                                Kelas
                                            </div>

                                            <div class="info-value">
                                                {{ $assignment?->class_name ?? '-' }}
                                            </div>

                                        </div>

                                        <div class="info-row">

                                            <div class="info-label">
                                                Judul
                                            </div>

                                            <div class="info-value">
                                                {{ $assignment?->title ?? '-' }}
                                            </div>

                                        </div>

                                    </div>


                                    {{-- FILE --}}
                                    <div class="info-card">

                                        <div class="info-heading">
                                            <span class="info-heading-icon">📎</span>
                                            File Submission
                                        </div>

                                        <div class="info-row">

                                            <div class="info-label">
                                                Nama File
                                            </div>

                                            <div class="info-value">
                                                {{ $submission->file_name }}
                                            </div>

                                        </div>

                                        <div class="info-row">

                                            <div class="info-label">
                                                Dikumpulkan
                                            </div>

                                            <div class="info-value">
                                                {{ $submittedAt->format('d M Y, H:i') }}
                                            </div>

                                        </div>

                                        <div class="info-row">

                                            <div class="info-label">
                                                Status Deadline
                                            </div>

                                            <div class="info-value {{ $deadlineClass }}">
                                                {{ $deadlineIcon }}
                                                {{ $deadlineLabel }}
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                {{-- TIMELINE --}}
                                <div class="timeline-card">

                                    <div class="section-title">
                                        Submission Timeline
                                    </div>

                                    <div class="section-description">
                                        Tahapan perjalanan submission kamu di NEXA.
                                    </div>


                                    <div class="timeline">

                                        <div class="timeline-item">

                                            <div class="timeline-icon">
                                                📤
                                            </div>

                                            <div class="timeline-label">
                                                Submitted
                                            </div>

                                            <div class="timeline-value">
                                                {{ $submittedAt->format('d M Y') }}
                                            </div>

                                        </div>


                                        <div class="timeline-item">

                                            <div class="timeline-icon">
                                                🤖
                                            </div>

                                            <div class="timeline-label">
                                                AI Evaluation
                                            </div>

                                            @if ($ai)

                                                <div class="timeline-value completed">
                                                    Completed
                                                </div>

                                            @else

                                                <div class="timeline-value pending">
                                                    Pending
                                                </div>

                                            @endif

                                        </div>


                                        <div class="timeline-item">

                                            <div class="timeline-icon">
                                                👨‍🏫
                                            </div>

                                            <div class="timeline-label">
                                                Teacher Review
                                            </div>

                                            @if ($review)

                                                <div class="timeline-value completed">
                                                    Reviewed
                                                </div>

                                            @else

                                                <div class="timeline-value pending">
                                                    Pending
                                                </div>

                                            @endif

                                        </div>


                                        <div class="timeline-item">

                                            <div class="timeline-icon">
                                                🏁
                                            </div>

                                            <div class="timeline-label">
                                                Passport Status
                                            </div>

                                            @if ($review)

                                                <div class="timeline-value complete">
                                                    Complete
                                                </div>

                                            @else

                                                <div class="timeline-value">
                                                    In Progress
                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </div>


                                {{-- AI EVALUATION --}}
                                <div class="evaluation-card">

                                    <div class="evaluation-header">

                                        <div>

                                            <div class="section-title">
                                                🤖 AI Evaluation
                                            </div>

                                            <div class="section-description">
                                                Hasil analisis AI terhadap submission ini.
                                            </div>

                                        </div>


                                        @if ($ai)

                                            <div class="score-box">

                                                <div class="score-label">
                                                    AI SCORE
                                                </div>

                                                <div class="score-number">
                                                    {{ $ai->score ?? '-' }}
                                                </div>

                                            </div>

                                        @endif

                                    </div>


                                    @if ($ai)

                                        <div class="evaluation-grid">

                                            <div class="evaluation-item">

                                                <div class="result-label">
                                                    Kelengkapan
                                                </div>

                                                <div class="result-value">
                                                    {{ $ai->completeness ?? '-' }}
                                                </div>

                                            </div>

                                            <div class="evaluation-item">

                                                <div class="result-label">
                                                    Kualitas
                                                </div>

                                                <div class="result-value">
                                                    {{ $ai->quality ?? '-' }}
                                                </div>

                                            </div>

                                            <div class="evaluation-item">

                                                <div class="result-label">
                                                    Deadline
                                                </div>

                                                <div class="result-value">
                                                    {{ $ai->deadline_status ?? '-' }}
                                                </div>

                                            </div>

                                        </div>


                                        <div class="text-grid">

                                            <div class="text-result">

                                                <div class="result-label">
                                                    Ringkasan
                                                </div>

                                                <div class="result-value">
                                                    {{ $ai->summary ?? '-' }}
                                                </div>

                                            </div>


                                            <div class="text-result">

                                                <div class="result-label">
                                                    Kesesuaian Instruksi
                                                </div>

                                                <div class="result-value">
                                                    {{ $ai->instruction_match ?? '-' }}
                                                </div>

                                            </div>


                                            <div class="text-result">

                                                <div class="result-label">
                                                    Yang Sudah Baik
                                                </div>

                                                <div class="result-value">
                                                    {{ $ai->strengths ?? '-' }}
                                                </div>

                                            </div>


                                            <div class="text-result">

                                                <div class="result-label">
                                                    Yang Perlu Diperbaiki
                                                </div>

                                                <div class="result-value">
                                                    {{ $ai->weaknesses ?? '-' }}
                                                </div>

                                            </div>

                                        </div>


                                        <div class="text-result wide-result">

                                            <div class="result-label">
                                                Saran AI
                                            </div>

                                            <div class="result-value">
                                                {{ $ai->suggestions ?? '-' }}
                                            </div>

                                        </div>

                                    @else

                                        <div class="pending-box">

                                            <div class="pending-title">
                                                ⏳ Submission belum dianalisis AI
                                            </div>

                                            <div class="pending-text">
                                                Hasil evaluasi akan muncul setelah AI Evaluation dijalankan.
                                            </div>

                                        </div>

                                    @endif

                                </div>


                                {{-- TEACHER REVIEW --}}
                                <div class="review-card">

                                    <div class="review-header">

                                        <div>

                                            <div class="section-title">
                                                👨‍🏫 Teacher Review
                                            </div>

                                            <div class="section-description">
                                                Penilaian akhir dari guru.
                                            </div>

                                        </div>


                                        @if ($review)

                                            <div class="score-box">

                                                <div class="score-label">
                                                    NILAI GURU
                                                </div>

                                                <div class="score-number teacher-score">
                                                    {{ $review->score ?? '-' }}
                                                </div>

                                            </div>

                                        @endif

                                    </div>


                                    @if ($review)

                                        <div class="feedback">

                                            <div class="result-label">
                                                Feedback Guru
                                            </div>

                                            <div class="feedback-box">
                                                {{ $review->comment ?: 'Guru tidak memberikan komentar.' }}
                                            </div>

                                        </div>

                                    @else

                                        <div class="pending-box">

                                            <div class="pending-title">
                                                ⏳ Belum ada penilaian dari guru
                                            </div>

                                            <div class="pending-text">
                                                Nilai dan feedback akan muncul setelah guru melakukan review.
                                            </div>

                                        </div>

                                    @endif

                                </div>


                                {{-- FOOTER --}}
                                <div class="passport-footer">

                                    <div>

                                        <div class="passport-id-label">
                                            PASSPORT ID
                                        </div>

                                        <div class="passport-id">
                                            NEXA-{{ str_pad($submission->id, 8, '0', STR_PAD_LEFT) }}
                                        </div>

                                    </div>


                                    <a
                                        href="{{ route(
                                            'student.assignments.show',
                                            $assignment
                                        ) }}"
                                        class="detail-button"
                                    >
                                        🔎 Lihat Detail Tugas
                                    </a>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    </div>

</x-app-layout>