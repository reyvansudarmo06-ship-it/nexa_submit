<x-app-layout>

    <x-slot name="header">
        <div class="nexa-header">
            <div>
                <div class="nexa-eyebrow">NEXA SYSTEM / AI INSTRUCTION</div>
                <h2>NEXA AI Baca Instruksi</h2>
                <p>Pahami tugas sebelum mulai mengerjakannya.</p>
            </div>

            <div class="header-status">
                <span class="status-dot"></span>
                AI READY
            </div>
        </div>
    </x-slot>


    <style>
        .instruction-page {
            max-width: 1250px;
            margin: 0 auto;
            padding-bottom: 45px;
        }

        .nexa-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nexa-header h2 {
            margin: 0;
            color: #f8fafc;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.3px;
        }

        .nexa-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .nexa-eyebrow {
            color: #818cf8;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.7px;
            text-transform: uppercase;
            margin-bottom: 4px;
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
            letter-spacing: .7px;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #34d399;
            box-shadow: 0 0 10px rgba(52,211,153,.8);
        }

        .instruction-hero {
            position: relative;
            overflow: hidden;
            padding: 31px;
            margin-bottom: 24px;
            border-radius: 23px;
            border: 1px solid rgba(99,102,241,.23);
            background:
                radial-gradient(circle at 90% 10%, rgba(99,102,241,.23), transparent 32%),
                radial-gradient(circle at 5% 100%, rgba(59,130,246,.12), transparent 35%),
                linear-gradient(135deg,#0b1020,#111936 55%,#10152c);
            box-shadow: 0 20px 55px rgba(0,0,0,.22);
        }

        .instruction-hero::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            right: -100px;
            top: -130px;
            border: 1px solid rgba(129,140,248,.08);
            background: rgba(99,102,241,.07);
        }

        .instruction-hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .ai-logo {
            width: 64px;
            height: 64px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            font-size: 29px;
            background: linear-gradient(135deg,#6366f1,#8b5cf6,#2563eb);
            box-shadow:
                0 15px 35px rgba(79,70,229,.3),
                inset 0 1px rgba(255,255,255,.15);
        }

        .hero-label {
            color: #818cf8;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .instruction-hero h1 {
            margin: 4px 0 0;
            color: #fff;
            font-size: 26px;
            font-weight: 850;
            letter-spacing: -.5px;
        }

        .instruction-hero p {
            margin: 7px 0 0;
            color: #94a3b8;
            font-size: 13px;
        }

        .alert-box {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            margin-bottom: 18px;
            border-radius: 14px;
            font-size: 12px;
        }

        .alert-success {
            color: #6ee7b7;
            background: rgba(16,185,129,.07);
            border: 1px solid rgba(16,185,129,.18);
        }

        .alert-error {
            color: #fca5a5;
            background: rgba(239,68,68,.07);
            border: 1px solid rgba(239,68,68,.18);
        }

        .global-error-title {
            font-weight: 800;
            margin-bottom: 3px;
        }

        .assignment-grid {
            display: grid;
            grid-template-columns: repeat(2,minmax(0,1fr));
            gap: 18px;
        }

        .assignment-card {
            position: relative;
            overflow: hidden;
            border-radius: 21px;
            border: 1px solid rgba(148,163,184,.10);
            background: rgba(15,23,42,.72);
            backdrop-filter: blur(18px);
            box-shadow: 0 15px 40px rgba(0,0,0,.16);
            padding: 23px;
            transition: .25s ease;
        }

        .assignment-card:hover {
            transform: translateY(-3px);
            border-color: rgba(99,102,241,.25);
            box-shadow: 0 20px 48px rgba(0,0,0,.23);
        }

        .assignment-card::after {
            content: "";
            position: absolute;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            right: -75px;
            top: -75px;
            background: rgba(99,102,241,.035);
            pointer-events: none;
        }

        .assignment-top {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
        }

        .subject-label {
            color: #818cf8;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .assignment-title {
            color: #f8fafc;
            font-size: 16px;
            line-height: 1.35;
            font-weight: 800;
            word-break: break-word;
        }

        .status-badge {
            flex-shrink: 0;
            padding: 6px 9px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-done {
            color: #6ee7b7;
            background: rgba(16,185,129,.08);
            border: 1px solid rgba(16,185,129,.18);
        }

        .status-pending {
            color: #94a3b8;
            background: rgba(100,116,139,.08);
            border: 1px solid rgba(100,116,139,.15);
        }

        .assignment-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 9px;
            margin-bottom: 17px;
        }

        .info-box {
            padding: 11px;
            border-radius: 12px;
            background: rgba(255,255,255,.025);
            border: 1px solid rgba(148,163,184,.07);
        }

        .info-label {
            color: #475569;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .7px;
            font-weight: 750;
        }

        .info-value {
            color: #cbd5e1;
            font-size: 11px;
            margin-top: 4px;
        }

        .description-box {
            padding: 14px;
            margin-bottom: 18px;
            border-radius: 14px;
            background: rgba(2,6,23,.32);
            border: 1px solid rgba(148,163,184,.07);
        }

        .description-label {
            color: #64748b;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .8px;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .description-text {
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .ai-result {
            padding-top: 4px;
        }

        .result-header {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 14px;
            margin-bottom: 17px;
            border-radius: 14px;
            background:
                linear-gradient(
                    135deg,
                    rgba(99,102,241,.10),
                    rgba(139,92,246,.07)
                );
            border: 1px solid rgba(99,102,241,.16);
        }

        .result-icon {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
            font-size: 18px;
        }

        .result-title {
            color: #f8fafc;
            font-size: 12px;
            font-weight: 800;
        }

        .result-subtitle {
            color: #64748b;
            font-size: 9px;
            margin-top: 3px;
        }

        .result-section {
            padding: 13px 14px;
            margin-bottom: 10px;
            border-radius: 13px;
            background: rgba(255,255,255,.018);
            border: 1px solid rgba(148,163,184,.06);
        }

        .result-section-title {
            color: #e2e8f0;
            font-size: 11px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .result-section-text {
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.7;
        }

        .check-item,
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .check-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            color: #818cf8;
            background: rgba(99,102,241,.10);
            border: 1px solid rgba(99,102,241,.14);
            font-size: 10px;
            font-weight: 800;
        }

        .step-number {
            width: 23px;
            height: 23px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            color: #a5b4fc;
            background: rgba(99,102,241,.10);
            border: 1px solid rgba(99,102,241,.14);
            font-size: 9px;
            font-weight: 800;
        }

        .ai-button {
            width: 100%;
            min-height: 42px;
            border: 0;
            border-radius: 12px;
            padding: 0 17px;
            color: #fff;
            background: linear-gradient(135deg,#4f46e5,#6366f1,#2563eb);
            box-shadow: 0 10px 25px rgba(79,70,229,.20);
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .ai-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(79,70,229,.30);
        }

        .reanalyze-button {
            width: 100%;
            min-height: 40px;
            border-radius: 11px;
            padding: 0 15px;
            color: #a5b4fc;
            background: rgba(99,102,241,.07);
            border: 1px solid rgba(99,102,241,.18);
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .reanalyze-button:hover {
            background: rgba(99,102,241,.12);
            border-color: rgba(99,102,241,.30);
        }

        .loading-box {
            padding: 13px;
            margin-top: 10px;
            border-radius: 12px;
            background: rgba(99,102,241,.06);
            border: 1px solid rgba(99,102,241,.13);
        }

        .loading-inner {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .spinner {
            width: 19px;
            height: 19px;
            flex-shrink: 0;
            border: 2px solid rgba(129,140,248,.25);
            border-top-color: #818cf8;
            border-radius: 50%;
            animation: nexaSpin .8s linear infinite;
        }

        .loading-title {
            color: #a5b4fc;
            font-size: 11px;
            font-weight: 800;
        }

        .loading-text {
            color: #64748b;
            font-size: 9px;
            margin-top: 3px;
        }

        .empty-state {
            padding: 75px 20px;
            text-align: center;
            border-radius: 22px;
            border: 1px solid rgba(148,163,184,.09);
            background: rgba(15,23,42,.72);
        }

        .empty-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: rgba(99,102,241,.08);
            border: 1px solid rgba(99,102,241,.13);
            font-size: 31px;
        }

        .empty-title {
            color: #f8fafc;
            font-size: 16px;
            font-weight: 800;
        }

        .empty-text {
            color: #64748b;
            font-size: 11px;
            margin-top: 6px;
        }

        .hidden {
            display: none !important;
        }

        @keyframes nexaSpin {
            to {
                transform: rotate(360deg);
            }
        }

        @media(max-width: 900px) {
            .assignment-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 600px) {
            .instruction-page {
                padding: 0 2px 30px;
            }

            .header-status {
                display: none;
            }

            .instruction-hero {
                padding: 23px;
            }

            .instruction-hero-content {
                align-items: flex-start;
            }

            .ai-logo {
                width: 53px;
                height: 53px;
                font-size: 24px;
                border-radius: 15px;
            }

            .instruction-hero h1 {
                font-size: 21px;
            }

            .instruction-hero p {
                font-size: 11px;
                line-height: 1.5;
            }

            .assignment-card {
                padding: 18px;
            }

            .assignment-info {
                grid-template-columns: 1fr;
            }

            .assignment-top {
                flex-direction: column;
            }

            .status-badge {
                align-self: flex-start;
            }
        }
    </style>


    <div class="instruction-page">

        {{-- HERO --}}
        <div class="instruction-hero">

            <div class="instruction-hero-content">

                <div class="ai-logo">
                    🤖
                </div>

                <div>
                    <div class="hero-label">
                        NEXA AI / INSTRUCTION ENGINE
                    </div>

                    <h1>
                        Baca Instruksi Tugas
                    </h1>

                    <p>
                        Pahami tugas, tujuan, persyaratan, dan langkah pengerjaannya sebelum mulai.
                    </p>
                </div>

                <div class="header-status">
                    <span class="status-dot"></span>
                    AI READY
                </div>

            </div>

        </div>


        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="alert-box alert-success">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>

        @endif


        {{-- ERROR --}}
        @if(session('error'))

            <div class="alert-box alert-error">
                <span>⚠</span>
                <span>{{ session('error') }}</span>
            </div>

        @endif


        {{-- GLOBAL AI ERROR --}}
        <div
            id="global-ai-error"
            class="alert-box alert-error hidden"
        >
            <span>⚠</span>

            <div>
                <div class="global-error-title">
                    NEXA AI mengalami masalah
                </div>

                <div id="global-ai-error-message"></div>
            </div>
        </div>


        {{-- EMPTY STATE --}}
        @if($assignments->isEmpty())

            <div class="empty-state">

                <div class="empty-icon">
                    📚
                </div>

                <div class="empty-title">
                    Belum ada tugas
                </div>

                <div class="empty-text">
                    Belum ada tugas aktif yang bisa dibaca oleh NEXA AI.
                </div>

            </div>

        @else

            <div class="assignment-grid">

                @foreach($assignments as $assignment)

                    <div
                        id="assignment-card-{{ $assignment->id }}"
                        class="assignment-card"
                    >

                        {{-- TOP --}}
                        <div class="assignment-top">

                            <div style="min-width:0;">

                                <div class="subject-label">
                                    {{ $assignment->subject ?? 'Tugas' }}
                                </div>

                                <div class="assignment-title">
                                    {{ $assignment->title }}
                                </div>

                            </div>


                            @if($assignment->aiInstructionAnalysis)

                                <span class="status-badge status-done ai-status-badge">
                                    ✓ Sudah Dibaca
                                </span>

                            @else

                                <span class="status-badge status-pending ai-status-badge">
                                    Belum Dianalisis
                                </span>

                            @endif

                        </div>


                        {{-- INFO --}}
                        <div class="assignment-info">

                            <div class="info-box">

                                <div class="info-label">
                                    Kelas
                                </div>

                                <div class="info-value">
                                    🎓 {{ $assignment->class_name ?? '-' }}
                                </div>

                            </div>


                            <div class="info-box">

                                <div class="info-label">
                                    Deadline
                                </div>

                                <div class="info-value">
                                    🕐
                                    {{ $assignment->deadline
                                        ? $assignment->deadline->format('d M Y, H:i')
                                        : '-' }}
                                </div>

                            </div>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="description-box">

                            <div class="description-label">
                                Instruksi Guru
                            </div>

                            <div class="description-text">
                                {{ $assignment->description ?: 'Tidak ada deskripsi tugas.' }}
                            </div>

                        </div>


                        {{-- EXISTING ANALYSIS --}}
                        @if($assignment->aiInstructionAnalysis)

                            @php

                                $analysis = $assignment->aiInstructionAnalysis;

                                $checklist = json_decode(
                                    $analysis->checklist ?? '[]',
                                    true
                                );

                                $steps = json_decode(
                                    $analysis->step_by_step ?? '[]',
                                    true
                                );

                                if (!is_array($checklist)) {
                                    $checklist = [];
                                }

                                if (!is_array($steps)) {
                                    $steps = [];
                                }

                            @endphp


                            <div class="ai-result">

                                <div class="result-header">

                                    <div class="result-icon">
                                        🤖
                                    </div>

                                    <div>

                                        <div class="result-title">
                                            Analisis NEXA AI
                                        </div>

                                        <div class="result-subtitle">
                                            Instruksi berhasil dipahami
                                        </div>

                                    </div>

                                </div>


                                <div class="result-section">

                                    <div class="result-section-title">
                                        🧠 Ringkasan
                                    </div>

                                    <div class="result-section-text">
                                        {{ $analysis->summary ?: 'Tidak dijelaskan.' }}
                                    </div>

                                </div>


                                <div class="result-section">

                                    <div class="result-section-title">
                                        🎯 Tujuan
                                    </div>

                                    <div class="result-section-text">
                                        {{ $analysis->objective ?: 'Tidak dijelaskan.' }}
                                    </div>

                                </div>


                                <div class="result-section">

                                    <div class="result-section-title">
                                        📋 Yang Harus Dipenuhi
                                    </div>

                                    <div class="result-section-text">
                                        {{ $analysis->requirements ?: 'Tidak dijelaskan.' }}
                                    </div>

                                </div>


                                @if(count($checklist))

                                    <div class="result-section">

                                        <div class="result-section-title">
                                            ☑️ Checklist
                                        </div>

                                        @foreach($checklist as $item)

                                            <div class="check-item">

                                                <span class="check-icon">
                                                    ✓
                                                </span>

                                                <span>
                                                    {{ $item }}
                                                </span>

                                            </div>

                                        @endforeach

                                    </div>

                                @endif


                                <div class="result-section">

                                    <div class="result-section-title">
                                        ⚠️ Catatan Penting
                                    </div>

                                    <div class="result-section-text">
                                        {{ $analysis->important_notes ?: 'Tidak ada catatan khusus.' }}
                                    </div>

                                </div>


                                @if(count($steps))

                                    <div class="result-section">

                                        <div class="result-section-title">
                                            🚀 Langkah Pengerjaan
                                        </div>

                                        @foreach($steps as $index => $step)

                                            <div class="step-item">

                                                <span class="step-number">
                                                    {{ $index + 1 }}
                                                </span>

                                                <span>
                                                    {{ $step }}
                                                </span>

                                            </div>

                                        @endforeach

                                    </div>

                                @endif

                            </div>


                            <button
                                type="button"
                                onclick="analyzeInstruction({{ $assignment->id }}, this)"
                                class="reanalyze-button"
                            >
                                🔄 Analisis Ulang dengan NEXA AI
                            </button>


                            <div class="ai-loading loading-box hidden">

                                <div class="loading-inner">

                                    <div class="spinner"></div>

                                    <div>

                                        <div class="loading-title">
                                            NEXA AI sedang membaca...
                                        </div>

                                        <div class="loading-text">
                                            Tunggu sebentar, instruksi sedang dianalisis.
                                        </div>

                                    </div>

                                </div>

                            </div>

                        @else

                            <button
                                type="button"
                                onclick="analyzeInstruction({{ $assignment->id }}, this)"
                                class="ai-analyze-button ai-button"
                            >

                                <span class="ai-normal-text">
                                    🤖 Baca Instruksi dengan NEXA AI
                                </span>

                                <span class="ai-loading-text hidden">
                                    ⏳ NEXA AI sedang membaca...
                                </span>

                            </button>


                            <div class="ai-loading loading-box hidden">

                                <div class="loading-inner">

                                    <div class="spinner"></div>

                                    <div>

                                        <div class="loading-title">
                                            NEXA AI sedang membaca...
                                        </div>

                                        <div class="loading-text">
                                            Menganalisis instruksi tugas.
                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endif


                        <div class="dynamic-ai-result hidden"></div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>


    <script>

        async function analyzeInstruction(assignmentId, button) {

            const card = document.getElementById(
                'assignment-card-' + assignmentId
            );

            if (!card) {
                return;
            }


            const loading = card.querySelector('.ai-loading');

            const normalText = card.querySelector('.ai-normal-text');

            const loadingText = card.querySelector('.ai-loading-text');

            const resultContainer = card.querySelector(
                '.dynamic-ai-result'
            );

            const statusBadge = card.querySelector(
                '.ai-status-badge'
            );


            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            )?.getAttribute('content');


            const csrfInput = document.querySelector(
                'input[name="_token"]'
            );


            const token =
                csrfToken ||
                csrfInput?.value;


            if (button) {

                button.disabled = true;

                button.style.opacity = '0.55';

                button.style.cursor = 'wait';

            }


            if (normalText) {
                normalText.classList.add('hidden');
            }


            if (loadingText) {
                loadingText.classList.remove('hidden');
            }


            if (loading) {
                loading.classList.remove('hidden');
            }


            if (resultContainer) {

                resultContainer.classList.add('hidden');

                resultContainer.innerHTML = '';

            }


            const globalError =
                document.getElementById('global-ai-error');


            if (globalError) {

                globalError.classList.add('hidden');

            }


            try {

                const response = await fetch(
                    '{{ url('/ai-instruction') }}/' +
                    assignmentId +
                    '/analyze',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': token
                        },

                        body: JSON.stringify({})
                    }
                );


                let data;

                try {

                    data = await response.json();

                } catch (jsonError) {

                    throw new Error(
                        'Server memberikan response yang tidak valid.'
                    );

                }


                if (!response.ok || !data.success) {

                    throw new Error(
                        data.message ||
                        data.error ||
                        'NEXA AI gagal menganalisis instruksi.'
                    );

                }


                const analysis = data.analysis;


                if (!analysis) {

                    throw new Error(
                        'Hasil analisis NEXA AI tidak ditemukan.'
                    );

                }


                renderInstructionResult(
                    card,
                    analysis,
                    assignmentId
                );


                if (statusBadge) {

                    statusBadge.className =
                        'status-badge status-done ai-status-badge';

                    statusBadge.textContent =
                        '✓ Sudah Dibaca';

                }


                if (button) {

                    button.disabled = false;

                    button.style.opacity = '1';

                    button.style.cursor = 'pointer';

                    button.innerHTML =
                        '🔄 Analisis Ulang dengan NEXA AI';

                    button.className =
                        'reanalyze-button';

                    button.onclick = function () {

                        analyzeInstruction(
                            assignmentId,
                            button
                        );

                    };

                }


            } catch (error) {

                console.error(
                    'NEXA AI Instruction Error:',
                    error
                );


                const errorBox =
                    document.getElementById(
                        'global-ai-error'
                    );

                const errorMessage =
                    document.getElementById(
                        'global-ai-error-message'
                    );


                if (errorBox && errorMessage) {

                    errorMessage.textContent =
                        error.message ||
                        'Terjadi kesalahan saat menghubungi NEXA AI.';

                    errorBox.classList.remove(
                        'hidden'
                    );

                }


                if (button) {

                    button.disabled = false;

                    button.style.opacity = '1';

                    button.style.cursor = 'pointer';

                    if (normalText) {

                        normalText.classList.remove(
                            'hidden'
                        );

                    }

                    if (loadingText) {

                        loadingText.classList.add(
                            'hidden'
                        );

                    }

                }

            } finally {

                if (loading) {

                    loading.classList.add(
                        'hidden'
                    );

                }

            }

        }


        function renderInstructionResult(
            card,
            analysis,
            assignmentId
        ) {

            const resultContainer =
                card.querySelector(
                    '.dynamic-ai-result'
                );


            if (!resultContainer) {
                return;
            }


            const checklist =
                Array.isArray(
                    analysis.checklist
                )
                    ? analysis.checklist
                    : [];


            const steps =
                Array.isArray(
                    analysis.step_by_step
                )
                    ? analysis.step_by_step
                    : [];


            let checklistHtml = '';


            if (checklist.length > 0) {

                checklistHtml = `

                    <div class="result-section">

                        <div class="result-section-title">
                            ☑️ Checklist
                        </div>

                        ${checklist.map(function(item) {

                            return `

                                <div class="check-item">

                                    <span class="check-icon">
                                        ✓
                                    </span>

                                    <span>
                                        ${escapeHtml(item)}
                                    </span>

                                </div>

                            `;

                        }).join('')}

                    </div>

                `;

            }


            let stepsHtml = '';


            if (steps.length > 0) {

                stepsHtml = `

                    <div class="result-section">

                        <div class="result-section-title">
                            🚀 Langkah Pengerjaan
                        </div>

                        ${steps.map(function(step, index) {

                            return `

                                <div class="step-item">

                                    <span class="step-number">
                                        ${index + 1}
                                    </span>

                                    <span>
                                        ${escapeHtml(step)}
                                    </span>

                                </div>

                            `;

                        }).join('')}

                    </div>

                `;

            }


            resultContainer.innerHTML = `

                <div class="ai-result">

                    <div class="result-header">

                        <div class="result-icon">
                            🤖
                        </div>

                        <div>

                            <div class="result-title">
                                Analisis NEXA AI
                            </div>

                            <div class="result-subtitle">
                                Instruksi berhasil dipahami
                            </div>

                        </div>

                    </div>


                    <div class="result-section">

                        <div class="result-section-title">
                            🧠 Ringkasan
                        </div>

                        <div class="result-section-text">
                            ${escapeHtml(
                                analysis.summary ||
                                'Tidak dijelaskan.'
                            )}
                        </div>

                    </div>


                    <div class="result-section">

                        <div class="result-section-title">
                            🎯 Tujuan
                        </div>

                        <div class="result-section-text">
                            ${escapeHtml(
                                analysis.objective ||
                                'Tidak dijelaskan.'
                            )}
                        </div>

                    </div>


                    <div class="result-section">

                        <div class="result-section-title">
                            📋 Yang Harus Dipenuhi
                        </div>

                        <div class="result-section-text">
                            ${escapeHtml(
                                analysis.requirements ||
                                'Tidak dijelaskan.'
                            )}
                        </div>

                    </div>


                    ${checklistHtml}


                    <div class="result-section">

                        <div class="result-section-title">
                            ⚠️ Catatan Penting
                        </div>

                        <div class="result-section-text">
                            ${escapeHtml(
                                analysis.important_notes ||
                                'Tidak ada catatan khusus.'
                            )}
                        </div>

                    </div>


                    ${stepsHtml}

                </div>

            `;


            resultContainer.classList.remove(
                'hidden'
            );


            const oldButton =
                card.querySelector(
                    '.ai-analyze-button'
                );


            if (oldButton) {

                oldButton.outerHTML = `

                    <button
                        type="button"
                        onclick="analyzeInstruction(
                            ${assignmentId},
                            this
                        )"
                        class="reanalyze-button"
                    >
                        🔄 Analisis Ulang dengan NEXA AI
                    </button>

                `;

            }

        }


        function escapeHtml(value) {

            if (
                value === null ||
                value === undefined
            ) {

                return '';

            }


            return String(value)
                .replace(
                    /&/g,
                    '&amp;'
                )
                .replace(
                    /</g,
                    '&lt;'
                )
                .replace(
                    />/g,
                    '&gt;'
                )
                .replace(
                    /"/g,
                    '&quot;'
                )
                .replace(
                    /'/g,
                    '&#039;'
                );

        }

    </script>

</x-app-layout>