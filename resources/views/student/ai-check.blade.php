<x-app-layout>

    <x-slot name="header">
        <div class="nexa-header">
            <div>
                <div class="nexa-eyebrow">NEXA SYSTEM / AI CENTER</div>
                <h2>NEXA AI Cek Tugas</h2>
                <p>Analisis tugas menggunakan kecerdasan buatan NEXA AI.</p>
            </div>

            <div class="header-status">
                <span class="status-dot"></span>
                AI READY
            </div>
        </div>
    </x-slot>

    <style>
        .ai-check-page {
            max-width: 1250px;
            margin: 0 auto;
            padding-bottom: 40px;
        }

        .nexa-hero {
            position: relative;
            overflow: hidden;
            padding: 34px;
            border-radius: 24px;
            border: 1px solid rgba(99,102,241,.25);
            background:
                radial-gradient(circle at 90% 10%, rgba(99,102,241,.22), transparent 32%),
                radial-gradient(circle at 10% 100%, rgba(59,130,246,.12), transparent 35%),
                linear-gradient(135deg, #0b1020 0%, #111936 55%, #10152c 100%);
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
            margin-bottom: 24px;
        }

        .nexa-hero::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            right: -110px;
            top: -130px;
            background: rgba(99,102,241,.08);
            border: 1px solid rgba(129,140,248,.08);
        }

        .nexa-hero::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            left: -100px;
            bottom: -120px;
            background: rgba(59,130,246,.06);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .ai-logo {
            width: 68px;
            height: 68px;
            flex-shrink: 0;
            border-radius: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 31px;
            background: linear-gradient(135deg,#6366f1,#4f46e5,#2563eb);
            box-shadow:
                0 15px 35px rgba(79,70,229,.3),
                inset 0 1px 1px rgba(255,255,255,.15);
        }

        .nexa-eyebrow {
            color: #818cf8;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .hero-content h1 {
            margin: 0;
            color: #fff;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .hero-content p {
            margin: 7px 0 0;
            color: #94a3b8;
            font-size: 13px;
        }

        .header-status {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(16,185,129,.08);
            border: 1px solid rgba(16,185,129,.18);
            color: #6ee7b7;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #34d399;
            box-shadow: 0 0 10px rgba(52,211,153,.8);
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 24px;
        }

        .feature-card {
            position: relative;
            overflow: hidden;
            padding: 21px;
            border-radius: 18px;
            border: 1px solid rgba(148,163,184,.10);
            background: rgba(15,23,42,.72);
            backdrop-filter: blur(15px);
            box-shadow: 0 10px 30px rgba(0,0,0,.15);
            transition: .25s ease;
        }

        .feature-card:hover {
            transform: translateY(-3px);
            border-color: rgba(99,102,241,.28);
            box-shadow: 0 15px 35px rgba(0,0,0,.22);
        }

        .feature-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: rgba(99,102,241,.10);
            border: 1px solid rgba(99,102,241,.14);
        }

        .feature-title {
            color: #f8fafc;
            font-size: 13px;
            font-weight: 750;
            margin-top: 13px;
        }

        .feature-text {
            color: #64748b;
            font-size: 11px;
            line-height: 1.6;
            margin-top: 5px;
        }

        .submission-box {
            overflow: hidden;
            border-radius: 22px;
            border: 1px solid rgba(148,163,184,.10);
            background: rgba(15,23,42,.72);
            backdrop-filter: blur(18px);
            box-shadow: 0 15px 45px rgba(0,0,0,.18);
        }

        .submission-head {
            padding: 23px 25px;
            border-bottom: 1px solid rgba(148,163,184,.08);
            background: rgba(255,255,255,.015);
        }

        .section-title {
            color: #f8fafc;
            font-size: 16px;
            font-weight: 800;
            margin: 0;
        }

        .section-description {
            color: #64748b;
            font-size: 11px;
            margin: 5px 0 0;
        }

        .submission-item {
            padding: 22px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            border-bottom: 1px solid rgba(148,163,184,.07);
            transition: .2s ease;
        }

        .submission-item:last-child {
            border-bottom: 0;
        }

        .submission-item:hover {
            background: rgba(99,102,241,.025);
        }

        .submission-main {
            display: flex;
            align-items: center;
            gap: 15px;
            min-width: 0;
        }

        .file-icon {
            width: 49px;
            height: 49px;
            flex-shrink: 0;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            background:
                linear-gradient(135deg,
                rgba(99,102,241,.14),
                rgba(59,130,246,.08));
            border: 1px solid rgba(99,102,241,.14);
        }

        .assignment-title {
            color: #f8fafc;
            font-size: 14px;
            font-weight: 750;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-name {
            color: #94a3b8;
            font-size: 11px;
            margin-top: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 500px;
        }

        .submission-date {
            color: #475569;
            font-size: 10px;
            margin-top: 4px;
        }

        .action-area {
            flex-shrink: 0;
        }

        .ai-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 39px;
            padding: 0 15px;
            border: 0;
            border-radius: 11px;
            background: linear-gradient(135deg,#4f46e5,#6366f1,#2563eb);
            color: #fff;
            font-size: 11px;
            font-weight: 750;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 9px 24px rgba(79,70,229,.22);
            transition: .2s ease;
        }

        .ai-button:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 13px 30px rgba(79,70,229,.32);
        }

        .result-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 39px;
            padding: 0 15px;
            border-radius: 11px;
            background: rgba(16,185,129,.08);
            border: 1px solid rgba(16,185,129,.20);
            color: #6ee7b7;
            font-size: 11px;
            font-weight: 750;
            text-decoration: none;
            transition: .2s ease;
        }

        .result-button:hover {
            color: #a7f3d0;
            background: rgba(16,185,129,.13);
            border-color: rgba(16,185,129,.30);
            transform: translateY(-2px);
        }

        .empty-state {
            padding: 65px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 31px;
            background: rgba(99,102,241,.08);
            border: 1px solid rgba(99,102,241,.12);
        }

        .empty-title {
            color: #f8fafc;
            font-size: 15px;
            font-weight: 750;
            margin-top: 16px;
        }

        .empty-text {
            color: #64748b;
            font-size: 12px;
            margin-top: 6px;
        }

        @media(max-width: 850px) {
            .feature-grid {
                grid-template-columns: 1fr;
            }

            .submission-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .action-area {
                width: 100%;
            }

            .ai-button,
            .result-button {
                width: 100%;
            }

            .file-name {
                max-width: calc(100vw - 150px);
            }
        }

        @media(max-width: 600px) {
            .ai-check-page {
                padding: 0 2px 30px;
            }

            .nexa-hero {
                padding: 23px;
                border-radius: 20px;
            }

            .hero-content {
                align-items: flex-start;
            }

            .ai-logo {
                width: 53px;
                height: 53px;
                font-size: 24px;
                border-radius: 15px;
            }

            .hero-content h1 {
                font-size: 21px;
            }

            .hero-content p {
                font-size: 11px;
                line-height: 1.5;
            }

            .header-status {
                display: none;
            }

            .submission-head,
            .submission-item {
                padding-left: 18px;
                padding-right: 18px;
            }

            .submission-main {
                width: 100%;
            }

            .assignment-title {
                max-width: calc(100vw - 115px);
            }

            .file-name {
                max-width: calc(100vw - 115px);
            }
        }
    </style>


    <div class="ai-check-page">

        {{-- HERO --}}
        <div class="nexa-hero">

            <div class="hero-content">

                <div class="ai-logo">
                    🤖
                </div>

                <div>
                    <div class="nexa-eyebrow">
                        NEXA AI
                    </div>

                    <h1>
                        AI Cek Tugas
                    </h1>

                    <p>
                        Biarkan AI membaca dan mengevaluasi tugas yang sudah kamu kumpulkan.
                    </p>
                </div>

                <div class="header-status">
                    <span class="status-dot"></span>
                    AI READY
                </div>

            </div>

        </div>


        {{-- AI FEATURES --}}
        <div class="feature-grid">

            <div class="feature-card">

                <div class="feature-icon">
                    📄
                </div>

                <div class="feature-title">
                    Baca File
                </div>

                <div class="feature-text">
                    AI membaca file tugas yang kamu kumpulkan.
                </div>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    🎯
                </div>

                <div class="feature-title">
                    Evaluasi
                </div>

                <div class="feature-text">
                    AI mengevaluasi kesesuaian dan kualitas tugas.
                </div>

            </div>


            <div class="feature-card">

                <div class="feature-icon">
                    💡
                </div>

                <div class="feature-title">
                    Rekomendasi
                </div>

                <div class="feature-text">
                    Dapatkan saran untuk memperbaiki tugas.
                </div>

            </div>

        </div>


        {{-- SUBMISSIONS --}}
        <div class="submission-box">

            <div class="submission-head">

                <h3 class="section-title">
                    Tugas yang Sudah Dikumpulkan
                </h3>

                <p class="section-description">
                    Pilih tugas untuk melihat atau menjalankan analisis AI.
                </p>

            </div>


            @forelse($submissions as $submission)

                <div class="submission-item">

                    <div class="submission-main">

                        <div class="file-icon">
                            📄
                        </div>

                        <div style="min-width:0;">

                            <div class="assignment-title">
                                {{ $submission->assignment->title }}
                            </div>

                            <div class="file-name">
                                {{ $submission->file_name }}
                            </div>

                            <div class="submission-date">
                                Dikumpulkan:
                                {{ $submission->created_at->format('d M Y H:i') }}
                            </div>

                        </div>

                    </div>


                    <div class="action-area">

                        @if($submission->aiAnalysis)

                            <a
                                href="{{ route('student.assignments.show', $submission->assignment) }}"
                                class="result-button"
                            >
                                ✓ Lihat Hasil AI
                            </a>

                        @else

                            <form
                                method="POST"
                                action="{{ route('ai.analyze', $submission) }}"
                                style="margin:0;"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="ai-button"
                                >
                                    🤖 Cek dengan NEXA AI
                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <div class="empty-icon">
                        📭
                    </div>

                    <div class="empty-title">
                        Belum ada tugas
                    </div>

                    <div class="empty-text">
                        Kumpulkan tugas terlebih dahulu untuk menggunakan NEXA AI.
                    </div>

                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>