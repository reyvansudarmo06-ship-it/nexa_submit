<x-app-layout>

    <style>
        .nexa-profile-page {
            min-height: calc(100vh - 80px);
            padding: 28px;
            color: #f8fafc;
            background:
                radial-gradient(circle at 90% 0%, rgba(99,102,241,.14), transparent 32%),
                radial-gradient(circle at 0% 100%, rgba(37,99,235,.10), transparent 35%),
                #070b16;
        }

        .profile-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .profile-hero {
            position: relative;
            overflow: hidden;
            padding: 28px 30px;
            margin-bottom: 22px;
            border-radius: 23px;
            border: 1px solid rgba(99,102,241,.20);
            background:
                radial-gradient(circle at 90% 20%, rgba(99,102,241,.20), transparent 32%),
                linear-gradient(135deg,#0b1020,#111936 55%,#10152c);
            box-shadow: 0 20px 55px rgba(0,0,0,.25);
        }

        .profile-hero::after {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            right: -100px;
            top: -145px;
            border-radius: 50%;
            border: 1px solid rgba(129,140,248,.08);
        }

        .profile-hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 17px;
        }

        .profile-avatar {
            width: 64px;
            height: 64px;
            min-width: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 19px;
            color: #fff;
            background: linear-gradient(135deg,#6366f1,#2563eb,#7c3aed);
            font-size: 25px;
            font-weight: 900;
            box-shadow: 0 15px 35px rgba(79,70,229,.28);
        }

        .profile-eyebrow {
            color: #818cf8;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.7px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .profile-hero h1 {
            margin: 0;
            color: #fff;
            font-size: 27px;
            font-weight: 850;
            letter-spacing: -.5px;
        }

        .profile-hero p {
            margin: 7px 0 0;
            color: #94a3b8;
            font-size: 12px;
        }

        .profile-status {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border-radius: 999px;
            color: #6ee7b7;
            background: rgba(16,185,129,.07);
            border: 1px solid rgba(16,185,129,.15);
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .7px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #34d399;
            box-shadow: 0 0 10px rgba(52,211,153,.8);
        }

        .profile-sections {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .profile-card {
            overflow: hidden;
            border-radius: 20px;
            border: 1px solid rgba(148,163,184,.09);
            background: rgba(15,23,42,.72);
            backdrop-filter: blur(15px);
            box-shadow: 0 18px 45px rgba(0,0,0,.18);
        }

        .profile-card-header {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 18px 21px;
            border-bottom: 1px solid rgba(148,163,184,.08);
            background: rgba(255,255,255,.015);
        }

        .card-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(99,102,241,.10);
            border: 1px solid rgba(99,102,241,.14);
            font-size: 18px;
        }

        .profile-card-header h3 {
            margin: 0;
            color: #f8fafc;
            font-size: 13px;
            font-weight: 800;
        }

        .profile-card-header p {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 9px;
        }

        .profile-card-body {
            padding: 22px;
        }

        /*
         * Breeze partials tetap dipakai.
         * Styling di bawah membantu elemen form bawaan Breeze
         * mengikuti tema NEXA 2.0.
         */

        .profile-card-body label {
            color: #cbd5e1 !important;
            font-size: 11px !important;
            font-weight: 700 !important;
        }

        .profile-card-body input,
        .profile-card-body textarea,
        .profile-card-body select {
            width: 100%;
            margin-top: 5px;
            padding: 11px 13px !important;
            border-radius: 11px !important;
            color: #f8fafc !important;
            background: #0b1222 !important;
            border: 1px solid rgba(148,163,184,.13) !important;
            outline: none !important;
            font-size: 12px !important;
            box-shadow: none !important;
        }

        .profile-card-body input:focus,
        .profile-card-body textarea:focus,
        .profile-card-body select:focus {
            border-color: rgba(99,102,241,.60) !important;
            box-shadow: 0 0 0 3px rgba(99,102,241,.07) !important;
        }

        .profile-card-body input::placeholder,
        .profile-card-body textarea::placeholder {
            color: #475569 !important;
        }

        .profile-card-body p,
        .profile-card-body span {
            color: #94a3b8;
            font-size: 11px;
        }

        .profile-card-body button[type="submit"] {
            padding: 9px 15px !important;
            border-radius: 10px !important;
            border: 0 !important;
            color: #fff !important;
            background: linear-gradient(135deg,#6366f1,#2563eb) !important;
            font-size: 10px !important;
            font-weight: 800 !important;
            box-shadow: 0 8px 20px rgba(79,70,229,.18);
            transition: .2s ease;
        }

        .profile-card-body button[type="submit"]:hover {
            transform: translateY(-1px);
            box-shadow: 0 11px 25px rgba(79,70,229,.28);
        }

        .profile-card-body a {
            color: #818cf8 !important;
        }

        .profile-card-body .text-gray-600,
        .profile-card-body .dark\:text-gray-400 {
            color: #64748b !important;
        }

        .danger-card {
            border-color: rgba(239,68,68,.12);
        }

        .danger-card .card-icon {
            background: rgba(239,68,68,.08);
            border-color: rgba(239,68,68,.13);
        }

        .danger-card .profile-card-header h3 {
            color: #fca5a5;
        }

        @media(max-width: 700px) {

            .nexa-profile-page {
                padding: 18px;
            }

            .profile-hero {
                padding: 22px;
            }

            .profile-avatar {
                width: 53px;
                height: 53px;
                min-width: 53px;
                border-radius: 15px;
                font-size: 21px;
            }

            .profile-hero h1 {
                font-size: 21px;
            }

            .profile-hero p {
                font-size: 10px;
            }

            .profile-status {
                display: none;
            }

            .profile-card-body {
                padding: 17px;
            }
        }
    </style>


    <div class="nexa-profile-page">

        <div class="profile-container">

            {{-- HERO --}}
            <div class="profile-hero">

                <div class="profile-hero-content">

                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>

                        <div class="profile-eyebrow">
                            NEXA SYSTEM / ACCOUNT
                        </div>

                        <h1>
                            Profile
                        </h1>

                        <p>
                            Kelola informasi akun, keamanan, dan pengaturan profil kamu.
                        </p>

                    </div>

                    <div class="profile-status">
                        <span class="status-dot"></span>
                        ACCOUNT ACTIVE
                    </div>

                </div>

            </div>


            {{-- PROFILE SECTIONS --}}
            <div class="profile-sections">


                {{-- INFORMATION --}}
                <div class="profile-card">

                    <div class="profile-card-header">

                        <div class="card-icon">
                            👤
                        </div>

                        <div>
                            <h3>
                                Informasi Profil
                            </h3>

                            <p>
                                Perbarui nama dan alamat email akun.
                            </p>
                        </div>

                    </div>

                    <div class="profile-card-body">

                        @include(
                            'profile.partials.update-profile-information-form'
                        )

                    </div>

                </div>


                {{-- PASSWORD --}}
                <div class="profile-card">

                    <div class="profile-card-header">

                        <div class="card-icon">
                            🔐
                        </div>

                        <div>
                            <h3>
                                Keamanan Akun
                            </h3>

                            <p>
                                Ubah password untuk menjaga akun tetap aman.
                            </p>
                        </div>

                    </div>

                    <div class="profile-card-body">

                        @include(
                            'profile.partials.update-password-form'
                        )

                    </div>

                </div>


                {{-- DELETE ACCOUNT --}}
                <div class="profile-card danger-card">

                    <div class="profile-card-header">

                        <div class="card-icon">
                            ⚠️
                        </div>

                        <div>
                            <h3>
                                Hapus Akun
                            </h3>

                            <p>
                                Tindakan ini bersifat permanen.
                            </p>
                        </div>

                    </div>

                    <div class="profile-card-body">

                        @include(
                            'profile.partials.delete-user-form'
                        )

                    </div>

                </div>


            </div>

        </div>

    </div>

</x-app-layout>