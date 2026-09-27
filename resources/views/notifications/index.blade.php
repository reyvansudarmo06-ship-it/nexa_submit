<x-app-layout>

    <style>
        .nexa-notif-page {
            min-height: calc(100vh - 80px);
            padding: 28px;
            color: #f8fafc;
            background:
                radial-gradient(circle at 90% 0%, rgba(99,102,241,.14), transparent 32%),
                radial-gradient(circle at 0% 100%, rgba(37,99,235,.10), transparent 35%),
                #070b16;
        }

        .notif-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .notif-hero {
            position: relative;
            overflow: hidden;
            padding: 27px 30px;
            margin-bottom: 22px;
            border-radius: 23px;
            border: 1px solid rgba(99,102,241,.20);
            background:
                radial-gradient(circle at 90% 20%, rgba(99,102,241,.20), transparent 32%),
                linear-gradient(135deg,#0b1020,#111936 55%,#10152c);
            box-shadow: 0 20px 55px rgba(0,0,0,.25);
        }

        .notif-hero::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            right: -90px;
            top: -130px;
            border-radius: 50%;
            border: 1px solid rgba(129,140,248,.08);
        }

        .notif-hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notif-hero-icon {
            width: 58px;
            height: 58px;
            min-width: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            font-size: 26px;
            background: linear-gradient(135deg,#6366f1,#2563eb);
            box-shadow: 0 13px 30px rgba(79,70,229,.25);
        }

        .notif-eyebrow {
            color: #818cf8;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.7px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .notif-hero h1 {
            margin: 0;
            color: #fff;
            font-size: 27px;
            font-weight: 850;
            letter-spacing: -.5px;
        }

        .notif-hero p {
            margin: 7px 0 0;
            color: #94a3b8;
            font-size: 12px;
        }

        .notif-hero-status {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border-radius: 999px;
            color: #a5b4fc;
            background: rgba(99,102,241,.08);
            border: 1px solid rgba(129,140,248,.14);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .7px;
        }

        .notif-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #818cf8;
            box-shadow: 0 0 10px rgba(129,140,248,.8);
        }

        .notif-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 17px;
        }

        .notif-toolbar-title {
            color: #f8fafc;
            font-size: 17px;
            font-weight: 800;
        }

        .notif-count {
            margin-top: 4px;
            color: #64748b;
            font-size: 10px;
        }

        .read-all-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 14px;
            border-radius: 11px;
            border: 1px solid rgba(99,102,241,.20);
            background: rgba(99,102,241,.08);
            color: #a5b4fc;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .read-all-btn:hover {
            transform: translateY(-1px);
            background: rgba(99,102,241,.14);
            border-color: rgba(129,140,248,.32);
            box-shadow: 0 8px 20px rgba(79,70,229,.12);
        }

        .notif-success {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 12px 15px;
            margin-bottom: 15px;
            border-radius: 12px;
            color: #86efac;
            background: rgba(34,197,94,.07);
            border: 1px solid rgba(34,197,94,.16);
            font-size: 11px;
        }

        .notification-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .notification-card {
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 17px;
            border-radius: 17px;
            border: 1px solid rgba(148,163,184,.09);
            background: rgba(15,23,42,.68);
            backdrop-filter: blur(12px);
            transition: .2s ease;
        }

        .notification-card:hover {
            transform: translateY(-2px);
            border-color: rgba(99,102,241,.22);
            background: rgba(20,29,52,.82);
            box-shadow: 0 12px 30px rgba(0,0,0,.17);
        }

        .notification-card.unread {
            border-color: rgba(99,102,241,.27);
            background:
                linear-gradient(
                    90deg,
                    rgba(99,102,241,.09),
                    rgba(15,23,42,.70)
                );
        }

        .notification-card.unread::before {
            content: "";
            position: absolute;
            left: 0;
            top: 15px;
            bottom: 15px;
            width: 3px;
            border-radius: 0 5px 5px 0;
            background: linear-gradient(180deg,#6366f1,#2563eb);
            box-shadow: 0 0 12px rgba(99,102,241,.45);
        }

        .notification-icon {
            width: 46px;
            height: 46px;
            min-width: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background:
                linear-gradient(
                    135deg,
                    rgba(99,102,241,.15),
                    rgba(37,99,235,.08)
                );
            border: 1px solid rgba(99,102,241,.12);
            font-size: 20px;
        }

        .notification-content {
            flex: 1;
            min-width: 0;
        }

        .notification-title-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .notification-title {
            color: #f8fafc;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.4;
        }

        .unread-label {
            padding: 3px 6px;
            border-radius: 999px;
            color: #a5b4fc;
            background: rgba(99,102,241,.10);
            border: 1px solid rgba(129,140,248,.12);
            font-size: 7px;
            font-weight: 800;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .notification-message {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.65;
        }

        .notification-time {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 8px;
            color: #475569;
            font-size: 9px;
        }

        .notification-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 9px;
            padding: 0;
            color: #818cf8;
            background: none;
            border: none;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
            transition: .2s;
        }

        .notification-action:hover {
            color: #a5b4fc;
            transform: translateX(2px);
        }

        .notification-dot {
            width: 7px;
            height: 7px;
            min-width: 7px;
            margin-top: 7px;
            border-radius: 50%;
            background: #6366f1;
            box-shadow: 0 0 9px rgba(99,102,241,.75);
        }

        .empty-notification {
            padding: 75px 25px;
            text-align: center;
            border-radius: 20px;
            border: 1px dashed rgba(148,163,184,.12);
            background: rgba(15,23,42,.50);
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 21px;
            background: rgba(99,102,241,.07);
            border: 1px solid rgba(99,102,241,.12);
            font-size: 30px;
        }

        .empty-notification h3 {
            margin: 0 0 7px;
            color: #f8fafc;
            font-size: 17px;
            font-weight: 800;
        }

        .empty-notification p {
            margin: 0;
            color: #64748b;
            font-size: 11px;
        }

        @media(max-width: 650px) {

            .nexa-notif-page {
                padding: 18px;
            }

            .notif-hero {
                padding: 22px;
            }

            .notif-hero-icon {
                width: 51px;
                height: 51px;
                min-width: 51px;
                font-size: 22px;
            }

            .notif-hero h1 {
                font-size: 21px;
            }

            .notif-hero p {
                font-size: 10px;
            }

            .notif-hero-status {
                display: none;
            }

            .notif-toolbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .read-all-btn {
                width: 100%;
                justify-content: center;
            }

            .notification-card {
                padding: 14px;
            }

            .notification-icon {
                width: 40px;
                height: 40px;
                min-width: 40px;
                font-size: 17px;
            }

            .notification-title {
                font-size: 12px;
            }

            .notification-message {
                font-size: 10px;
            }
        }
    </style>


    <div class="nexa-notif-page">

        <div class="notif-container">

            {{-- HERO --}}
            <div class="notif-hero">

                <div class="notif-hero-content">

                    <div class="notif-hero-icon">
                        🔔
                    </div>

                    <div>

                        <div class="notif-eyebrow">
                            NEXA SYSTEM / NOTIFICATIONS
                        </div>

                        <h1>
                            Pusat Notifikasi
                        </h1>

                        <p>
                            Semua informasi terbaru dari NEXA SUBMIT.
                        </p>

                    </div>

                    <div class="notif-hero-status">
                        <span class="notif-status-dot"></span>
                        SYSTEM ACTIVE
                    </div>

                </div>

            </div>


            {{-- TOOLBAR --}}
            <div class="notif-toolbar">

                <div>

                    <div class="notif-toolbar-title">
                        Aktivitas Terbaru
                    </div>

                    <div class="notif-count">
                        {{ $notifications->count() }} notifikasi
                    </div>

                </div>


                @if($notifications->whereNull('read_at')->count() > 0)

                    <form
                        method="POST"
                        action="{{ route('notifications.read-all') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="read-all-btn"
                        >
                            ✓ Tandai Semua Dibaca
                        </button>

                    </form>

                @endif

            </div>


            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="notif-success">

                    <span>✓</span>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- NOTIFICATION LIST --}}
            @if($notifications->count())

                <div class="notification-list">

                    @foreach($notifications as $notification)

                        <div class="notification-card
                            {{ !$notification->read_at ? 'unread' : '' }}">

                            <div class="notification-icon">
                                {{ $notification->icon ?? '🔔' }}
                            </div>


                            <div class="notification-content">

                                <div class="notification-title-row">

                                    <div class="notification-title">
                                        {{ $notification->title }}
                                    </div>

                                    @if(!$notification->read_at)

                                        <span class="unread-label">
                                            Baru
                                        </span>

                                    @endif

                                </div>


                                <div class="notification-message">
                                    {{ $notification->message }}
                                </div>


                                <div class="notification-time">

                                    <span>◷</span>

                                    {{ $notification->created_at->diffForHumans() }}

                                </div>


                                @if($notification->action_url)

                                    <form
                                        method="POST"
                                        action="{{ route('notifications.read', $notification) }}"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="notification-action"
                                        >
                                            Lihat Detail
                                            <span>→</span>
                                        </button>

                                    </form>

                                @else

                                    @if(!$notification->read_at)

                                        <form
                                            method="POST"
                                            action="{{ route('notifications.read', $notification) }}"
                                        >
                                            @csrf

                                            <button
                                                type="submit"
                                                class="notification-action"
                                            >
                                                Tandai Dibaca
                                                <span>✓</span>
                                            </button>

                                        </form>

                                    @endif

                                @endif

                            </div>


                            @if(!$notification->read_at)

                                <div class="notification-dot"></div>

                            @endif

                        </div>

                    @endforeach

                </div>

            @else

                {{-- EMPTY --}}
                <div class="empty-notification">

                    <div class="empty-icon">
                        🔔
                    </div>

                    <h3>
                        Belum Ada Notifikasi
                    </h3>

                    <p>
                        NEXA akan menampilkan informasi penting di sini.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>