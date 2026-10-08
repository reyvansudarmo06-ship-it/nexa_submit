<x-app-layout>

    <style>

        /* =========================================================
           NEXA AI ASSISTANT
        ========================================================= */

        .nexa-assistant-page {
            min-height: calc(100vh - 80px);
            padding: 28px;
            color: #f8fafc;

            background:
                radial-gradient(
                    circle at 90% 0%,
                    rgba(99,102,241,.14),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 0% 100%,
                    rgba(37,99,235,.10),
                    transparent 35%
                ),
                #070b16;
        }

        .assistant-container {
            max-width: 1180px;
            margin: 0 auto;
        }


        /* =========================================================
           HERO
        ========================================================= */

        .assistant-hero {
            position: relative;
            overflow: hidden;

            padding: 30px;
            margin-bottom: 22px;

            border-radius: 23px;
            border: 1px solid rgba(99,102,241,.22);

            background:
                radial-gradient(
                    circle at 90% 10%,
                    rgba(99,102,241,.22),
                    transparent 32%
                ),
                linear-gradient(
                    135deg,
                    #0b1020,
                    #111936 55%,
                    #10152c
                );

            box-shadow:
                0 20px 55px rgba(0,0,0,.25);
        }

        .assistant-hero::before {
            content: "";

            position: absolute;

            width: 270px;
            height: 270px;

            right: -100px;
            top: -150px;

            border-radius: 50%;

            background: rgba(99,102,241,.07);

            border: 1px solid rgba(129,140,248,.07);
        }

        .hero-content {
            position: relative;
            z-index: 2;

            display: flex;
            align-items: center;

            gap: 17px;
        }

        .hero-icon {
            width: 64px;
            height: 64px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 18px;

            font-size: 29px;

            background:
                linear-gradient(
                    135deg,
                    #6366f1,
                    #8b5cf6,
                    #2563eb
                );

            box-shadow:
                0 15px 35px rgba(79,70,229,.30),
                inset 0 1px rgba(255,255,255,.14);
        }

        .hero-eyebrow {
            color: #818cf8;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 1.8px;

            text-transform: uppercase;

            margin-bottom: 5px;
        }

        .hero-content h1 {
            margin: 0;

            font-size: 27px;
            font-weight: 850;

            letter-spacing: -.5px;

            color: #fff;
        }

        .hero-content p {
            margin: 7px 0 0;

            color: #94a3b8;

            font-size: 13px;
            line-height: 1.6;
        }

        .online-badge {
            margin-left: auto;

            display: flex;
            align-items: center;

            gap: 7px;

            padding: 8px 12px;

            border-radius: 999px;

            color: #6ee7b7;

            background: rgba(16,185,129,.07);

            border: 1px solid rgba(16,185,129,.17);

            font-size: 10px;
            font-weight: 800;

            letter-spacing: .7px;
        }

        .online-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: #34d399;

            box-shadow:
                0 0 10px rgba(52,211,153,.85);
        }


        /* =========================================================
           CHAT CARD
        ========================================================= */

        .chat-card {
            overflow: hidden;

            border-radius: 23px;

            border:
                1px solid rgba(148,163,184,.10);

            background:
                rgba(15,23,42,.76);

            backdrop-filter: blur(18px);

            box-shadow:
                0 25px 70px rgba(0,0,0,.28);
        }


        /* =========================================================
           CHAT HEADER
        ========================================================= */

        .chat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 17px 22px;

            border-bottom:
                1px solid rgba(148,163,184,.08);

            background:
                rgba(255,255,255,.015);
        }

        .ai-profile {
            display: flex;
            align-items: center;

            gap: 12px;
        }

        .ai-avatar {
            width: 44px;
            height: 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 13px;

            font-size: 21px;

            background:
                linear-gradient(
                    135deg,
                    #6366f1,
                    #2563eb
                );

            box-shadow:
                0 9px 24px rgba(79,70,229,.22);
        }

        .ai-name {
            color: #f8fafc;

            font-size: 13px;
            font-weight: 800;
        }

        .ai-status {
            display: flex;
            align-items: center;

            gap: 5px;

            color: #64748b;

            font-size: 9px;

            margin-top: 3px;
        }

        .mini-dot {
            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: #34d399;
        }

        .chat-label {
            color: #475569;

            font-size: 9px;
            font-weight: 800;

            letter-spacing: 1px;

            text-transform: uppercase;
        }


        /* =========================================================
           CHAT BODY
        ========================================================= */

        .chat-body {
            min-height: 450px;
            max-height: 600px;

            overflow-y: auto;

            padding: 26px;

            scroll-behavior: smooth;
        }

        .chat-body::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background: rgba(100,116,139,.25);

            border-radius: 20px;
        }


        /* =========================================================
           EMPTY CHAT
        ========================================================= */

        .empty-chat {
            min-height: 390px;

            display: flex;
            align-items: center;
            justify-content: center;

            text-align: center;
        }

        .empty-chat-inner {
            max-width: 510px;
        }

        .empty-ai-icon {
            width: 75px;
            height: 75px;

            margin: 0 auto 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 22px;

            font-size: 34px;

            background:
                linear-gradient(
                    135deg,
                    rgba(99,102,241,.15),
                    rgba(37,99,235,.08)
                );

            border:
                1px solid rgba(99,102,241,.16);

            box-shadow:
                0 15px 35px rgba(0,0,0,.15);
        }

        .empty-chat h3 {
            margin: 0;

            color: #f8fafc;

            font-size: 18px;
            font-weight: 800;
        }

        .empty-chat p {
            margin: 9px auto 0;

            color: #64748b;

            font-size: 12px;

            line-height: 1.8;
        }


        /* =========================================================
           CONVERSATION
        ========================================================= */

        .conversation {
            margin-bottom: 24px;
        }

        .message {
            display: flex;

            width: 100%;

            margin-bottom: 12px;

            animation:
                messageIn .22s ease;
        }

        @keyframes messageIn {

            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        .message.user {
            justify-content: flex-end;
        }

        .message.ai {
            justify-content: flex-start;
        }


        /* =========================================================
           MESSAGE WRAPPER
        ========================================================= */

        .message-wrap {
            width: fit-content;

            max-width:
                min(88%, 850px);

            min-width: 0;
        }

        .message.user .message-wrap {
            display: flex;

            flex-direction: column;

            align-items: flex-end;

            width: fit-content;

            max-width:
                min(75%, 700px);
        }

        .message.ai .message-wrap {
            display: flex;

            flex-direction: column;

            align-items: flex-start;

            width: fit-content;

            max-width:
                min(88%, 850px);
        }

        .message-label {
            color: #475569;

            font-size: 9px;

            font-weight: 700;

            margin:
                0 5px 5px;
        }


        /* =========================================================
           MESSAGE BUBBLE
        ========================================================= */

        .bubble {
            display: block;

            width: fit-content;

            max-width: 100%;

            box-sizing: border-box;

            padding:
                12px 15px;

            border-radius: 15px;

            font-size: 12px;

            line-height: 1.7;

            white-space: normal;

            overflow-wrap: anywhere;

            word-break: normal;

            text-align: left;
        }

        .message.user .bubble {
            color: #fff;

            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #6366f1
                );

            border-bottom-right-radius: 5px;

            box-shadow:
                0 8px 25px rgba(79,70,229,.15);
        }

        .message.ai .bubble {
            color: #cbd5e1;

            background:
                rgba(17,24,39,.9);

            border:
                1px solid rgba(148,163,184,.10);

            border-bottom-left-radius: 5px;

            text-align: left;
        }

        .message.ai .bubble strong {
            color: #f8fafc;

            font-weight: 800;
        }

        .message.ai .bubble br {
            line-height: 1.7;
        }


        /* =========================================================
           THINKING MESSAGE
        ========================================================= */

        .thinking-message {
            display: flex;

            justify-content: flex-start;

            width: 100%;

            margin-bottom: 14px;

            animation:
                messageIn .22s ease;
        }

        .thinking-wrap {
            display: flex;

            flex-direction: column;

            align-items: flex-start;

            width: fit-content;
        }

        .thinking-label {
            color: #475569;

            font-size: 9px;

            font-weight: 700;

            margin:
                0 5px 5px;
        }

        .thinking-bubble {
            display: flex;

            align-items: center;

            gap: 5px;

            padding:
                11px 14px;

            border-radius: 14px;

            border-bottom-left-radius: 5px;

            color: #94a3b8;

            background:
                rgba(17,24,39,.9);

            border:
                1px solid rgba(148,163,184,.10);

            font-size: 11px;
        }

        .thinking-dots {
            display: flex;

            gap: 4px;
        }

        .thinking-dots span {
            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: #818cf8;

            animation:
                thinkingDot 1.2s infinite ease-in-out;
        }

        .thinking-dots span:nth-child(2) {
            animation-delay: .15s;
        }

        .thinking-dots span:nth-child(3) {
            animation-delay: .30s;
        }

        @keyframes thinkingDot {

            0%,
            60%,
            100% {
                opacity: .25;
                transform: translateY(0);
            }

            30% {
                opacity: 1;
                transform: translateY(-3px);
            }

        }


        /* =========================================================
           CHAT FORM
        ========================================================= */

        .chat-form {
            padding: 19px;

            border-top:
                1px solid rgba(148,163,184,.08);

            background:
                rgba(2,6,23,.50);
        }

        .error-box {
            padding:
                12px 14px;

            margin-bottom: 12px;

            border-radius: 12px;

            color: #fca5a5;

            background:
                rgba(239,68,68,.07);

            border:
                1px solid rgba(239,68,68,.17);

            font-size: 11px;
        }

        .assignment-label {
            color: #64748b;

            font-size: 9px;

            font-weight: 800;

            letter-spacing: .8px;

            text-transform: uppercase;

            margin-bottom: 6px;
        }

        .assignment-select {
            width: 100%;

            min-height: 42px;

            margin-bottom: 11px;

            padding:
                0 13px;

            border-radius: 11px;

            outline: none;

            color: #cbd5e1;

            background: #0b1222;

            border:
                1px solid rgba(148,163,184,.12);

            font-size: 11px;
        }

        .assignment-select:focus {
            border-color:
                rgba(99,102,241,.55);

            box-shadow:
                0 0 0 3px rgba(99,102,241,.07);
        }

        .input-row {
            display: flex;

            align-items: stretch;

            gap: 9px;
        }

        .message-input {
            flex: 1;

            min-height: 54px;

            max-height: 150px;

            resize: vertical;

            padding: 14px;

            border-radius: 13px;

            outline: none;

            color: #f8fafc;

            background: #0b1222;

            border:
                1px solid rgba(148,163,184,.12);

            font-size: 12px;

            line-height: 1.6;
        }

        .message-input::placeholder {
            color: #475569;
        }

        .message-input:focus {
            border-color:
                rgba(99,102,241,.55);

            box-shadow:
                0 0 0 3px rgba(99,102,241,.07);
        }

        .send-button {
            width: 54px;

            min-width: 54px;

            border: 0;

            border-radius: 13px;

            color: #fff;

            background:
                linear-gradient(
                    135deg,
                    #6366f1,
                    #2563eb
                );

            font-size: 19px;

            cursor: pointer;

            transition: .2s ease;

            box-shadow:
                0 9px 24px rgba(79,70,229,.20);
        }

        .send-button:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 13px 30px rgba(79,70,229,.30);
        }

        .send-button:disabled {
            opacity: .55;

            cursor: wait;

            transform: none;
        }

        .helper {
            display: flex;

            justify-content: center;

            align-items: center;

            gap: 5px;

            margin-top: 9px;

            color: #475569;

            font-size: 9px;

            text-align: center;
        }

        .helper-dot {
            width: 4px;
            height: 4px;

            border-radius: 50%;

            background: #6366f1;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media(max-width: 700px) {

            .nexa-assistant-page {
                padding: 18px;
            }

            .assistant-hero {
                padding: 23px;
            }

            .hero-icon {
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
            }

            .online-badge {
                display: none;
            }

            .chat-body {
                padding: 18px;

                min-height: 400px;
            }

            .message-wrap,
            .message.user .message-wrap,
            .message.ai .message-wrap {

                width: fit-content;

                max-width: 90%;
            }

            .bubble {
                padding:
                    10px 12px;

                font-size: 11.5px;

                line-height: 1.65;
            }

            .chat-form {
                padding: 15px;
            }

            .send-button {
                width: 50px;

                min-width: 50px;
            }
        }

        @media(max-width: 420px) {

            .nexa-assistant-page {
                padding: 12px;
            }

            .assistant-hero {
                padding: 18px;

                border-radius: 18px;
            }

            .hero-content {
                gap: 11px;
            }

            .hero-icon {
                width: 48px;
                height: 48px;

                font-size: 21px;
            }

            .hero-content h1 {
                font-size: 18px;
            }

            .hero-content p {
                font-size: 10px;
            }

            .chat-card {
                border-radius: 18px;
            }

            .chat-body {
                padding: 14px;
            }

            .message-wrap,
            .message.user .message-wrap,
            .message.ai .message-wrap {

                max-width: 94%;
            }

            .bubble {
                padding:
                    9px 11px;

                font-size: 11px;

                line-height: 1.65;
            }
        }

    </style>


    <div class="nexa-assistant-page">

        <div class="assistant-container">


            {{-- =====================================================
                 HERO
            ====================================================== --}}

            <div class="assistant-hero">

                <div class="hero-content">

                    <div class="hero-icon">
                        🤖
                    </div>

                    <div>

                        <div class="hero-eyebrow">
                            NEXA AI / ASSISTANT
                        </div>

                        <h1>
                            AI Assistant
                        </h1>

                        <p>
                            Teman belajar untuk memahami tugas, menyusun langkah pengerjaan,
                            dan membantu kamu belajar dengan lebih terarah.
                        </p>

                    </div>

                    <div class="online-badge">

                        <span class="online-dot"></span>

                        ONLINE

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 CHAT CARD
            ====================================================== --}}

            <div class="chat-card">


                {{-- CHAT HEADER --}}

                <div class="chat-top">

                    <div class="ai-profile">

                        <div class="ai-avatar">
                            🤖
                        </div>

                        <div>

                            <div class="ai-name">
                                NEXA AI Assistant
                            </div>

                            <div class="ai-status">

                                <span class="mini-dot"></span>

                                Online • Siap membantu

                            </div>

                        </div>

                    </div>

                    <div class="chat-label">
                        AI CHAT
                    </div>

                </div>


                {{-- =================================================
                     CHAT BODY
                ================================================== --}}

                <div
                    class="chat-body"
                    id="nexaChatBody"
                >

                    <div
                        id="emptyChat"
                        @if($conversations->count() > 0)
                            style="display:none;"
                        @endif
                    >

                        <div class="empty-chat">

                            <div class="empty-chat-inner">

                                <div class="empty-ai-icon">
                                    🤖
                                </div>

                                <h3>
                                    Halo, saya NEXA AI 👋
                                </h3>

                                <p>
                                    Tanyakan sesuatu tentang tugas kamu.
                                    Kamu bisa meminta penjelasan instruksi,
                                    langkah pengerjaan, konsep belajar,
                                    atau saran supaya tugas lebih terarah.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- CHAT HISTORY --}}

                    <div id="conversationList">

                        @if($conversations->count() > 0)

                            @foreach($conversations as $conversation)

                                <div class="conversation">


                                    {{-- USER MESSAGE --}}

                                    <div class="message user">

                                        <div class="message-wrap">

                                            <div class="message-label">
                                                KAMU
                                            </div>

                                            <div class="bubble js-message-content">
                                                {{ $conversation->message }}
                                            </div>

                                        </div>

                                    </div>


                                    {{-- AI MESSAGE --}}

                                    <div class="message ai">

                                        <div class="message-wrap">

                                            <div class="message-label">
                                                NEXA AI
                                            </div>

                                            <div class="bubble js-message-content">
                                                {{ $conversation->response }}
                                            </div>

                                        </div>

                                    </div>


                                </div>

                            @endforeach

                        @endif

                    </div>


                    {{-- THINKING CONTAINER --}}

                    <div
                        id="thinkingContainer"
                        style="display:none;"
                    >

                        <div class="thinking-message">

                            <div class="thinking-wrap">

                                <div class="thinking-label">
                                    NEXA AI
                                </div>

                                <div class="thinking-bubble">

                                    <span>
                                        Sedang berpikir
                                    </span>

                                    <span class="thinking-dots">

                                        <span></span>
                                        <span></span>
                                        <span></span>

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     CHAT FORM
                ================================================== --}}

                <div class="chat-form">

                    <div
                        id="ajaxError"
                        class="error-box"
                        style="display:none;"
                    ></div>


                    <form
                        id="nexaAiForm"
                        action="{{ route('student.ai-assistant.ask') }}"
                        method="POST"
                    >

                        @csrf


                        <div class="assignment-label">
                            Konteks Tugas
                        </div>


                        <select
                            name="assignment_id"
                            id="assignmentId"
                            class="assignment-select"
                        >

                            <option value="">
                                💡 Tidak menggunakan tugas tertentu
                            </option>

                            @foreach($assignments as $assignment)

                                <option
                                    value="{{ $assignment->id }}"
                                >

                                    {{ $assignment->title }}

                                    @if($assignment->subject)

                                        — {{ $assignment->subject }}

                                    @endif

                                </option>

                            @endforeach

                        </select>


                        <div class="input-row">


                            <textarea
                                id="nexaMessage"
                                name="message"
                                class="message-input"
                                placeholder="Tulis pertanyaan kamu..."
                                maxlength="4000"
                                required
                            >{{ old('message') }}</textarea>


                            <button
                                type="submit"
                                class="send-button"
                                id="nexaSendButton"
                                title="Kirim pertanyaan"
                            >
                                ➤
                            </button>


                        </div>


                        <div class="helper">

                            <span class="helper-dot"></span>

                            NEXA AI membantu memahami tugas,
                            bukan menggantikan proses belajarmu.

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- =============================================================
         JAVASCRIPT
    ============================================================= --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {


                /* =================================================
                   ELEMENT
                ================================================= */

                const form =
                    document.getElementById(
                        'nexaAiForm'
                    );

                const button =
                    document.getElementById(
                        'nexaSendButton'
                    );

                const messageInput =
                    document.getElementById(
                        'nexaMessage'
                    );

                const assignmentSelect =
                    document.getElementById(
                        'assignmentId'
                    );

                const chatBody =
                    document.getElementById(
                        'nexaChatBody'
                    );

                const conversationList =
                    document.getElementById(
                        'conversationList'
                    );

                const thinkingContainer =
                    document.getElementById(
                        'thinkingContainer'
                    );

                const emptyChat =
                    document.getElementById(
                        'emptyChat'
                    );

                const ajaxError =
                    document.getElementById(
                        'ajaxError'
                    );


                /* =================================================
                   CSRF
                ================================================= */

                const csrfToken =
                    document.querySelector(
                        'input[name="_token"]'
                    )?.value;


                /* =================================================
                   SCROLL
                ================================================= */

                function scrollToBottom() {

                    if (!chatBody) {
                        return;
                    }

                    setTimeout(
                        function () {

                            chatBody.scrollTo({

                                top:
                                    chatBody.scrollHeight,

                                behavior:
                                    'smooth'

                            });

                        },
                        50
                    );

                }


                /* =================================================
                   ESCAPE HTML
                ================================================= */

                function escapeHtml(value) {

                    const div =
                        document.createElement(
                            'div'
                        );

                    div.textContent =
                        value ?? '';

                    return div.innerHTML;
                }


                /* =================================================
                   TEXT FORMAT
                ================================================= */

                function formatMessage(value) {

                    let text =
                        escapeHtml(
                            value ?? ''
                        );

                    /*
                     * **teks** menjadi bold
                     */
                    text =
                        text.replace(
                            /\*\*(.*?)\*\*/g,
                            '<strong>$1</strong>'
                        );

                    /*
                     * ### Judul
                     */
                    text =
                        text.replace(
                            /^### (.*)$/gm,
                            '<strong>$1</strong>'
                        );

                    /*
                     * ## Judul
                     */
                    text =
                        text.replace(
                            /^## (.*)$/gm,
                            '<strong>$1</strong>'
                        );

                    /*
                     * # Judul
                     */
                    text =
                        text.replace(
                            /^# (.*)$/gm,
                            '<strong>$1</strong>'
                        );

                    /*
                     * Ganti newline menjadi HTML
                     */
                    text =
                        text.replace(
                            /\n/g,
                            '<br>'
                        );

                    return text;
                }


                /* =================================================
                   FORMAT CHAT HISTORY
                ================================================= */

                function formatExistingMessages() {

                    const messages =
                        document.querySelectorAll(
                            '.js-message-content'
                        );

                    messages.forEach(
                        function (element) {

                            const originalText =
                                element.textContent;

                            element.innerHTML =
                                formatMessage(
                                    originalText
                                );

                        }
                    );

                }


                /*
                 * Format chat lama dari database
                 */
                formatExistingMessages();


                /* =================================================
                   HIDE ERROR
                ================================================= */

                function hideError() {

                    if (!ajaxError) {
                        return;
                    }

                    ajaxError.style.display =
                        'none';

                    ajaxError.innerHTML =
                        '';

                }


                /* =================================================
                   SHOW ERROR
                ================================================= */

                function showError(message) {

                    if (!ajaxError) {
                        return;
                    }

                    ajaxError.innerHTML =
                        '⚠️ ' +
                        escapeHtml(
                            message
                        );

                    ajaxError.style.display =
                        'block';

                    scrollToBottom();

                }


                /* =================================================
                   ADD USER MESSAGE
                ================================================= */

                function addUserMessage(
                    message
                ) {

                    if (!conversationList) {
                        return;
                    }

                    if (emptyChat) {

                        emptyChat.style.display =
                            'none';

                    }


                    const conversation =
                        document.createElement(
                            'div'
                        );

                    conversation.className =
                        'conversation';


                    conversation.innerHTML = `

                        <div class="message user">

                            <div class="message-wrap">

                                <div class="message-label">
                                    KAMU
                                </div>

                                <div class="bubble">
                                    ${formatMessage(message)}
                                </div>

                            </div>

                        </div>

                    `;


                    conversationList.appendChild(
                        conversation
                    );

                    scrollToBottom();

                }


                /* =================================================
                   ADD AI MESSAGE
                ================================================= */

                function addAiMessage(
                    response
                ) {

                    if (!conversationList) {
                        return;
                    }


                    const conversation =
                        document.createElement(
                            'div'
                        );

                    conversation.className =
                        'conversation';


                    conversation.innerHTML = `

                        <div class="message ai">

                            <div class="message-wrap">

                                <div class="message-label">
                                    NEXA AI
                                </div>

                                <div class="bubble">
                                    ${formatMessage(response)}
                                </div>

                            </div>

                        </div>

                    `;


                    conversationList.appendChild(
                        conversation
                    );

                    scrollToBottom();

                }


                /* =================================================
                   THINKING ON
                ================================================= */

                function showThinking() {

                    if (!thinkingContainer) {
                        return;
                    }

                    thinkingContainer.style.display =
                        'block';

                    scrollToBottom();

                }


                /* =================================================
                   THINKING OFF
                ================================================= */

                function hideThinking() {

                    if (!thinkingContainer) {
                        return;
                    }

                    thinkingContainer.style.display =
                        'none';

                }


                /* =================================================
                   BUTTON STATE
                ================================================= */

                function setLoading(
                    loading
                ) {

                    if (!button) {
                        return;
                    }

                    button.disabled =
                        loading;

                    if (loading) {

                        button.innerHTML =
                            '⏳';

                    } else {

                        button.innerHTML =
                            '➤';

                    }

                }


                /* =================================================
                   SUBMIT
                ================================================= */

                if (form) {

                    form.addEventListener(
                        'submit',
                        function () {

                            hideError();

                            setLoading(true);

                            showThinking();

                        }
                    );

                }


                /* =================================================
                   ENTER UNTUK KIRIM
                ================================================= */

                if (messageInput) {

                    messageInput.addEventListener(
                        'keydown',
                        function (event) {

                            /*
                             * Enter = kirim
                             * Shift + Enter = baris baru
                             */

                            if (
                                event.key === 'Enter' &&
                                !event.shiftKey
                            ) {

                                event.preventDefault();


                                if (
                                    !button.disabled
                                ) {

                                    form.requestSubmit();

                                }

                            }

                        }
                    );

                }


                /* =================================================
                   INITIAL SCROLL
                ================================================= */

                scrollToBottom();

            }
        );

    </script>

</x-app-layout>