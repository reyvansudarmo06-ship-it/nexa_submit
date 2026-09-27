<x-app-layout>

    <x-slot name="header">
        <div class="nexa-header">
            <div>
                <div class="nexa-eyebrow">
                    <span class="pulse-dot"></span>
                    STUDENT WORKSPACE
                </div>

                <h2 class="nexa-title">
                    Tugas Saya
                </h2>

                <p class="nexa-subtitle">
                    Kelola semua tugas dan pantau deadline kamu dalam satu tempat.
                </p>
            </div>

            <div class="nexa-header-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                </svg>
            </div>
        </div>
    </x-slot>

    <style>
        .assignments-page {
            min-height: calc(100vh - 80px);
            padding: 32px 0 60px;
            color: #e8ecff;
        }

        .assignments-container {
            max-width: 1380px;
            margin: 0 auto;
            padding: 0 28px;
        }

        .nexa-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .nexa-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.8px;
            color: #8c9cff;
            margin-bottom: 8px;
        }

        .pulse-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #7c5cff;
            box-shadow: 0 0 12px rgba(124, 92, 255, .9);
        }

        .nexa-title {
            margin: 0;
            font-size: 29px;
            line-height: 1.2;
            font-weight: 800;
            color: #f5f7ff;
            letter-spacing: -.7px;
        }

        .nexa-subtitle {
            margin: 7px 0 0;
            font-size: 14px;
            color: #8992ad;
        }

        .nexa-header-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            color: #9d8cff;
            background: linear-gradient(
                135deg,
                rgba(124, 92, 255, .16),
                rgba(55, 120, 255, .08)
            );
            border: 1px solid rgba(139, 120, 255, .2);
            box-shadow: 0 0 30px rgba(92, 76, 180, .12);
        }

        .assignment-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .assignment-card {
            position: relative;
            overflow: hidden;
            min-height: 315px;
            padding: 24px;
            border-radius: 24px;
            background:
                linear-gradient(
                    145deg,
                    rgba(25, 30, 52, .94),
                    rgba(13, 17, 32, .97)
                );
            border: 1px solid rgba(132, 145, 190, .13);
            box-shadow:
                0 15px 45px rgba(0, 0, 0, .25),
                inset 0 1px 0 rgba(255,255,255,.025);
            transition:
                transform .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .assignment-card::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            top: -100px;
            right: -70px;
            border-radius: 50%;
            background: rgba(108, 82, 255, .15);
            filter: blur(45px);
            pointer-events: none;
        }

        .assignment-card:hover {
            transform: translateY(-5px);
            border-color: rgba(124, 92, 255, .35);
            box-shadow:
                0 22px 55px rgba(0, 0, 0, .35),
                0 0 30px rgba(95, 74, 220, .08);
        }

        .assignment-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 22px;
        }

        .subject-badge {
            display: inline-flex;
            align-items: center;
            max-width: 65%;
            padding: 7px 11px;
            border-radius: 10px;
            background: rgba(124, 92, 255, .11);
            border: 1px solid rgba(124, 92, 255, .18);
            color: #a99cff;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 9px;
            background: rgba(67, 211, 145, .08);
            border: 1px solid rgba(67, 211, 145, .15);
            color: #65dfa6;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #4ade91;
            box-shadow: 0 0 8px rgba(74, 222, 145, .8);
        }

        .assignment-title {
            position: relative;
            margin: 0;
            color: #f4f6ff;
            font-size: 21px;
            line-height: 1.3;
            font-weight: 800;
            letter-spacing: -.3px;
        }

        .assignment-description {
            position: relative;
            margin: 12px 0 0;
            color: #858da7;
            font-size: 13px;
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .assignment-meta {
            position: relative;
            display: flex;
            align-items: center;
            gap: 11px;
            margin-top: 22px;
            padding: 13px 14px;
            border-radius: 14px;
            background: rgba(255,255,255,.025);
            border: 1px solid rgba(255,255,255,.055);
        }

        .deadline-icon {
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: #9f8dff;
            background: rgba(124, 92, 255, .1);
        }

        .meta-label {
            display: block;
            color: #68718b;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 3px;
        }

        .meta-value {
            color: #dce1f3;
            font-size: 12px;
            font-weight: 600;
        }

        .assignment-button {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            margin-top: 18px;
            padding: 12px 16px;
            border-radius: 13px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            background: linear-gradient(135deg, #7055ed, #4776e6);
            box-shadow: 0 8px 22px rgba(91, 77, 210, .22);
            transition: all .2s ease;
        }

        .assignment-button:hover {
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(91, 77, 210, .32);
        }

        .empty-state {
            max-width: 620px;
            margin: 45px auto;
            padding: 55px 30px;
            text-align: center;
            border-radius: 25px;
            background:
                linear-gradient(
                    145deg,
                    rgba(25, 30, 52, .94),
                    rgba(13, 17, 32, .97)
                );
            border: 1px solid rgba(132, 145, 190, .13);
            box-shadow: 0 20px 55px rgba(0,0,0,.25);
        }

        .empty-icon {
            width: 68px;
            height: 68px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            color: #9583ff;
            background: rgba(124, 92, 255, .1);
            border: 1px solid rgba(124, 92, 255, .18);
        }

        .empty-title {
            margin: 0;
            color: #f1f3ff;
            font-size: 21px;
            font-weight: 800;
        }

        .empty-text {
            margin: 8px 0 0;
            color: #7e879f;
            font-size: 13px;
        }

        @media (max-width: 1050px) {
            .assignment-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .assignments-container {
                padding: 0 16px;
            }

            .assignments-page {
                padding-top: 22px;
            }

            .nexa-header {
                align-items: flex-start;
            }

            .nexa-title {
                font-size: 24px;
            }

            .nexa-header-icon {
                width: 48px;
                height: 48px;
                border-radius: 15px;
            }

            .assignment-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .assignment-card {
                min-height: auto;
            }
        }
    </style>

    <div class="assignments-page">

        <div class="assignments-container">

            @if($assignments->count() > 0)

                <div class="assignment-grid">

                    @foreach($assignments as $assignment)

                        <div class="assignment-card">

                            <div class="assignment-top">

                                <span class="subject-badge">
                                    {{ $assignment->subject ?? 'Tugas' }}
                                </span>

                                <span class="status-badge">
                                    <span class="status-dot"></span>
                                    {{ $assignment->status }}
                                </span>

                            </div>

                            <h3 class="assignment-title">
                                {{ $assignment->title }}
                            </h3>

                            <p class="assignment-description">
                                {{ $assignment->description ?? 'Tidak ada deskripsi tugas.' }}
                            </p>

                            <div class="assignment-meta">

                                <div class="deadline-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor"
                                         stroke-width="1.8">
                                        <rect x="3" y="4" width="18" height="17" rx="3"/>
                                        <path d="M16 2v4M8 2v4M3 10h18"/>
                                        <path d="M8 14h.01M12 14h.01M16 14h.01"/>
                                    </svg>
                                </div>

                                <div>
                                    <span class="meta-label">
                                        Deadline
                                    </span>

                                    <span class="meta-value">
                                        {{ $assignment->deadline?->format('d M Y H:i') ?? 'Tidak ditentukan' }}
                                    </span>
                                </div>

                            </div>

                            <a
                                href="{{ route('student.assignments.show', $assignment) }}"
                                class="assignment-button"
                            >
                                Lihat Detail

                                <svg width="16" height="16" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor"
                                     stroke-width="2">
                                    <path d="M5 12h14"/>
                                    <path d="m13 6 6 6-6 6"/>
                                </svg>
                            </a>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        <svg width="30" height="30" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor"
                             stroke-width="1.7">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                        </svg>
                    </div>

                    <h3 class="empty-title">
                        Belum Ada Tugas
                    </h3>

                    <p class="empty-text">
                        Tugas dari guru akan muncul di sini.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>