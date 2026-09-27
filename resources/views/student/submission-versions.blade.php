<x-app-layout>

    <style>
        .versions-page {
            min-height: calc(100vh - 70px);
            padding: 34px 20px 60px;
            color: #e5e7eb;
        }

        .versions-container {
            max-width: 1180px;
            margin: auto;
        }

        .versions-hero {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(139, 92, 246, .18);
            border-radius: 28px;
            padding: 28px;
            margin-bottom: 22px;
            background:
                radial-gradient(circle at 85% 15%, rgba(59,130,246,.16), transparent 32%),
                radial-gradient(circle at 10% 90%, rgba(139,92,246,.12), transparent 35%),
                rgba(15,23,42,.78);
            backdrop-filter: blur(18px);
            box-shadow: 0 20px 60px rgba(0,0,0,.22);
        }

        .versions-hero::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            right: -70px;
            bottom: -100px;
            border-radius: 50%;
            background: rgba(59,130,246,.10);
            filter: blur(10px);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .hero-icon {
            width: 58px;
            height: 58px;
            flex: 0 0 58px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            box-shadow: 0 12px 35px rgba(99,102,241,.28);
        }

        .hero-title {
            margin: 0;
            color: #fff;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .hero-subtitle {
            margin: 6px 0 0;
            color: #94a3b8;
            font-size: 14px;
        }

        .alert-box {
            border-radius: 16px;
            padding: 15px 18px;
            margin-bottom: 16px;
            backdrop-filter: blur(12px);
            font-size: 14px;
        }

        .alert-success {
            color: #86efac;
            border: 1px solid rgba(34,197,94,.18);
            background: rgba(34,197,94,.06);
        }

        .alert-info {
            color: #93c5fd;
            border: 1px solid rgba(59,130,246,.18);
            background: rgba(59,130,246,.06);
        }

        .alert-error {
            color: #fca5a5;
            border: 1px solid rgba(239,68,68,.18);
            background: rgba(239,68,68,.06);
        }

        .main-card {
            overflow: hidden;
            border-radius: 28px;
            border: 1px solid rgba(148,163,184,.12);
            background:
                linear-gradient(
                    145deg,
                    rgba(15,23,42,.94),
                    rgba(10,15,30,.94)
                );
            box-shadow: 0 24px 70px rgba(0,0,0,.24);
        }

        .assignment-header {
            padding: 25px 28px;
            border-bottom: 1px solid rgba(148,163,184,.10);
            background:
                radial-gradient(circle at 100% 0%, rgba(59,130,246,.12), transparent 30%),
                linear-gradient(
                    135deg,
                    rgba(124,58,237,.10),
                    rgba(37,99,235,.06)
                );
        }

        .assignment-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .eyebrow {
            color: #818cf8;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .assignment-title {
            margin: 7px 0 4px;
            color: #fff;
            font-size: 21px;
            font-weight: 800;
        }

        .assignment-meta {
            color: #94a3b8;
            font-size: 13px;
        }

        .version-count {
            flex-shrink: 0;
            padding: 11px 16px;
            border-radius: 14px;
            color: #c4b5fd;
            font-size: 13px;
            font-weight: 700;
            border: 1px solid rgba(139,92,246,.20);
            background: rgba(139,92,246,.08);
        }

        .content-area {
            padding: 28px;
        }

        .empty-version {
            padding: 45px 25px;
            text-align: center;
            border-radius: 22px;
            border: 1px solid rgba(148,163,184,.10);
            background: rgba(15,23,42,.55);
        }

        .empty-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 17px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background: linear-gradient(
                135deg,
                rgba(124,58,237,.16),
                rgba(37,99,235,.13)
            );
            border: 1px solid rgba(139,92,246,.18);
        }

        .empty-title {
            color: #fff;
            font-size: 18px;
            font-weight: 800;
        }

        .empty-text {
            margin-top: 7px;
            color: #64748b;
            font-size: 13px;
        }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 18px;
            border-radius: 13px;
            border: 1px solid rgba(139,92,246,.24);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            box-shadow: 0 10px 30px rgba(99,102,241,.18);
            transition: .2s ease;
        }

        .primary-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.08);
        }

        .versions-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .version-card {
            position: relative;
            overflow: hidden;
            padding: 22px;
            border-radius: 22px;
            border: 1px solid rgba(148,163,184,.10);
            background:
                linear-gradient(
                    145deg,
                    rgba(17,24,39,.92),
                    rgba(15,23,42,.78)
                );
            transition: .25s ease;
        }

        .version-card:hover {
            transform: translateY(-2px);
            border-color: rgba(99,102,241,.24);
            box-shadow: 0 18px 45px rgba(0,0,0,.18);
        }

        .version-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .version-info {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .version-number {
            width: 52px;
            height: 52px;
            flex: 0 0 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 14px;
            font-weight: 900;
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            box-shadow: 0 10px 28px rgba(99,102,241,.20);
        }

        .version-name {
            color: #fff;
            font-size: 15px;
            font-weight: 800;
        }

        .version-file {
            max-width: 480px;
            margin-top: 5px;
            color: #64748b;
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .version-meta {
            display: flex;
            gap: 25px;
            flex-shrink: 0;
        }

        .meta-label {
            color: #475569;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .meta-value {
            margin-top: 5px;
            color: #cbd5e1;
            font-size: 12px;
        }

        .status {
            color: #4ade80;
        }

        .note-box {
            margin-top: 17px;
            padding: 14px 16px;
            border-radius: 15px;
            background: rgba(2,6,23,.45);
            border: 1px solid rgba(148,163,184,.07);
        }

        .note-title {
            color: #64748b;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .note-text {
            margin-top: 5px;
            color: #cbd5e1;
            font-size: 13px;
            line-height: 1.65;
        }

        .ai-box {
            margin-top: 17px;
        }

        .ai-result {
            padding: 21px;
            border-radius: 20px;
            border: 1px solid rgba(99,102,241,.18);
            background:
                radial-gradient(circle at 100% 0%, rgba(59,130,246,.09), transparent 35%),
                rgba(79,70,229,.045);
        }

        .ai-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
        }

        .ai-label {
            color: #818cf8;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .ai-subtitle {
            margin-top: 5px;
            color: #64748b;
            font-size: 12px;
        }

        .score {
            padding: 9px 13px;
            border-radius: 12px;
            color: #c4b5fd;
            font-size: 13px;
            font-weight: 800;
            border: 1px solid rgba(139,92,246,.20);
            background: rgba(139,92,246,.08);
            white-space: nowrap;
        }

        .ai-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 13px;
        }

        .ai-item {
            padding: 15px;
            border-radius: 15px;
            background: rgba(2,6,23,.28);
            border: 1px solid rgba(148,163,184,.06);
        }

        .ai-item.full {
            grid-column: 1 / -1;
        }

        .ai-item-title {
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .ai-item-text {
            margin-top: 7px;
            color: #cbd5e1;
            font-size: 13px;
            line-height: 1.7;
        }

        .ai-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 18px;
            padding-top: 14px;
            border-top: 1px solid rgba(148,163,184,.08);
        }

        .saved {
            color: #4ade80;
            font-size: 11px;
        }

        .analyze-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 15px;
            border-radius: 13px;
            border: 1px solid rgba(99,102,241,.25);
            color: #a5b4fc;
            font-size: 12px;
            font-weight: 800;
            background: rgba(99,102,241,.08);
            transition: .2s ease;
        }

        .analyze-btn:hover {
            background: rgba(99,102,241,.14);
            border-color: rgba(99,102,241,.38);
        }

        .analyze-btn:disabled {
            opacity: .55;
            cursor: wait;
        }

        .analysis-loading {
            margin-top: 14px;
            padding: 16px;
            border-radius: 16px;
            border: 1px solid rgba(99,102,241,.15);
            background: rgba(99,102,241,.045);
        }

        .loading-title {
            color: #a5b4fc;
            font-size: 13px;
            font-weight: 700;
        }

        .loading-text {
            margin-top: 5px;
            color: #64748b;
            font-size: 11px;
        }

        .analysis-error {
            margin-top: 14px;
            padding: 15px;
            border-radius: 15px;
            border: 1px solid rgba(239,68,68,.18);
            background: rgba(239,68,68,.05);
        }

        .error-title {
            color: #fca5a5;
            font-size: 12px;
            font-weight: 800;
        }

        .error-text {
            margin-top: 5px;
            color: #f87171;
            font-size: 12px;
        }

        .upload-panel {
            margin-top: 25px;
            padding: 24px;
            border-radius: 22px;
            border: 1px solid rgba(99,102,241,.16);
            background:
                radial-gradient(circle at 100% 0%, rgba(59,130,246,.08), transparent 35%),
                rgba(99,102,241,.045);
        }

        .upload-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 20px;
        }

        .upload-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(99,102,241,.10);
            border: 1px solid rgba(99,102,241,.15);
        }

        .upload-title {
            color: #fff;
            font-size: 15px;
            font-weight: 800;
        }

        .upload-subtitle {
            margin-top: 4px;
            color: #64748b;
            font-size: 11px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 700;
        }

        .file-input {
            width: 100%;
            padding: 12px;
            border-radius: 13px;
            border: 1px dashed rgba(99,102,241,.25);
            color: #94a3b8;
            background: rgba(2,6,23,.42);
            font-size: 12px;
        }

        .file-input:focus {
            outline: none;
            border-color: #6366f1;
        }

        .form-help {
            margin-top: 6px;
            color: #475569;
            font-size: 10px;
        }

        .note-input {
            width: 100%;
            min-height: 105px;
            resize: vertical;
            padding: 13px;
            border-radius: 13px;
            border: 1px solid rgba(148,163,184,.10);
            color: #e5e7eb;
            background: rgba(2,6,23,.42);
            font-size: 12px;
        }

        .note-input::placeholder {
            color: #475569;
        }

        .note-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,.08);
        }

        .upload-submit {
            margin-top: 17px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 18px;
            border: 0;
            border-radius: 13px;
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            box-shadow: 0 10px 28px rgba(99,102,241,.18);
            cursor: pointer;
            transition: .2s ease;
        }

        .upload-submit:hover {
            transform: translateY(-1px);
            filter: brightness(1.08);
        }

        @media (max-width: 850px) {
            .version-top {
                flex-direction: column;
                align-items: stretch;
            }

            .version-meta {
                justify-content: space-between;
            }

            .version-file {
                max-width: 100%;
            }
        }

        @media (max-width: 650px) {
            .versions-page {
                padding: 20px 12px 40px;
            }

            .versions-hero {
                padding: 22px;
                border-radius: 22px;
            }

            .hero-content {
                align-items: flex-start;
            }

            .hero-icon {
                width: 48px;
                height: 48px;
                flex-basis: 48px;
                border-radius: 15px;
                font-size: 20px;
            }

            .hero-title {
                font-size: 22px;
            }

            .assignment-header,
            .content-area {
                padding: 20px;
            }

            .assignment-header-inner {
                align-items: flex-start;
                flex-direction: column;
            }

            .version-card {
                padding: 17px;
            }

            .version-info {
                align-items: flex-start;
            }

            .version-meta {
                gap: 15px;
            }

            .ai-grid {
                grid-template-columns: 1fr;
            }

            .ai-item.full {
                grid-column: auto;
            }

            .ai-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .ai-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .analyze-btn {
                width: 100%;
                justify-content: center;
            }

            .upload-panel {
                padding: 18px;
            }
        }
    </style>

    <div class="versions-page">
        <div class="versions-container">

            {{-- HERO --}}
            <div class="versions-hero">
                <div class="hero-content">
                    <div class="hero-icon">
                        🕘
                    </div>

                    <div>
                        <h1 class="hero-title">
                            Riwayat Versi Tugas
                        </h1>

                        <p class="hero-subtitle">
                            Lihat perkembangan tugas, hasil revisi, dan evaluasi AI dari setiap versi.
                        </p>
                    </div>
                </div>
            </div>

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="alert-box alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- INFO --}}
            @if (session('info'))
                <div class="alert-box alert-info">
                    ℹ️ {{ session('info') }}
                </div>
            @endif

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert-box alert-error">
                    <strong>⚠️ Terjadi kesalahan:</strong>

                    <div style="margin-top: 6px;">
                        @foreach ($errors->all() as $error)
                            <div>• {{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- MAIN CARD --}}
            <div class="main-card">

                {{-- ASSIGNMENT HEADER --}}
                <div class="assignment-header">
                    <div class="assignment-header-inner">

                        <div>
                            <div class="eyebrow">
                                Submission History
                            </div>

                            <h2 class="assignment-title">
                                {{ $submission->assignment?->title ?? 'Tugas' }}
                            </h2>

                            <div class="assignment-meta">
                                {{ $submission->assignment?->subject ?? '-' }}
                                <span style="opacity:.35; margin:0 5px;">•</span>
                                {{ $submission->assignment?->class_name ?? '-' }}
                            </div>
                        </div>

                        <div class="version-count">
                            {{ $submission->versions->count() }} Versi
                        </div>

                    </div>
                </div>

                <div class="content-area">

                    {{-- VERSION LIST --}}
                    @if ($submission->versions->isEmpty())

                        <div class="empty-version">

                            <div class="empty-icon">
                                🗂️
                            </div>

                            <div class="empty-title">
                                Belum Ada Riwayat Versi
                            </div>

                            <p class="empty-text">
                                Submission saat ini belum dicatat sebagai Version 1.
                            </p>

                            <form
                                action="{{ route('student.submission-versions.initial', $submission) }}"
                                method="POST"
                                style="margin-top: 22px;"
                            >
                                @csrf

                                <button type="submit" class="primary-btn">
                                    📌 Simpan sebagai Version 1
                                </button>
                            </form>

                        </div>

                    @else

                        <div class="versions-list">

                            @foreach ($submission->versions as $version)

                                <div class="version-card">

                                    {{-- VERSION HEADER --}}
                                    <div class="version-top">

                                        <div class="version-info">

                                            <div class="version-number">
                                                V{{ $version->version_number }}
                                            </div>

                                            <div style="min-width:0;">
                                                <div class="version-name">
                                                    Version {{ $version->version_number }}
                                                </div>

                                                <div class="version-file">
                                                    {{ $version->file_name }}
                                                </div>
                                            </div>

                                        </div>

                                        <div class="version-meta">

                                            <div>
                                                <div class="meta-label">
                                                    Dibuat
                                                </div>

                                                <div class="meta-value">
                                                    {{ $version->created_at->format('d M Y, H:i') }}
                                                </div>
                                            </div>

                                            <div>
                                                <div class="meta-label">
                                                    Status
                                                </div>

                                                <div class="meta-value status">
                                                    ● {{ ucfirst($version->status) }}
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    {{-- NOTE --}}
                                    @if ($version->note)

                                        <div class="note-box">

                                            <div class="note-title">
                                                Catatan Revisi
                                            </div>

                                            <div class="note-text">
                                                {{ $version->note }}
                                            </div>

                                        </div>

                                    @endif

                                    {{-- AI ANALYSIS --}}
                                    <div class="ai-box">

                                        @if ($version->aiAnalysis)

                                            <div class="ai-result">

                                                <div class="ai-header">

                                                    <div>
                                                        <div class="ai-label">
                                                            🤖 NEXA AI Evaluation
                                                        </div>

                                                        <div class="ai-subtitle">
                                                            Analisis tersimpan untuk Version {{ $version->version_number }}
                                                        </div>
                                                    </div>

                                                    <div class="score">
                                                        Score:
                                                        {{ $version->aiAnalysis->score ?? '-' }}
                                                        / 100
                                                    </div>

                                                </div>

                                                <div class="ai-grid">

                                                    <div class="ai-item full">
                                                        <div class="ai-item-title">
                                                            Ringkasan
                                                        </div>

                                                        <div class="ai-item-text">
                                                            {{ $version->aiAnalysis->summary ?? '-' }}
                                                        </div>
                                                    </div>

                                                    <div class="ai-item">
                                                        <div class="ai-item-title">
                                                            Kesesuaian Instruksi
                                                        </div>

                                                        <div class="ai-item-text">
                                                            {{ $version->aiAnalysis->instruction_match ?? '-' }}
                                                        </div>
                                                    </div>

                                                    <div class="ai-item">
                                                        <div class="ai-item-title">
                                                            Yang Sudah Baik
                                                        </div>

                                                        <div class="ai-item-text">
                                                            {{ $version->aiAnalysis->strengths ?? '-' }}
                                                        </div>
                                                    </div>

                                                    <div class="ai-item">
                                                        <div class="ai-item-title">
                                                            Yang Masih Kurang
                                                        </div>

                                                        <div class="ai-item-text">
                                                            {{ $version->aiAnalysis->weaknesses ?? '-' }}
                                                        </div>
                                                    </div>

                                                    <div class="ai-item">
                                                        <div class="ai-item-title">
                                                            Saran Perbaikan
                                                        </div>

                                                        <div class="ai-item-text">
                                                            {{ $version->aiAnalysis->suggestions ?? '-' }}
                                                        </div>
                                                    </div>

                                                    <div class="ai-item">
                                                        <div class="ai-item-title">
                                                            Kelengkapan
                                                        </div>

                                                        <div class="ai-item-text">
                                                            {{ $version->aiAnalysis->completeness ?? '-' }}
                                                        </div>
                                                    </div>

                                                    <div class="ai-item">
                                                        <div class="ai-item-title">
                                                            Kualitas
                                                        </div>

                                                        <div class="ai-item-text">
                                                            {{ $version->aiAnalysis->quality ?? '-' }}
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="ai-footer">

                                                    <span class="saved">
                                                        ✓ Analisis tersimpan
                                                    </span>

                                                    <span style="color:#475569;font-size:11px;">
                                                        Version {{ $version->version_number }}
                                                    </span>

                                                </div>

                                            </div>

                                        @else

                                            <button
                                                type="button"
                                                onclick="analyzeVersion({{ $version->id }}, this)"
                                                class="analyze-btn"
                                            >
                                                🤖 Analisis Version
                                            </button>

                                            <div
                                                id="version-analysis-{{ $version->id }}"
                                                style="display:none;"
                                            ></div>

                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                    {{-- ADD NEW VERSION --}}
                    @if ($submission->versions->isNotEmpty())

                        <div class="upload-panel">

                            <div class="upload-heading">

                                <div class="upload-icon">
                                    📤
                                </div>

                                <div>
                                    <div class="upload-title">
                                        Tambah Versi Baru
                                    </div>

                                    <div class="upload-subtitle">
                                        Upload revisi tugas tanpa menghapus versi sebelumnya.
                                    </div>
                                </div>

                            </div>

                            <form
                                action="{{ route('student.submission-versions.store', $submission) }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >

                                @csrf

                                <div>
                                    <label for="file" class="form-label">
                                        File Revisi
                                    </label>

                                    <input
                                        type="file"
                                        name="file"
                                        id="file"
                                        required
                                        class="file-input"
                                    >

                                    <div class="form-help">
                                        Maksimal 10 MB.
                                    </div>
                                </div>

                                <div style="margin-top:18px;">
                                    <label for="note" class="form-label">
                                        Catatan Revisi
                                    </label>

                                    <textarea
                                        name="note"
                                        id="note"
                                        rows="4"
                                        maxlength="2000"
                                        placeholder="Contoh: Memperbaiki bagian yang kurang sesuai dengan feedback AI dan guru."
                                        class="note-input"
                                    ></textarea>
                                </div>

                                <button type="submit" class="upload-submit">
                                    🚀 Upload Versi Baru
                                </button>

                            </form>

                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>

    <script>
        async function analyzeVersion(versionId, button = null) {

            const resultBox = document.getElementById(
                `version-analysis-${versionId}`
            );

            if (!resultBox) {
                return;
            }

            if (button) {
                button.disabled = true;
                button.innerText = '⏳ Menganalisis...';
            }

            resultBox.style.display = 'block';

            resultBox.innerHTML = `
                <div class="analysis-loading">
                    <div class="loading-title">
                        🤖 NEXA AI sedang membaca dan mengevaluasi file...
                    </div>

                    <div class="loading-text">
                        Mohon tunggu, proses analisis sedang berlangsung.
                    </div>
                </div>
            `;

            try {

                const csrfToken = document.querySelector(
                    'meta[name="csrf-token"]'
                )?.getAttribute('content');

                if (!csrfToken) {
                    throw new Error(
                        'CSRF token tidak ditemukan.'
                    );
                }

                const response = await fetch(
                    `/ai/analyze-version/${versionId}`,
                    {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                    }
                );

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(
                        data.message || 'Analisis AI gagal.'
                    );
                }

                const analysis = data.analysis;

                resultBox.innerHTML = `
                    <div class="ai-result">

                        <div class="ai-header">

                            <div>
                                <div class="ai-label">
                                    🤖 NEXA AI Evaluation
                                </div>

                                <div class="ai-subtitle">
                                    Analisis Version ${data.version}
                                </div>
                            </div>

                            <div class="score">
                                Score:
                                ${analysis.score ?? '-'}
                                / 100
                            </div>

                        </div>

                        <div class="ai-grid">

                            <div class="ai-item full">
                                <div class="ai-item-title">
                                    Ringkasan
                                </div>

                                <div class="ai-item-text">
                                    ${analysis.summary || '-'}
                                </div>
                            </div>

                            <div class="ai-item">
                                <div class="ai-item-title">
                                    Kesesuaian Instruksi
                                </div>

                                <div class="ai-item-text">
                                    ${analysis.instruction_match || '-'}
                                </div>
                            </div>

                            <div class="ai-item">
                                <div class="ai-item-title">
                                    Yang Sudah Baik
                                </div>

                                <div class="ai-item-text">
                                    ${analysis.strengths || '-'}
                                </div>
                            </div>

                            <div class="ai-item">
                                <div class="ai-item-title">
                                    Yang Masih Kurang
                                </div>

                                <div class="ai-item-text">
                                    ${analysis.weaknesses || '-'}
                                </div>
                            </div>

                            <div class="ai-item">
                                <div class="ai-item-title">
                                    Saran Perbaikan
                                </div>

                                <div class="ai-item-text">
                                    ${analysis.suggestions || '-'}
                                </div>
                            </div>

                            <div class="ai-item">
                                <div class="ai-item-title">
                                    Kelengkapan
                                </div>

                                <div class="ai-item-text">
                                    ${analysis.completeness || '-'}
                                </div>
                            </div>

                            <div class="ai-item">
                                <div class="ai-item-title">
                                    Kualitas
                                </div>

                                <div class="ai-item-text">
                                    ${analysis.quality || '-'}
                                </div>
                            </div>

                        </div>

                        <div class="ai-footer">
                            <span class="saved">
                                ✓ Analisis berhasil disimpan
                            </span>

                            <span style="color:#475569;font-size:11px;">
                                NEXA AI
                            </span>
                        </div>

                    </div>
                `;

                if (button) {
                    button.remove();
                }

            } catch (error) {

                resultBox.innerHTML = `
                    <div class="analysis-error">
                        <div class="error-title">
                            ⚠️ Analisis gagal
                        </div>

                        <div class="error-text">
                            ${error.message}
                        </div>
                    </div>
                `;

                if (button) {
                    button.disabled = false;
                    button.innerText = '🔄 Coba Lagi';
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | AUTO ANALYSIS
        |--------------------------------------------------------------------------
        | Versi yang belum mempunyai hasil AI akan otomatis dianalisis
        | ketika halaman Riwayat Versi dibuka.
        */

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const analyzeButtons =
                    document.querySelectorAll(
                        'button[onclick^="analyzeVersion"]'
                    );

                analyzeButtons.forEach(
                    function (button) {

                        const onclick =
                            button.getAttribute('onclick');

                        const match =
                            onclick.match(
                                /analyzeVersion\((\d+)/
                            );

                        if (!match) {
                            return;
                        }

                        const versionId =
                            match[1];

                        analyzeVersion(
                            versionId,
                            button
                        );
                    }
                );

            }
        );
    </script>

</x-app-layout>