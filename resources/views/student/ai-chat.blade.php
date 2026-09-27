<x-app-layout>

    <div class="nexa-chat-page">

        <div class="nexa-chat-container">

            {{-- =========================================================
                 HEADER
            ========================================================== --}}

            <div class="nexa-chat-header">

                <div class="nexa-ai-brand">

                    <div class="nexa-ai-logo">
                        🤖
                    </div>

                    <div>
                        <h1>NEXA AI</h1>
                        <p>Asisten pribadi untuk tugas kamu</p>
                    </div>

                </div>

                <a
                    href="{{ route('student.assignments.show', $submission->assignment) }}"
                    class="nexa-back-btn"
                >
                    ← Kembali
                </a>

            </div>


            {{-- =========================================================
                 TASK INFO
            ========================================================== --}}

            <div class="nexa-task-card">

                <div>

                    <div class="nexa-label">
                        SEDANG MEMBAHAS TUGAS
                    </div>

                    <h2>
                        {{ $submission->assignment->title }}
                    </h2>

                    <div class="nexa-task-meta">

                        <span>
                            {{ $submission->assignment->subject }}
                        </span>

                        <span>
                            {{ $submission->assignment->class_name }}
                        </span>

                        @if($submission->aiAnalysis)

                            <span class="score">
                                AI Score

                                <strong>
                                    {{ $submission->aiAnalysis->score ?? '-' }}/100
                                </strong>
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 CHAT CARD
            ========================================================== --}}

            <div class="nexa-chat-card">

                {{-- =====================================================
                     CHAT AREA
                ====================================================== --}}

                <div
                    id="chatMessages"
                    class="nexa-messages"
                >

                    {{-- =================================================
                         JIKA SUDAH ADA RIWAYAT CHAT
                    ================================================== --}}

                    @if($submission->aiChatMessages->count() > 0)

                        @foreach($submission->aiChatMessages as $chat)

                            @if($chat->role === 'user')

                                {{-- ==============================
                                     PESAN SISWA
                                =============================== --}}

                                <div class="user-message">

                                    <div class="user-bubble">
                                        {{ $chat->message }}
                                    </div>

                                </div>

                            @elseif($chat->role === 'assistant')

                                {{-- ==============================
                                     PESAN NEXA AI
                                =============================== --}}

                                <div class="ai-message">

                                    <div class="ai-avatar">
                                        🤖
                                    </div>

                                    <div class="ai-content">

                                        <div class="message-name">
                                            NEXA AI
                                        </div>

                                        <div class="ai-bubble">
                                            {!! nl2br(e($chat->message)) !!}
                                        </div>

                                    </div>

                                </div>

                            @endif

                        @endforeach


                    {{-- =================================================
                         JIKA BELUM ADA RIWAYAT CHAT
                    ================================================== --}}

                    @else

                        <div class="ai-message">

                            <div class="ai-avatar">
                                🤖
                            </div>

                            <div class="ai-content">

                                <div class="message-name">
                                    NEXA AI
                                </div>

                                <div class="ai-bubble">

                                    Halo! 👋 Gue NEXA AI.

                                    <br><br>

                                    Gue bisa bantu kamu memahami:

                                    <br>

                                    • hasil analisis tugas

                                    <br>

                                    • nilai AI

                                    <br>

                                    • feedback guru

                                    <br>

                                    • bagian yang perlu diperbaiki

                                    <br>

                                    • langkah revisi tugas

                                    <br><br>

                                    Pilih bantuan cepat di bawah atau langsung tanyakan apa yang mau kamu bahas.

                                </div>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- =====================================================
                     QUICK QUESTIONS
                ====================================================== --}}

                <div class="nexa-quick-area">

                    <div class="quick-title">
                        ✨ Bantuan cepat
                    </div>

                    <div class="quick-buttons">

                        {{-- ANALISIS NILAI --}}

                        <button
                            type="button"
                            class="quick-question"
                            data-message="Kenapa nilai AI saya seperti itu? Jelaskan berdasarkan hasil analisis tugas saya."
                        >

                            <span class="quick-icon">
                                📊
                            </span>

                            <span>
                                Analisis Nilai
                            </span>

                        </button>


                        {{-- PERBAIKAN --}}

                        <button
                            type="button"
                            class="quick-question"
                            data-message="Apa saja yang harus saya perbaiki dari tugas saya? Jelaskan berdasarkan kelemahan dan saran dari analisis AI."
                        >

                            <span class="quick-icon">
                                🔧
                            </span>

                            <span>
                                Perbaikan
                            </span>

                        </button>


                        {{-- CHECKLIST REVISI --}}

                        <button
                            type="button"
                            class="quick-question"
                            data-message="Buatkan checklist revisi tugas saya yang jelas dan berurutan berdasarkan hasil analisis AI."
                        >

                            <span class="quick-icon">
                                📋
                            </span>

                            <span>
                                Checklist Revisi
                            </span>

                        </button>


                        {{-- JELASKAN TUGAS --}}

                        <button
                            type="button"
                            class="quick-question"
                            data-message="Jelaskan tugas saya dan apa yang sebenarnya diminta oleh instruksi tugas tersebut."
                        >

                            <span class="quick-icon">
                                🧠
                            </span>

                            <span>
                                Jelaskan Tugas
                            </span>

                        </button>

                    </div>

                </div>


                {{-- =====================================================
                     INPUT
                ====================================================== --}}

                <div class="nexa-input-area">

                    <form id="chatForm">

                        @csrf

                        <div class="nexa-input-wrapper">

                            <input
                                type="text"
                                id="messageInput"
                                placeholder="Tanyakan sesuatu tentang tugas kamu..."
                                maxlength="2000"
                                autocomplete="off"
                            >

                            <button
                                type="submit"
                                id="sendButton"
                            >
                                <span id="sendButtonText">
                                    Kirim
                                </span>

                                <span
                                    id="sendButtonLoading"
                                    style="display:none;"
                                >
                                    Mengirim...
                                </span>
                            </button>

                        </div>

                    </form>

                    <div class="input-info">

                        NEXA AI menggunakan data tugas, analisis AI,
                        feedback guru, dan riwayat percakapan sebagai konteks jawaban.

                    </div>

                </div>

            </div>

        </div>

    </div>


    <style>

        /* =========================================================
           PAGE
        ========================================================= */

        .nexa-chat-page {
            min-height: calc(100vh - 65px);
            padding: 35px 40px 50px;
            background: #080d1c;
            color: #f8fafc;
        }

        .nexa-chat-container {
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .nexa-chat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .nexa-ai-brand {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nexa-ai-logo {
            width: 58px;
            height: 58px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 16px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #4f46e5
                );

            font-size: 27px;

            box-shadow:
                0 10px 30px rgba(37,99,235,.25);
        }

        .nexa-ai-brand h1 {
            margin: 0;

            font-size: 27px;
            font-weight: 800;

            color: white;
        }

        .nexa-ai-brand p {
            margin: 4px 0 0;

            color: #8994ad;
            font-size: 14px;
        }

        .nexa-back-btn {
            text-decoration: none;

            padding: 10px 17px;

            border-radius: 11px;

            color: #cbd5e1;

            background: #111827;

            border: 1px solid #263149;

            transition: .2s;
        }

        .nexa-back-btn:hover {
            color: white;
            background: #182238;
        }


        /* =========================================================
           TASK CARD
        ========================================================= */

        .nexa-task-card {

            background:
                linear-gradient(
                    135deg,
                    #11182a,
                    #0e1525
                );

            border: 1px solid #202b42;

            border-radius: 18px;

            padding: 21px 24px;

            margin-bottom: 18px;

            box-shadow:
                0 15px 35px rgba(0,0,0,.15);
        }

        .nexa-label {

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 1.5px;

            color: #71809e;

            margin-bottom: 7px;
        }

        .nexa-task-card h2 {

            margin: 0 0 12px;

            font-size: 21px;

            color: white;

            font-weight: 750;
        }

        .nexa-task-meta {

            display: flex;

            flex-wrap: wrap;

            gap: 8px;
        }

        .nexa-task-meta span {

            padding: 6px 10px;

            border-radius: 8px;

            background: #192238;

            border: 1px solid #293653;

            color: #aeb9cf;

            font-size: 12px;
        }

        .nexa-task-meta .score {
            color: #8fb4ff;
        }

        .nexa-task-meta .score strong {

            color: #60a5fa;

            margin-left: 4px;
        }


        /* =========================================================
           CHAT CARD
        ========================================================= */

        .nexa-chat-card {

            background: #0d1424;

            border: 1px solid #202b42;

            border-radius: 20px;

            overflow: hidden;

            box-shadow:
                0 20px 50px rgba(0,0,0,.25);
        }


        /* =========================================================
           MESSAGES
        ========================================================= */

        .nexa-messages {

            height: 500px;

            overflow-y: auto;

            padding: 28px;

            background:

                radial-gradient(
                    circle at top right,
                    rgba(37,99,235,.08),
                    transparent 35%
                ),

                #0a1020;
        }

        .nexa-messages::-webkit-scrollbar {
            width: 7px;
        }

        .nexa-messages::-webkit-scrollbar-track {
            background: #0b1120;
        }

        .nexa-messages::-webkit-scrollbar-thumb {

            background: #273451;

            border-radius: 10px;
        }


        /* =========================================================
           AI MESSAGE
        ========================================================= */

        .ai-message {

            display: flex;

            gap: 13px;

            margin-bottom: 25px;

            max-width: 850px;
        }

        .ai-avatar {

            width: 40px;
            height: 40px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #4f46e5
                );

            font-size: 19px;
        }

        .ai-content {
            max-width: 75%;
        }

        .message-name {

            font-size: 12px;

            font-weight: 700;

            color: #71809e;

            margin: 0 0 6px 3px;

            letter-spacing: .3px;
        }

        .ai-bubble {

            padding: 15px 18px;

            border-radius: 6px 17px 17px 17px;

            background: #151e32;

            border: 1px solid #26334f;

            color: #d8e0ef;

            line-height: 1.65;

            font-size: 14px;

            box-shadow:
                0 5px 18px rgba(0,0,0,.12);
        }


        /* =========================================================
           USER MESSAGE
        ========================================================= */

        .user-message {

            display: flex;

            justify-content: flex-end;

            margin-bottom: 22px;
        }

        .user-bubble {

            max-width: 75%;

            padding: 13px 18px;

            border-radius: 17px 17px 5px 17px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #315fe8
                );

            color: white;

            font-size: 14px;

            line-height: 1.6;

            box-shadow:
                0 7px 20px rgba(37,99,235,.18);
        }


        /* =========================================================
           TYPING
        ========================================================= */

        .typing-bubble {

            color: #8190aa;

            font-style: italic;
        }


        /* =========================================================
           QUICK QUESTIONS
        ========================================================= */

        .nexa-quick-area {

            padding: 18px 22px;

            border-top: 1px solid #202b42;

            background: #0d1424;
        }

        .quick-title {

            color: #687791;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 1px;

            text-transform: uppercase;

            margin-bottom: 10px;
        }

        .quick-buttons {

            display: flex;

            flex-wrap: wrap;

            gap: 8px;
        }

        .quick-question {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            border: 1px solid #293653;

            background: #111a2d;

            color: #aebbd2;

            border-radius: 10px;

            padding: 10px 14px;

            font-size: 12px;

            cursor: pointer;

            transition: all .2s ease;

            position: relative;

            overflow: hidden;
        }

        .quick-question:hover {

            background: #192640;

            border-color: #3b82f6;

            color: #dbeafe;

            transform: translateY(-1px);

            box-shadow:
                0 7px 18px rgba(37,99,235,.12);
        }

        .quick-question:active {

            transform: scale(.97);
        }

        .quick-question.loading {

            opacity: .45;

            pointer-events: none;

            transform: none;
        }

        .quick-icon {

            font-size: 15px;

            line-height: 1;
        }


        /* =========================================================
           INPUT
        ========================================================= */

        .nexa-input-area {

            padding: 18px 22px 20px;

            border-top: 1px solid #202b42;

            background: #0b1221;
        }

        .nexa-input-wrapper {

            display: flex;

            gap: 10px;
        }

        .nexa-input-wrapper input {

            flex: 1;

            min-width: 0;

            height: 48px;

            padding: 0 16px;

            border-radius: 12px;

            outline: none;

            background: #121b2d;

            border: 1px solid #293653;

            color: white;

            font-size: 14px;

            transition: .2s;
        }

        .nexa-input-wrapper input::placeholder {
            color: #64728b;
        }

        .nexa-input-wrapper input:focus {

            border-color: #3b82f6;

            box-shadow:
                0 0 0 3px rgba(59,130,246,.12);
        }

        .nexa-input-wrapper button {

            height: 48px;

            padding: 0 22px;

            border: none;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #4f46e5
                );

            color: white;

            font-weight: 700;

            cursor: pointer;

            transition: .2s;
        }

        .nexa-input-wrapper button:hover {

            transform: translateY(-1px);

            box-shadow:
                0 8px 20px rgba(37,99,235,.25);
        }

        .nexa-input-wrapper button:disabled {

            opacity: .5;

            cursor: not-allowed;

            transform: none;
        }

        .input-info {

            margin-top: 9px;

            color: #56647d;

            font-size: 11px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 768px) {

            .nexa-chat-page {

                padding: 20px 14px 35px;
            }

            .nexa-chat-header {

                align-items: flex-start;
            }

            .nexa-ai-logo {

                width: 48px;
                height: 48px;
            }

            .nexa-ai-brand h1 {

                font-size: 22px;
            }

            .nexa-back-btn {

                font-size: 12px;

                padding: 8px 11px;
            }

            .nexa-messages {

                height: 470px;

                padding: 18px;
            }

            .ai-content,
            .user-bubble {

                max-width: 88%;
            }

            .quick-buttons {

                flex-direction: column;
            }

            .quick-question {

                width: 100%;

                justify-content: flex-start;

                text-align: left;
            }

            .nexa-input-wrapper {

                gap: 7px;
            }

            .nexa-input-wrapper button {

                padding: 0 16px;
            }

        }

    </style>


    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const form =
                    document.getElementById(
                        'chatForm'
                    );

                const input =
                    document.getElementById(
                        'messageInput'
                    );

                const button =
                    document.getElementById(
                        'sendButton'
                    );

                const sendButtonText =
                    document.getElementById(
                        'sendButtonText'
                    );

                const sendButtonLoading =
                    document.getElementById(
                        'sendButtonLoading'
                    );

                const chatMessages =
                    document.getElementById(
                        'chatMessages'
                    );

                const chatUrl =
                    "{{ route('student.ai-chat.ask', $submission) }}";


                /* =====================================================
                   SCROLL CHAT KE PALING BAWAH
                ====================================================== */

                function scrollChat() {

                    chatMessages.scrollTop =
                        chatMessages.scrollHeight;

                }


                /* =====================================================
                   ESCAPE HTML
                ====================================================== */

                function escapeHtml(text) {

                    const div =
                        document.createElement(
                            'div'
                        );

                    div.textContent =
                        text;

                    return div.innerHTML;

                }


                /* =====================================================
                   FORMAT JAWABAN AI
                ====================================================== */

                function formatAiMessage(message) {

                    return escapeHtml(message)

                        /*
                        **teks**
                        menjadi bold
                        */

                        .replace(
                            /\*\*(.*?)\*\*/g,
                            '<strong>$1</strong>'
                        )

                        /*
                        Baris baru
                        */

                        .replace(
                            /\n/g,
                            '<br>'
                        );

                }


                /* =====================================================
                   TAMBAH PESAN USER
                ====================================================== */

                function addUserMessage(message) {

                    const wrapper =
                        document.createElement(
                            'div'
                        );

                    wrapper.className =
                        'user-message';

                    wrapper.innerHTML = `

                        <div class="user-bubble">
                            ${escapeHtml(message)}
                        </div>

                    `;

                    chatMessages.appendChild(
                        wrapper
                    );

                    scrollChat();

                }


                /* =====================================================
                   TAMBAH PESAN AI
                ====================================================== */

                function addAiMessage(message) {

                    const wrapper =
                        document.createElement(
                            'div'
                        );

                    wrapper.className =
                        'ai-message';

                    wrapper.innerHTML = `

                        <div class="ai-avatar">
                            🤖
                        </div>

                        <div class="ai-content">

                            <div class="message-name">
                                NEXA AI
                            </div>

                            <div class="ai-bubble">
                                ${formatAiMessage(message)}
                            </div>

                        </div>

                    `;

                    chatMessages.appendChild(
                        wrapper
                    );

                    scrollChat();

                }


                /* =====================================================
                   TYPING INDICATOR
                ====================================================== */

                function addTyping() {

                    const wrapper =
                        document.createElement(
                            'div'
                        );

                    wrapper.id =
                        'typingIndicator';

                    wrapper.className =
                        'ai-message';

                    wrapper.innerHTML = `

                        <div class="ai-avatar">
                            🤖
                        </div>

                        <div class="ai-content">

                            <div class="message-name">
                                NEXA AI
                            </div>

                            <div class="ai-bubble typing-bubble">
                                NEXA AI sedang berpikir...
                            </div>

                        </div>

                    `;

                    chatMessages.appendChild(
                        wrapper
                    );

                    scrollChat();

                }


                /* =====================================================
                   HAPUS TYPING
                ====================================================== */

                function removeTyping() {

                    const typing =
                        document.getElementById(
                            'typingIndicator'
                        );

                    if (typing) {

                        typing.remove();

                    }

                }


                /* =====================================================
                   SET LOADING STATE
                ====================================================== */

                function setLoading(
                    loading
                ) {

                    button.disabled =
                        loading;

                    input.disabled =
                        loading;


                    document
                        .querySelectorAll(
                            '.quick-question'
                        )
                        .forEach(
                            function (
                                quickButton
                            ) {

                                if (loading) {

                                    quickButton
                                        .classList
                                        .add(
                                            'loading'
                                        );

                                } else {

                                    quickButton
                                        .classList
                                        .remove(
                                            'loading'
                                        );

                                }

                            }
                        );


                    if (loading) {

                        sendButtonText.style.display =
                            'none';

                        sendButtonLoading.style.display =
                            'inline';

                    } else {

                        sendButtonText.style.display =
                            'inline';

                        sendButtonLoading.style.display =
                            'none';

                    }

                }


                /* =====================================================
                   KIRIM PESAN
                ====================================================== */

                async function sendMessage(
                    message
                ) {

                    if (
                        !message ||
                        !message.trim()
                    ) {

                        return;

                    }


                    message =
                        message.trim();


                    /*
                    -----------------------------------------------
                    Tampilkan pesan user
                    -----------------------------------------------
                    */

                    addUserMessage(
                        message
                    );


                    /*
                    -----------------------------------------------
                    Kosongkan input
                    -----------------------------------------------
                    */

                    input.value =
                        '';


                    /*
                    -----------------------------------------------
                    Disable semua input
                    -----------------------------------------------
                    */

                    setLoading(
                        true
                    );


                    /*
                    -----------------------------------------------
                    Tampilkan typing
                    -----------------------------------------------
                    */

                    addTyping();


                    try {

                        const response =
                            await fetch(
                                chatUrl,
                                {
                                    method:
                                        'POST',

                                    headers: {

                                        'Content-Type':
                                            'application/json',

                                        'Accept':
                                            'application/json',

                                        'X-CSRF-TOKEN':
                                            document
                                                .querySelector(
                                                    'input[name="_token"]'
                                                )
                                                .value

                                    },

                                    body:
                                        JSON.stringify(
                                            {
                                                message:
                                                    message
                                            }
                                        )

                                }
                            );


                        /*
                        -------------------------------------------
                        Ambil response
                        -------------------------------------------
                        */

                        const data =
                            await response.json();


                        /*
                        -------------------------------------------
                        Hapus typing
                        -------------------------------------------
                        */

                        removeTyping();


                        /*
                        -------------------------------------------
                        Berhasil
                        -------------------------------------------
                        */

                        if (
                            response.ok &&
                            data.success
                        ) {

                            addAiMessage(
                                data.answer
                            );

                        } else {

                            addAiMessage(
                                data.message ||
                                'NEXA AI tidak dapat menjawab saat ini.'
                            );

                        }


                    } catch (
                        error
                    ) {

                        /*
                        -------------------------------------------
                        Error koneksi
                        -------------------------------------------
                        */

                        removeTyping();


                        addAiMessage(
                            'Terjadi masalah saat menghubungkan ke NEXA AI. Coba lagi.'
                        );


                        console.error(
                            'NEXA AI Error:',
                            error
                        );

                    } finally {

                        /*
                        -------------------------------------------
                        Aktifkan kembali input
                        -------------------------------------------
                        */

                        setLoading(
                            false
                        );

                        input.focus();

                    }

                }


                /* =====================================================
                   FORM SUBMIT
                ====================================================== */

                form.addEventListener(
                    'submit',
                    function (
                        event
                    ) {

                        event.preventDefault();


                        sendMessage(
                            input.value
                        );

                    }
                );


                /* =====================================================
                   QUICK QUESTIONS
                ====================================================== */

                document
                    .querySelectorAll(
                        '.quick-question'
                    )
                    .forEach(
                        function (
                            quickButton
                        ) {

                            quickButton.addEventListener(
                                'click',
                                function () {

                                    const message =
                                        this.dataset.message;

                                    sendMessage(
                                        message
                                    );

                                }
                            );

                        }
                    );


                /* =====================================================
                   ENTER UNTUK KIRIM
                ====================================================== */

                input.addEventListener(
                    'keydown',
                    function (
                        event
                    ) {

                        if (
                            event.key ===
                            'Enter'
                        ) {

                            event.preventDefault();

                            form.requestSubmit();

                        }

                    }
                );


                /* =====================================================
                   INITIAL SCROLL
                ====================================================== */

                scrollChat();

            }
        );

    </script>

</x-app-layout>