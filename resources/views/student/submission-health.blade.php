<x-app-layout>

    <x-slot name="header">
        <div>
            <div class="health-eyebrow">
                <span class="health-dot"></span>
                NEXA MONITORING
            </div>

            <h2 class="health-title">
                Submission Health
            </h2>

            <p class="health-subtitle">
                Pantau kondisi pengumpulan tugas kamu secara real-time.
            </p>
        </div>
    </x-slot>


    <style>
        .health-page {
            min-height: calc(100vh - 80px);
            padding: 30px 0 70px;
        }

        .health-container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 25px;
        }

        .health-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #9c8dff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.8px;
            margin-bottom: 6px;
        }

        .health-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #7c5cff;
            box-shadow: 0 0 13px rgba(124,92,255,.9);
        }

        .health-title {
            margin: 0;
            color: #f4f6ff;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.6px;
        }

        .health-subtitle {
            margin-top: 5px;
            color: #7d879f;
            font-size: 12px;
        }

        .health-hero {
            position: relative;
            overflow: hidden;
            padding: 28px;
            border-radius: 24px;
            background:
                linear-gradient(
                    135deg,
                    rgba(28,34,61,.98),
                    rgba(13,17,33,.98)
                );
            border: 1px solid rgba(135,148,195,.14);
            box-shadow:
                0 20px 60px rgba(0,0,0,.28),
                inset 0 1px 0 rgba(255,255,255,.025);
        }

        .health-hero::before {
            content: "";
            position: absolute;
            width: 330px;
            height: 330px;
            right: -100px;
            top: -190px;
            border-radius: 50%;
            background: rgba(101,79,255,.16);
            filter: blur(60px);
            pointer-events: none;
        }

        .health-hero-content {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
        }

        .hero-label {
            color: #8f82f5;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .hero-heading {
            margin-top: 7px;
            color: #f0f2ff;
            font-size: 24px;
            font-weight: 800;
        }

        .hero-text {
            margin-top: 6px;
            color: #7c859d;
            font-size: 12px;
        }

        .hero-status {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 17px;
            border-radius: 14px;
            background: rgba(103,221,165,.055);
            border: 1px solid rgba(103,221,165,.13);
            color: #70dda8;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-pulse {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #67dda5;
            box-shadow: 0 0 12px rgba(103,221,165,.8);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 15px;
            margin-top: 17px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            padding: 20px;
            min-height: 125px;
            border-radius: 19px;
            background: rgba(18,23,42,.92);
            border: 1px solid rgba(139,151,190,.1);
            box-shadow: 0 12px 30px rgba(0,0,0,.17);
        }

        .stat-card::after {
            content: "";
            position: absolute;
            width: 90px;
            height: 90px;
            right: -45px;
            bottom: -45px;
            border-radius: 50%;
            background: rgba(124,92,255,.08);
            filter: blur(20px);
        }

        .stat-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(124,92,255,.09);
            border: 1px solid rgba(124,92,255,.13);
            color: #a99cff;
            font-size: 15px;
        }

        .stat-label {
            margin-top: 13px;
            color: #737d96;
            font-size: 10px;
            font-weight: 700;
        }

        .stat-value {
            margin-top: 3px;
            color: #eef1fc;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.6px;
        }

        .progress-card {
            margin-top: 17px;
            padding: 23px;
            border-radius: 19px;
            background: rgba(18,23,42,.92);
            border: 1px solid rgba(139,151,190,.1);
        }

        .section-heading {
            color: #edf0fb;
            font-size: 14px;
            font-weight: 800;
        }

        .section-description {
            margin-top: 3px;
            color: #68728a;
            font-size: 10px;
        }

        .progress-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 18px;
            margin-bottom: 9px;
        }

        .progress-label {
            color: #929bb1;
            font-size: 11px;
            font-weight: 700;
        }

        .progress-percent {
            color: #a899ff;
            font-size: 13px;
            font-weight: 800;
        }

        .progress-track {
            width: 100%;
            height: 10px;
            overflow: hidden;
            border-radius: 99px;
            background: rgba(255,255,255,.055);
        }

        .progress-bar {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg,#7055ed,#4e83f2);
            box-shadow: 0 0 18px rgba(98,81,231,.35);
            transition: width .5s ease;
        }

        .columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 17px;
            margin-top: 17px;
        }

        .health-card {
            min-width: 0;
            padding: 23px;
            border-radius: 19px;
            background: rgba(18,23,42,.92);
            border: 1px solid rgba(139,151,190,.1);
        }

        .card-heading-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 14px;
        }

        .count-badge {
            min-width: 27px;
            height: 27px;
            padding: 0 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            color: #a89aff;
            background: rgba(124,92,255,.09);
            border: 1px solid rgba(124,92,255,.13);
            font-size: 10px;
            font-weight: 800;
        }

        .assignment-item,
        .submission-item {
            padding: 15px 0;
            border-top: 1px solid rgba(255,255,255,.055);
        }

        .item-main {
            min-width: 0;
        }

        .item-title {
            color: #e7eaf7;
            font-size: 12px;
            font-weight: 800;
            line-height: 1.45;
        }

        .item-subtitle {
            margin-top: 4px;
            color: #6e7890;
            font-size: 10px;
        }

        .assignment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
        }

        .view-button {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 13px;
            border-radius: 9px;
            color: #dfe3ff;
            background: rgba(76,102,224,.12);
            border: 1px solid rgba(87,111,229,.18);
            text-decoration: none;
            font-size: 10px;
            font-weight: 800;
            transition: .2s ease;
        }

        .view-button:hover {
            background: rgba(76,102,224,.2);
            color: white;
            transform: translateY(-1px);
        }

        .status-line {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-top: 7px;
            color: #78839b;
            font-size: 10px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #7d879c;
        }

        .status-green {
            color: #67dda5;
        }

        .status-green .status-dot {
            background: #67dda5;
            box-shadow: 0 0 8px rgba(103,221,165,.6);
        }

        .status-yellow {
            color: #e7b65d;
        }

        .status-yellow .status-dot {
            background: #e7b65d;
        }

        .status-blue {
            color: #76a9ff;
        }

        .status-blue .status-dot {
            background: #76a9ff;
        }

        .empty-state {
            padding: 28px 12px;
            text-align: center;
            color: #69738b;
            font-size: 11px;
        }

        .empty-icon {
            margin-bottom: 8px;
            font-size: 23px;
        }

        @media (max-width: 900px) {
            .stats-grid {
                grid-template-columns: repeat(2,1fr);
            }

            .columns {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .health-container {
                padding: 0 15px;
            }

            .health-hero {
                padding: 21px;
            }

            .health-hero-content {
                align-items: flex-start;
                flex-direction: column;
            }

            .hero-heading {
                font-size: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 15px;
                min-height: 110px;
            }

            .stat-value {
                font-size: 23px;
            }

            .health-card,
            .progress-card {
                padding: 18px;
            }
        }
    </style>


    <div class="health-page">

        <div class="health-container">

            {{-- HERO --}}
            <div class="health-hero">

                <div class="health-hero-content">

                    <div>
                        <div class="hero-label">
                            Student Submission Monitor
                        </div>

                        <div class="hero-heading">
                            Kondisi Pengumpulan Tugas
                        </div>

                        <div class="hero-text">
                            Lihat progres tugas, analisis AI, dan penilaian guru dalam satu tempat.
                        </div>
                    </div>

                    <div class="hero-status">
                        <span class="status-pulse"></span>
                        Sistem Aktif
                    </div>

                </div>

            </div>


            {{-- STATISTICS --}}
            <div class="stats-grid">

                <div class="stat-card">

                    <div class="stat-icon">📚</div>

                    <div class="stat-label">
                        Total Tugas
                    </div>

                    <div class="stat-value">
                        {{ $totalAssignments }}
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon">📤</div>

                    <div class="stat-label">
                        Sudah Dikumpulkan
                    </div>

                    <div class="stat-value">
                        {{ $submittedCount }}
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon">🤖</div>

                    <div class="stat-label">
                        AI Dianalisis
                    </div>

                    <div class="stat-value">
                        {{ $aiAnalyzedCount }}
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon">✓</div>

                    <div class="stat-label">
                        Sudah Dinilai
                    </div>

                    <div class="stat-value">
                        {{ $reviewedCount }}
                    </div>

                </div>

            </div>


            {{-- PROGRESS --}}
            <div class="progress-card">

                <div class="section-heading">
                    Submission Progress
                </div>

                <div class="section-description">
                    Persentase tugas yang sudah berhasil kamu kumpulkan.
                </div>

                <div class="progress-top">

                    <span class="progress-label">
                        Progress Pengumpulan
                    </span>

                    <span class="progress-percent">
                        {{ $submissionProgress }}%
                    </span>

                </div>

                <div class="progress-track">

                    <div
                        class="progress-bar"
                        style="width: {{ $submissionProgress }}%"
                    ></div>

                </div>

            </div>


            {{-- TWO COLUMNS --}}
            <div class="columns">

                {{-- BELUM DIKUMPULKAN --}}
                <div class="health-card">

                    <div class="card-heading-row">

                        <div>
                            <div class="section-heading">
                                Tugas Belum Dikumpulkan
                            </div>

                            <div class="section-description">
                                Tugas yang masih perlu kamu selesaikan.
                            </div>
                        </div>

                        <div class="count-badge">
                            {{ $assignments->whereNotIn(
                                'id',
                                $submissions->pluck('assignment_id')
                            )->count() }}
                        </div>

                    </div>


                    @forelse (
                        $assignments->whereNotIn(
                            'id',
                            $submissions->pluck('assignment_id')
                        ) as $assignment
                    )

                        <div class="assignment-item">

                            <div class="item-main">

                                <div class="item-title">
                                    {{ $assignment->title }}
                                </div>

                                <div class="item-subtitle">
                                    {{ $assignment->subject }}
                                </div>

                            </div>

                            <a
                                href="{{ route(
                                    'student.assignments.show',
                                    $assignment
                                ) }}"
                                class="view-button"
                            >
                                Lihat →
                            </a>

                        </div>

                    @empty

                        <div class="empty-state">

                            <div class="empty-icon">
                                🎉
                            </div>

                            Semua tugas sudah dikumpulkan.

                        </div>

                    @endforelse

                </div>


                {{-- SUBMISSION SAYA --}}
                <div class="health-card">

                    <div class="card-heading-row">

                        <div>
                            <div class="section-heading">
                                Submission Saya
                            </div>

                            <div class="section-description">
                                Status tugas yang sudah kamu kirim.
                            </div>
                        </div>

                        <div class="count-badge">
                            {{ $submissions->count() }}
                        </div>

                    </div>


                    @forelse ($submissions as $submission)

                        <div class="submission-item">

                            <div class="item-title">
                                {{ $submission->assignment->title }}
                            </div>


                            <div class="status-line">

                                <span class="status-dot"></span>

                                Status:
                                {{ $submission->status }}

                            </div>


                            @if ($submission->aiAnalysis)

                                <div class="status-line status-green">

                                    <span class="status-dot"></span>

                                    AI Score:
                                    {{ $submission->aiAnalysis->score ?? '-' }}

                                </div>

                            @else

                                <div class="status-line status-yellow">

                                    <span class="status-dot"></span>

                                    Belum dianalisis AI

                                </div>

                            @endif


                            @if ($submission->teacherReview)

                                <div class="status-line status-blue">

                                    <span class="status-dot"></span>

                                    Nilai Guru:
                                    {{ $submission->teacherReview->score ?? '-' }}

                                </div>

                            @else

                                <div class="status-line">

                                    <span class="status-dot"></span>

                                    Belum dinilai guru

                                </div>

                            @endif

                        </div>

                    @empty

                        <div class="empty-state">

                            <div class="empty-icon">
                                📭
                            </div>

                            Belum ada tugas yang dikumpulkan.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</x-app-layout>