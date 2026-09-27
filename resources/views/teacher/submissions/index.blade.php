<x-app-layout>

    <div class="nexa-page">

        {{-- BACKGROUND GLOW --}}
        <div class="nexa-glow glow-1"></div>
        <div class="nexa-glow glow-2"></div>

        <div class="nexa-container">

            {{-- HEADER --}}
            <div class="page-header">

                <div>
                    <div class="eyebrow">
                        <span class="eyebrow-dot"></span>
                        TEACHER · SUBMISSIONS
                    </div>

                    <h1 class="page-title">
                        Pengumpulan Tugas
                    </h1>

                    <p class="page-description">
                        Pantau seluruh tugas yang dikumpulkan siswa untuk assignment ini.
                    </p>
                </div>

                <div class="header-badge">
                    <span class="badge-icon">📥</span>
                    <div>
                        <span class="badge-label">TOTAL PENGUMPULAN</span>
                        <strong>{{ $submissions->count() }}</strong>
                    </div>
                </div>

            </div>


            {{-- ASSIGNMENT INFO --}}
            <div class="assignment-card">

                <div class="assignment-icon">
                    📚
                </div>

                <div class="assignment-info">
                    <span class="assignment-label">
                        ASSIGNMENT
                    </span>

                    <h2>
                        {{ $assignment->title }}
                    </h2>

                    <div class="assignment-meta">

                        <span>
                            📘 {{ $assignment->subject }}
                        </span>

                        <span class="meta-divider"></span>

                        <span>
                            👥 {{ $assignment->class_name }}
                        </span>

                    </div>
                </div>

                <div class="assignment-status">
                    <span class="status-dot"></span>
                    ACTIVE
                </div>

            </div>


            {{-- SUBMISSIONS --}}
            <div class="submissions-card">

                <div class="card-header">

                    <div>
                        <span class="section-label">
                            STUDENT SUBMISSIONS
                        </span>

                        <h2>
                            Daftar Pengumpulan
                        </h2>

                        <p>
                            Klik nama siswa untuk melihat detail dan melakukan review.
                        </p>
                    </div>

                    <div class="submission-count">
                        {{ $submissions->count() }}
                        <span>submission</span>
                    </div>

                </div>


                @if($submissions->count() > 0)

                    {{-- DESKTOP TABLE --}}
                    <div class="table-wrapper">

                        <table class="submission-table">

                            <thead>
                                <tr>

                                    <th>
                                        <span>SISWA</span>
                                    </th>

                                    <th>
                                        <span>FILE</span>
                                    </th>

                                    <th>
                                        <span>WAKTU KIRIM</span>
                                    </th>

                                    <th>
                                        <span>STATUS</span>
                                    </th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach($submissions as $submission)

                                    <tr>

                                        {{-- STUDENT --}}
                                        <td>

                                            <a
                                                href="{{ route('teacher.submissions.show', $submission) }}"
                                                class="student-link"
                                            >

                                                <div class="student-avatar">
                                                    {{ strtoupper(substr($submission->student->name, 0, 1)) }}
                                                </div>

                                                <div class="student-info">

                                                    <strong>
                                                        {{ $submission->student->name }}
                                                    </strong>

                                                    <span>
                                                        {{ $submission->student->email }}
                                                    </span>

                                                </div>

                                            </a>

                                        </td>


                                        {{-- FILE --}}
                                        <td>

                                            <div class="file-box">

                                                <div class="file-icon">
                                                    📄
                                                </div>

                                                <span title="{{ $submission->file_name }}">
                                                    {{ $submission->file_name }}
                                                </span>

                                            </div>

                                        </td>


                                        {{-- TIME --}}
                                        <td>

                                            <div class="time-box">

                                                <span class="time-date">
                                                    {{ $submission->created_at->format('d M Y') }}
                                                </span>

                                                <span class="time-hour">
                                                    {{ $submission->created_at->format('H:i') }}
                                                </span>

                                            </div>

                                        </td>


                                        {{-- STATUS --}}
                                        <td>

                                            <span class="status-pill">
                                                <span class="status-pill-dot"></span>
                                                {{ ucfirst($submission->status) }}
                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- MOBILE CARDS --}}
                    <div class="mobile-submissions">

                        @foreach($submissions as $submission)

                            <a
                                href="{{ route('teacher.submissions.show', $submission) }}"
                                class="mobile-submission-card"
                            >

                                <div class="mobile-top">

                                    <div class="mobile-student">

                                        <div class="student-avatar">
                                            {{ strtoupper(substr($submission->student->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <strong>
                                                {{ $submission->student->name }}
                                            </strong>

                                            <span>
                                                {{ $submission->student->email }}
                                            </span>
                                        </div>

                                    </div>

                                    <span class="status-pill">
                                        <span class="status-pill-dot"></span>
                                        {{ ucfirst($submission->status) }}
                                    </span>

                                </div>


                                <div class="mobile-file">

                                    <div class="file-icon">
                                        📄
                                    </div>

                                    <div>
                                        <span>FILE</span>
                                        <strong>
                                            {{ $submission->file_name }}
                                        </strong>
                                    </div>

                                </div>


                                <div class="mobile-time">
                                    🕐
                                    {{ $submission->created_at->format('d M Y H:i') }}
                                </div>

                                <div class="mobile-open">
                                    Lihat Detail
                                    <span>→</span>
                                </div>

                            </a>

                        @endforeach

                    </div>

                @else

                    {{-- EMPTY STATE --}}
                    <div class="empty-state">

                        <div class="empty-icon">
                            📭
                        </div>

                        <div class="empty-glow"></div>

                        <h3>
                            Belum Ada Pengumpulan
                        </h3>

                        <p>
                            Belum ada siswa yang mengumpulkan tugas ini.
                        </p>

                        <div class="empty-line"></div>

                        <span>
                            Submission akan muncul di halaman ini ketika siswa mengumpulkan tugas.
                        </span>

                    </div>

                @endif

            </div>

        </div>

    </div>


    <style>

        /* =========================================================
           NEXA SUBMIT — TEACHER SUBMISSIONS
        ========================================================= */

        .nexa-page {
            position: relative;
            min-height: calc(100vh - 70px);
            padding: 42px 30px 60px;
            overflow: hidden;
            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(91, 33, 182, .18),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 80%,
                    rgba(37, 99, 235, .13),
                    transparent 32%
                );
        }

        .nexa-container {
            position: relative;
            z-index: 2;
            max-width: 1250px;
            margin: auto;
        }


        /* GLOW */

        .nexa-glow {
            position: fixed;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            opacity: .12;
        }

        .glow-1 {
            background: #7c3aed;
            top: 100px;
            left: -180px;
        }

        .glow-2 {
            background: #2563eb;
            bottom: -180px;
            right: -150px;
        }


        /* HEADER */

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 28px;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #a78bfa;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .16em;
            margin-bottom: 10px;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #8b5cf6;
            box-shadow: 0 0 14px #8b5cf6;
        }

        .page-title {
            margin: 0;
            color: #f8fafc;
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.1;
            font-weight: 850;
            letter-spacing: -.04em;
        }

        .page-description {
            margin: 10px 0 0;
            color: #94a3b8;
            font-size: 14px;
        }


        /* HEADER BADGE */

        .header-badge {
            min-width: 185px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px 18px;
            border: 1px solid rgba(139, 92, 246, .2);
            border-radius: 18px;
            background: rgba(15, 23, 42, .65);
            backdrop-filter: blur(18px);
            box-shadow: 0 15px 40px rgba(0,0,0,.15);
        }

        .badge-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: rgba(124, 58, 237, .16);
            font-size: 20px;
        }

        .badge-label {
            display: block;
            color: #64748b;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .12em;
        }

        .header-badge strong {
            display: block;
            color: #f8fafc;
            font-size: 22px;
            margin-top: 1px;
        }


        /* ASSIGNMENT CARD */

        .assignment-card {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 20px;
            margin-bottom: 22px;
            border: 1px solid rgba(148,163,184,.13);
            border-radius: 22px;
            background:
                linear-gradient(
                    135deg,
                    rgba(30,41,59,.88),
                    rgba(15,23,42,.72)
                );
            box-shadow:
                0 20px 60px rgba(0,0,0,.18),
                inset 0 1px rgba(255,255,255,.03);
            backdrop-filter: blur(20px);
        }

        .assignment-icon {
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

        .assignment-info {
            min-width: 0;
            flex: 1;
        }

        .assignment-label,
        .section-label {
            color: #64748b;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .15em;
        }

        .assignment-info h2 {
            margin: 4px 0 7px;
            color: #f8fafc;
            font-size: 19px;
            font-weight: 800;
        }

        .assignment-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #94a3b8;
            font-size: 12px;
        }

        .meta-divider {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #475569;
        }

        .assignment-status {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border-radius: 999px;
            color: #86efac;
            background: rgba(34,197,94,.08);
            border: 1px solid rgba(34,197,94,.14);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .08em;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 10px rgba(34,197,94,.8);
        }


        /* MAIN CARD */

        .submissions-card {
            overflow: hidden;
            border: 1px solid rgba(148,163,184,.13);
            border-radius: 24px;
            background: rgba(15,23,42,.76);
            box-shadow:
                0 30px 80px rgba(0,0,0,.22),
                inset 0 1px rgba(255,255,255,.035);
            backdrop-filter: blur(24px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 26px 28px;
            border-bottom: 1px solid rgba(148,163,184,.1);
        }

        .card-header h2 {
            margin: 5px 0 4px;
            color: #f8fafc;
            font-size: 20px;
            font-weight: 800;
        }

        .card-header p {
            margin: 0;
            color: #64748b;
            font-size: 12px;
        }

        .submission-count {
            color: #a78bfa;
            font-size: 24px;
            font-weight: 850;
            text-align: right;
        }

        .submission-count span {
            display: block;
            color: #64748b;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .08em;
        }


        /* TABLE */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .submission-table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
        }

        .submission-table thead {
            background: rgba(2,6,23,.28);
        }

        .submission-table th {
            padding: 14px 24px;
            text-align: left;
            color: #64748b;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .13em;
            white-space: nowrap;
        }

        .submission-table td {
            padding: 17px 24px;
            border-top: 1px solid rgba(148,163,184,.07);
            vertical-align: middle;
        }

        .submission-table tbody tr {
            transition: .2s ease;
        }

        .submission-table tbody tr:hover {
            background: rgba(124,58,237,.045);
        }


        /* STUDENT */

        .student-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            color: #ddd6fe;
            background:
                linear-gradient(
                    135deg,
                    rgba(124,58,237,.32),
                    rgba(37,99,235,.28)
                );
            border: 1px solid rgba(139,92,246,.22);
            font-size: 14px;
            font-weight: 850;
        }

        .student-info strong {
            display: block;
            color: #f1f5f9;
            font-size: 13px;
            transition: .2s;
        }

        .student-link:hover .student-info strong {
            color: #a78bfa;
        }

        .student-info span {
            display: block;
            max-width: 230px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #64748b;
            font-size: 11px;
            margin-top: 3px;
        }


        /* FILE */

        .file-box {
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 260px;
        }

        .file-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: rgba(59,130,246,.1);
            border: 1px solid rgba(59,130,246,.13);
            font-size: 15px;
        }

        .file-box span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 600;
        }


        /* TIME */

        .time-box {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .time-date {
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 600;
        }

        .time-hour {
            color: #64748b;
            font-size: 11px;
        }


        /* STATUS */

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border-radius: 999px;
            color: #86efac;
            background: rgba(34,197,94,.08);
            border: 1px solid rgba(34,197,94,.13);
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-pill-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 9px rgba(34,197,94,.7);
        }


        /* EMPTY */

        .empty-state {
            position: relative;
            padding: 80px 25px;
            text-align: center;
            overflow: hidden;
        }

        .empty-icon {
            position: relative;
            z-index: 2;
            width: 78px;
            height: 78px;
            display: grid;
            place-items: center;
            margin: 0 auto 20px;
            border-radius: 24px;
            background:
                linear-gradient(
                    135deg,
                    rgba(124,58,237,.15),
                    rgba(37,99,235,.1)
                );
            border: 1px solid rgba(139,92,246,.14);
            font-size: 32px;
        }

        .empty-state h3 {
            position: relative;
            z-index: 2;
            margin: 0;
            color: #f8fafc;
            font-size: 20px;
            font-weight: 800;
        }

        .empty-state p {
            position: relative;
            z-index: 2;
            margin: 8px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .empty-line {
            position: relative;
            z-index: 2;
            width: 55px;
            height: 2px;
            margin: 24px auto 13px;
            border-radius: 99px;
            background: linear-gradient(
                90deg,
                #7c3aed,
                #3b82f6
            );
        }

        .empty-state > span {
            position: relative;
            z-index: 2;
            color: #475569;
            font-size: 11px;
        }

        .empty-glow {
            position: absolute;
            width: 250px;
            height: 250px;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            border-radius: 50%;
            background: rgba(124,58,237,.08);
            filter: blur(70px);
        }


        /* MOBILE */

        .mobile-submissions {
            display: none;
        }

        @media(max-width: 800px) {

            .nexa-page {
                padding: 28px 16px 45px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 18px;
            }

            .header-badge {
                width: 100%;
            }

            .assignment-card {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .assignment-status {
                margin-left: 76px;
            }

            .card-header {
                padding: 22px 20px;
            }

            .submission-table {
                display: none;
            }

            .table-wrapper {
                display: none;
            }

            .mobile-submissions {
                display: flex;
                flex-direction: column;
            }

            .mobile-submission-card {
                display: block;
                padding: 19px;
                border-bottom: 1px solid rgba(148,163,184,.08);
                text-decoration: none;
                transition: .2s ease;
            }

            .mobile-submission-card:hover {
                background: rgba(124,58,237,.05);
            }

            .mobile-top {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 12px;
            }

            .mobile-student {
                display: flex;
                align-items: center;
                gap: 10px;
                min-width: 0;
            }

            .mobile-student > div:last-child {
                min-width: 0;
            }

            .mobile-student strong {
                display: block;
                color: #f1f5f9;
                font-size: 13px;
            }

            .mobile-student span {
                display: block;
                max-width: 170px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                color: #64748b;
                font-size: 10px;
                margin-top: 3px;
            }

            .mobile-file {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-top: 17px;
                padding: 12px;
                border-radius: 13px;
                background: rgba(2,6,23,.28);
                border: 1px solid rgba(148,163,184,.08);
            }

            .mobile-file > div:last-child {
                min-width: 0;
            }

            .mobile-file span {
                display: block;
                color: #64748b;
                font-size: 8px;
                font-weight: 800;
                letter-spacing: .1em;
            }

            .mobile-file strong {
                display: block;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                color: #cbd5e1;
                font-size: 11px;
                margin-top: 3px;
            }

            .mobile-time {
                color: #64748b;
                font-size: 10px;
                margin-top: 12px;
            }

            .mobile-open {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 14px;
                padding-top: 12px;
                border-top: 1px solid rgba(148,163,184,.07);
                color: #a78bfa;
                font-size: 10px;
                font-weight: 800;
            }

            .mobile-open span {
                font-size: 16px;
            }
        }

        @media(max-width: 480px) {

            .nexa-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .page-title {
                font-size: 29px;
            }

            .assignment-icon {
                width: 50px;
                height: 50px;
                flex-basis: 50px;
            }

            .assignment-status {
                margin-left: 68px;
            }

            .assignment-meta {
                flex-wrap: wrap;
            }

            .card-header {
                align-items: flex-start;
            }

            .submission-count {
                font-size: 20px;
            }

            .status-pill {
                font-size: 9px;
                padding: 6px 8px;
            }
        }

    </style>

</x-app-layout>