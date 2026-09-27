<x-app-layout>

    <x-slot name="header">
        <div class="nexa-header">
            <div>
                <h2>Deadline &amp; Progress</h2>
                <p>Pantau deadline dan status pengumpulan tugas kamu.</p>
            </div>

            <div class="header-badge">
                <span class="header-dot"></span>
                LIVE TRACKING
            </div>
        </div>
    </x-slot>

    <style>
        :root {
            --nexa-bg: #070b14;
            --nexa-card: rgba(15, 23, 42, .78);
            --nexa-card-2: rgba(17, 24, 39, .72);
            --nexa-border: rgba(148, 163, 184, .12);
            --nexa-border-hover: rgba(129, 140, 248, .38);
            --nexa-text: #f8fafc;
            --nexa-muted: #94a3b8;
            --nexa-dim: #64748b;
            --nexa-purple: #6366f1;
            --nexa-blue: #38bdf8;
            --nexa-green: #34d399;
            --nexa-yellow: #fbbf24;
            --nexa-red: #f87171;
        }

        .deadline-page {
            position: relative;
            max-width: 1240px;
            margin: 0 auto;
            padding: 6px 0 40px;
        }

        .deadline-page::before {
            content: "";
            position: fixed;
            width: 420px;
            height: 420px;
            top: 80px;
            right: -180px;
            background: rgba(99, 102, 241, .08);
            filter: blur(100px);
            border-radius: 50%;
            pointer-events: none;
            z-index: -1;
        }

        .deadline-page::after {
            content: "";
            position: fixed;
            width: 360px;
            height: 360px;
            bottom: -100px;
            left: 180px;
            background: rgba(56, 189, 248, .045);
            filter: blur(100px);
            border-radius: 50%;
            pointer-events: none;
            z-index: -1;
        }

        /* =========================
           HEADER
        ========================= */

        .nexa-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .nexa-header h2 {
            margin: 0;
            color: #fff;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.4px;
        }

        .nexa-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border: 1px solid rgba(99, 102, 241, .2);
            border-radius: 999px;
            background: rgba(99, 102, 241, .08);
            color: #a5b4fc;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
            white-space: nowrap;
        }

        .header-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #34d399;
            box-shadow: 0 0 10px rgba(52, 211, 153, .8);
        }

        /* =========================
           HERO
        ========================= */

        .deadline-hero {
            position: relative;
            overflow: hidden;
            margin-bottom: 22px;
            padding: 28px;
            border: 1px solid var(--nexa-border);
            border-radius: 22px;
            background:
                radial-gradient(
                    circle at 90% 20%,
                    rgba(99, 102, 241, .18),
                    transparent 34%
                ),
                radial-gradient(
                    circle at 10% 100%,
                    rgba(56, 189, 248, .08),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    rgba(15, 23, 42, .96),
                    rgba(9, 14, 27, .92)
                );
            box-shadow:
                0 20px 60px rgba(0, 0, 0, .18);
        }

        .deadline-hero::before {
            content: "";
            position: absolute;
            width: 170px;
            height: 170px;
            right: 50px;
            top: -100px;
            border-radius: 50%;
            background: rgba(99, 102, 241, .16);
            filter: blur(45px);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 12px;
            padding: 6px 10px;
            border-radius: 8px;
            background: rgba(99, 102, 241, .09);
            border: 1px solid rgba(99, 102, 241, .16);
            color: #a5b4fc;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        .deadline-hero h1 {
            margin: 0;
            color: #fff;
            font-size: 30px;
            line-height: 1.15;
            font-weight: 850;
            letter-spacing: -.8px;
        }

        .deadline-hero p {
            max-width: 650px;
            margin: 10px 0 0;
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.7;
        }

        /* =========================
           SUMMARY
        ========================= */

        .deadline-summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 30px;
        }

        .deadline-stat {
            position: relative;
            overflow: hidden;
            min-height: 128px;
            padding: 19px;
            border: 1px solid var(--nexa-border);
            border-radius: 17px;
            background: var(--nexa-card);
            backdrop-filter: blur(18px);
            transition: .25s ease;
        }

        .deadline-stat:hover {
            transform: translateY(-3px);
            border-color: var(--nexa-border-hover);
            box-shadow: 0 14px 35px rgba(0, 0, 0, .18);
        }

        .deadline-stat::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(
                90deg,
                #6366f1,
                #38bdf8
            );
        }

        .deadline-stat.green::before {
            background: linear-gradient(
                90deg,
                #059669,
                #34d399
            );
        }

        .deadline-stat.orange::before {
            background: linear-gradient(
                90deg,
                #d97706,
                #fbbf24
            );
        }

        .deadline-stat.red::before {
            background: linear-gradient(
                90deg,
                #dc2626,
                #f87171
            );
        }

        .stat-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 13px;
            border-radius: 10px;
            background: rgba(99, 102, 241, .1);
            border: 1px solid rgba(99, 102, 241, .16);
            font-size: 15px;
        }

        .green .stat-icon {
            background: rgba(16, 185, 129, .09);
            border-color: rgba(16, 185, 129, .16);
        }

        .orange .stat-icon {
            background: rgba(245, 158, 11, .09);
            border-color: rgba(245, 158, 11, .16);
        }

        .red .stat-icon {
            background: rgba(239, 68, 68, .09);
            border-color: rgba(239, 68, 68, .16);
        }

        .deadline-stat-label {
            color: #64748b;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .deadline-stat-number {
            margin-top: 5px;
            color: #fff;
            font-size: 27px;
            line-height: 1;
            font-weight: 850;
        }

        .deadline-stat-description {
            margin-top: 7px;
            color: #64748b;
            font-size: 11px;
        }

        /* =========================
           SECTION HEADER
        ========================= */

        .deadline-section {
            margin-top: 8px;
        }

        .deadline-section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 14px;
        }

        .section-title-left {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .section-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(99, 102, 241, .1);
            border: 1px solid rgba(99, 102, 241, .17);
            font-size: 15px;
        }

        .deadline-section-title h3 {
            margin: 0;
            color: #f8fafc;
            font-size: 16px;
            font-weight: 800;
        }

        .deadline-section-title p {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 11px;
        }

        .task-count {
            padding: 7px 11px;
            border-radius: 8px;
            background: rgba(15, 23, 42, .8);
            border: 1px solid var(--nexa-border);
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
        }

        /* =========================
           LIST
        ========================= */

        .deadline-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .deadline-card {
            position: relative;
            overflow: hidden;
            padding: 21px;
            border: 1px solid var(--nexa-border);
            border-radius: 18px;
            background:
                linear-gradient(
                    135deg,
                    rgba(15, 23, 42, .88),
                    rgba(9, 14, 27, .82)
                );
            backdrop-filter: blur(18px);
            transition: .25s ease;
        }

        .deadline-card:hover {
            transform: translateY(-2px);
            border-color: rgba(129, 140, 248, .3);
            box-shadow:
                0 18px 45px rgba(0, 0, 0, .2),
                0 0 30px rgba(99, 102, 241, .035);
        }

        .deadline-card::after {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            right: -90px;
            top: -90px;
            border-radius: 50%;
            background: rgba(99, 102, 241, .07);
            filter: blur(25px);
            pointer-events: none;
        }

        /* =========================
           TOP
        ========================= */

        .deadline-card-top {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
        }

        .deadline-card-title {
            color: #f8fafc;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: -.2px;
        }

        .deadline-card-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-top: 10px;
        }

        .deadline-meta {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 7px;
            background: rgba(2, 6, 23, .5);
            border: 1px solid rgba(148, 163, 184, .1);
            color: #94a3b8;
            font-size: 10px;
        }

        /* =========================
           STATUS
        ========================= */

        .deadline-status {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            padding: 7px 11px;
            border-radius: 9px;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .deadline-status.submitted {
            background: rgba(16, 185, 129, .08);
            border: 1px solid rgba(16, 185, 129, .2);
            color: #6ee7b7;
        }

        .deadline-status.pending {
            background: rgba(245, 158, 11, .08);
            border: 1px solid rgba(245, 158, 11, .2);
            color: #fcd34d;
        }

        .deadline-status.late {
            background: rgba(239, 68, 68, .08);
            border: 1px solid rgba(239, 68, 68, .2);
            color: #fca5a5;
        }

        /* =========================
           DEADLINE INFO
        ========================= */

        .deadline-info {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 18px;
            padding: 13px 15px;
            border: 1px solid rgba(148, 163, 184, .1);
            border-radius: 12px;
            background: rgba(2, 6, 23, .4);
        }

        .deadline-info-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .deadline-clock {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            background:
                linear-gradient(
                    135deg,
                    rgba(99, 102, 241, .16),
                    rgba(56, 189, 248, .07)
                );
            border: 1px solid rgba(99, 102, 241, .2);
            font-size: 15px;
        }

        .deadline-info-label {
            color: #64748b;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .deadline-info-value {
            margin-top: 3px;
            color: #e2e8f0;
            font-size: 12px;
            font-weight: 750;
        }

        .deadline-countdown {
            color: #818cf8;
            font-size: 11px;
            font-weight: 800;
            text-align: right;
        }

        .deadline-countdown.warning {
            color: #fbbf24;
        }

        .deadline-countdown.danger {
            color: #f87171;
        }

        .deadline-countdown.done {
            color: #34d399;
        }

        /* =========================
           PROGRESS
        ========================= */

        .deadline-progress-area {
            position: relative;
            z-index: 1;
            margin-top: 18px;
        }

        .deadline-progress-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .deadline-progress-label {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
        }

        .deadline-progress-percent {
            color: #e2e8f0;
            font-size: 10px;
            font-weight: 850;
        }

        .deadline-progress-bar {
            width: 100%;
            height: 7px;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(30, 41, 59, .75);
            border: 1px solid rgba(148, 163, 184, .05);
        }

        .deadline-progress-fill {
            height: 100%;
            border-radius: inherit;
            background:
                linear-gradient(
                    90deg,
                    #4f46e5,
                    #6366f1,
                    #38bdf8
                );
            box-shadow: 0 0 12px rgba(99, 102, 241, .28);
            transition: width .4s ease;
        }

        .deadline-progress-fill.complete {
            background:
                linear-gradient(
                    90deg,
                    #059669,
                    #34d399
                );
            box-shadow: 0 0 12px rgba(52, 211, 153, .2);
        }

        .deadline-progress-fill.late {
            background:
                linear-gradient(
                    90deg,
                    #dc2626,
                    #f87171
                );
        }

        /* =========================
           FOOTER
        ========================= */

        .deadline-card-footer {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid rgba(148, 163, 184, .08);
        }

        .deadline-note {
            color: #64748b;
            font-size: 10px;
            line-height: 1.5;
        }

        .deadline-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 13px;
            border-radius: 9px;
            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #6366f1
                );
            border: 1px solid rgba(129, 140, 248, .2);
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            text-decoration: none;
            box-shadow:
                0 7px 18px rgba(79, 70, 229, .18);
            transition: .2s ease;
        }

        .deadline-button:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow:
                0 10px 25px rgba(79, 70, 229, .28);
        }

        .deadline-button.secondary {
            background: rgba(30, 41, 59, .75);
            border: 1px solid rgba(148, 163, 184, .12);
            box-shadow: none;
            color: #cbd5e1;
        }

        .deadline-button.secondary:hover {
            background: rgba(51, 65, 85, .8);
            color: #fff;
        }

        /* =========================
           EMPTY
        ========================= */

        .deadline-empty {
            position: relative;
            overflow: hidden;
            padding: 70px 25px;
            text-align: center;
            border: 1px solid var(--nexa-border);
            border-radius: 20px;
            background:
                radial-gradient(
                    circle at center,
                    rgba(99, 102, 241, .07),
                    transparent 45%
                ),
                rgba(15, 23, 42, .7);
        }

        .deadline-empty-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            background:
                linear-gradient(
                    135deg,
                    rgba(99, 102, 241, .13),
                    rgba(56, 189, 248, .06)
                );
            border: 1px solid rgba(99, 102, 241, .2);
            font-size: 26px;
            box-shadow:
                0 10px 35px rgba(99, 102, 241, .08);
        }

        .deadline-empty h3 {
            margin: 0;
            color: #f8fafc;
            font-size: 17px;
            font-weight: 800;
        }

        .deadline-empty p {
            max-width: 460px;
            margin: 9px auto 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.7;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1000px) {

            .deadline-summary {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 700px) {

            .nexa-header {
                align-items: flex-start;
            }

            .header-badge {
                display: none;
            }

            .deadline-page {
                padding-bottom: 25px;
            }

            .deadline-hero {
                padding: 22px;
                border-radius: 18px;
            }

            .deadline-hero h1 {
                font-size: 24px;
            }

            .deadline-card {
                padding: 17px;
                border-radius: 16px;
            }

            .deadline-card-top {
                flex-direction: column;
                gap: 12px;
            }

            .deadline-status {
                align-self: flex-start;
            }

            .deadline-info {
                align-items: flex-start;
                flex-direction: column;
            }

            .deadline-countdown {
                text-align: left;
            }

            .deadline-card-footer {
                align-items: stretch;
                flex-direction: column;
            }

            .deadline-button {
                width: 100%;
            }

        }

        @media (max-width: 520px) {

            .deadline-summary {
                grid-template-columns: 1fr;
            }

            .deadline-section-title {
                align-items: flex-start;
            }

            .task-count {
                display: none;
            }

            .deadline-meta {
                font-size: 9px;
            }

        }
    </style>


    <div class="deadline-page">

        {{-- =========================
             HERO
        ========================== --}}

        <div class="deadline-hero">

            <div class="hero-content">

                <div class="hero-eyebrow">
                    <span>◈</span>
                    NEXA TRACKER
                </div>

                <h1>
                    Deadline &amp; Progress
                </h1>

                <p>
                    Pantau deadline, status pengumpulan, dan perkembangan
                    tugas kamu dalam satu tempat.
                </p>

            </div>

        </div>


        {{-- =========================
             SUMMARY CALCULATION
        ========================== --}}

        @php

            $totalAssignments = $assignments->count();

            $submittedCount = 0;
            $pendingCount = 0;
            $lateCount = 0;

            foreach ($assignments as $assignment) {

                $submission = $submissions->get($assignment->id);

                if ($submission) {

                    $submittedCount++;

                } else {

                    if (
                        $assignment->deadline &&
                        $assignment->deadline->isPast()
                    ) {

                        $lateCount++;

                    } else {

                        $pendingCount++;

                    }

                }

            }

        @endphp


        {{-- =========================
             SUMMARY
        ========================== --}}

        <div class="deadline-summary">

            <div class="deadline-stat">

                <div class="stat-icon">
                    📚
                </div>

                <div class="deadline-stat-label">
                    Total Tugas
                </div>

                <div class="deadline-stat-number">
                    {{ $totalAssignments }}
                </div>

                <div class="deadline-stat-description">
                    Tugas aktif
                </div>

            </div>


            <div class="deadline-stat green">

                <div class="stat-icon">
                    ✓
                </div>

                <div class="deadline-stat-label">
                    Terkumpul
                </div>

                <div class="deadline-stat-number">
                    {{ $submittedCount }}
                </div>

                <div class="deadline-stat-description">
                    Tugas sudah dikumpulkan
                </div>

            </div>


            <div class="deadline-stat orange">

                <div class="stat-icon">
                    ⏳
                </div>

                <div class="deadline-stat-label">
                    Belum Dikumpulkan
                </div>

                <div class="deadline-stat-number">
                    {{ $pendingCount }}
                </div>

                <div class="deadline-stat-description">
                    Masih menunggu pengumpulan
                </div>

            </div>


            <div class="deadline-stat red">

                <div class="stat-icon">
                    !
                </div>

                <div class="deadline-stat-label">
                    Terlambat
                </div>

                <div class="deadline-stat-number">
                    {{ $lateCount }}
                </div>

                <div class="deadline-stat-description">
                    Deadline sudah lewat
                </div>

            </div>

        </div>


        {{-- =========================
             ASSIGNMENT SECTION
        ========================== --}}

        <div class="deadline-section">

            <div class="deadline-section-title">

                <div class="section-title-left">

                    <div class="section-icon">
                        📋
                    </div>

                    <div>

                        <h3>
                            Daftar Tugas
                        </h3>

                        <p>
                            Status pengumpulan dan waktu yang tersisa
                        </p>

                    </div>

                </div>

                <div class="task-count">
                    {{ $totalAssignments }} tugas aktif
                </div>

            </div>


            @if($assignments->count())

                <div class="deadline-list">

                    @foreach($assignments as $assignment)

                        @php

                            $submission = $submissions->get($assignment->id);

                            $isSubmitted = (bool) $submission;

                            $isLate = !$isSubmitted
                                && $assignment->deadline
                                && $assignment->deadline->isPast();

                            if ($isSubmitted) {

                                $statusClass = 'submitted';

                                $statusText = '✓ Sudah Dikumpulkan';

                                $progress = 100;

                            } elseif ($isLate) {

                                $statusClass = 'late';

                                $statusText = '⚠ Terlambat';

                                $progress = 0;

                            } else {

                                $statusClass = 'pending';

                                $statusText = '● Belum Dikumpulkan';

                                $progress = 0;

                            }


                            if (!$assignment->deadline) {

                                $countdownText = 'Tidak ada deadline';

                                $countdownClass = '';

                            } elseif ($isSubmitted) {

                                $countdownText = 'Tugas sudah dikumpulkan';

                                $countdownClass = 'done';

                            } elseif ($isLate) {

                                $countdownText = 'Deadline sudah lewat';

                                $countdownClass = 'danger';

                            } else {

                                $now = now();

                                $seconds = $now->diffInSeconds(
                                    $assignment->deadline,
                                    false
                                );

                                $days = intdiv(
                                    max($seconds, 0),
                                    86400
                                );

                                $hours = intdiv(
                                    max($seconds, 0) % 86400,
                                    3600
                                );

                                $minutes = intdiv(
                                    max($seconds, 0) % 3600,
                                    60
                                );

                                if ($days > 0) {

                                    $countdownText =
                                        $days . ' hari ' .
                                        $hours . ' jam lagi';

                                } elseif ($hours > 0) {

                                    $countdownText =
                                        $hours . ' jam ' .
                                        $minutes . ' menit lagi';

                                } else {

                                    $countdownText =
                                        max($minutes, 1) . ' menit lagi';

                                }

                                if ($seconds <= 86400) {

                                    $countdownClass = 'warning';

                                } else {

                                    $countdownClass = '';

                                }

                            }

                        @endphp


                        <div class="deadline-card">

                            {{-- TOP --}}

                            <div class="deadline-card-top">

                                <div>

                                    <div class="deadline-card-title">
                                        {{ $assignment->title }}
                                    </div>

                                    <div class="deadline-card-meta">

                                        @if($assignment->subject)

                                            <span class="deadline-meta">
                                                📚 {{ $assignment->subject }}
                                            </span>

                                        @endif


                                        @if($assignment->class_name)

                                            <span class="deadline-meta">
                                                🏫 {{ $assignment->class_name }}
                                            </span>

                                        @endif


                                        @if($assignment->teacher)

                                            <span class="deadline-meta">
                                                👨‍🏫 {{ $assignment->teacher->name }}
                                            </span>

                                        @endif

                                    </div>

                                </div>


                                <div class="deadline-status {{ $statusClass }}">
                                    {{ $statusText }}
                                </div>

                            </div>


                            {{-- DEADLINE --}}

                            <div class="deadline-info">

                                <div class="deadline-info-left">

                                    <div class="deadline-clock">
                                        ⏰
                                    </div>

                                    <div>

                                        <div class="deadline-info-label">
                                            Deadline
                                        </div>

                                        <div class="deadline-info-value">

                                            @if($assignment->deadline)

                                                {{ $assignment->deadline->format('d/m/Y • H:i') }}

                                            @else

                                                Tidak ditentukan

                                            @endif

                                        </div>

                                    </div>

                                </div>


                                <div class="deadline-countdown {{ $countdownClass }}">
                                    {{ $countdownText }}
                                </div>

                            </div>


                            {{-- PROGRESS --}}

                            <div class="deadline-progress-area">

                                <div class="deadline-progress-head">

                                    <div class="deadline-progress-label">
                                        Progress Pengumpulan
                                    </div>

                                    <div class="deadline-progress-percent">
                                        {{ $progress }}%
                                    </div>

                                </div>


                                <div class="deadline-progress-bar">

                                    <div
                                        class="deadline-progress-fill
                                        {{ $isSubmitted ? 'complete' : ($isLate ? 'late' : '') }}"
                                        style="width: {{ $progress }}%;"
                                    ></div>

                                </div>

                            </div>


                            {{-- FOOTER --}}

                            <div class="deadline-card-footer">

                                <div class="deadline-note">

                                    @if($isSubmitted)

                                        ✓ File tugas sudah masuk ke sistem.

                                    @elseif($isLate)

                                        ⚠ Tugas belum dikumpulkan dan deadline telah lewat.

                                    @else

                                        Tugas belum dikumpulkan.
                                        Jangan sampai melewati deadline.

                                    @endif

                                </div>


                                <div>

                                    @if($isSubmitted)

                                        <a
                                            href="{{ route('student.submission-versions', $submission) }}"
                                            class="deadline-button secondary"
                                        >
                                            🕒 Riwayat Versi
                                        </a>

                                    @else

                                        <a
                                            href="{{ route('student.assignments.show', $assignment) }}"
                                            class="deadline-button"
                                        >
                                            📤 Lihat &amp; Kumpulkan
                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                {{-- EMPTY --}}

                <div class="deadline-empty">

                    <div class="deadline-empty-icon">
                        📅
                    </div>

                    <h3>
                        Belum Ada Tugas
                    </h3>

                    <p>
                        Saat ini belum ada tugas aktif yang diberikan guru.
                        Jika guru sudah membuat tugas baru, tugas tersebut
                        akan muncul di halaman ini.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>