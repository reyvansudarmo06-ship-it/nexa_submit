<x-app-layout>

    <x-slot name="header">
        <div class="nexa-header">

            <div>
                <div class="nexa-eyebrow">
                    NEXA SUBMIT • REVIEW CENTER
                </div>

                <h2>
                    Review & Feedback
                </h2>

                <p>
                    Pantau submission siswa dan berikan feedback secara langsung.
                </p>
            </div>

            <div class="system-status">
                <span></span>
                REVIEW SYSTEM ACTIVE
            </div>

        </div>
    </x-slot>


    <div class="review-page">

        <div class="review-container">


            {{-- HERO --}}

            <section class="review-hero">

                <div class="hero-main">

                    <div class="hero-icon">
                        ✓
                    </div>

                    <div>

                        <div class="hero-label">
                            TEACHER REVIEW CENTER
                        </div>

                        <h1>
                            Review & Feedback Guru
                        </h1>

                        <p>
                            Periksa hasil tugas siswa, lihat evaluasi AI,
                            lalu berikan nilai dan feedback secara langsung.
                        </p>

                    </div>

                </div>


                <div class="hero-decoration">

                    <div class="orb orb-one"></div>
                    <div class="orb orb-two"></div>

                    <div class="scan-line"></div>

                </div>

            </section>



            {{-- STATISTICS --}}

            <section class="stats-grid">


                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-icon purple">
                            ↓
                        </div>

                        <span class="stat-code">
                            SUB
                        </span>

                    </div>

                    <div class="stat-label">
                        Total Submission
                    </div>

                    <div class="stat-number">
                        {{ $totalSubmissions }}
                    </div>

                    <div class="stat-footer">
                        Semua tugas masuk
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-icon green">
                            ✓
                        </div>

                        <span class="stat-code">
                            DONE
                        </span>

                    </div>

                    <div class="stat-label">
                        Sudah Direview
                    </div>

                    <div class="stat-number">
                        {{ $reviewed }}
                    </div>

                    <div class="stat-footer green-text">
                        Review selesai
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-icon yellow">
                            !
                        </div>

                        <span class="stat-code">
                            WAIT
                        </span>

                    </div>

                    <div class="stat-label">
                        Menunggu Review
                    </div>

                    <div class="stat-number">
                        {{ $pending }}
                    </div>

                    <div class="stat-footer yellow-text">
                        Membutuhkan tindakan
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-top">

                        <div class="stat-icon blue">
                            AI
                        </div>

                        <span class="stat-code">
                            AI
                        </span>

                    </div>

                    <div class="stat-label">
                        Dianalisis AI
                    </div>

                    <div class="stat-number">
                        {{ $aiAnalyzed }}
                    </div>

                    <div class="stat-footer blue-text">
                        Analisis tersedia
                    </div>

                </div>

            </section>



            {{-- SUBMISSION LIST --}}

            <section class="submission-card">


                <div class="submission-header">

                    <div>

                        <div class="section-label">
                            SUBMISSION DATABASE
                        </div>

                        <h2>
                            Daftar Submission
                        </h2>

                        <p>
                            Semua tugas yang dikumpulkan siswa pada tugas Anda.
                        </p>

                    </div>


                    <div class="database-status">

                        <span class="live-dot"></span>

                        LIVE DATA

                    </div>

                </div>



                @if($submissions->count() > 0)


                    <div class="submission-list">


                        @foreach($submissions as $submission)


                            <div class="submission-row">


                                {{-- STUDENT --}}

                                <div class="student-block">

                                    <div class="student-avatar">

                                        {{ strtoupper(substr($submission->student->name, 0, 1)) }}

                                    </div>

                                    <div>

                                        <div class="student-name">
                                            {{ $submission->student->name }}
                                        </div>

                                        <div class="student-email">
                                            {{ $submission->student->email }}
                                        </div>

                                    </div>

                                </div>



                                {{-- ASSIGNMENT --}}

                                <div class="assignment-block">

                                    <div class="assignment-label">
                                        ASSIGNMENT
                                    </div>

                                    <div class="assignment-title">
                                        {{ $submission->assignment->title }}
                                    </div>

                                    <div class="assignment-meta">

                                        <span>
                                            {{ $submission->assignment->subject }}
                                        </span>

                                        <i>•</i>

                                        <span>
                                            {{ $submission->assignment->class_name }}
                                        </span>

                                    </div>

                                </div>



                                {{-- AI SCORE --}}

                                <div class="score-block">

                                    <div class="score-label">
                                        AI SCORE
                                    </div>

                                    @if($submission->aiAnalysis)

                                        <div class="score-value">
                                            {{ $submission->aiAnalysis->score }}
                                        </div>

                                        <div class="score-progress">

                                            <div
                                                class="score-progress-fill"
                                                style="width: {{ max(0, min(100, $submission->aiAnalysis->score)) }}%;"
                                            ></div>

                                        </div>

                                    @else

                                        <div class="score-empty">
                                            —
                                        </div>

                                    @endif

                                </div>



                                {{-- STATUS --}}

                                <div class="status-block">

                                    <div class="status-label">
                                        REVIEW STATUS
                                    </div>

                                    @if($submission->teacherReview)

                                        <span class="status-pill reviewed">

                                            <span class="status-dot"></span>

                                            Sudah Direview

                                        </span>

                                    @else

                                        <span class="status-pill pending">

                                            <span class="status-dot"></span>

                                            Menunggu Review

                                        </span>

                                    @endif

                                </div>



                                {{-- ACTION --}}

                                <div class="action-block">

                                    <a
                                        href="{{ route('teacher.submissions.show', $submission) }}"
                                        class="review-button"
                                    >

                                        <span>
                                            Review
                                        </span>

                                        <b>
                                            →
                                        </b>

                                    </a>

                                </div>


                            </div>


                        @endforeach


                    </div>


                @else


                    {{-- EMPTY STATE --}}

                    <div class="empty-state">

                        <div class="empty-icon">
                            ∅
                        </div>

                        <h3>
                            Belum Ada Submission
                        </h3>

                        <p>
                            Belum ada tugas yang dikumpulkan oleh siswa.
                        </p>

                        <div class="empty-status">
                            WAITING FOR SUBMISSIONS
                        </div>

                    </div>


                @endif


            </section>



            {{-- FOOTER --}}

            <div class="review-footer">

                <div class="footer-brand">

                    <span class="footer-logo">
                        N
                    </span>

                    <span>
                        NEXA SUBMIT
                    </span>

                </div>

                <div>
                    Teacher Review Management System
                </div>

            </div>


        </div>

    </div>



    <style>

        /* =========================================
           HEADER
        ========================================= */

        .nexa-header {
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
        }

        .nexa-eyebrow {
            color:#818cf8;
            font-size:10px;
            font-weight:800;
            letter-spacing:2px;
        }

        .nexa-header h2 {
            margin:5px 0 0;
            color:#f8fafc;
            font-size:22px;
            font-weight:800;
            letter-spacing:-.4px;
        }

        .nexa-header p {
            margin:5px 0 0;
            color:#94a3b8;
            font-size:13px;
        }

        .system-status {
            display:flex;
            align-items:center;
            gap:8px;
            padding:9px 13px;
            border:1px solid rgba(34,197,94,.15);
            border-radius:12px;
            background:rgba(34,197,94,.05);
            color:#86efac;
            font-size:10px;
            font-weight:800;
            letter-spacing:1px;
        }

        .system-status span {
            width:7px;
            height:7px;
            border-radius:50%;
            background:#22c55e;
            box-shadow:0 0 12px rgba(34,197,94,.8);
        }


        /* =========================================
           PAGE
        ========================================= */

        .review-page {
            min-height:calc(100vh - 80px);
            padding:32px 24px 45px;
            background:
                radial-gradient(
                    circle at 10% 5%,
                    rgba(124,58,237,.15),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 10%,
                    rgba(37,99,235,.11),
                    transparent 27%
                ),
                #050816;
            color:#f8fafc;
        }

        .review-container {
            max-width:1250px;
            margin:0 auto;
        }


        /* =========================================
           HERO
        ========================================= */

        .review-hero {
            position:relative;
            overflow:hidden;
            display:flex;
            align-items:center;
            justify-content:space-between;
            min-height:185px;
            margin-bottom:22px;
            padding:30px;
            border:1px solid rgba(148,163,184,.12);
            border-radius:23px;
            background:
                linear-gradient(
                    135deg,
                    rgba(124,58,237,.15),
                    rgba(37,99,235,.07)
                ),
                rgba(15,23,42,.75);
            box-shadow:
                0 25px 70px rgba(0,0,0,.28),
                inset 0 1px 0 rgba(255,255,255,.04);
            backdrop-filter:blur(20px);
        }

        .hero-main {
            position:relative;
            z-index:2;
            display:flex;
            align-items:center;
            gap:20px;
        }

        .hero-icon {
            width:64px;
            height:64px;
            flex-shrink:0;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:19px;
            background:
                linear-gradient(
                    135deg,
                    #7c3aed,
                    #2563eb
                );
            color:white;
            font-size:29px;
            font-weight:800;
            box-shadow:
                0 15px 35px rgba(79,70,229,.3);
        }

        .hero-label {
            color:#a78bfa;
            font-size:10px;
            font-weight:800;
            letter-spacing:2px;
        }

        .review-hero h1 {
            margin:6px 0;
            font-size:27px;
            font-weight:850;
            letter-spacing:-.7px;
        }

        .review-hero p {
            max-width:620px;
            margin:0;
            color:#94a3b8;
            font-size:13px;
            line-height:1.6;
        }

        .hero-decoration {
            position:absolute;
            inset:0;
            pointer-events:none;
        }

        .orb {
            position:absolute;
            border-radius:50%;
            filter:blur(2px);
        }

        .orb-one {
            width:170px;
            height:170px;
            right:100px;
            top:-75px;
            background:rgba(124,58,237,.08);
        }

        .orb-two {
            width:120px;
            height:120px;
            right:20px;
            bottom:-60px;
            background:rgba(37,99,235,.09);
        }

        .scan-line {
            position:absolute;
            right:30px;
            top:0;
            width:1px;
            height:100%;
            background:linear-gradient(
                transparent,
                rgba(129,140,248,.25),
                transparent
            );
        }


        /* =========================================
           STATS
        ========================================= */

        .stats-grid {
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:14px;
            margin-bottom:22px;
        }

        .stat-card {
            padding:20px;
            border:1px solid rgba(148,163,184,.11);
            border-radius:18px;
            background:rgba(15,23,42,.76);
            box-shadow:
                0 15px 40px rgba(0,0,0,.18),
                inset 0 1px 0 rgba(255,255,255,.025);
            transition:
                transform .2s,
                border-color .2s;
        }

        .stat-card:hover {
            transform:translateY(-2px);
            border-color:rgba(129,140,248,.24);
        }

        .stat-top {
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:16px;
        }

        .stat-icon {
            width:39px;
            height:39px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:12px;
            font-size:13px;
            font-weight:900;
        }

        .stat-icon.purple {
            color:#c4b5fd;
            background:rgba(139,92,246,.12);
        }

        .stat-icon.green {
            color:#4ade80;
            background:rgba(34,197,94,.11);
        }

        .stat-icon.yellow {
            color:#facc15;
            background:rgba(250,204,21,.10);
        }

        .stat-icon.blue {
            color:#60a5fa;
            background:rgba(59,130,246,.11);
            font-size:10px;
        }

        .stat-code {
            color:#475569;
            font-size:9px;
            font-weight:800;
            letter-spacing:1px;
        }

        .stat-label {
            color:#94a3b8;
            font-size:11px;
        }

        .stat-number {
            margin-top:4px;
            color:#f8fafc;
            font-size:28px;
            font-weight:850;
            letter-spacing:-.7px;
        }

        .stat-footer {
            margin-top:7px;
            color:#475569;
            font-size:10px;
        }

        .green-text {
            color:#4ade80;
        }

        .yellow-text {
            color:#facc15;
        }

        .blue-text {
            color:#60a5fa;
        }


        /* =========================================
           SUBMISSION CARD
        ========================================= */

        .submission-card {
            overflow:hidden;
            border:1px solid rgba(148,163,184,.12);
            border-radius:22px;
            background:rgba(15,23,42,.78);
            box-shadow:
                0 25px 65px rgba(0,0,0,.24),
                inset 0 1px 0 rgba(255,255,255,.03);
            backdrop-filter:blur(18px);
        }

        .submission-header {
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
            padding:24px 25px;
            border-bottom:1px solid rgba(148,163,184,.09);
        }

        .section-label {
            color:#818cf8;
            font-size:9px;
            font-weight:800;
            letter-spacing:2px;
        }

        .submission-header h2 {
            margin:5px 0 3px;
            color:#f8fafc;
            font-size:18px;
            font-weight:800;
        }

        .submission-header p {
            margin:0;
            color:#64748b;
            font-size:11px;
        }

        .database-status {
            display:flex;
            align-items:center;
            gap:7px;
            padding:8px 11px;
            border:1px solid rgba(34,197,94,.13);
            border-radius:10px;
            color:#64748b;
            background:rgba(34,197,94,.035);
            font-size:9px;
            font-weight:800;
            letter-spacing:1px;
        }

        .live-dot {
            width:6px;
            height:6px;
            border-radius:50%;
            background:#22c55e;
            box-shadow:0 0 10px rgba(34,197,94,.7);
        }


        /* =========================================
           ROW
        ========================================= */

        .submission-row {
            display:grid;
            grid-template-columns:
                minmax(190px,1.1fr)
                minmax(190px,1.2fr)
                100px
                145px
                105px;
            align-items:center;
            gap:18px;
            padding:18px 25px;
            border-bottom:1px solid rgba(148,163,184,.07);
            transition:
                background .2s;
        }

        .submission-row:last-child {
            border-bottom:none;
        }

        .submission-row:hover {
            background:rgba(99,102,241,.035);
        }


        /* STUDENT */

        .student-block {
            display:flex;
            align-items:center;
            gap:11px;
            min-width:0;
        }

        .student-avatar {
            width:38px;
            height:38px;
            flex-shrink:0;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:12px;
            background:
                linear-gradient(
                    135deg,
                    rgba(124,58,237,.24),
                    rgba(37,99,235,.18)
                );
            border:1px solid rgba(129,140,248,.14);
            color:#c4b5fd;
            font-size:12px;
            font-weight:900;
        }

        .student-name {
            overflow:hidden;
            color:#e2e8f0;
            font-size:12px;
            font-weight:750;
            text-overflow:ellipsis;
            white-space:nowrap;
        }

        .student-email {
            overflow:hidden;
            margin-top:3px;
            color:#475569;
            font-size:10px;
            text-overflow:ellipsis;
            white-space:nowrap;
        }


        /* ASSIGNMENT */

        .assignment-label,
        .score-label,
        .status-label {
            margin-bottom:5px;
            color:#475569;
            font-size:8px;
            font-weight:800;
            letter-spacing:1px;
        }

        .assignment-title {
            overflow:hidden;
            color:#cbd5e1;
            font-size:12px;
            font-weight:700;
            text-overflow:ellipsis;
            white-space:nowrap;
        }

        .assignment-meta {
            display:flex;
            gap:5px;
            margin-top:4px;
            color:#64748b;
            font-size:9px;
        }

        .assignment-meta i {
            color:#334155;
            font-style:normal;
        }


        /* SCORE */

        .score-block {
            text-align:center;
        }

        .score-value {
            color:#a5b4fc;
            font-size:20px;
            font-weight:850;
        }

        .score-empty {
            color:#475569;
            font-size:20px;
            font-weight:800;
        }

        .score-progress {
            width:55px;
            height:3px;
            margin:6px auto 0;
            overflow:hidden;
            border-radius:99px;
            background:#1e293b;
        }

        .score-progress-fill {
            height:100%;
            border-radius:99px;
            background:linear-gradient(
                90deg,
                #7c3aed,
                #3b82f6
            );
        }


        /* STATUS */

        .status-block {
            text-align:center;
        }

        .status-pill {
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding:6px 9px;
            border-radius:999px;
            font-size:8px;
            font-weight:800;
            white-space:nowrap;
        }

        .status-pill.reviewed {
            color:#4ade80;
            background:rgba(34,197,94,.08);
            border:1px solid rgba(34,197,94,.10);
        }

        .status-pill.pending {
            color:#facc15;
            background:rgba(250,204,21,.08);
            border:1px solid rgba(250,204,21,.10);
        }

        .status-dot {
            width:5px;
            height:5px;
            border-radius:50%;
        }

        .reviewed .status-dot {
            background:#22c55e;
            box-shadow:0 0 7px rgba(34,197,94,.7);
        }

        .pending .status-dot {
            background:#eab308;
            box-shadow:0 0 7px rgba(234,179,8,.6);
        }


        /* ACTION */

        .action-block {
            text-align:right;
        }

        .review-button {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:9px;
            min-width:83px;
            padding:9px 12px;
            border:1px solid rgba(129,140,248,.16);
            border-radius:10px;
            background:
                linear-gradient(
                    135deg,
                    rgba(124,58,237,.9),
                    rgba(37,99,235,.9)
                );
            color:white;
            text-decoration:none;
            font-size:10px;
            font-weight:800;
            box-shadow:0 8px 20px rgba(79,70,229,.16);
            transition:
                transform .2s,
                box-shadow .2s;
        }

        .review-button:hover {
            color:white;
            transform:translateY(-2px);
            box-shadow:0 12px 25px rgba(79,70,229,.27);
        }

        .review-button b {
            font-size:14px;
            font-weight:400;
            opacity:.7;
        }


        /* =========================================
           EMPTY
        ========================================= */

        .empty-state {
            padding:75px 25px;
            text-align:center;
        }

        .empty-icon {
            width:62px;
            height:62px;
            margin:0 auto 16px;
            display:flex;
            align-items:center;
            justify-content:center;
            border:1px solid rgba(129,140,248,.12);
            border-radius:18px;
            background:rgba(99,102,241,.06);
            color:#64748b;
            font-size:25px;
        }

        .empty-state h3 {
            margin:0;
            color:#cbd5e1;
            font-size:16px;
            font-weight:800;
        }

        .empty-state p {
            margin:6px 0 14px;
            color:#475569;
            font-size:11px;
        }

        .empty-status {
            display:inline-block;
            padding:7px 11px;
            border:1px solid rgba(148,163,184,.08);
            border-radius:8px;
            color:#334155;
            font-size:8px;
            font-weight:800;
            letter-spacing:1.2px;
        }


        /* =========================================
           FOOTER
        ========================================= */

        .review-footer {
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:18px 3px;
            color:#334155;
            font-size:9px;
        }

        .footer-brand {
            display:flex;
            align-items:center;
            gap:8px;
            color:#475569;
            font-weight:800;
            letter-spacing:.7px;
        }

        .footer-logo {
            width:23px;
            height:23px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:7px;
            background:linear-gradient(
                135deg,
                #7c3aed,
                #2563eb
            );
            color:white;
            font-size:10px;
            font-weight:900;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width:1100px) {

            .submission-row {
                grid-template-columns:
                    minmax(180px,1fr)
                    minmax(180px,1fr)
                    90px
                    130px;
            }

            .action-block {
                grid-column:1 / -1;
                text-align:right;
            }

        }


        @media (max-width:850px) {

            .stats-grid {
                grid-template-columns:repeat(2,1fr);
            }

            .submission-row {
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:17px;
            }

            .score-block,
            .status-block {
                text-align:left;
            }

            .score-progress {
                margin-left:0;
            }

            .action-block {
                grid-column:1 / -1;
                text-align:left;
            }

            .review-button {
                width:100%;
            }

        }


        @media (max-width:600px) {

            .review-page {
                padding:20px 14px 35px;
            }

            .nexa-header {
                align-items:flex-start;
            }

            .system-status {
                display:none;
            }

            .review-hero {
                min-height:auto;
                padding:21px;
                border-radius:19px;
            }

            .hero-main {
                align-items:flex-start;
                gap:14px;
            }

            .hero-icon {
                width:48px;
                height:48px;
                border-radius:14px;
                font-size:22px;
            }

            .review-hero h1 {
                font-size:20px;
            }

            .review-hero p {
                font-size:11px;
            }

            .stats-grid {
                grid-template-columns:1fr;
            }

            .submission-header {
                align-items:flex-start;
                flex-direction:column;
                padding:20px;
            }

            .database-status {
                width:max-content;
            }

            .submission-row {
                display:block;
                padding:19px;
            }

            .student-block,
            .assignment-block,
            .score-block,
            .status-block,
            .action-block {
                margin-bottom:16px;
                text-align:left;
            }

            .action-block {
                margin-bottom:0;
            }

            .score-progress {
                margin-left:0;
            }

            .review-footer {
                flex-direction:column;
                align-items:flex-start;
                gap:8px;
            }

        }

    </style>

</x-app-layout>