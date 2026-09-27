<x-app-layout>

    <x-slot name="header">
        <div class="nexa-header">
            <div>
                <div class="nexa-kicker">NEXA SUBMIT / TEACHER</div>

                <h2 class="nexa-header-title">
                    Teacher Assignments
                </h2>

                <p class="nexa-header-subtitle">
                    Kelola seluruh tugas yang kamu buat dalam satu workspace.
                </p>
            </div>

            <div class="nexa-header-actions">
                <span class="nexa-system-status">
                    <span class="nexa-status-dot"></span>
                    SYSTEM ONLINE
                </span>

                <a
                    href="{{ route('teacher.assignments.create') }}"
                    class="nexa-create-btn"
                >
                    <span>＋</span>
                    Buat Tugas
                </a>
            </div>
        </div>
    </x-slot>


    <style>
        .nexa-page {
            position: relative;
            color: #e5e7eb;
        }

        .nexa-page::before {
            content: "";
            position: fixed;
            width: 420px;
            height: 420px;
            top: 90px;
            right: -180px;
            border-radius: 50%;
            background: rgba(99,102,241,.07);
            filter: blur(100px);
            pointer-events: none;
        }

        .nexa-page::after {
            content: "";
            position: fixed;
            width: 350px;
            height: 350px;
            bottom: -160px;
            left: 230px;
            border-radius: 50%;
            background: rgba(124,58,237,.05);
            filter: blur(100px);
            pointer-events: none;
        }

        .nexa-wrapper {
            position: relative;
            z-index: 1;
            max-width: 1380px;
            margin: auto;
        }

        /* HEADER */

        .nexa-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .nexa-kicker {
            margin-bottom: 6px;
            color: #818cf8;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .nexa-header-title {
            margin: 0;
            color: #f8fafc;
            font-size: 21px;
            font-weight: 850;
            letter-spacing: -.5px;
        }

        .nexa-header-subtitle {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 11px;
        }

        .nexa-header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nexa-system-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 12px;
            border-radius: 999px;
            color: #a5b4fc;
            background: rgba(99,102,241,.07);
            border: 1px solid rgba(99,102,241,.17);
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .8px;
            white-space: nowrap;
        }

        .nexa-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #34d399;
            box-shadow: 0 0 12px rgba(52,211,153,.9);
        }

        .nexa-create-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 14px;
            border-radius: 11px;
            color: #fff;
            background: linear-gradient(135deg,#6366f1,#7c3aed);
            border: 1px solid rgba(255,255,255,.08);
            box-shadow: 0 8px 25px rgba(99,102,241,.23);
            font-size: 10px;
            font-weight: 850;
            text-decoration: none;
            transition: .2s ease;
        }

        .nexa-create-btn:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 13px 32px rgba(99,102,241,.34);
        }

        /* MAIN */

        .nexa-content {
            margin-top: 2px;
        }

        /* SUCCESS */

        .nexa-success {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 15px;
            color: #a7f3d0;
            background:
                linear-gradient(
                    135deg,
                    rgba(16,185,129,.10),
                    rgba(15,23,42,.60)
                );
            border: 1px solid rgba(16,185,129,.16);
            box-shadow: 0 12px 30px rgba(0,0,0,.10);
            font-size: 10px;
            font-weight: 700;
        }

        .nexa-success-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 31px;
            height: 31px;
            flex-shrink: 0;
            border-radius: 9px;
            background: rgba(16,185,129,.12);
            border: 1px solid rgba(16,185,129,.15);
            font-size: 14px;
        }

        /* PAGE INTRO */

        .nexa-intro {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 16px;
        }

        .nexa-intro-title {
            color: #f8fafc;
            font-size: 15px;
            font-weight: 850;
        }

        .nexa-intro-text {
            margin-top: 4px;
            color: #475569;
            font-size: 10px;
        }

        .nexa-count {
            color: #818cf8;
            font-size: 10px;
            font-weight: 800;
        }

        /* GRID */

        .nexa-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 16px;
        }

        /* CARD */

        .nexa-assignment {
            position: relative;
            overflow: hidden;
            padding: 20px;
            border-radius: 20px;
            background:
                linear-gradient(
                    145deg,
                    rgba(30,41,59,.84),
                    rgba(15,23,42,.95)
                );
            border: 1px solid rgba(148,163,184,.085);
            box-shadow:
                0 18px 45px rgba(0,0,0,.12),
                inset 0 1px 0 rgba(255,255,255,.025);
            transition: .23s ease;
        }

        .nexa-assignment:hover {
            transform: translateY(-4px);
            border-color: rgba(129,140,248,.24);
            box-shadow:
                0 25px 55px rgba(0,0,0,.20),
                0 0 30px rgba(99,102,241,.05);
        }

        .nexa-assignment::before {
            content: "";
            position: absolute;
            width: 130px;
            height: 130px;
            top: -75px;
            right: -65px;
            border-radius: 50%;
            background: rgba(99,102,241,.06);
            pointer-events: none;
        }

        .nexa-card-top {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .nexa-subject {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 999px;
            color: #a5b4fc;
            background: rgba(99,102,241,.09);
            border: 1px solid rgba(99,102,241,.14);
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .nexa-card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            border-radius: 10px;
            color: #a5b4fc;
            background: rgba(99,102,241,.10);
            border: 1px solid rgba(99,102,241,.13);
            font-size: 14px;
        }

        .nexa-title {
            position: relative;
            z-index: 1;
            margin-top: 15px;
            color: #f8fafc;
            font-size: 17px;
            font-weight: 850;
            line-height: 1.35;
            letter-spacing: -.3px;
        }

        .nexa-description {
            position: relative;
            z-index: 1;
            display: -webkit-box;
            overflow: hidden;
            margin-top: 8px;
            min-height: 45px;
            color: #64748b;
            font-size: 10px;
            line-height: 1.65;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        /* META */

        .nexa-meta {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr;
            gap: 7px;
            margin-top: 17px;
        }

        .nexa-meta-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 10px;
            border-radius: 11px;
            background: rgba(2,6,23,.30);
            border: 1px solid rgba(148,163,184,.055);
        }

        .nexa-meta-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 27px;
            height: 27px;
            flex-shrink: 0;
            border-radius: 8px;
            background: rgba(255,255,255,.035);
            font-size: 12px;
        }

        .nexa-meta-label {
            color: #475569;
            font-size: 7px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .nexa-meta-value {
            margin-top: 2px;
            color: #cbd5e1;
            font-size: 9px;
            font-weight: 750;
        }

        /* ACTION */

        .nexa-action {
            position: relative;
            z-index: 1;
            display: flex;
            margin-top: 16px;
        }

        .nexa-submission-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            gap: 8px;
            padding: 11px 13px;
            border-radius: 11px;
            color: #fff;
            background: linear-gradient(135deg,#4f46e5,#6d28d9);
            border: 1px solid rgba(255,255,255,.07);
            box-shadow: 0 8px 22px rgba(79,70,229,.18);
            font-size: 9px;
            font-weight: 850;
            text-decoration: none;
            transition: .2s ease;
        }

        .nexa-submission-btn:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(79,70,229,.30);
        }

        .nexa-arrow {
            font-size: 13px;
            transition: .2s ease;
        }

        .nexa-submission-btn:hover .nexa-arrow {
            transform: translateX(3px);
        }

        /* EMPTY */

        .nexa-empty {
            padding: 70px 20px;
            border-radius: 22px;
            text-align: center;
            background:
                linear-gradient(
                    145deg,
                    rgba(30,41,59,.72),
                    rgba(15,23,42,.92)
                );
            border: 1px solid rgba(148,163,184,.08);
            box-shadow: 0 18px 45px rgba(0,0,0,.10);
        }

        .nexa-empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            margin: 0 auto;
            border-radius: 18px;
            background: rgba(99,102,241,.10);
            border: 1px solid rgba(99,102,241,.14);
            font-size: 27px;
        }

        .nexa-empty-title {
            margin-top: 17px;
            color: #f8fafc;
            font-size: 17px;
            font-weight: 850;
        }

        .nexa-empty-text {
            max-width: 430px;
            margin: 7px auto 0;
            color: #475569;
            font-size: 10px;
            line-height: 1.6;
        }

        .nexa-empty-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 20px;
            padding: 11px 17px;
            border-radius: 11px;
            color: #fff;
            background: linear-gradient(135deg,#6366f1,#7c3aed);
            font-size: 10px;
            font-weight: 850;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(99,102,241,.22);
            transition: .2s ease;
        }

        .nexa-empty-btn:hover {
            color: #fff;
            transform: translateY(-2px);
        }

        /* FOOTER */

        .nexa-footer {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 16px 2px 5px;
        }

        .nexa-footer span {
            color: #334155;
            font-size: 8px;
        }

        /* RESPONSIVE */

        @media (max-width: 1050px) {
            .nexa-grid {
                grid-template-columns: repeat(2, minmax(0,1fr));
            }
        }

        @media (max-width: 750px) {
            .nexa-header {
                align-items: flex-start;
            }

            .nexa-system-status {
                display: none;
            }

            .nexa-grid {
                grid-template-columns: 1fr;
            }

            .nexa-header-actions {
                flex-shrink: 0;
            }

            .nexa-create-btn {
                padding: 9px 11px;
            }
        }

        @media (max-width: 520px) {
            .nexa-header {
                flex-direction: column;
                align-items: stretch;
            }

            .nexa-create-btn {
                width: 100%;
            }

            .nexa-intro {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }

            .nexa-footer {
                flex-direction: column;
            }
        }
    </style>


    <div class="nexa-page">

        <div class="nexa-wrapper">

            <div class="nexa-content">

                {{-- SUCCESS --}}

                @if(session('success'))

                    <div class="nexa-success">

                        <div class="nexa-success-icon">
                            ✓
                        </div>

                        <div>
                            {{ session('success') }}
                        </div>

                    </div>

                @endif


                {{-- INTRO --}}

                <div class="nexa-intro">

                    <div>
                        <div class="nexa-intro-title">
                            Tugas yang Kamu Buat
                        </div>

                        <div class="nexa-intro-text">
                            Pantau tugas dan pengumpulan siswa dari sini.
                        </div>
                    </div>

                    <div class="nexa-count">
                        {{ $assignments->count() }} TUGAS
                    </div>

                </div>


                {{-- ASSIGNMENTS --}}

                @if($assignments->count())

                    <div class="nexa-grid">

                        @foreach($assignments as $assignment)

                            <article class="nexa-assignment">

                                <div class="nexa-card-top">

                                    <div class="nexa-subject">
                                        {{ $assignment->subject ?? 'Tugas' }}
                                    </div>

                                    <div class="nexa-card-icon">
                                        📚
                                    </div>

                                </div>


                                <div class="nexa-title">
                                    {{ $assignment->title }}
                                </div>


                                <div class="nexa-description">
                                    {{ $assignment->description ?? 'Tidak ada deskripsi.' }}
                                </div>


                                <div class="nexa-meta">

                                    <div class="nexa-meta-item">

                                        <div class="nexa-meta-icon">
                                            👥
                                        </div>

                                        <div>
                                            <div class="nexa-meta-label">
                                                Kelas
                                            </div>

                                            <div class="nexa-meta-value">
                                                {{ $assignment->class_name }}
                                            </div>
                                        </div>

                                    </div>


                                    <div class="nexa-meta-item">

                                        <div class="nexa-meta-icon">
                                            ⏰
                                        </div>

                                        <div>
                                            <div class="nexa-meta-label">
                                                Deadline
                                            </div>

                                            <div class="nexa-meta-value">
                                                {{ $assignment->deadline?->format('d M Y H:i') ?? 'Tidak ditentukan' }}
                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <div class="nexa-action">

                                    <a
                                        href="{{ route('teacher.submissions.index', $assignment) }}"
                                        class="nexa-submission-btn"
                                    >
                                        📥
                                        Lihat Pengumpulan

                                        <span class="nexa-arrow">
                                            →
                                        </span>
                                    </a>

                                </div>

                            </article>

                        @endforeach

                    </div>

                @else

                    <div class="nexa-empty">

                        <div class="nexa-empty-icon">
                            📚
                        </div>

                        <div class="nexa-empty-title">
                            Belum Ada Tugas
                        </div>

                        <div class="nexa-empty-text">
                            Buat tugas pertama kamu untuk mulai menggunakan
                            NEXA SUBMIT dan menerima pengumpulan dari siswa.
                        </div>

                        <a
                            href="{{ route('teacher.assignments.create') }}"
                            class="nexa-empty-btn"
                        >
                            ＋ Buat Tugas
                        </a>

                    </div>

                @endif


                <div class="nexa-footer">

                    <span>
                        NEXA SUBMIT • Teacher Workspace
                    </span>

                    <span>
                        Smart Assignment Management
                    </span>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>