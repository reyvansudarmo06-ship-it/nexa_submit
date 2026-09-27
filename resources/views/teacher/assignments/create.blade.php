<x-app-layout>

    <x-slot name="header">
        <div class="nexa-header">
            <div>
                <div class="nexa-eyebrow">
                    NEXA SUBMIT • TEACHER
                </div>

                <h2>
                    Buat Tugas Baru
                </h2>

                <p>
                    Buat tugas dan tentukan detail pengumpulannya
                </p>
            </div>

            <div class="header-status">
                <span class="status-dot"></span>
                SYSTEM READY
            </div>
        </div>
    </x-slot>

    <div class="nexa-page">

        <div class="nexa-container">

            {{-- HERO --}}
            <div class="create-hero">

                <div class="hero-icon">
                    +
                </div>

                <div>
                    <span class="hero-label">
                        ASSIGNMENT CREATOR
                    </span>

                    <h1>
                        Buat tugas untuk siswa
                    </h1>

                    <p>
                        Lengkapi informasi tugas, kelas, mata pelajaran,
                        dan deadline sebelum dipublikasikan.
                    </p>
                </div>

            </div>


            {{-- FORM CARD --}}
            <div class="form-card">

                <div class="form-card-header">

                    <div>
                        <span class="section-label">
                            TASK CONFIGURATION
                        </span>

                        <h3>
                            Detail Tugas
                        </h3>

                        <p>
                            Isi informasi berikut dengan lengkap.
                        </p>
                    </div>

                    <div class="form-number">
                        01
                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('teacher.assignments.store') }}"
                    class="nexa-form"
                >

                    @csrf


                    {{-- JUDUL --}}
                    <div class="field-group">

                        <label for="title">
                            Judul Tugas
                            <span>*</span>
                        </label>

                        <div class="input-wrapper">

                            <div class="input-icon">
                                T
                            </div>

                            <input
                                id="title"
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Contoh: Membuat Website Portfolio"
                                required
                                autocomplete="off"
                            >

                        </div>

                        @error('title')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- DESKRIPSI --}}
                    <div class="field-group">

                        <label for="description">
                            Deskripsi
                        </label>

                        <div class="textarea-wrapper">

                            <div class="textarea-icon">
                                ≡
                            </div>

                            <textarea
                                id="description"
                                name="description"
                                rows="6"
                                placeholder="Jelaskan instruksi dan ketentuan tugas..."
                            >{{ old('description') }}</textarea>

                        </div>

                        <div class="field-hint">
                            Jelaskan instruksi tugas agar siswa dapat memahami
                            pekerjaan yang harus dikumpulkan.
                        </div>

                        @error('description')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- MAPEL + KELAS --}}
                    <div class="field-grid">


                        {{-- MAPEL --}}
                        <div class="field-group">

                            <label for="subject">
                                Mata Pelajaran
                                <span>*</span>
                            </label>

                            <div class="input-wrapper">

                                <div class="input-icon">
                                    S
                                </div>

                                <input
                                    id="subject"
                                    type="text"
                                    name="subject"
                                    value="{{ old('subject') }}"
                                    placeholder="Contoh: PWEB"
                                    required
                                    autocomplete="off"
                                >

                            </div>

                            @error('subject')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- KELAS --}}
                        <div class="field-group">

                            <label for="class_name">
                                Kelas
                                <span>*</span>
                            </label>

                            <div class="input-wrapper">

                                <div class="input-icon">
                                    K
                                </div>

                                <input
                                    id="class_name"
                                    type="text"
                                    name="class_name"
                                    value="{{ old('class_name') }}"
                                    placeholder="Contoh: XI PPLG 3"
                                    required
                                    autocomplete="off"
                                >

                            </div>

                            @error('class_name')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- DEADLINE --}}
                    <div class="field-group">

                        <label for="deadline">
                            Deadline
                            <span>*</span>
                        </label>

                        <div class="deadline-box">

                            <div class="deadline-icon">
                                ⏱
                            </div>

                            <div class="deadline-content">

                                <div class="deadline-title">
                                    Batas Pengumpulan
                                </div>

                                <div class="deadline-description">
                                    Tentukan tanggal dan waktu terakhir
                                    siswa dapat mengumpulkan tugas.
                                </div>

                                <input
                                    id="deadline"
                                    type="datetime-local"
                                    name="deadline"
                                    value="{{ old('deadline') }}"
                                    required
                                >

                            </div>

                        </div>

                        @error('deadline')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- SUMMARY --}}
                    <div class="publish-info">

                        <div class="info-icon">
                            ✓
                        </div>

                        <div>
                            <strong>
                                Siap membuat tugas?
                            </strong>

                            <p>
                                Setelah dibuat, tugas akan tersedia untuk
                                siswa sesuai kelas yang ditentukan.
                            </p>
                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="form-actions">

                        <a
                            href="{{ route('teacher.assignments') }}"
                            class="cancel-button"
                        >
                            <span>←</span>
                            Batal
                        </a>


                        <button
                            type="submit"
                            class="create-button"
                        >
                            <span class="button-icon">
                                +
                            </span>

                            <span>
                                Buat Tugas
                            </span>

                            <span class="button-arrow">
                                →
                            </span>
                        </button>

                    </div>

                </form>

            </div>


            {{-- BOTTOM INFO --}}
            <div class="bottom-info">

                <div>
                    <span class="bottom-dot"></span>
                    NEXA SUBMIT
                </div>

                <span>
                    Assignment Management System
                </span>

            </div>

        </div>

    </div>


    <style>

        .nexa-header {
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
        }

        .nexa-header h2 {
            margin:4px 0 0;
            color:#f8fafc;
            font-size:22px;
            font-weight:800;
            letter-spacing:-.4px;
        }

        .nexa-header p {
            margin:6px 0 0;
            color:#94a3b8;
            font-size:13px;
        }

        .nexa-eyebrow {
            color:#8b5cf6;
            font-size:10px;
            font-weight:800;
            letter-spacing:2px;
        }

        .header-status {
            display:flex;
            align-items:center;
            gap:8px;
            padding:9px 13px;
            border:1px solid rgba(139,92,246,.22);
            background:rgba(139,92,246,.08);
            border-radius:12px;
            color:#c4b5fd;
            font-size:10px;
            font-weight:800;
            letter-spacing:1px;
        }

        .status-dot,
        .bottom-dot {
            width:7px;
            height:7px;
            border-radius:50%;
            background:#22c55e;
            box-shadow:0 0 12px rgba(34,197,94,.8);
        }


        .nexa-page {
            min-height:calc(100vh - 80px);
            padding:34px 24px 45px;
            background:
                radial-gradient(
                    circle at 12% 10%,
                    rgba(124,58,237,.13),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 25%,
                    rgba(37,99,235,.10),
                    transparent 25%
                ),
                #050816;
        }

        .nexa-container {
            max-width:900px;
            margin:0 auto;
        }


        /* HERO */

        .create-hero {
            display:flex;
            align-items:center;
            gap:20px;
            margin-bottom:24px;
            padding:25px;
            border:1px solid rgba(148,163,184,.12);
            border-radius:22px;
            background:
                linear-gradient(
                    135deg,
                    rgba(124,58,237,.16),
                    rgba(37,99,235,.08)
                ),
                rgba(15,23,42,.72);
            box-shadow:
                0 20px 60px rgba(0,0,0,.25),
                inset 0 1px 0 rgba(255,255,255,.04);
            backdrop-filter:blur(18px);
        }

        .hero-icon {
            width:58px;
            height:58px;
            flex-shrink:0;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:17px;
            color:white;
            font-size:29px;
            font-weight:300;
            background:
                linear-gradient(
                    135deg,
                    #7c3aed,
                    #2563eb
                );
            box-shadow:
                0 12px 30px rgba(99,102,241,.3);
        }

        .hero-label,
        .section-label {
            color:#818cf8;
            font-size:10px;
            font-weight:800;
            letter-spacing:2px;
        }

        .create-hero h1 {
            margin:5px 0 5px;
            color:#f8fafc;
            font-size:24px;
            font-weight:800;
            letter-spacing:-.5px;
        }

        .create-hero p {
            margin:0;
            color:#94a3b8;
            font-size:13px;
            line-height:1.6;
        }


        /* FORM */

        .form-card {
            overflow:hidden;
            border:1px solid rgba(148,163,184,.12);
            border-radius:24px;
            background:rgba(15,23,42,.78);
            box-shadow:
                0 25px 70px rgba(0,0,0,.3),
                inset 0 1px 0 rgba(255,255,255,.035);
            backdrop-filter:blur(20px);
        }

        .form-card-header {
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            padding:27px 29px;
            border-bottom:1px solid rgba(148,163,184,.10);
        }

        .form-card-header h3 {
            margin:6px 0 3px;
            color:#f8fafc;
            font-size:19px;
            font-weight:800;
        }

        .form-card-header p {
            margin:0;
            color:#64748b;
            font-size:12px;
        }

        .form-number {
            width:42px;
            height:42px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:13px;
            background:rgba(99,102,241,.1);
            border:1px solid rgba(129,140,248,.16);
            color:#818cf8;
            font-size:12px;
            font-weight:800;
        }

        .nexa-form {
            padding:29px;
        }


        .field-group {
            margin-bottom:25px;
        }

        .field-group label {
            display:block;
            margin-bottom:9px;
            color:#cbd5e1;
            font-size:12px;
            font-weight:700;
        }

        .field-group label span {
            color:#a78bfa;
        }

        .input-wrapper,
        .textarea-wrapper {
            position:relative;
        }

        .input-icon,
        .textarea-icon {
            position:absolute;
            left:15px;
            top:50%;
            transform:translateY(-50%);
            width:26px;
            height:26px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:8px;
            background:rgba(99,102,241,.12);
            color:#818cf8;
            font-size:10px;
            font-weight:900;
            pointer-events:none;
        }

        .textarea-icon {
            top:18px;
            transform:none;
        }

        .nexa-form input[type="text"],
        .nexa-form input[type="datetime-local"],
        .nexa-form textarea {
            width:100%;
            box-sizing:border-box;
            border:1px solid rgba(148,163,184,.14);
            border-radius:14px;
            outline:none;
            background:rgba(2,6,23,.48);
            color:#f8fafc;
            font-size:13px;
            transition:
                border-color .2s,
                box-shadow .2s,
                background .2s;
        }

        .nexa-form input[type="text"],
        .nexa-form input[type="datetime-local"] {
            height:50px;
            padding:0 16px 0 53px;
        }

        .nexa-form textarea {
            min-height:145px;
            padding:15px 17px 15px 53px;
            resize:vertical;
            line-height:1.6;
        }

        .nexa-form input::placeholder,
        .nexa-form textarea::placeholder {
            color:#475569;
        }

        .nexa-form input:focus,
        .nexa-form textarea:focus {
            border-color:rgba(129,140,248,.65);
            background:rgba(2,6,23,.7);
            box-shadow:
                0 0 0 3px rgba(99,102,241,.09),
                0 0 25px rgba(99,102,241,.07);
        }

        .nexa-form input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter:invert(1);
            opacity:.6;
            cursor:pointer;
        }


        .field-grid {
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:18px;
        }

        .field-hint {
            margin-top:8px;
            color:#64748b;
            font-size:11px;
            line-height:1.5;
        }


        /* DEADLINE */

        .deadline-box {
            display:flex;
            gap:15px;
            padding:17px;
            border:1px solid rgba(129,140,248,.15);
            border-radius:16px;
            background:
                linear-gradient(
                    135deg,
                    rgba(99,102,241,.08),
                    rgba(37,99,235,.04)
                );
        }

        .deadline-icon {
            width:42px;
            height:42px;
            flex-shrink:0;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:12px;
            background:rgba(139,92,246,.13);
            color:#a78bfa;
            font-size:17px;
        }

        .deadline-content {
            width:100%;
        }

        .deadline-title {
            color:#e2e8f0;
            font-size:12px;
            font-weight:800;
        }

        .deadline-description {
            margin:4px 0 12px;
            color:#64748b;
            font-size:11px;
        }

        .deadline-content input {
            padding-left:14px !important;
            height:46px !important;
        }


        /* INFO */

        .publish-info {
            display:flex;
            align-items:flex-start;
            gap:13px;
            margin-top:5px;
            padding:15px;
            border:1px solid rgba(34,197,94,.12);
            border-radius:14px;
            background:rgba(34,197,94,.045);
        }

        .info-icon {
            width:28px;
            height:28px;
            flex-shrink:0;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:9px;
            background:rgba(34,197,94,.12);
            color:#4ade80;
            font-size:12px;
            font-weight:900;
        }

        .publish-info strong {
            display:block;
            color:#d1fae5;
            font-size:12px;
        }

        .publish-info p {
            margin:4px 0 0;
            color:#64748b;
            font-size:11px;
            line-height:1.5;
        }


        /* ERROR */

        .error-message {
            margin-top:7px;
            padding-left:3px;
            color:#fca5a5;
            font-size:11px;
        }


        /* ACTIONS */

        .form-actions {
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:15px;
            margin-top:29px;
            padding-top:22px;
            border-top:1px solid rgba(148,163,184,.10);
        }

        .cancel-button,
        .create-button {
            display:flex;
            align-items:center;
            justify-content:center;
            gap:9px;
            min-height:47px;
            border-radius:13px;
            text-decoration:none;
            font-size:12px;
            font-weight:800;
            transition:
                transform .2s,
                box-shadow .2s,
                border-color .2s;
        }

        .cancel-button {
            padding:0 18px;
            color:#94a3b8;
            border:1px solid rgba(148,163,184,.14);
            background:rgba(15,23,42,.6);
        }

        .cancel-button:hover {
            color:#e2e8f0;
            border-color:rgba(148,163,184,.3);
            transform:translateY(-1px);
        }

        .create-button {
            min-width:160px;
            padding:0 16px;
            border:0;
            color:white;
            cursor:pointer;
            background:
                linear-gradient(
                    135deg,
                    #7c3aed,
                    #2563eb
                );
            box-shadow:
                0 12px 28px rgba(79,70,229,.24);
        }

        .create-button:hover {
            transform:translateY(-2px);
            box-shadow:
                0 16px 34px rgba(79,70,229,.34);
        }

        .button-icon {
            width:23px;
            height:23px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:7px;
            background:rgba(255,255,255,.13);
            font-size:15px;
        }

        .button-arrow {
            margin-left:auto;
            opacity:.65;
            font-size:16px;
        }


        /* BOTTOM */

        .bottom-info {
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:17px 4px;
            color:#475569;
            font-size:10px;
            letter-spacing:.5px;
        }

        .bottom-info > div {
            display:flex;
            align-items:center;
            gap:8px;
            font-weight:800;
        }


        /* RESPONSIVE */

        @media (max-width:760px) {

            .nexa-page {
                padding:22px 14px 35px;
            }

            .nexa-header {
                align-items:flex-start;
            }

            .header-status {
                display:none;
            }

            .create-hero {
                padding:20px;
            }

            .hero-icon {
                width:48px;
                height:48px;
                border-radius:14px;
            }

            .create-hero h1 {
                font-size:19px;
            }

            .create-hero p {
                font-size:12px;
            }

            .form-card-header,
            .nexa-form {
                padding:21px;
            }

            .field-grid {
                grid-template-columns:1fr;
                gap:0;
            }

            .form-actions {
                flex-direction:column-reverse;
                align-items:stretch;
            }

            .cancel-button,
            .create-button {
                width:100%;
            }

            .bottom-info {
                flex-direction:column;
                align-items:flex-start;
                gap:7px;
            }
        }

        @media (max-width:480px) {

            .create-hero {
                gap:13px;
                padding:17px;
                border-radius:18px;
            }

            .hero-icon {
                width:43px;
                height:43px;
                font-size:22px;
            }

            .create-hero h1 {
                font-size:17px;
            }

            .create-hero p {
                font-size:11px;
            }

            .form-card {
                border-radius:18px;
            }

            .deadline-box {
                padding:13px;
            }

            .deadline-icon {
                width:36px;
                height:36px;
            }
        }

    </style>

</x-app-layout>