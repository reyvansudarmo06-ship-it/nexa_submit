<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NEXA SUBMIT</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background: #070b16;
            color: #e8ecf7;
        }

        a {
            text-decoration: none;
        }

        button,
        input,
        textarea,
        select {
            font: inherit;
        }

        ::selection {
            background: rgba(124, 92, 255, .35);
            color: white;
        }

        /* =====================================================
           GLOBAL APP
        ===================================================== */

        .nexa-app {
            min-height: 100vh;
            display: flex;

            background:
                radial-gradient(
                    circle at 78% -10%,
                    rgba(99, 102, 241, .18),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 35% 110%,
                    rgba(139, 92, 246, .08),
                    transparent 30%
                ),
                #070b16;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .nexa-sidebar {
            position: fixed;
            z-index: 100;

            top: 0;
            left: 0;
            bottom: 0;

            width: 278px;

            display: flex;
            flex-direction: column;

            background:
                linear-gradient(
                    180deg,
                    rgba(17, 24, 39, .98),
                    rgba(10, 15, 28, .99)
                );

            border-right: 1px solid rgba(255,255,255,.07);

            box-shadow:
                20px 0 60px rgba(0,0,0,.18);

            overflow: hidden;
        }

        .nexa-sidebar::before {
            content: "";

            position: absolute;

            width: 240px;
            height: 240px;

            top: -100px;
            left: -100px;

            background: rgba(99,102,241,.16);

            filter: blur(80px);

            pointer-events: none;
        }

        /* =====================================================
           BRAND
        ===================================================== */

        .nexa-logo {
            position: relative;

            min-height: 88px;

            padding: 0 25px;

            display: flex;
            align-items: center;

            border-bottom: 1px solid rgba(255,255,255,.06);
        }

        .nexa-brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .nexa-brand-mark {
            width: 42px;
            height: 42px;

            border-radius: 14px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            font-size: 18px;
            font-weight: 900;

            background:
                linear-gradient(
                    135deg,
                    #7c3aed,
                    #4f46e5 55%,
                    #2563eb
                );

            box-shadow:
                0 10px 30px rgba(79,70,229,.35),
                inset 0 1px 0 rgba(255,255,255,.2);
        }

        .nexa-logo-main {
            color: #fff;

            font-size: 21px;
            line-height: 1;

            font-weight: 900;

            letter-spacing: -.7px;
        }

        .nexa-logo-main span {
            color: #8b7cff;
        }

        .nexa-logo-sub {
            margin-top: 5px;

            color: #667085;

            font-size: 8px;
            font-weight: 800;

            letter-spacing: 2px;
        }

        /* =====================================================
           USER CARD
        ===================================================== */

        .nexa-user {
            padding: 18px;
        }

        .nexa-user-box {
            position: relative;

            padding: 13px;

            display: flex;
            align-items: center;

            gap: 12px;

            border-radius: 17px;

            background:
                linear-gradient(
                    135deg,
                    rgba(255,255,255,.055),
                    rgba(255,255,255,.02)
                );

            border: 1px solid rgba(255,255,255,.07);

            box-shadow:
                inset 0 1px 0 rgba(255,255,255,.04);
        }

        .nexa-avatar {
            width: 43px;
            height: 43px;

            flex-shrink: 0;

            border-radius: 13px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            font-size: 15px;
            font-weight: 900;

            background:
                linear-gradient(
                    135deg,
                    #8b5cf6,
                    #4f46e5
                );

            box-shadow:
                0 8px 22px rgba(79,70,229,.3);
        }

        .nexa-user-name {
            max-width: 150px;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;

            color: #fff;

            font-size: 13px;
            font-weight: 800;
        }

        .nexa-user-role {
            margin-top: 4px;

            color: #7f8ba3;

            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .8px;
        }

        /* =====================================================
           MENU
        ===================================================== */

        .nexa-menu {
            position: relative;

            flex: 1;

            padding: 5px 14px 15px;

            overflow-y: auto;
        }

        .nexa-menu::-webkit-scrollbar {
            width: 4px;
        }

        .nexa-menu::-webkit-scrollbar-thumb {
            background: #26304a;
            border-radius: 20px;
        }

        .nexa-menu-title {
            padding: 0 11px;

            margin: 19px 0 8px;

            color: #556078;

            font-size: 9px;
            font-weight: 900;

            letter-spacing: 1.7px;

            text-transform: uppercase;
        }

        .nexa-menu a {
            position: relative;

            display: flex;
            align-items: center;

            gap: 11px;

            min-height: 43px;

            margin-bottom: 4px;
            padding: 10px 12px;

            border: 1px solid transparent;

            border-radius: 13px;

            color: #8e99ad;

            font-size: 12px;
            font-weight: 700;

            transition:
                background .2s ease,
                color .2s ease,
                border .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        .nexa-menu a:hover {
            color: #fff;

            background: rgba(255,255,255,.045);

            border-color: rgba(255,255,255,.06);

            transform: translateX(3px);
        }

        .nexa-menu a.active {
            color: #fff;

            background:
                linear-gradient(
                    135deg,
                    rgba(124,92,255,.25),
                    rgba(59,130,246,.12)
                );

            border-color:
                rgba(124,92,255,.27);

            box-shadow:
                0 10px 28px rgba(0,0,0,.12);
        }

        .nexa-menu a.active::before {
            content: "";

            position: absolute;

            left: -14px;

            width: 3px;
            height: 23px;

            border-radius: 0 8px 8px 0;

            background:
                linear-gradient(
                    180deg,
                    #a78bfa,
                    #4f46e5
                );

            box-shadow:
                0 0 15px rgba(124,92,255,.7);
        }

        .nexa-icon {
            width: 27px;
            min-width: 27px;
            height: 27px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: rgba(255,255,255,.035);

            font-size: 14px;

            transition: .2s;
        }

        .nexa-menu a:hover .nexa-icon,
        .nexa-menu a.active .nexa-icon {
            background: rgba(124,92,255,.18);
        }

        /* =====================================================
           AI MENU
        ===================================================== */

        .nexa-ai-feature {
            background:
                linear-gradient(
                    135deg,
                    rgba(124,92,255,.055),
                    rgba(59,130,246,.025)
                );
        }

        .nexa-ai-feature:hover {
            background:
                linear-gradient(
                    135deg,
                    rgba(124,92,255,.15),
                    rgba(59,130,246,.07)
                ) !important;
        }

        /* =====================================================
           DIVIDER
        ===================================================== */

        .nexa-menu-divider {
            height: 1px;

            margin: 15px 9px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,.08),
                    transparent
                );
        }

        /* =====================================================
           LOGOUT
        ===================================================== */

        .nexa-logout {
            padding: 13px 14px;

            border-top: 1px solid rgba(255,255,255,.06);
        }

        .nexa-logout button {
            width: 100%;

            display: flex;
            align-items: center;

            gap: 11px;

            padding: 11px 12px;

            border: 1px solid transparent;

            border-radius: 13px;

            background: transparent;

            color: #7f8ba3;

            text-align: left;

            font-size: 12px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s;
        }

        .nexa-logout button:hover {
            color: #fb7185;

            background: rgba(244,63,94,.07);

            border-color: rgba(244,63,94,.12);
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .nexa-main {
            width: calc(100% - 278px);

            min-height: 100vh;

            margin-left: 278px;
        }

        /* =====================================================
           TOPBAR
        ===================================================== */

        .nexa-topbar {
            position: sticky;

            top: 0;

            z-index: 50;

            min-height: 78px;

            padding: 0 32px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            background:
                rgba(7,11,22,.78);

            border-bottom: 1px solid rgba(255,255,255,.06);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .nexa-header-title {
            min-width: 0;
        }

        .nexa-header-title h2 {
            margin: 0;

            color: #fff;

            font-size: 18px;
            font-weight: 850;

            letter-spacing: -.4px;
        }

        .nexa-header-title p {
            margin: 4px 0 0;

            color: #667085;

            font-size: 11px;
        }

        .nexa-topbar-right {
            display: flex;
            align-items: center;

            gap: 14px;
        }

        /* =====================================================
           NOTIFICATION
        ===================================================== */

        .nexa-top-notification {
            position: relative;

            width: 41px;
            height: 41px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 13px;

            color: #a7b0c2;

            background: rgba(255,255,255,.035);

            border: 1px solid rgba(255,255,255,.07);

            font-size: 16px;

            transition: .2s;
        }

        .nexa-top-notification:hover {
            color: #fff;

            background: rgba(124,92,255,.13);

            border-color: rgba(124,92,255,.3);

            transform: translateY(-2px);
        }

        .nexa-notification-badge {
            position: absolute;

            top: -5px;
            right: -5px;

            min-width: 18px;
            height: 18px;

            padding: 0 5px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 999px;

            background:
                linear-gradient(
                    135deg,
                    #fb7185,
                    #ef4444
                );

            border: 2px solid #070b16;

            color: white;

            font-size: 8px;
            font-weight: 900;

            box-shadow:
                0 4px 12px rgba(239,68,68,.35);
        }

        /* =====================================================
           TOP USER
        ===================================================== */

        .nexa-top-user {
            display: flex;
            align-items: center;

            gap: 11px;

            padding-left: 13px;

            border-left: 1px solid rgba(255,255,255,.08);
        }

        .nexa-top-user-info {
            text-align: right;
        }

        .nexa-top-user-name {
            color: #f5f7fb;

            font-size: 12px;
            font-weight: 800;
        }

        .nexa-top-user-role {
            margin-top: 3px;

            color: #667085;

            font-size: 9px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .nexa-top-avatar {
            width: 39px;
            height: 39px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            color: #fff;

            font-size: 13px;
            font-weight: 900;

            background:
                linear-gradient(
                    135deg,
                    #7c3aed,
                    #2563eb
                );

            box-shadow:
                0 7px 20px rgba(79,70,229,.25);
        }

        /* =====================================================
           CONTENT
        ===================================================== */

        .nexa-content {
            position: relative;

            min-height: calc(100vh - 78px);

            padding: 32px;

            background:
                radial-gradient(
                    circle at 85% 0%,
                    rgba(99,102,241,.08),
                    transparent 27%
                ),
                radial-gradient(
                    circle at 5% 90%,
                    rgba(124,58,237,.045),
                    transparent 25%
                ),
                #070b16;
        }

        .nexa-content::before {
            content: "";

            position: fixed;

            width: 350px;
            height: 350px;

            right: -180px;
            bottom: -180px;

            border-radius: 50%;

            background: rgba(79,70,229,.07);

            filter: blur(100px);

            pointer-events: none;
        }

        /* =====================================================
           ALERTS
        ===================================================== */

        .nexa-alert {
            position: relative;

            max-width: 1250px;

            margin: 0 auto 20px;

            padding: 14px 17px;

            border-radius: 14px;

            font-size: 12px;
            font-weight: 650;

            backdrop-filter: blur(12px);
        }

        .nexa-success {
            color: #6ee7b7;

            background:
                linear-gradient(
                    135deg,
                    rgba(16,185,129,.1),
                    rgba(16,185,129,.035)
                );

            border: 1px solid rgba(16,185,129,.2);
        }

        .nexa-error {
            color: #fda4af;

            background:
                linear-gradient(
                    135deg,
                    rgba(244,63,94,.1),
                    rgba(244,63,94,.035)
                );

            border: 1px solid rgba(244,63,94,.2);
        }

        /* =====================================================
           GENERIC FORM ELEMENTS
           BIKIN HALAMAN LAMA IKUT KELIHATAN LEBIH SERAGAM
        ===================================================== */

        .nexa-content input,
        .nexa-content textarea,
        .nexa-content select {
            background: rgba(255,255,255,.035);
            color: #e5e7eb;

            border: 1px solid rgba(255,255,255,.09);

            border-radius: 11px;

            outline: none;

            transition: .2s;
        }

        .nexa-content input:focus,
        .nexa-content textarea:focus,
        .nexa-content select:focus {
            border-color: rgba(124,92,255,.55);

            box-shadow:
                0 0 0 3px rgba(124,92,255,.08);
        }

        .nexa-content input::placeholder,
        .nexa-content textarea::placeholder {
            color: #59657b;
        }

        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 950px) {

            .nexa-sidebar {
                width: 235px;
            }

            .nexa-main {
                width: calc(100% - 235px);
                margin-left: 235px;
            }

            .nexa-topbar {
                padding: 0 22px;
            }

            .nexa-content {
                padding: 24px;
            }
        }

        @media (max-width: 720px) {

            .nexa-sidebar {
                width: 72px;
            }

            .nexa-main {
                width: calc(100% - 72px);
                margin-left: 72px;
            }

            .nexa-logo {
                justify-content: center;
                padding: 0;
            }

            .nexa-brand {
                gap: 0;
            }

            .nexa-logo-main,
            .nexa-logo-sub {
                display: none;
            }

            .nexa-user {
                padding: 14px 9px;
            }

            .nexa-user-box {
                justify-content: center;
                padding: 8px;
            }

            .nexa-user-name,
            .nexa-user-role {
                display: none;
            }

            .nexa-menu {
                padding: 5px 8px;
            }

            .nexa-menu-title {
                display: none;
            }

            .nexa-menu a {
                justify-content: center;
                padding: 10px 5px;
            }

            .nexa-menu a span:not(.nexa-icon) {
                display: none;
            }

            .nexa-menu a.active::before {
                left: -8px;
            }

            .nexa-menu-divider {
                margin: 12px 4px;
            }

            .nexa-logout {
                padding: 9px 8px;
            }

            .nexa-logout button {
                justify-content: center;
                padding: 11px 5px;
            }

            .nexa-logout button span:not(.nexa-icon) {
                display: none;
            }

            .nexa-topbar {
                min-height: 70px;
                padding: 0 14px;
            }

            .nexa-header-title h2 {
                font-size: 15px;
            }

            .nexa-header-title p {
                display: none;
            }

            .nexa-top-user {
                padding-left: 8px;
            }

            .nexa-top-user-info {
                display: none;
            }

            .nexa-content {
                min-height: calc(100vh - 70px);
                padding: 17px;
            }
        }

        @media (max-width: 420px) {

            .nexa-sidebar {
                width: 62px;
            }

            .nexa-main {
                width: calc(100% - 62px);
                margin-left: 62px;
            }

            .nexa-top-notification {
                width: 37px;
                height: 37px;
            }

            .nexa-top-avatar {
                width: 36px;
                height: 36px;
            }
        }
    </style>
</head>

<body>

@php
    $unreadNotifications = \App\Models\Notification::where(
        'user_id',
        auth()->id()
    )
    ->whereNull('read_at')
    ->count();
@endphp

<div class="nexa-app">

    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside class="nexa-sidebar">

        {{-- BRAND --}}
        <div class="nexa-logo">

            <div class="nexa-brand">

                <div class="nexa-brand-mark">
                    N
                </div>

                <div>
                    <div class="nexa-logo-main">
                        NEXA<span>.</span>
                    </div>

                    <div class="nexa-logo-sub">
                        SMART SUBMISSION
                    </div>
                </div>

            </div>

        </div>


        {{-- USER --}}
        <div class="nexa-user">

            <div class="nexa-user-box">

                <div class="nexa-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <div class="nexa-user-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="nexa-user-role">
                        {{ auth()->user()->role }}
                    </div>
                </div>

            </div>

        </div>


        {{-- MENU --}}
        <nav class="nexa-menu">

            @if(auth()->user()->role === 'student')

                {{-- AI --}}
                <div class="nexa-menu-title">
                    NEXA Intelligence
                </div>

                <a
                    href="{{ route('student.ai-check') }}"
                    class="nexa-ai-feature {{ request()->routeIs('student.ai-check') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">🤖</span>
                    <span>NEXA AI Cek Tugas</span>
                </a>

                <a
                    href="{{ route('student.ai-instruction') }}"
                    class="nexa-ai-feature {{ request()->routeIs('student.ai-instruction*') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">📋</span>
                    <span>AI Baca Instruksi</span>
                </a>

                <a
                    href="{{ route('student.ai-assistant') }}"
                    class="nexa-ai-feature {{ request()->routeIs('student.ai-assistant*') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">💬</span>
                    <span>AI Assistant</span>
                </a>


                <div class="nexa-menu-divider"></div>


                {{-- SUBMISSION --}}
                <div class="nexa-menu-title">
                    Submission System
                </div>

                <a
                    href="{{ route('student.assignments') }}"
                    class="{{ request()->routeIs('student.assignments*') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">📤</span>
                    <span>Smart Submit</span>
                </a>

                <a
                    href="{{ route('student.submission-health') }}"
                    class="{{ request()->routeIs('student.submission-health') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">📊</span>
                    <span>Submission Health</span>
                </a>

                <a
                    href="{{ route('student.submission-passport') }}"
                    class="{{ request()->routeIs('student.submission-passport') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">🪪</span>
                    <span>Submission Passport</span>
                </a>

                <a
                    href="{{ route('student.smart-revision') }}"
                    class="{{ request()->routeIs('student.smart-revision') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">🔧</span>
                    <span>Smart Revision</span>
                </a>

                <a
                    href="{{ route('student.submission-versions.home') }}"
                    class="{{ request()->routeIs('student.submission-versions*') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">🕒</span>
                    <span>Riwayat Versi Tugas</span>
                </a>

                <a
                    href="{{ route('student.deadline-progress') }}"
                    class="{{ request()->routeIs('student.deadline-progress') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">📅</span>
                    <span>Deadline &amp; Progress</span>
                </a>

            @endif


            {{-- =================================================
                 TEACHER
            ================================================== --}}

            @if(auth()->user()->role === 'teacher')

                <div class="nexa-menu-title">
                    Teacher Workspace
                </div>

                <a
                    href="{{ route('teacher.assignments') }}"
                    class="{{ request()->routeIs('teacher.assignments*') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">📚</span>
                    <span>Manajemen Tugas</span>
                </a>

                <a
                    href="{{ route('teacher.reviews') }}"
                    class="{{ request()->routeIs('teacher.reviews*') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">👨‍🏫</span>
                    <span>Review &amp; Feedback Guru</span>
                </a>

                <a
                    href="{{ route('teacher.analytics') }}"
                    class="{{ request()->routeIs('teacher.analytics*') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">📈</span>
                    <span>Analytics Kelas</span>
                </a>

                <a
                    href="{{ route('teacher.users') }}"
                    class="{{ request()->routeIs('teacher.users*') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">👥</span>
                    <span>Manajemen User</span>
                </a>

                <a
                    href="{{ route('teacher.logs') }}"
                    class="{{ request()->routeIs('teacher.logs*') ? 'active' : '' }}"
                >
                    <span class="nexa-icon">🛡️</span>
                    <span>Security &amp; System Logs</span>
                </a>

            @endif


            {{-- SYSTEM --}}
            <div class="nexa-menu-divider"></div>

            <div class="nexa-menu-title">
                System
            </div>

            <a
                href="{{ route('notifications.index') }}"
                class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}"
            >

                <span class="nexa-icon">🔔</span>

                <span>Notifikasi</span>

                @if($unreadNotifications > 0)
                    <span
                        style="
                            margin-left:auto;
                            min-width:20px;
                            height:20px;
                            padding:0 6px;
                            border-radius:999px;
                            background:linear-gradient(135deg,#fb7185,#ef4444);
                            color:#fff;
                            font-size:9px;
                            font-weight:900;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                        "
                    >
                        {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
                    </span>
                @endif

            </a>


            {{-- ACCOUNT --}}
            <div class="nexa-menu-divider"></div>

            <div class="nexa-menu-title">
                Account
            </div>

            <a
                href="{{ route('profile.edit') }}"
                class="{{ request()->routeIs('profile.*') ? 'active' : '' }}"
            >
                <span class="nexa-icon">⚙️</span>
                <span>Profile</span>
            </a>

        </nav>


        {{-- LOGOUT --}}
        <div class="nexa-logout">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button type="submit">

                    <span class="nexa-icon">↪</span>

                    <span>Keluar</span>

                </button>

            </form>

        </div>

    </aside>


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <div class="nexa-main">

        {{-- TOPBAR --}}
        <header class="nexa-topbar">

            <div class="nexa-header-title">

                @isset($header)

                    {{ $header }}

                @else

                    <h2>NEXA SUBMIT</h2>

                @endisset

            </div>


            <div class="nexa-topbar-right">

                {{-- NOTIFICATION --}}
                <a
                    href="{{ route('notifications.index') }}"
                    class="nexa-top-notification"
                    title="Notifikasi"
                >

                    🔔

                    @if($unreadNotifications > 0)

                        <span class="nexa-notification-badge">
                            {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
                        </span>

                    @endif

                </a>


                {{-- USER --}}
                <div class="nexa-top-user">

                    <div class="nexa-top-user-info">

                        <div class="nexa-top-user-name">
                            {{ auth()->user()->name }}
                        </div>

                        <div class="nexa-top-user-role">
                            {{ auth()->user()->role }}
                        </div>

                    </div>

                    <div class="nexa-top-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                </div>

            </div>

        </header>


        {{-- CONTENT --}}
        <main class="nexa-content">

            @if(session('success'))

                <div class="nexa-alert nexa-success">
                    ✓ {{ session('success') }}
                </div>

            @endif


            @if($errors->any())

                <div class="nexa-alert nexa-error">

                    <strong>
                        Terjadi kesalahan:
                    </strong>

                    <ul style="margin:8px 0 0 18px;">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{ $slot }}

        </main>

    </div>

</div>

</body>
</html>