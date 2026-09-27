<x-app-layout>

    <x-slot name="header">
        <div class="nexa-header">
            <div>
                <div class="nexa-kicker">NEXA SUBMIT / STUDENT</div>

                <h2>Student Dashboard</h2>

                <p>
                    Kelola tugas, deadline, pengumpulan, dan analisis AI
                    dalam satu workspace.
                </p>
            </div>

            <div class="nexa-live">
                <span></span>
                SYSTEM ONLINE
            </div>
        </div>
    </x-slot>


    <style>
        /* =====================================================
           NEXA SUBMIT — STUDENT DASHBOARD FINAL UI
        ===================================================== */

        .nexa-dashboard {
            position: relative;
            min-height: calc(100vh - 80px);
            color: #e5e7eb;
            overflow: hidden;
        }

        .nexa-dashboard::before {
            content: "";
            position: fixed;
            width: 460px;
            height: 460px;
            top: 50px;
            right: -220px;
            border-radius: 50%;
            background: rgba(99,102,241,.075);
            filter: blur(100px);
            pointer-events: none;
            z-index: 0;
        }

        .nexa-dashboard::after {
            content: "";
            position: fixed;
            width: 400px;
            height: 400px;
            left: 180px;
            bottom: -220px;
            border-radius: 50%;
            background: rgba(124,58,237,.045);
            filter: blur(100px);
            pointer-events: none;
            z-index: 0;
        }

        .nexa-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1380px;
            margin: 0 auto;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .nexa-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .nexa-kicker {
            margin-bottom: 6px;
            color: #818cf8;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .nexa-header h2 {
            margin: 0;
            color: #f8fafc;
            font-size: 21px;
            line-height: 1.2;
            font-weight: 850;
            letter-spacing: -.5px;
        }

        .nexa-header p {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 11px;
            line-height: 1.5;
        }

        .nexa-live {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border: 1px solid rgba(99,102,241,.18);
            border-radius: 999px;
            background: rgba(99,102,241,.07);
            color: #a5b4fc;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .8px;
            white-space: nowrap;
        }

        .nexa-live span {
            width: 7px;
            height: 7px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #34d399;
            box-shadow: 0 0 13px rgba(52,211,153,.9);
        }


        /* =====================================================
           HERO
        ===================================================== */

        .nexa-hero {
            position: relative;
            overflow: hidden;
            margin-bottom: 18px;
            padding: 28px;
            border: 1px solid rgba(129,140,248,.16);
            border-radius: 24px;

            background:
                radial-gradient(
                    circle at 88% 15%,
                    rgba(129,140,248,.25),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 60% 115%,
                    rgba(168,85,247,.14),
                    transparent 32%
                ),
                linear-gradient(
                    135deg,
                    #171d3b,
                    #0f152b 62%,
                    #10162c
                );

            box-shadow:
                0 24px 65px rgba(0,0,0,.22),
                inset 0 1px 0 rgba(255,255,255,.035);
        }

        .nexa-hero::before {
            content: "";
            position: absolute;
            width: 270px;
            height: 270px;
            top: -160px;
            right: -90px;
            border-radius: 50%;
            background: rgba(129,140,248,.075);
            border: 1px solid rgba(255,255,255,.035);
        }

        .nexa-hero::after {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            right: 24%;
            bottom: -110px;
            border-radius: 50%;
            background: rgba(168,85,247,.06);
        }

        .nexa-hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 28px;
        }

        .nexa-hero-label {
            margin-bottom: 7px;
            color: #818cf8;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .nexa-hero-title {
            margin: 0;
            color: #fff;
            font-size: 31px;
            line-height: 1.15;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .nexa-hero-text {
            max-width: 620px;
            margin: 10px 0 0;
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.7;
        }

        .nexa-actions {
            display: flex;
            gap: 9px;
            flex-shrink: 0;
        }

        .nexa-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 39px;
            padding: 9px 14px;
            border-radius: 11px;
            font-size: 10px;
            font-weight: 800;
            text-decoration: none;
            white-space: nowrap;
            transition: .2s ease;
        }

        .nexa-btn-primary {
            color: #fff;
            background: linear-gradient(135deg,#6366f1,#7c3aed);
            border: 1px solid rgba(255,255,255,.08);
            box-shadow: 0 8px 25px rgba(99,102,241,.22);
        }

        .nexa-btn-primary:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 13px 32px rgba(99,102,241,.32);
        }

        .nexa-btn-secondary {
            color: #cbd5e1;
            background: rgba(255,255,255,.045);
            border: 1px solid rgba(255,255,255,.09);
        }

        .nexa-btn-secondary:hover {
            color: #fff;
            background: rgba(255,255,255,.08);
            transform: translateY(-2px);
        }


        /* =====================================================
           STATISTICS
        ===================================================== */

        .nexa-stat-grid {
            display: grid;
            grid-template-columns: repeat(3,minmax(0,1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .nexa-stat {
            position: relative;
            overflow: hidden;
            min-width: 0;
            padding: 19px;

            border: 1px solid rgba(148,163,184,.085);
            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    rgba(30,41,59,.82),
                    rgba(15,23,42,.94)
                );

            box-shadow:
                0 15px 38px rgba(0,0,0,.11),
                inset 0 1px 0 rgba(255,255,255,.025);

            transition: .2s ease;
        }

        .nexa-stat:hover {
            transform: translateY(-3px);
            border-color: rgba(129,140,248,.22);
            box-shadow: 0 20px 45px rgba(0,0,0,.17);
        }

        .nexa-stat::after {
            content: "";
            position: absolute;
            width: 90px;
            height: 90px;
            right: -40px;
            bottom: -45px;
            border-radius: 50%;
            background: rgba(99,102,241,.045);
        }

        .nexa-stat-top {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
        }

        .nexa-stat-label {
            color: #64748b;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .9px;
        }

        .nexa-stat-number {
            margin-top: 7px;
            color: #f8fafc;
            font-size: 29px;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .nexa-stat-description {
            margin-top: 3px;
            color: #475569;
            font-size: 9px;
        }

        .nexa-stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 41px;
            height: 41px;
            flex-shrink: 0;
            border-radius: 12px;
            font-size: 17px;
        }

        .nexa-indigo {
            color: #a5b4fc;
            background: rgba(99,102,241,.12);
            border: 1px solid rgba(99,102,241,.17);
        }

        .nexa-green {
            color: #6ee7b7;
            background: rgba(16,185,129,.10);
            border: 1px solid rgba(16,185,129,.15);
        }

        .nexa-orange {
            color: #fdba74;
            background: rgba(249,115,22,.10);
            border: 1px solid rgba(249,115,22,.15);
        }


        /* =====================================================
           COMMON CARD
        ===================================================== */

        .nexa-card {
            min-width: 0;
            border: 1px solid rgba(148,163,184,.085);
            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    rgba(30,41,59,.82),
                    rgba(15,23,42,.94)
                );

            box-shadow:
                0 18px 45px rgba(0,0,0,.13),
                inset 0 1px 0 rgba(255,255,255,.025);
        }


        /* =====================================================
           SECTION HEAD
        ===================================================== */

        .nexa-section-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
        }

        .nexa-section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #f8fafc;
            font-size: 14px;
            font-weight: 850;
        }

        .nexa-section-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 33px;
            height: 33px;
            flex-shrink: 0;
            border-radius: 10px;
            background: rgba(99,102,241,.11);
            border: 1px solid rgba(99,102,241,.13);
        }

        .nexa-section-description {
            margin: 5px 0 0 42px;
            color: #475569;
            font-size: 9px;
        }


        /* =====================================================
           PROGRESS
        ===================================================== */

        .nexa-progress {
            padding: 21px;
            margin-bottom: 18px;
        }

        .nexa-progress-score {
            color: #a5b4fc;
            font-size: 26px;
            line-height: 1;
            font-weight: 900;
            text-align: right;
        }

        .nexa-progress-score-label {
            margin-top: 4px;
            color: #475569;
            font-size: 8px;
            font-weight: 700;
            text-align: right;
        }

        .nexa-progress-track {
            height: 8px;
            margin-top: 18px;
            overflow: hidden;
            border-radius: 999px;
            background: #0b1222;
            border: 1px solid rgba(148,163,184,.06);
        }

        .nexa-progress-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(
                90deg,
                #4f46e5,
                #7c3aed,
                #a78bfa
            );
            box-shadow: 0 0 20px rgba(99,102,241,.4);
        }

        .nexa-progress-details {
            display: grid;
            grid-template-columns: repeat(2,minmax(0,1fr));
            gap: 9px;
            margin-top: 13px;
        }

        .nexa-progress-item {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
            padding: 9px 11px;
            border-radius: 12px;
            background: rgba(2,6,23,.32);
            border: 1px solid rgba(148,163,184,.06);
        }

        .nexa-dot {
            width: 7px;
            height: 7px;
            flex-shrink: 0;
            border-radius: 50%;
        }

        .nexa-dot-green {
            background: #34d399;
            box-shadow: 0 0 10px rgba(52,211,153,.55);
        }

        .nexa-dot-orange {
            background: #fb923c;
            box-shadow: 0 0 10px rgba(251,146,60,.45);
        }

        .nexa-progress-main {
            color: #cbd5e1;
            font-size: 10px;
            font-weight: 750;
        }

        .nexa-progress-sub {
            margin-top: 2px;
            color: #475569;
            font-size: 8px;
        }


        /* =====================================================
           MAIN GRID
        ===================================================== */

        .nexa-main-grid {
            display: grid;
            grid-template-columns: minmax(0,2fr) minmax(250px,1fr);
            gap: 18px;
            margin-bottom: 18px;
        }

        .nexa-deadline {
            padding: 21px;
        }

        .nexa-deadline-box {
            margin-top: 16px;
            padding: 16px;
            border-radius: 16px;

            background:
                linear-gradient(
                    135deg,
                    rgba(249,115,22,.07),
                    rgba(15,23,42,.35)
                );

            border: 1px solid rgba(249,115,22,.13);
        }

        .nexa-deadline-content {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
        }

        .nexa-small-label {
            color: #fb923c;
            font-size: 8px;
            font-weight: 900;
            letter-spacing: 1.2px;
        }

        .nexa-deadline-title {
            margin-top: 5px;
            color: #f8fafc;
            font-size: 17px;
            line-height: 1.35;
            font-weight: 850;
        }

        .nexa-deadline-meta {
            margin-top: 5px;
            color: #64748b;
            font-size: 10px;
        }

        .nexa-deadline-badge {
            padding: 6px 9px;
            border-radius: 999px;
            color: #fb923c;
            background: rgba(249,115,22,.09);
            border: 1px solid rgba(249,115,22,.12);
            font-size: 8px;
            font-weight: 850;
            white-space: nowrap;
        }

        .nexa-deadline-bottom {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
            margin-top: 19px;
        }

        .nexa-date-label {
            color: #475569;
            font-size: 8px;
            font-weight: 700;
        }

        .nexa-date {
            margin-top: 3px;
            color: #fb923c;
            font-size: 12px;
            font-weight: 850;
        }


        /* =====================================================
           AI CARD
        ===================================================== */

        .nexa-ai {
            position: relative;
            overflow: hidden;
            padding: 21px;
            border-radius: 20px;

            background:
                radial-gradient(
                    circle at 85% 5%,
                    rgba(255,255,255,.15),
                    transparent 26%
                ),
                radial-gradient(
                    circle at 10% 100%,
                    rgba(255,255,255,.055),
                    transparent 30%
                ),
                linear-gradient(
                    145deg,
                    #4f46e5,
                    #6d28d9 55%,
                    #312e81
                );

            border: 1px solid rgba(255,255,255,.13);
            box-shadow: 0 20px 50px rgba(79,70,229,.22);
        }

        .nexa-ai::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            right: -90px;
            bottom: -100px;
            border-radius: 50%;
            background: rgba(255,255,255,.055);
        }

        .nexa-ai-content {
            position: relative;
            z-index: 2;
        }

        .nexa-ai-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .nexa-ai-label {
            color: #c7d2fe;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 1.7px;
        }

        .nexa-ai-title {
            margin-top: 3px;
            color: #fff;
            font-size: 18px;
            font-weight: 900;
        }

        .nexa-ai-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 13px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.09);
            font-size: 18px;
        }

        .nexa-ai-number {
            margin-top: 27px;
            color: #fff;
            font-size: 38px;
            font-weight: 950;
            letter-spacing: -1.5px;
        }

        .nexa-ai-description {
            max-width: 210px;
            color: #c7d2fe;
            font-size: 9px;
            line-height: 1.6;
        }

        .nexa-ai-button {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 19px;
            padding: 9px 12px;
            border-radius: 11px;
            color: #4f46e5;
            background: #fff;
            font-size: 10px;
            font-weight: 900;
            text-decoration: none;
            transition: .2s;
        }

        .nexa-ai-button:hover {
            color: #4338ca;
            background: #eef2ff;
            transform: translateY(-2px);
        }


        /* =====================================================
           SUBMISSIONS
        ===================================================== */

        .nexa-submissions {
            padding: 21px;
        }

        .nexa-view-all {
            color: #818cf8;
            font-size: 9px;
            font-weight: 850;
            text-decoration: none;
            white-space: nowrap;
        }

        .nexa-view-all:hover {
            color: #a5b4fc;
        }

        .nexa-submission-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 16px;
        }

        .nexa-submission {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            min-width: 0;
            padding: 11px;

            border: 1px solid rgba(148,163,184,.06);
            border-radius: 14px;
            background: rgba(2,6,23,.29);

            transition: .2s ease;
        }

        .nexa-submission:hover {
            transform: translateX(2px);
            border-color: rgba(129,140,248,.19);
            background: rgba(99,102,241,.045);
        }

        .nexa-submission-left {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 0;
        }

        .nexa-file {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 37px;
            height: 37px;
            flex-shrink: 0;
            border-radius: 11px;
            color: #6ee7b7;
            background: rgba(16,185,129,.08);
            border: 1px solid rgba(16,185,129,.13);
            font-size: 15px;
        }

        .nexa-submission-title {
            overflow: hidden;
            color: #dbe4f0;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .nexa-submission-meta {
            margin-top: 3px;
            overflow: hidden;
            color: #475569;
            font-size: 8px;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .nexa-submission-status {
            padding: 5px 9px;
            flex-shrink: 0;
            border: 1px solid rgba(16,185,129,.12);
            border-radius: 999px;
            color: #34d399;
            background: rgba(16,185,129,.08);
            font-size: 8px;
            font-weight: 900;
            white-space: nowrap;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .nexa-empty {
            padding: 45px 15px;
            text-align: center;
        }

        .nexa-empty-icon {
            font-size: 38px;
            opacity: .85;
        }

        .nexa-empty-title {
            margin-top: 10px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 800;
        }

        .nexa-empty-text {
            margin-top: 4px;
            color: #475569;
            font-size: 9px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .nexa-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 2px 4px;
        }

        .nexa-footer span {
            color: #334155;
            font-size: 8px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1050px) {

            .nexa-main-grid {
                grid-template-columns: 1fr;
            }

            .nexa-ai {
                min-height: 210px;
            }
        }


        @media (max-width: 850px) {

            .nexa-hero-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .nexa-actions {
                width: 100%;
            }

            .nexa-actions .nexa-btn {
                flex: 1;
            }
        }


        @media (max-width: 700px) {

            .nexa-header {
                align-items: flex-start;
            }

            .nexa-live {
                display: none;
            }

            .nexa-stat-grid {
                grid-template-columns: 1fr;
            }

            .nexa-hero {
                padding: 22px;
                border-radius: 20px;
            }

            .nexa-hero-title {
                font-size: 25px;
            }

            .nexa-hero-text {
                font-size: 11px;
            }

            .nexa-progress-details {
                grid-template-columns: 1fr;
            }

            .nexa-deadline-content {
                flex-direction: column;
            }

            .nexa-deadline-bottom {
                flex-direction: column;
                align-items: stretch;
            }

            .nexa-deadline-bottom .nexa-btn {
                width: 100%;
            }

            .nexa-section-head {
                gap: 10px;
            }
        }


        @media (max-width: 520px) {

            .nexa-actions {
                flex-direction: column;
            }

            .nexa-actions .nexa-btn {
                width: 100%;
            }

            .nexa-submission {
                align-items: flex-start;
                flex-direction: column;
            }

            .nexa-submission-status {
                margin-left: 48px;
            }

            .nexa-footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .nexa-progress-score {
                font-size: 23px;
            }
        }


        @media (max-width: 400px) {

            .nexa-hero-title {
                font-size: 22px;
            }

            .nexa-section-title {
                font-size: 12px;
            }

            .nexa-section-description {
                font-size: 8px;
            }

            .nexa-deadline-title {
                font-size: 15px;
            }
        }
    </style>


    <div class="nexa-dashboard">

        <div class="nexa-wrapper">


            {{-- =================================================
                 HERO
            ================================================== --}}

            <section class="nexa-hero">

                <div class="nexa-hero-content">

                    <div>

                        <div class="nexa-hero-label">
                            STUDENT WORKSPACE
                        </div>

                        <h1 class="nexa-hero-title">
                            Halo, {{ auth()->user()->name }} 👋
                        </h1>

                        <p class="nexa-hero-text">
                            Pantau tugas, deadline, pengumpulan,
                            dan analisis NEXA AI kamu dalam satu workspace.
                        </p>

                    </div>


                    <div class="nexa-actions">

                        <a
                            href="{{ route('student.assignments') }}"
                            class="nexa-btn nexa-btn-primary"
                        >
                            📚
                            Tugas Saya
                        </a>

                        <a
                            href="{{ route('student.ai-check') }}"
                            class="nexa-btn nexa-btn-secondary"
                        >
                            🤖
                            NEXA AI
                        </a>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 STATISTICS
            ================================================== --}}

            <div class="nexa-stat-grid">

                <div class="nexa-stat">

                    <div class="nexa-stat-top">

                        <div>

                            <div class="nexa-stat-label">
                                TOTAL TUGAS
                            </div>

                            <div class="nexa-stat-number">
                                {{ $totalAssignments }}
                            </div>

                            <div class="nexa-stat-description">
                                Semua tugas yang tersedia
                            </div>

                        </div>

                        <div class="nexa-stat-icon nexa-indigo">
                            📚
                        </div>

                    </div>

                </div>


                <div class="nexa-stat">

                    <div class="nexa-stat-top">

                        <div>

                            <div class="nexa-stat-label">
                                SUDAH DIKUMPULKAN
                            </div>

                            <div class="nexa-stat-number">
                                {{ $submittedCount }}
                            </div>

                            <div class="nexa-stat-description">
                                Tugas berhasil dikirim
                            </div>

                        </div>

                        <div class="nexa-stat-icon nexa-green">
                            ✓
                        </div>

                    </div>

                </div>


                <div class="nexa-stat">

                    <div class="nexa-stat-top">

                        <div>

                            <div class="nexa-stat-label">
                                BELUM DIKUMPULKAN
                            </div>

                            <div class="nexa-stat-number">
                                {{ $pendingCount }}
                            </div>

                            <div class="nexa-stat-description">
                                Perlu segera dikerjakan
                            </div>

                        </div>

                        <div class="nexa-stat-icon nexa-orange">
                            ⏳
                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 PROGRESS
            ================================================== --}}

            <section class="nexa-card nexa-progress">

                <div class="nexa-section-head">

                    <div>

                        <div class="nexa-section-title">

                            <span class="nexa-section-icon">
                                📈
                            </span>

                            Progress Tugas

                        </div>

                        <p class="nexa-section-description">
                            Pantau perkembangan pengumpulan tugas kamu.
                        </p>

                    </div>


                    <div>

                        <div class="nexa-progress-score">
                            {{ $progressPercentage }}%
                        </div>

                        <div class="nexa-progress-score-label">
                            PROGRES PENGUMPULAN
                        </div>

                    </div>

                </div>


                <div class="nexa-progress-track">

                    <div
                        class="nexa-progress-fill"
                        style="width: {{ min(100, max(0, $progressPercentage)) }}%"
                    ></div>

                </div>


                <div class="nexa-progress-details">

                    <div class="nexa-progress-item">

                        <span class="nexa-dot nexa-dot-green"></span>

                        <div>

                            <div class="nexa-progress-main">
                                {{ $submittedCount }} tugas selesai
                            </div>

                            <div class="nexa-progress-sub">
                                Sudah dikumpulkan
                            </div>

                        </div>

                    </div>


                    <div class="nexa-progress-item">

                        <span class="nexa-dot nexa-dot-orange"></span>

                        <div>

                            <div class="nexa-progress-main">
                                {{ $pendingCount }} tugas tersisa
                            </div>

                            <div class="nexa-progress-sub">
                                Belum dikumpulkan
                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 DEADLINE + AI
            ================================================== --}}

            <div class="nexa-main-grid">


                {{-- DEADLINE --}}

                <section class="nexa-card nexa-deadline">

                    <div class="nexa-section-title">

                        <span class="nexa-section-icon">
                            ⏰
                        </span>

                        Deadline Terdekat

                    </div>

                    <p class="nexa-section-description">
                        Tugas yang perlu kamu perhatikan.
                    </p>


                    @if($nearestDeadline)

                        <div class="nexa-deadline-box">

                            <div class="nexa-deadline-content">

                                <div>

                                    <div class="nexa-small-label">
                                        TUGAS BERIKUTNYA
                                    </div>

                                    <div class="nexa-deadline-title">
                                        {{ $nearestDeadline->title }}
                                    </div>

                                    <div class="nexa-deadline-meta">

                                        {{ $nearestDeadline->subject }}

                                        @if($nearestDeadline->class_name)
                                            • {{ $nearestDeadline->class_name }}
                                        @endif

                                    </div>

                                </div>


                                <div class="nexa-deadline-badge">
                                    ⏳ Belum Dikumpulkan
                                </div>

                            </div>


                            <div class="nexa-deadline-bottom">

                                <div>

                                    <div class="nexa-date-label">
                                        DEADLINE
                                    </div>

                                    <div class="nexa-date">
                                        {{ \Carbon\Carbon::parse($nearestDeadline->deadline)->format('d M Y, H:i') }}
                                    </div>

                                </div>


                                <a
                                    href="{{ route('student.assignments.show', $nearestDeadline) }}"
                                    class="nexa-btn nexa-btn-primary"
                                >
                                    Lihat Tugas
                                    →
                                </a>

                            </div>

                        </div>

                    @else

                        <div class="nexa-empty">

                            <div class="nexa-empty-icon">
                                🎉
                            </div>

                            <div class="nexa-empty-title">
                                Tidak ada deadline aktif.
                            </div>

                            <div class="nexa-empty-text">
                                Kamu aman untuk sekarang.
                            </div>

                        </div>

                    @endif

                </section>


                {{-- AI --}}

                <section class="nexa-ai">

                    <div class="nexa-ai-content">

                        <div class="nexa-ai-top">

                            <div>

                                <div class="nexa-ai-label">
                                    NEXA AI
                                </div>

                                <div class="nexa-ai-title">
                                    AI Analysis
                                </div>

                            </div>

                            <div class="nexa-ai-icon">
                                🤖
                            </div>

                        </div>


                        <div class="nexa-ai-number">
                            {{ $aiAnalysisCount }}
                        </div>

                        <div class="nexa-ai-description">
                            tugas telah dianalisis menggunakan NEXA AI
                        </div>


                        <a
                            href="{{ route('student.ai-check') }}"
                            class="nexa-ai-button"
                        >
                            Buka NEXA AI
                            →
                        </a>

                    </div>

                </section>

            </div>


            {{-- =================================================
                 RECENT SUBMISSIONS
            ================================================== --}}

            <section class="nexa-card nexa-submissions">

                <div class="nexa-section-head">

                    <div>

                        <div class="nexa-section-title">

                            <span class="nexa-section-icon">
                                📄
                            </span>

                            Pengumpulan Terbaru

                        </div>

                        <p class="nexa-section-description">
                            Riwayat tugas yang baru kamu kumpulkan.
                        </p>

                    </div>


                    <a
                        href="{{ route('student.assignments') }}"
                        class="nexa-view-all"
                    >
                        Lihat semua →
                    </a>

                </div>


                @if($recentSubmissions->count())

                    <div class="nexa-submission-list">

                        @foreach($recentSubmissions as $submission)

                            <div class="nexa-submission">

                                <div class="nexa-submission-left">

                                    <div class="nexa-file">
                                        📄
                                    </div>

                                    <div style="min-width:0;">

                                        <div class="nexa-submission-title">
                                            {{ $submission->assignment->title ?? $submission->file_name }}
                                        </div>

                                        <div class="nexa-submission-meta">

                                            {{ $submission->file_name }}

                                            <span style="margin:0 4px;">
                                                •
                                            </span>

                                            {{ $submission->created_at->format('d M Y H:i') }}

                                        </div>

                                    </div>

                                </div>


                                <div class="nexa-submission-status">
                                    ✓ TERKUMPUL
                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="nexa-empty">

                        <div class="nexa-empty-icon">
                            📭
                        </div>

                        <div class="nexa-empty-title">
                            Belum ada pengumpulan.
                        </div>

                        <div class="nexa-empty-text">
                            Tugas yang kamu kumpulkan akan muncul di sini.
                        </div>

                        <a
                            href="{{ route('student.assignments') }}"
                            class="nexa-btn nexa-btn-primary"
                            style="margin-top:18px;"
                        >
                            Lihat Tugas
                        </a>

                    </div>

                @endif

            </section>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="nexa-footer">

                <span>
                    NEXA SUBMIT • Smart Assignment Management
                </span>

                <span>
                    Powered by NEXA AI 🤖
                </span>

            </div>

        </div>

    </div>

</x-app-layout>