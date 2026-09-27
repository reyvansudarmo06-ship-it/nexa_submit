<x-app-layout>

    <style>
        .nexa-logs {
            min-height: calc(100vh - 80px);
            padding: 34px;
            color: #f8fafc;
            background:
                radial-gradient(circle at 85% 0%, rgba(99,102,241,.18), transparent 28%),
                radial-gradient(circle at 10% 85%, rgba(6,182,212,.08), transparent 30%),
                #070a12;
        }

        .nexa-logs-container {
            max-width: 1350px;
            margin: 0 auto;
        }

        /* HERO */

        .logs-hero {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 28px;
        }

        .logs-eyebrow {
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

        .logs-hero h1 {
            margin: 0;
            font-size: 34px;
            line-height: 1.15;
            font-weight: 850;
            letter-spacing: -.8px;
        }

        .logs-hero p {
            margin: 9px 0 0;
            color: #94a3b8;
            font-size: 14px;
        }

        .monitor-status {
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

        .monitor-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 12px rgba(34,197,94,.8);
        }

        /* STATISTICS */

        .logs-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 17px;
            margin-bottom: 22px;
        }

        .logs-stat {
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

        .logs-stat::after {
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

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .stat-icon {
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

        .stat-tag {
            color: #475569;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .6px;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 12px;
        }

        .stat-value {
            margin-top: 4px;
            font-size: 29px;
            font-weight: 850;
        }

        .stat-purple .stat-icon {
            background: rgba(168,85,247,.10);
            border-color: rgba(168,85,247,.16);
        }

        .stat-green .stat-icon {
            background: rgba(34,197,94,.10);
            border-color: rgba(34,197,94,.16);
        }

        .stat-yellow .stat-icon {
            background: rgba(234,179,8,.10);
            border-color: rgba(234,179,8,.16);
        }

        /* CARD */

        .nexa-log-card {
            overflow: hidden;
            margin-bottom: 22px;
            border-radius: 22px;
            background: rgba(11,16,29,.82);
            border: 1px solid rgba(148,163,184,.12);
            box-shadow: 0 25px 70px rgba(0,0,0,.20);
            backdrop-filter: blur(18px);
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 21px 23px;
            border-bottom: 1px solid rgba(148,163,184,.08);
        }

        .card-heading-icon {
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

        .card-title {
            font-size: 17px;
            font-weight: 800;
        }

        .card-subtitle {
            margin-top: 4px;
            color: #64748b;
            font-size: 11px;
        }

        /* FILTER */

        .filter-body {
            padding: 22px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr auto;
            gap: 13px;
            align-items: end;
        }

        .field-label {
            display: block;
            margin-bottom: 7px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
        }

        .nexa-input,
        .nexa-select {
            width: 100%;
            height: 43px;
            padding: 0 13px;
            color: #e2e8f0;
            background: #080d19;
            border: 1px solid rgba(148,163,184,.13);
            border-radius: 12px;
            outline: none;
            font-size: 12px;
            transition: border-color .2s ease,
                        box-shadow .2s ease;
        }

        .nexa-input::placeholder {
            color: #475569;
        }

        .nexa-input:focus,
        .nexa-select:focus {
            border-color: rgba(99,102,241,.55);
            box-shadow: 0 0 0 3px rgba(99,102,241,.08);
        }

        .nexa-select option {
            background: #0b1120;
            color: #e2e8f0;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
        }

        .btn-filter,
        .btn-reset {
            height: 43px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 17px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 750;
            text-decoration: none;
            white-space: nowrap;
            transition: all .2s ease;
        }

        .btn-filter {
            color: white;
            border: 1px solid rgba(129,140,248,.22);
            background: linear-gradient(
                135deg,
                #6366f1,
                #4f46e5
            );
            box-shadow: 0 8px 24px rgba(79,70,229,.20);
        }

        .btn-filter:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(79,70,229,.28);
        }

        .btn-reset {
            color: #94a3b8;
            background: #121a2a;
            border: 1px solid rgba(148,163,184,.10);
        }

        .btn-reset:hover {
            color: #e2e8f0;
            background: #172033;
        }

        .export-row {
            padding: 0 22px 22px;
        }

        .btn-export {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border-radius: 12px;
            color: #86efac;
            background: rgba(34,197,94,.08);
            border: 1px solid rgba(34,197,94,.16);
            text-decoration: none;
            font-size: 11px;
            font-weight: 750;
            transition: all .2s ease;
        }

        .btn-export:hover {
            background: rgba(34,197,94,.14);
            transform: translateY(-1px);
        }

        /* LOG HEADER */

        .logs-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 21px 23px;
            border-bottom: 1px solid rgba(148,163,184,.08);
        }

        .logs-count {
            display: inline-flex;
            align-items: center;
            padding: 7px 11px;
            border-radius: 999px;
            color: #a5b4fc;
            background: rgba(99,102,241,.09);
            border: 1px solid rgba(129,140,248,.15);
            font-size: 10px;
            font-weight: 800;
        }

        .page-number {
            color: #64748b;
            font-size: 10px;
        }

        /* TABLE */

        .table-wrapper {
            overflow-x: auto;
        }

        .logs-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        .logs-table thead {
            background: rgba(5,9,17,.55);
        }

        .logs-table th {
            padding: 14px 20px;
            color: #64748b;
            text-align: left;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .7px;
            border-bottom: 1px solid rgba(148,163,184,.07);
        }

        .logs-table td {
            padding: 16px 20px;
            color: #cbd5e1;
            font-size: 11px;
            border-bottom: 1px solid rgba(148,163,184,.06);
            vertical-align: middle;
        }

        .logs-table tbody tr {
            transition: background .2s ease;
        }

        .logs-table tbody tr:hover {
            background: rgba(99,102,241,.035);
        }

        .date-main {
            color: #e2e8f0;
            font-size: 11px;
            font-weight: 650;
            white-space: nowrap;
        }

        .date-time {
            margin-top: 3px;
            color: #475569;
            font-family: monospace;
            font-size: 9px;
        }

        .log-user-name {
            color: #e2e8f0;
            font-size: 11px;
            font-weight: 700;
        }

        .log-user-role {
            margin-top: 3px;
            color: #64748b;
            font-size: 9px;
            text-transform: capitalize;
        }

        .system-user {
            color: #64748b;
            font-size: 11px;
        }

        .action-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 9px;
            border-radius: 999px;
            border: 1px solid;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        .action-submission {
            color: #4ade80;
            background: rgba(34,197,94,.08);
            border-color: rgba(34,197,94,.16);
        }

        .action-ai {
            color: #c084fc;
            background: rgba(168,85,247,.08);
            border-color: rgba(168,85,247,.16);
        }

        .action-review {
            color: #facc15;
            background: rgba(234,179,8,.08);
            border-color: rgba(234,179,8,.16);
        }

        .action-assignment {
            color: #60a5fa;
            background: rgba(59,130,246,.08);
            border-color: rgba(59,130,246,.16);
        }

        .action-default {
            color: #94a3b8;
            background: rgba(100,116,139,.08);
            border-color: rgba(100,116,139,.16);
        }

        .description {
            max-width: 360px;
            color: #94a3b8;
            line-height: 1.5;
        }

        .ip-address {
            color: #64748b;
            font-family: monospace;
            font-size: 10px;
            white-space: nowrap;
        }

        /* EMPTY */

        .logs-empty {
            padding: 70px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            background: rgba(99,102,241,.08);
            border: 1px solid rgba(129,140,248,.12);
            font-size: 24px;
        }

        .empty-title {
            color: #e2e8f0;
            font-size: 16px;
            font-weight: 750;
        }

        .empty-text {
            margin-top: 6px;
            color: #64748b;
            font-size: 11px;
        }

        /* PAGINATION */

        .pagination-wrapper {
            padding: 18px 22px;
            border-top: 1px solid rgba(148,163,184,.07);
            overflow-x: auto;
        }

        .pagination-wrapper nav {
            display: flex;
            justify-content: center;
        }

        /* RESPONSIVE */

        @media (max-width: 1050px) {

            .logs-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }

            .filter-actions {
                grid-column: span 2;
            }
        }

        @media (max-width: 700px) {

            .nexa-logs {
                padding: 20px 14px;
            }

            .logs-hero {
                flex-direction: column;
                align-items: flex-start;
            }

            .logs-hero h1 {
                font-size: 27px;
            }

            .logs-stats {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                grid-column: auto;
            }

            .btn-filter,
            .btn-reset {
                flex: 1;
            }

            .logs-header {
                padding: 18px;
            }

            .filter-body {
                padding: 18px;
            }

            .export-row {
                padding: 0 18px 18px;
            }
        }
    </style>


    <div class="nexa-logs">

        <div class="nexa-logs-container">

            {{-- HERO --}}

            <div class="logs-hero">

                <div>

                    <div class="logs-eyebrow">
                        🛡️ NEXA SECURITY MONITORING
                    </div>

                    <h1>
                        Security & System Logs
                    </h1>

                    <p>
                        Pantau aktivitas pengguna dan sistem NEXA SUBMIT
                        secara terpusat.
                    </p>

                </div>

                <div class="monitor-status">
                    <span class="monitor-dot"></span>
                    System Monitoring Active
                </div>

            </div>


            {{-- STATISTICS --}}

            <div class="logs-stats">

                {{-- TOTAL --}}

                <div class="logs-stat">

                    <div class="stat-top">

                        <div class="stat-icon">
                            🛡️
                        </div>

                        <span class="stat-tag">
                            ALL ACTIVITY
                        </span>

                    </div>

                    <div class="stat-label">
                        Total Aktivitas
                    </div>

                    <div class="stat-value">
                        {{ $totalLogs }}
                    </div>

                </div>


                {{-- AI --}}

                <div class="logs-stat stat-purple">

                    <div class="stat-top">

                        <div class="stat-icon">
                            🤖
                        </div>

                        <span class="stat-tag">
                            NEXA AI
                        </span>

                    </div>

                    <div class="stat-label">
                        AI Analysis
                    </div>

                    <div class="stat-value" style="color:#c084fc;">
                        {{ $aiLogs }}
                    </div>

                </div>


                {{-- SUBMISSION --}}

                <div class="logs-stat stat-green">

                    <div class="stat-top">

                        <div class="stat-icon">
                            📤
                        </div>

                        <span class="stat-tag">
                            SUBMISSIONS
                        </span>

                    </div>

                    <div class="stat-label">
                        Submission
                    </div>

                    <div class="stat-value" style="color:#4ade80;">
                        {{ $submissionLogs }}
                    </div>

                </div>


                {{-- REVIEW --}}

                <div class="logs-stat stat-yellow">

                    <div class="stat-top">

                        <div class="stat-icon">
                            📋
                        </div>

                        <span class="stat-tag">
                            REVIEWS
                        </span>

                    </div>

                    <div class="stat-label">
                        Teacher Review
                    </div>

                    <div class="stat-value" style="color:#facc15;">
                        {{ $reviewLogs }}
                    </div>

                </div>

            </div>


            {{-- FILTER CARD --}}

            <div class="nexa-log-card">

                <div class="card-heading">

                    <div class="card-heading-icon">
                        🔎
                    </div>

                    <div>

                        <div class="card-title">
                            Search & Filter
                        </div>

                        <div class="card-subtitle">
                            Cari dan saring aktivitas sistem berdasarkan kebutuhan.
                        </div>

                    </div>

                </div>


                <form
                    method="GET"
                    action="{{ route('teacher.logs') }}"
                    class="filter-body"
                >

                    <div class="filter-grid">

                        {{-- SEARCH --}}

                        <div>

                            <label class="field-label">
                                Cari Log
                            </label>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="User, aktivitas, IP..."
                                class="nexa-input"
                            >

                        </div>


                        {{-- USER --}}

                        <div>

                            <label class="field-label">
                                Filter User
                            </label>

                            <select
                                name="user_id"
                                class="nexa-select"
                            >

                                <option value="">
                                    Semua User
                                </option>

                                @foreach($users as $user)

                                    <option
                                        value="{{ $user->id }}"
                                        {{ request('user_id') == $user->id ? 'selected' : '' }}
                                    >
                                        {{ $user->name }} — {{ ucfirst($user->role) }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- ACTION --}}

                        <div>

                            <label class="field-label">
                                Filter Aktivitas
                            </label>

                            <select
                                name="action"
                                class="nexa-select"
                            >

                                <option value="">
                                    Semua Aktivitas
                                </option>

                                <option
                                    value="SUBMISSION_CREATED"
                                    {{ request('action') === 'SUBMISSION_CREATED' ? 'selected' : '' }}
                                >
                                    Submission
                                </option>

                                <option
                                    value="AI_ANALYSIS"
                                    {{ request('action') === 'AI_ANALYSIS' ? 'selected' : '' }}
                                >
                                    AI Analysis
                                </option>

                                <option
                                    value="AI_VERSION_ANALYSIS"
                                    {{ request('action') === 'AI_VERSION_ANALYSIS' ? 'selected' : '' }}
                                >
                                    AI Version Analysis
                                </option>

                                <option
                                    value="TEACHER_REVIEW"
                                    {{ request('action') === 'TEACHER_REVIEW' ? 'selected' : '' }}
                                >
                                    Teacher Review
                                </option>

                                <option
                                    value="CREATE_ASSIGNMENT"
                                    {{ request('action') === 'CREATE_ASSIGNMENT' ? 'selected' : '' }}
                                >
                                    Create Assignment
                                </option>

                            </select>

                        </div>


                        {{-- BUTTONS --}}

                        <div class="filter-actions">

                            <button
                                type="submit"
                                class="btn-filter"
                            >
                                🔎 Filter
                            </button>

                            <a
                                href="{{ route('teacher.logs') }}"
                                class="btn-reset"
                            >
                                Reset
                            </a>

                        </div>

                    </div>

                </form>


                {{-- EXPORT --}}

                <div class="export-row">

                    <a
                        href="{{ route('teacher.logs.export', request()->query()) }}"
                        class="btn-export"
                    >
                        ⬇️ Export CSV
                    </a>

                </div>

            </div>


            {{-- LOG LIST --}}

            <div class="nexa-log-card">

                <div class="logs-header">

                    <div>

                        <div class="card-title">
                            Aktivitas Terbaru
                        </div>

                        <div class="card-subtitle">
                            {{ $logs->total() }} aktivitas tercatat
                        </div>

                    </div>

                    <div>

                        <span class="logs-count">
                            PAGE {{ $logs->currentPage() }}
                        </span>

                    </div>

                </div>


                @if($logs->count())

                    <div class="table-wrapper">

                        <table class="logs-table">

                            <thead>

                                <tr>

                                    <th>
                                        Waktu
                                    </th>

                                    <th>
                                        User
                                    </th>

                                    <th>
                                        Aktivitas
                                    </th>

                                    <th>
                                        Deskripsi
                                    </th>

                                    <th>
                                        IP Address
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($logs as $log)

                                    <tr>

                                        {{-- WAKTU --}}

                                        <td>

                                            <div class="date-main">
                                                {{ $log->created_at?->format('d M Y') }}
                                            </div>

                                            <div class="date-time">
                                                {{ $log->created_at?->format('H:i:s') }}
                                            </div>

                                        </td>


                                        {{-- USER --}}

                                        <td>

                                            @if($log->user)

                                                <div class="log-user-name">
                                                    {{ $log->user->name }}
                                                </div>

                                                <div class="log-user-role">
                                                    {{ $log->user->role }}
                                                </div>

                                            @else

                                                <span class="system-user">
                                                    System
                                                </span>

                                            @endif

                                        </td>


                                        {{-- AKTIVITAS --}}

                                        <td>

                                            @php
                                                $actionClass = match($log->action) {

                                                    'SUBMISSION_CREATED'
                                                        => 'action-submission',

                                                    'AI_ANALYSIS',
                                                    'AI_VERSION_ANALYSIS'
                                                        => 'action-ai',

                                                    'TEACHER_REVIEW'
                                                        => 'action-review',

                                                    'CREATE_ASSIGNMENT'
                                                        => 'action-assignment',

                                                    default
                                                        => 'action-default',
                                                };
                                            @endphp

                                            <span class="action-pill {{ $actionClass }}">
                                                {{ $log->action }}
                                            </span>

                                        </td>


                                        {{-- DESKRIPSI --}}

                                        <td>

                                            <div class="description">
                                                {{ $log->description ?? '-' }}
                                            </div>

                                        </td>


                                        {{-- IP --}}

                                        <td>

                                            <span class="ip-address">
                                                {{ $log->ip_address ?? '-' }}
                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- PAGINATION --}}

                    <div class="pagination-wrapper">

                        {{ $logs->withQueryString()->links() }}

                    </div>

                @else

                    <div class="logs-empty">

                        <div class="empty-icon">
                            🛡️
                        </div>

                        <div class="empty-title">
                            Tidak Ada Aktivitas
                        </div>

                        <div class="empty-text">
                            Tidak ditemukan log dengan filter tersebut.
                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>