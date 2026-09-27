<x-app-layout>

    <x-slot name="header">
        <div class="submit-header">
            <div>
                <div class="submit-eyebrow">
                    <span class="submit-dot"></span>
                    NEXA SUBMIT
                </div>

                <h2 class="submit-title">
                    Kumpulkan Tugas
                </h2>

                <p class="submit-subtitle">
                    Upload tugas kamu dan kirim ke guru dengan aman.
                </p>
            </div>

            <div class="submit-header-icon">
                📤
            </div>
        </div>
    </x-slot>


    <style>
        .submit-page {
            min-height: calc(100vh - 80px);
            padding: 32px 0 70px;
        }

        .submit-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 25px;
        }

        .submit-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .submit-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #9585ff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.8px;
            margin-bottom: 7px;
        }

        .submit-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #7c5cff;
            box-shadow: 0 0 12px rgba(124,92,255,.9);
        }

        .submit-title {
            margin: 0;
            color: #f4f6ff;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -.6px;
        }

        .submit-subtitle {
            margin: 6px 0 0;
            color: #858ea8;
            font-size: 13px;
        }

        .submit-header-icon {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            background: rgba(124,92,255,.1);
            border: 1px solid rgba(124,92,255,.18);
            font-size: 22px;
        }

        .submit-card {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            padding: 28px;
            background:
                linear-gradient(
                    145deg,
                    rgba(25,30,52,.96),
                    rgba(13,17,32,.98)
                );
            border: 1px solid rgba(132,145,190,.13);
            box-shadow:
                0 18px 55px rgba(0,0,0,.28),
                inset 0 1px 0 rgba(255,255,255,.025);
        }

        .submit-card::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            top: -180px;
            right: -80px;
            border-radius: 50%;
            background: rgba(108,82,255,.13);
            filter: blur(55px);
            pointer-events: none;
        }

        .assignment-info {
            position: relative;
            padding-bottom: 23px;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .subject-badge {
            display: inline-flex;
            padding: 7px 11px;
            border-radius: 10px;
            color: #a496ff;
            background: rgba(124,92,255,.1);
            border: 1px solid rgba(124,92,255,.17);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .assignment-title {
            margin: 12px 0 0;
            color: #f3f5ff;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .assignment-class {
            margin-top: 6px;
            color: #777f97;
            font-size: 12px;
        }

        .deadline-box {
            position: relative;
            display: flex;
            align-items: center;
            gap: 13px;
            margin-top: 21px;
            padding: 15px;
            border-radius: 15px;
            background: rgba(255,255,255,.025);
            border: 1px solid rgba(255,255,255,.055);
        }

        .deadline-icon {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: rgba(255,158,74,.09);
            color: #ffb45e;
        }

        .deadline-label {
            color: #69738b;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .deadline-value {
            margin-top: 4px;
            color: #e4e8f7;
            font-size: 13px;
            font-weight: 700;
        }

        .form-section {
            position: relative;
            margin-top: 27px;
        }

        .field-label {
            display: block;
            margin-bottom: 9px;
            color: #e5e8f6;
            font-size: 12px;
            font-weight: 800;
        }

        .field-required {
            color: #a394ff;
        }

        .upload-area {
            position: relative;
            display: block;
            padding: 30px 20px;
            text-align: center;
            border-radius: 18px;
            background: rgba(255,255,255,.025);
            border: 1px dashed rgba(139,125,255,.3);
            cursor: pointer;
            transition: .25s ease;
        }

        .upload-area:hover {
            background: rgba(124,92,255,.06);
            border-color: rgba(139,125,255,.55);
        }

        .upload-icon {
            width: 55px;
            height: 55px;
            margin: 0 auto 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            color: #a495ff;
            background: rgba(124,92,255,.1);
            border: 1px solid rgba(124,92,255,.16);
            font-size: 23px;
        }

        .upload-title {
            color: #e9ecf9;
            font-size: 14px;
            font-weight: 800;
        }

        .upload-description {
            margin-top: 5px;
            color: #727c95;
            font-size: 11px;
        }

        .file-input {
            position: absolute;
            width: 1px;
            height: 1px;
            opacity: 0;
            pointer-events: none;
        }

        .file-name {
            margin-top: 13px;
            color: #a89aff;
            font-size: 12px;
            font-weight: 700;
            min-height: 18px;
        }

        .textarea-wrap {
            position: relative;
        }

        .note-input {
            width: 100%;
            min-height: 135px;
            resize: vertical;
            padding: 15px;
            color: #e7eaf7;
            background: rgba(255,255,255,.025);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 15px;
            outline: none;
            font-size: 13px;
            line-height: 1.6;
            transition: .2s ease;
        }

        .note-input::placeholder {
            color: #5f6880;
        }

        .note-input:focus {
            border-color: rgba(124,92,255,.5);
            box-shadow: 0 0 0 3px rgba(124,92,255,.07);
            background: rgba(124,92,255,.025);
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 27px;
            padding-top: 22px;
            border-top: 1px solid rgba(255,255,255,.07);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 12px 17px;
            border-radius: 12px;
            color: #a1a9bf;
            background: rgba(255,255,255,.035);
            border: 1px solid rgba(255,255,255,.08);
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            transition: .2s ease;
        }

        .back-button:hover {
            color: #f0f2ff;
            background: rgba(255,255,255,.06);
        }

        .submit-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border: 0;
            border-radius: 12px;
            color: white;
            background: linear-gradient(135deg,#7055ed,#4776e6);
            box-shadow: 0 9px 25px rgba(91,77,210,.25);
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .submit-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 13px 30px rgba(91,77,210,.35);
        }

        .submit-button:disabled {
            opacity: .6;
            cursor: wait;
            transform: none;
        }

        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-top: 17px;
            color: #626c84;
            font-size: 10px;
        }

        @media (max-width: 650px) {
            .submit-container {
                padding: 0 16px;
            }

            .submit-card {
                padding: 20px;
            }

            .submit-title {
                font-size: 23px;
            }

            .submit-header-icon {
                width: 47px;
                height: 47px;
            }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .back-button,
            .submit-button {
                width: 100%;
            }
        }
    </style>


    <div class="submit-page">

        <div class="submit-container">

            <div class="submit-card">

                {{-- INFO TUGAS --}}
                <div class="assignment-info">

                    <span class="subject-badge">
                        {{ $assignment->subject }}
                    </span>

                    <h1 class="assignment-title">
                        {{ $assignment->title }}
                    </h1>

                    <p class="assignment-class">
                        Kelas {{ $assignment->class_name }}
                    </p>


                    <div class="deadline-box">

                        <div class="deadline-icon">
                            <svg width="19" height="19" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="1.8">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                        </div>

                        <div>

                            <div class="deadline-label">
                                Deadline
                            </div>

                            <div class="deadline-value">
                                {{ $assignment->deadline?->format('d M Y H:i') ?? 'Tidak ditentukan' }}
                            </div>

                        </div>

                    </div>

                </div>


                {{-- FORM --}}
                <form
                    method="POST"
                    action="{{ route('student.submissions.store', $assignment) }}"
                    enctype="multipart/form-data"
                    class="form-section"
                    id="submission-form"
                >

                    @csrf


                    {{-- FILE --}}
                    <div>

                        <label class="field-label">
                            File Tugas
                            <span class="field-required">*</span>
                        </label>

                        <label class="upload-area" for="task-file">

                            <div class="upload-icon">
                                <svg width="25" height="25" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor"
                                     stroke-width="1.7">
                                    <path d="M12 16V4"/>
                                    <path d="m7 9 5-5 5 5"/>
                                    <path d="M5 20h14"/>
                                </svg>
                            </div>

                            <div class="upload-title">
                                Pilih file tugas
                            </div>

                            <div class="upload-description">
                                Klik area ini untuk memilih file dari perangkat kamu
                            </div>

                            <input
                                id="task-file"
                                type="file"
                                name="file"
                                required
                                class="file-input"
                            >

                            <div
                                id="file-name"
                                class="file-name"
                            >
                                Belum ada file dipilih
                            </div>

                        </label>

                    </div>


                    {{-- CATATAN --}}
                    <div class="form-section">

                        <label
                            for="note"
                            class="field-label"
                        >
                            Catatan
                            <span style="color:#68728b;font-weight:500;">
                                (opsional)
                            </span>
                        </label>

                        <div class="textarea-wrap">

                            <textarea
                                id="note"
                                name="note"
                                rows="5"
                                placeholder="Tambahkan catatan untuk guru jika diperlukan..."
                                class="note-input"
                            ></textarea>

                        </div>

                    </div>


                    {{-- ACTION --}}
                    <div class="form-actions">

                        <a
                            href="{{ route('student.assignments.show', $assignment) }}"
                            class="back-button"
                        >
                            ← Kembali
                        </a>

                        <button
                            type="submit"
                            class="submit-button"
                            id="submit-button"
                        >
                            <span id="submit-text">
                                📤 Kirim Tugas
                            </span>

                            <span
                                id="submit-loading"
                                style="display:none;"
                            >
                                ⏳ Mengirim...
                            </span>
                        </button>

                    </div>

                </form>


                <div class="security-note">
                    🔒 File akan dikirim secara aman ke sistem NEXA SUBMIT
                </div>

            </div>

        </div>

    </div>


    <script>

        const fileInput =
            document.getElementById('task-file');

        const fileName =
            document.getElementById('file-name');

        const form =
            document.getElementById('submission-form');

        const submitButton =
            document.getElementById('submit-button');

        const submitText =
            document.getElementById('submit-text');

        const submitLoading =
            document.getElementById('submit-loading');


        if (fileInput) {

            fileInput.addEventListener('change', function () {

                if (this.files && this.files.length > 0) {

                    fileName.textContent =
                        '✓ ' + this.files[0].name;

                    fileName.style.color =
                        '#67dda5';

                } else {

                    fileName.textContent =
                        'Belum ada file dipilih';

                    fileName.style.color =
                        '#a89aff';

                }

            });

        }


        if (form) {

            form.addEventListener('submit', function () {

                if (!submitButton) {
                    return;
                }

                submitButton.disabled = true;

                if (submitText) {
                    submitText.style.display = 'none';
                }

                if (submitLoading) {
                    submitLoading.style.display = 'inline';
                }

            });

        }

    </script>

</x-app-layout>