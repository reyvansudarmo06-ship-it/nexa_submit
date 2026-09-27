<x-app-layout>

    <style>
        .nexa-users {
            min-height: calc(100vh - 80px);
            padding: 34px;
            color: #f8fafc;
            background:
                radial-gradient(circle at 85% 0%, rgba(99,102,241,.18), transparent 28%),
                radial-gradient(circle at 10% 80%, rgba(6,182,212,.08), transparent 30%),
                #070a12;
        }

        .nexa-users-container {
            max-width: 1250px;
            margin: 0 auto;
        }

        /* HEADER */

        .users-hero {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 28px;
        }

        .users-eyebrow {
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

        .users-hero h1 {
            margin: 0;
            font-size: 34px;
            line-height: 1.15;
            font-weight: 850;
            letter-spacing: -.8px;
        }

        .users-hero p {
            margin: 9px 0 0;
            color: #94a3b8;
            font-size: 14px;
            max-width: 620px;
        }

        .system-status {
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

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 12px rgba(34,197,94,.8);
        }

        /* STATS */

        .users-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 17px;
            margin-bottom: 22px;
        }

        .users-stat {
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

        .users-stat::after {
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
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: rgba(99,102,241,.12);
            border: 1px solid rgba(129,140,248,.18);
            font-size: 19px;
        }

        .stat-tag {
            font-size: 10px;
            color: #64748b;
            font-weight: 700;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 12px;
        }

        .stat-number {
            margin-top: 4px;
            font-size: 29px;
            font-weight: 850;
            letter-spacing: -.5px;
        }

        /* MAIN CARD */

        .users-panel {
            overflow: hidden;
            border-radius: 22px;
            background: rgba(11,16,29,.82);
            border: 1px solid rgba(148,163,184,.12);
            box-shadow: 0 25px 70px rgba(0,0,0,.22);
            backdrop-filter: blur(18px);
        }

        .users-panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 22px 24px;
            border-bottom: 1px solid rgba(148,163,184,.09);
        }

        .panel-title-wrap {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .panel-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(
                135deg,
                rgba(99,102,241,.20),
                rgba(6,182,212,.12)
            );
            border: 1px solid rgba(129,140,248,.18);
        }

        .panel-title {
            font-size: 17px;
            font-weight: 800;
        }

        .panel-subtitle {
            margin-top: 4px;
            color: #64748b;
            font-size: 11px;
        }

        .user-count {
            padding: 7px 11px;
            border-radius: 999px;
            background: rgba(99,102,241,.09);
            border: 1px solid rgba(129,140,248,.15);
            color: #a5b4fc;
            font-size: 10px;
            font-weight: 800;
        }

        /* USER ROW */

        .user-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 17px 24px;
            border-bottom: 1px solid rgba(148,163,184,.07);
            transition: background .2s ease;
        }

        .user-row:last-child {
            border-bottom: none;
        }

        .user-row:hover {
            background: rgba(99,102,241,.045);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            min-width: 45px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                linear-gradient(
                    135deg,
                    #6366f1,
                    #06b6d4
                );
            color: white;
            font-size: 15px;
            font-weight: 850;
            box-shadow: 0 7px 22px rgba(99,102,241,.18);
        }

        .user-main {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            color: #f8fafc;
            font-size: 14px;
            font-weight: 750;
        }

        .user-email {
            color: #64748b;
            font-size: 11px;
            margin-top: 4px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-role {
            min-width: 105px;
        }

        .role-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .4px;
        }

        .role-student {
            color: #60a5fa;
            background: rgba(59,130,246,.10);
            border: 1px solid rgba(59,130,246,.16);
        }

        .role-teacher {
            color: #c084fc;
            background: rgba(168,85,247,.10);
            border: 1px solid rgba(168,85,247,.16);
        }

        .user-date {
            min-width: 120px;
            text-align: right;
            color: #64748b;
            font-size: 10px;
            line-height: 1.5;
        }

        .date-label {
            color: #475569;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .date-value {
            color: #94a3b8;
            font-size: 11px;
            font-weight: 600;
        }

        /* EMPTY */

        .users-empty {
            padding: 75px 20px;
            text-align: center;
            color: #64748b;
        }

        .empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 16px;
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
            font-size: 12px;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {
            .nexa-users {
                padding: 24px 18px;
            }

            .users-hero {
                align-items: flex-start;
                flex-direction: column;
            }

            .users-stats {
                grid-template-columns: 1fr;
            }

            .system-status {
                width: fit-content;
            }

            .user-row {
                flex-wrap: wrap;
            }

            .user-main {
                min-width: calc(100% - 65px);
            }

            .user-role {
                margin-left: 61px;
            }

            .user-date {
                margin-left: auto;
            }
        }

        @media (max-width: 520px) {
            .nexa-users {
                padding: 18px 13px;
            }

            .users-hero h1 {
                font-size: 27px;
            }

            .users-panel-header {
                padding: 18px;
            }

            .user-row {
                padding: 16px;
                gap: 13px;
            }

            .user-role {
                margin-left: 0;
            }

            .user-date {
                width: 100%;
                margin-left: 0;
                text-align: left;
                padding-left: 58px;
            }

            .user-count {
                display: none;
            }
        }
    </style>


    <div class="nexa-users">

        <div class="nexa-users-container">

            {{-- HERO --}}

            <div class="users-hero">

                <div>

                    <div class="users-eyebrow">
                        👥 NEXA USER MANAGEMENT
                    </div>

                    <h1>
                        Manajemen User
                    </h1>

                    <p>
                        Pantau akun siswa dan guru yang terdaftar
                        di ekosistem NEXA SUBMIT.
                    </p>

                </div>

                <div class="system-status">
                    <span class="status-dot"></span>
                    Sistem User Aktif
                </div>

            </div>


            {{-- STATISTICS --}}

            <div class="users-stats">

                <div class="users-stat">

                    <div class="stat-top">

                        <div class="stat-icon">
                            👥
                        </div>

                        <span class="stat-tag">
                            ALL ACCOUNTS
                        </span>

                    </div>

                    <div class="stat-label">
                        Total User
                    </div>

                    <div class="stat-number">
                        {{ $totalUsers }}
                    </div>

                </div>


                <div class="users-stat">

                    <div class="stat-top">

                        <div class="stat-icon">
                            🎓
                        </div>

                        <span class="stat-tag">
                            STUDENT
                        </span>

                    </div>

                    <div class="stat-label">
                        Total Siswa
                    </div>

                    <div class="stat-number">
                        {{ $totalStudents }}
                    </div>

                </div>


                <div class="users-stat">

                    <div class="stat-top">

                        <div class="stat-icon">
                            👨‍🏫
                        </div>

                        <span class="stat-tag">
                            TEACHER
                        </span>

                    </div>

                    <div class="stat-label">
                        Total Guru
                    </div>

                    <div class="stat-number">
                        {{ $totalTeachers }}
                    </div>

                </div>

            </div>


            {{-- USER LIST --}}

            <div class="users-panel">

                <div class="users-panel-header">

                    <div class="panel-title-wrap">

                        <div class="panel-icon">
                            👤
                        </div>

                        <div>

                            <div class="panel-title">
                                Daftar User
                            </div>

                            <div class="panel-subtitle">
                                Semua akun yang tersedia di sistem NEXA SUBMIT.
                            </div>

                        </div>

                    </div>

                    <div class="user-count">
                        {{ $totalUsers }} USER
                    </div>

                </div>


                @if($users->count() > 0)

                    @foreach($users as $user)

                        <div class="user-row">

                            {{-- AVATAR --}}

                            <div class="user-avatar">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>


                            {{-- USER INFO --}}

                            <div class="user-main">

                                <div class="user-name">
                                    {{ $user->name }}
                                </div>

                                <div class="user-email">
                                    {{ $user->email }}
                                </div>

                            </div>


                            {{-- ROLE --}}

                            <div class="user-role">

                                @if($user->role === 'teacher')

                                    <span class="role-pill role-teacher">
                                        👨‍🏫 TEACHER
                                    </span>

                                @else

                                    <span class="role-pill role-student">
                                        🎓 STUDENT
                                    </span>

                                @endif

                            </div>


                            {{-- DATE --}}

                            <div class="user-date">

                                <div class="date-label">
                                    Bergabung
                                </div>

                                <div class="date-value">
                                    {{ $user->created_at?->format('d M Y') }}
                                </div>

                            </div>

                        </div>

                    @endforeach

                @else

                    <div class="users-empty">

                        <div class="empty-icon">
                            👥
                        </div>

                        <div class="empty-title">
                            Belum Ada User
                        </div>

                        <div class="empty-text">
                            Belum ada akun yang tersedia di sistem.
                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>