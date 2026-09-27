<x-app-layout> 
 
    <x-slot name="header"> 
        <div class="detail-header"> 
            <div> 
                <div class="detail-eyebrow"> 
                    <span class="detail-dot"></span> 
                    ASSIGNMENT WORKSPACE 
                </div> 
 
                <h2 class="detail-header-title"> 
                    Detail Tugas 
                </h2> 
 
                <p class="detail-header-subtitle"> 
                    {{ $assignment->subject }} • {{ $assignment->class_name }} 
                </p> 
            </div> 
 
            <a 
                href="{{ route('student.assignments') }}" 
                class="back-button" 
            > 
                <span>←</span> 
                Kembali 
            </a> 
        </div> 
    </x-slot> 
 
    <style> 
        .detail-page { 
            min-height: calc(100vh - 80px); 
            padding: 30px 0 70px; 
            color: #e9edff; 
        } 
 
        .detail-container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 0 26px; 
        } 
 
        .detail-header { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            gap: 20px; 
        } 
 
        .detail-eyebrow { 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            color: #9585ff; 
            font-size: 10px; 
            font-weight: 800; 
            letter-spacing: 1.8px; 
            margin-bottom: 7px; 
        } 
 
        .detail-dot { 
            width: 7px; 
            height: 7px; 
            border-radius: 50%; 
            background: #7c5cff; 
            box-shadow: 0 0 12px rgba(124,92,255,.9); 
        } 
 
        .detail-header-title { 
            margin: 0; 
            color: #f4f6ff; 
            font-size: 28px; 
            font-weight: 800; 
            letter-spacing: -.6px; 
        } 
 
        .detail-header-subtitle { 
            margin: 6px 0 0; 
            color: #858ea8; 
            font-size: 13px; 
        } 
 
        .back-button { 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            padding: 10px 16px; 
            border-radius: 12px; 
            color: #dfe4fa; 
            text-decoration: none; 
            font-size: 12px; 
            font-weight: 700; 
            background: rgba(255,255,255,.045); 
            border: 1px solid rgba(255,255,255,.09); 
            transition: .2s ease; 
        } 
 
        .back-button:hover { 
            color: white; 
            background: rgba(124,92,255,.13); 
            border-color: rgba(124,92,255,.3); 
        } 
 
        .detail-stack { 
            display: flex; 
            flex-direction: column; 
            gap: 20px; 
        } 
 
        .nexa-card { 
            position: relative; 
            overflow: hidden; 
            border-radius: 22px; 
            background: 
                linear-gradient( 
                    145deg, 
                    rgba(25,30,52,.95), 
                    rgba(13,17,32,.98) 
                ); 
            border: 1px solid rgba(132,145,190,.13); 
            box-shadow: 
                0 15px 45px rgba(0,0,0,.24), 
                inset 0 1px 0 rgba(255,255,255,.025); 
        } 
 
        .nexa-card::before { 
            content: ""; 
            position: absolute; 
            width: 220px; 
            height: 220px; 
            top: -150px; 
            right: -80px; 
            border-radius: 50%; 
            background: rgba(108,82,255,.12); 
            filter: blur(50px); 
            pointer-events: none; 
        } 
 
        .card-padding { 
            position: relative; 
            padding: 25px; 
        } 
 
        .success-alert, 
        .error-alert { 
            padding: 14px 17px; 
            border-radius: 14px; 
            font-size: 13px; 
            font-weight: 600; 
        } 
 
        .success-alert { 
            color: #6ee7ad; 
            background: rgba(42,211,130,.07); 
            border: 1px solid rgba(42,211,130,.16); 
        } 
 
        .error-alert { 
            color: #ff8585; 
            background: rgba(255,70,70,.07); 
            border: 1px solid rgba(255,70,70,.16); 
        } 
 
        .assignment-main { 
            display: grid; 
            grid-template-columns: minmax(0,1fr) 260px; 
            gap: 24px; 
            align-items: start; 
        } 
 
        .subject-label { 
            color: #9b8cff; 
            font-size: 11px; 
            font-weight: 800; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        } 
 
        .assignment-main-title { 
            margin: 7px 0 0; 
            color: #f5f7ff; 
            font-size: 27px; 
            line-height: 1.25; 
            font-weight: 800; 
            letter-spacing: -.6px; 
        } 
 
        .assignment-description { 
            margin-top: 13px; 
            color: #8992ac; 
            font-size: 14px; 
            line-height: 1.75; 
            white-space: pre-line; 
        } 
 
        .deadline-panel { 
            padding: 18px; 
            border-radius: 17px; 
            background: rgba(255,255,255,.035); 
            border: 1px solid rgba(255,255,255,.065); 
        } 
 
        .deadline-panel-label { 
            color: #68728b; 
            font-size: 10px; 
            font-weight: 800; 
            text-transform: uppercase; 
            letter-spacing: .9px; 
        } 
 
        .deadline-panel-value { 
            margin-top: 8px; 
            color: #e8ebf9; 
            font-size: 14px; 
            font-weight: 700; 
        } 
 
        .section-head { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            gap: 15px; 
            margin-bottom: 20px; 
        } 
 
        .section-title-wrap { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
        } 
 
        .section-icon { 
            width: 43px; 
            height: 43px; 
            flex-shrink: 0; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 13px; 
            color: #a394ff; 
            background: rgba(124,92,255,.1); 
            border: 1px solid rgba(124,92,255,.16); 
        } 
 
        .section-title { 
            margin: 0; 
            color: #f0f2ff; 
            font-size: 17px; 
            font-weight: 800; 
        } 
 
        .section-description { 
            margin: 4px 0 0; 
            color: #707a94; 
            font-size: 12px; 
        } 
 
        .status-badge { 
            padding: 7px 12px; 
            border-radius: 10px; 
            font-size: 11px; 
            font-weight: 800; 
        } 
 
        .status-done { 
            color: #63dfa3; 
            background: rgba(65,211,145,.08); 
            border: 1px solid rgba(65,211,145,.16); 
        } 
 
        .status-pending { 
            color: #f5c76c; 
            background: rgba(245,199,108,.08); 
            border: 1px solid rgba(245,199,108,.15); 
        } 
 
        .info-grid { 
            display: grid; 
            grid-template-columns: repeat(2,minmax(0,1fr)); 
            gap: 14px; 
        } 
 
        .info-box { 
            padding: 17px; 
            border-radius: 15px; 
            background: rgba(255,255,255,.025); 
            border: 1px solid rgba(255,255,255,.055); 
        } 
 
        .info-label { 
            color: #69738d; 
            font-size: 10px; 
            font-weight: 800; 
            text-transform: uppercase; 
            letter-spacing: .8px; 
        } 
 
        .info-value { 
            margin-top: 7px; 
            color: #e4e8f7; 
            font-size: 13px; 
            font-weight: 700; 
        } 
 
        .note-box { 
            margin-top: 14px; 
            padding: 16px; 
            border-radius: 15px; 
            background: rgba(255,255,255,.025); 
            border: 1px solid rgba(255,255,255,.055); 
        } 
 
        .note-text { 
            margin-top: 7px; 
            color: #9aa2b8; 
            font-size: 13px; 
            line-height: 1.65; 
            white-space: pre-line; 
        } 
 
        .ai-panel { 
            margin-top: 22px; 
            padding: 21px; 
            border-radius: 19px; 
            background: 
                linear-gradient( 
                    135deg, 
                    rgba(91,71,190,.13), 
                    rgba(50,89,190,.06) 
                ); 
            border: 1px solid rgba(124,92,255,.2); 
        } 
 
        .ai-panel-inner { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            gap: 20px; 
        } 
 
        .ai-brand { 
            display: flex; 
            align-items: flex-start; 
            gap: 13px; 
        } 
 
        .ai-icon { 
            width: 46px; 
            height: 46px; 
            flex-shrink: 0; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 14px; 
            background: linear-gradient(135deg,#7055ed,#4776e6); 
            box-shadow: 0 8px 22px rgba(92,76,210,.2); 
        } 
 
        .ai-label { 
            color: #a393ff; 
            font-size: 9px; 
            font-weight: 900; 
            letter-spacing: 1.3px; 
        } 
 
        .ai-title { 
            margin: 4px 0 0; 
            color: #f0f2ff; 
            font-size: 16px; 
            font-weight: 800; 
        } 
 
        .ai-description { 
            margin-top: 5px; 
            max-width: 620px; 
            color: #818ba5; 
            font-size: 12px; 
            line-height: 1.6; 
        } 
 
        .primary-button { 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            gap: 8px; 
            padding: 11px 16px; 
            border: 0; 
            border-radius: 12px; 
            color: white; 
            text-decoration: none; 
            font-size: 12px; 
            font-weight: 800; 
            background: linear-gradient(135deg,#7055ed,#4776e6); 
            box-shadow: 0 8px 22px rgba(91,77,210,.22); 
            cursor: pointer; 
            transition: .2s ease; 
            white-space: nowrap; 
        } 
 
        .primary-button:hover { 
            color: white; 
            transform: translateY(-1px); 
            box-shadow: 0 12px 28px rgba(91,77,210,.32); 
        } 
 
        .dark-button { 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            gap: 8px; 
            padding: 11px 16px; 
            border-radius: 12px; 
            color: white; 
            background: #11162a; 
            border: 1px solid rgba(255,255,255,.08); 
            text-decoration: none; 
            font-size: 12px; 
            font-weight: 800; 
            transition: .2s ease; 
            white-space: nowrap; 
        } 
 
        .dark-button:hover { 
            color: white; 
            background: #191f38; 
        } 
 
        .deadline-card { 
            padding: 19px; 
            border-radius: 19px; 
            background: 
                linear-gradient( 
                    135deg, 
                    rgba(255,151,61,.08), 
                    rgba(255,87,87,.035) 
                ); 
            border: 1px solid rgba(255,155,73,.16); 
        } 
 
        .deadline-card-inner { 
            display: flex; 
            align-items: center; 
            gap: 14px; 
        } 
 
        .deadline-icon { 
            width: 46px; 
            height: 46px; 
            flex-shrink: 0; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 14px; 
            color: #ffb45e; 
            background: rgba(255,155,73,.1); 
        } 
 
        .deadline-label { 
            color: #70798f; 
            font-size: 11px; 
        } 
 
        #deadline-countdown { 
            margin-top: 4px; 
            color: #ffb35d; 
            font-size: 19px; 
            font-weight: 800; 
        } 
 
        .progress-header { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            gap: 20px; 
            margin-bottom: 19px; 
        } 
 
        .progress-number { 
            color: #9b8cff; 
            font-size: 31px; 
            font-weight: 900; 
        } 
 
        .progress-label { 
            color: #68728b; 
            font-size: 10px; 
            text-align: right; 
        } 
 
        .progress-track { 
            height: 9px; 
            margin-bottom: 22px; 
            overflow: hidden; 
            border-radius: 999px; 
            background: rgba(255,255,255,.06); 
        } 
 
        .progress-fill { 
            height: 100%; 
            border-radius: inherit; 
            background: linear-gradient(90deg,#7055ed,#4776e6); 
            box-shadow: 0 0 15px rgba(102,81,230,.35); 
            transition: width .7s ease; 
        } 
 
        .progress-grid { 
            display: grid; 
            grid-template-columns: repeat(4,minmax(0,1fr)); 
            gap: 13px; 
        } 
 
        .progress-step { 
            padding: 17px; 
            border-radius: 16px; 
            background: rgba(255,255,255,.025); 
            border: 1px solid rgba(255,255,255,.055); 
        } 
 
        .step-icon { 
            width: 39px; 
            height: 39px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 11px; 
            font-size: 16px; 
        } 
 
        .step-done { 
            background: rgba(53,211,139,.1); 
            border-color: rgba(53,211,139,.14); 
        } 
 
        .step-ai { 
            background: rgba(124,92,255,.1); 
            border-color: rgba(124,92,255,.14); 
        } 
 
        .step-review { 
            background: rgba(63,143,255,.1); 
            border-color: rgba(63,143,255,.14); 
        } 
 
        .step-wait { 
            background: rgba(255,255,255,.045); 
        } 
 
        .step-title { 
            margin-top: 12px; 
            color: #e7eaf7; 
            font-size: 13px; 
            font-weight: 800; 
        } 
 
        .step-description { 
            margin-top: 5px; 
            color: #747e97; 
            font-size: 11px; 
            line-height: 1.5; 
        } 
 
        .step-status { 
            margin-top: 10px; 
            font-size: 10px; 
            font-weight: 800; 
        } 
 
        .green { 
            color: #62dda2; 
        } 
 
        .purple { 
            color: #a091ff; 
        } 
 
        .blue { 
            color: #72aaff; 
        } 
 
        .muted { 
            color: #737c94; 
        } 
 
        .evaluation-title { 
            margin-bottom: 17px; 
        } 
 
        .evaluation-title h2 { 
            margin: 0; 
            color: #f0f2ff; 
            font-size: 20px; 
            font-weight: 800; 
        } 
 
        .evaluation-title p { 
            margin-top: 5px; 
            color: #737d96; 
            font-size: 12px; 
        } 
 
        .metric-grid { 
            display: grid; 
            grid-template-columns: repeat(3,minmax(0,1fr)); 
            gap: 14px; 
        } 
 
        .metric-card { 
            padding: 20px; 
            border-radius: 17px; 
            background: rgba(255,255,255,.025); 
            border: 1px solid rgba(255,255,255,.055); 
        } 
 
        .metric-label { 
            color: #9585ff; 
            font-size: 10px; 
            font-weight: 800; 
            text-transform: uppercase; 
            letter-spacing: .7px; 
        } 
 
        .metric-score { 
            margin-top: 8px; 
            color: #f1f3ff; 
            font-size: 42px; 
            font-weight: 900; 
        } 
 
        .metric-small { 
            margin-top: 2px; 
            color: #6e7890; 
            font-size: 11px; 
        } 
 
        .metric-text { 
            margin-top: 10px; 
            color: #9aa2b8; 
            font-size: 13px; 
            line-height: 1.65; 
            white-space: pre-line; 
        } 
 
        .score-meter { 
            margin-top: 15px; 
        } 
 
        .score-meter-head { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            gap: 15px; 
        } 
 
        .score-meter-title { 
            color: #e8ebf8; 
            font-size: 14px; 
            font-weight: 800; 
        } 
 
        .score-meter-subtitle { 
            margin-top: 4px; 
            color: #707a92; 
            font-size: 11px; 
        } 
 
        .score-value { 
            font-size: 25px; 
            font-weight: 900; 
        } 
 
        .score-track { 
            height: 12px; 
            margin-top: 17px; 
            overflow: hidden; 
            border-radius: 999px; 
            background: rgba(255,255,255,.06); 
        } 
 
        .score-fill { 
            height: 100%; 
            border-radius: inherit; 
            transition: width .7s ease; 
        } 
 
        .score-scale { 
            display: flex; 
            justify-content: space-between; 
            margin-top: 6px; 
            color: #59627a; 
            font-size: 9px; 
        } 

        /* SCORE BREAKDOWN */

        .score-breakdown-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 20px;
        }

        .score-breakdown-item {
            padding: 16px;
            border-radius: 15px;
            background: rgba(255,255,255,.025);
            border: 1px solid rgba(255,255,255,.055);
        }

        .score-breakdown-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            color: #aeb6cc;
            font-size: 12px;
            font-weight: 700;
        }

        .score-breakdown-top strong {
            color: #f0f2ff;
            font-size: 13px;
            white-space: nowrap;
        }

        .breakdown-track {
            height: 7px;
            margin-top: 12px;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(255,255,255,.06);
        }

        .breakdown-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #7055ed, #4776e6);
            box-shadow: 0 0 12px rgba(102,81,230,.3);
        }

        .breakdown-total {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 18px;
            padding: 16px 18px;
            border-radius: 15px;
            background: linear-gradient(
                135deg,
                rgba(112,85,237,.12),
                rgba(71,118,230,.07)
            );
            border: 1px solid rgba(124,92,255,.18);
        }

        .breakdown-total span {
            color: #9da6bd;
            font-size: 12px;
            font-weight: 800;
        }

        .breakdown-total strong {
            color: #a493ff;
            font-size: 22px;
            font-weight: 900;
        }
 
        .content-box { 
            padding: 21px; 
            border-radius: 17px; 
            background: rgba(255,255,255,.025); 
            border: 1px solid rgba(255,255,255,.055); 
        } 
 
        .content-box h3 { 
            margin: 0; 
            color: #e8ebf8; 
            font-size: 14px; 
            font-weight: 800; 
        } 
 
        .content-box p { 
            margin-top: 10px; 
            color: #959db2; 
            font-size: 13px; 
            line-height: 1.75; 
            white-space: pre-line; 
        } 
 
        .two-column { 
            display: grid; 
            grid-template-columns: repeat(2,minmax(0,1fr)); 
            gap: 14px; 
        } 
 
        .positive { 
            border-color: rgba(55,211,139,.13); 
        } 
 
        .positive h3 { 
            color: #63dfa3; 
        } 
 
        .negative { 
            border-color: rgba(255,87,87,.13); 
        } 
 
        .negative h3 { 
            color: #ff8888; 
        } 
 
        .suggestion-box { 
            background: 
                linear-gradient( 
                    135deg, 
                    rgba(91,71,190,.12), 
                    rgba(55,100,190,.05) 
                ); 
            border-color: rgba(124,92,255,.15); 
        } 
 
        .suggestion-box h3 { 
            color: #a193ff; 
        } 
 
        .chat-panel { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            gap: 20px; 
            padding: 21px; 
            border-radius: 19px; 
            background: 
                linear-gradient( 
                    135deg, 
                    rgba(124,92,255,.1), 
                    rgba(63,111,220,.045) 
                ); 
            border: 1px solid rgba(124,92,255,.16); 
        } 
 
        .chat-brand { 
            display: flex; 
            align-items: flex-start; 
            gap: 13px; 
        } 
 
        .chat-icon { 
            width: 46px; 
            height: 46px; 
            flex-shrink: 0; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 14px; 
            color: white; 
            background: #11162a; 
            border: 1px solid rgba(255,255,255,.08); 
        } 
 
        .chat-label { 
            color: #9b8cff; 
            font-size: 9px; 
            font-weight: 900; 
            letter-spacing: 1.2px; 
        } 
 
        .chat-title { 
            margin-top: 4px; 
            color: #edf0ff; 
            font-size: 15px; 
            font-weight: 800; 
        } 
 
        .chat-description { 
            margin-top: 5px; 
            max-width: 650px; 
            color: #7f89a2; 
            font-size: 12px; 
            line-height: 1.6; 
        } 
 
        .teacher-score-grid { 
            display: grid; 
            grid-template-columns: 260px minmax(0,1fr); 
            gap: 14px; 
        } 
 
        .teacher-score { 
            padding: 20px; 
            border-radius: 17px; 
            background: rgba(255,255,255,.025); 
            border: 1px solid rgba(255,255,255,.055); 
        } 
 
        .teacher-score-label { 
            color: #69738c; 
            font-size: 10px; 
            font-weight: 800; 
            text-transform: uppercase; 
            letter-spacing: .7px; 
        } 
 
        .teacher-score-value { 
            margin-top: 5px; 
            color: #f2f4ff; 
            font-size: 40px; 
            font-weight: 900; 
        } 
 
        .teacher-comment { 
            color: #969eb4; 
            font-size: 13px; 
            line-height: 1.7; 
            white-space: pre-line; 
            margin-top: 9px; 
        } 
 
        .waiting-box { 
            padding: 14px 16px; 
            border-radius: 13px; 
            color: #f3c86f; 
            background: rgba(245,199,108,.06); 
            border: 1px solid rgba(245,199,108,.14); 
            font-size: 12px; 
        } 
 
        .empty-submit { 
            text-align: center; 
            padding: 25px 10px 8px; 
        } 
 
        .empty-submit p { 
            color: #777f97; 
            font-size: 13px; 
            margin-bottom: 15px; 
        } 
 
        .inline-actions { 
            display: flex; 
            flex-wrap: wrap; 
            gap: 10px; 
        } 
 
        .hidden { 
            display: none !important; 
        } 
 
        @media (max-width: 900px) { 
            .assignment-main { 
                grid-template-columns: 1fr; 
            } 
 
            .progress-grid { 
                grid-template-columns: repeat(2,minmax(0,1fr)); 
            } 
 
            .teacher-score-grid { 
                grid-template-columns: 1fr; 
            } 
        } 
 
        @media (max-width: 700px) { 
            .detail-container { 
                padding: 0 16px; 
            } 
 
            .detail-page { 
                padding-top: 20px; 
            } 
 
            .detail-header { 
                align-items: flex-start; 
            } 
 
            .detail-header-title { 
                font-size: 23px; 
            } 
 
            .back-button { 
                padding: 9px 12px; 
            } 
 
            .card-padding { 
                padding: 19px; 
            } 
 
            .assignment-main-title { 
                font-size: 22px; 
            } 
 
            .ai-panel-inner, 
            .chat-panel { 
                flex-direction: column; 
                align-items: stretch; 
            } 
 
            .ai-panel .primary-button, 
            .chat-panel .dark-button { 
                width: 100%; 
            } 
 
            .metric-grid, 
            .two-column { 
                grid-template-columns: 1fr; 
            }

            .score-breakdown-grid {
                grid-template-columns: 1fr;
            }
 
            .progress-header { 
                align-items: flex-start; 
            } 
        } 
 
        @media (max-width: 480px) { 
            .progress-grid { 
                grid-template-columns: 1fr; 
            } 
 
            .info-grid { 
                grid-template-columns: 1fr; 
            } 
 
            .section-head { 
                align-items: flex-start; 
            } 
 
            .status-badge { 
                font-size: 10px; 
            } 
        } 
    </style> 
 
 
    <div class="detail-page"> 
 
        <div class="detail-container"> 
 
            <div class="detail-stack"> 
 
                {{-- SUCCESS --}} 
                @if(session('success')) 
                    <div class="success-alert"> 
                        ✓ {{ session('success') }} 
                    </div> 
                @endif 
 
 
                {{-- ERROR --}} 
                @if(session('error')) 
                    <div class="error-alert"> 
                        ⚠ {{ session('error') }} 
                    </div> 
                @endif 
 
 
                {{-- DETAIL TUGAS --}} 
                <div class="nexa-card"> 
                    <div class="card-padding"> 
 
                        <div class="assignment-main"> 
 
                            <div> 
                                <div class="subject-label"> 
                                    {{ $assignment->subject }} 
                                </div> 
 
                                <h1 class="assignment-main-title"> 
                                    {{ $assignment->title }} 
                                </h1> 
 
                                <p class="assignment-description"> 
                                    {{ $assignment->description }} 
                                </p> 
                            </div> 
 
                            <div class="deadline-panel"> 
                                <div class="deadline-panel-label"> 
                                    Deadline 
                                </div> 
 
                                <div class="deadline-panel-value"> 
                                    {{ $assignment->deadline?->format('d M Y, H:i') ?? '-' }} 
                                </div> 
                            </div> 
 
                        </div> 
 
                    </div> 
                </div> 
 
 
                {{-- PENGUMPULAN --}} 
                <div class="nexa-card"> 
                    <div class="card-padding"> 
 
                        <div class="section-head"> 
 
                            <div class="section-title-wrap"> 
 
                                <div class="section-icon"> 
                                    <svg width="20" height="20" viewBox="0 0 24 24" 
                                         fill="none" stroke="currentColor" 
                                         stroke-width="1.8"> 
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/> 
                                        <path d="m7 10 5 5 5-5"/> 
                                        <path d="M12 15V3"/> 
                                    </svg> 
                                </div> 
 
                                <div> 
                                    <h2 class="section-title"> 
                                        Pengumpulan 
                                    </h2> 
 
                                    <p class="section-description"> 
                                        Status dan informasi tugas kamu. 
                                    </p> 
                                </div> 
 
                            </div> 
 
                            @if($submission) 
                                <span class="status-badge status-done"> 
                                    ✓ Terkumpul 
                                </span> 
                            @else 
                                <span class="status-badge status-pending"> 
                                    Belum dikumpulkan 
                                </span> 
                            @endif 
 
                        </div> 
 
 
                        @if($submission) 
 
                            <div class="info-grid"> 
 
                                <div class="info-box"> 
 
                                    <div class="info-label"> 
                                        File 
                                    </div> 
 
                                    <div class="info-value"> 
                                        {{ $submission->file_name }} 
                                    </div> 
 
                                </div> 
 
                                <div class="info-box"> 
 
                                    <div class="info-label"> 
                                        Waktu Dikumpulkan 
                                    </div> 
 
                                    <div class="info-value"> 
                                        {{ $submission->created_at->format('d M Y, H:i') }} 
                                    </div> 
 
                                </div> 
 
                            </div> 
 
 
                            @if($submission->note) 
 
                                <div class="note-box"> 
 
                                    <div class="info-label"> 
                                        Catatan 
                                    </div> 
 
                                    <div class="note-text"> 
                                        {{ $submission->note }} 
                                    </div> 
 
                                </div> 
 
                            @endif 
 
 
                            {{-- NEXA AI --}} 
                            <div class="ai-panel"> 
 
                                <div class="ai-panel-inner"> 
 
                                    <div class="ai-brand"> 
 
                                        <div class="ai-icon"> 
                                            <svg width="23" height="23" viewBox="0 0 24 24" 
                                                 fill="none" stroke="white" 
                                                 stroke-width="1.7"> 
                                                <path d="M12 3v4"/> 
                                                <path d="M12 17v4"/> 
                                                <path d="m4.22 4.22 2.83 2.83"/> 
                                                <path d="m16.95 16.95 2.83 2.83"/> 
                                                <path d="M3 12h4"/> 
                                                <path d="M17 12h4"/> 
                                                <path d="m4.22 19.78 2.83-2.83"/> 
                                                <path d="m16.95 7.05 2.83-2.83"/> 
                                                <circle cx="12" cy="12" r="4"/> 
                                            </svg> 
                                        </div> 
 
                                        <div> 
                                            <div class="ai-label"> 
                                                NEXA AI 
                                            </div> 
 
                                            <div class="ai-title"> 
                                                AI Cek Tugas 
                                            </div> 
 
                                            <div class="ai-description"> 
                                                Analisis kesesuaian, kualitas, kelengkapan, 
                                                dan saran perbaikan tugas. 
                                            </div> 
 
                                        </div> 
 
                                    </div> 
 
 
                                    @if(!$submission->aiAnalysis) 
 
                                        <form 
                                            method="POST" 
                                            action="{{ route('ai.analyze', $submission) }}" 
                                            onsubmit="startAiLoading(this)" 
                                        > 
 
                                            @csrf 
 
                                            <button 
                                                type="submit" 
                                                class="primary-button" 
                                            > 
 
                                                <span class="ai-button-text"> 
                                                    Analisis dengan NEXA AI 
                                                </span> 
 
                                                <span class="ai-button-loading hidden"> 
                                                    NEXA AI sedang menganalisis... 
                                                </span> 
 
                                            </button> 
 
                                        </form> 
 
                                    @else 
 
                                        <div class="inline-actions"> 
 
                                            <div class="status-badge status-done"> 
                                                ✓ Sudah Dianalisis 
                                            </div> 
 
                                            <a 
                                                href="{{ route('student.ai-chat', $submission) }}" 
                                                class="dark-button" 
                                            > 
                                                💬 Chat NEXA AI 
                                            </a> 
 
                                        </div> 
 
                                    @endif 
 
                                </div> 
 
                            </div> 
 
                        @else 
 
                            <div class="empty-submit"> 
 
                                <p> 
                                    Kamu belum mengumpulkan tugas ini. 
                                </p> 
 
                                <a 
                                    href="{{ route('student.submissions.create', $assignment) }}" 
                                    class="primary-button" 
                                > 
                                    📤 Kumpulkan Tugas 
                                </a> 
 
                            </div> 
 
                        @endif 
 
                    </div> 
                </div> 
 
 
                {{-- COUNTDOWN --}} 
                <div 
                    class="deadline-card" 
                    id="deadline-box" 
                    data-deadline="{{ \Carbon\Carbon::parse($assignment->deadline)->toIso8601String() }}" 
                > 
 
                    <div class="deadline-card-inner"> 
 
                        <div class="deadline-icon"> 
                            <svg width="21" height="21" viewBox="0 0 24 24" 
                                 fill="none" stroke="currentColor" 
                                 stroke-width="1.8"> 
                                <circle cx="12" cy="12" r="9"/> 
                                <path d="M12 7v5l3 2"/> 
                            </svg> 
                        </div> 
 
                        <div> 
 
                            <div class="deadline-label"> 
                                Batas waktu pengumpulan 
                            </div> 
 
                            <div id="deadline-countdown"> 
                                Menghitung... 
                            </div> 
 
                        </div> 
 
                    </div> 
 
                </div> 
 
 
                {{-- PROGRESS --}} 
                @if($submission) 
 
                    @php 
 
                        $progress = 25; 
 
                        if ($submission->aiAnalysis) { 
                            $progress = 50; 
                        } 
 
                        if ($submission->teacherReview) { 
                            $progress = 100; 
                        } 
 
                    @endphp 
 
                    <div class="nexa-card"> 
 
                        <div class="card-padding"> 
 
                            <div class="progress-header"> 
 
                                <div> 
 
                                    <div class="section-title"> 
                                        Progress Tugas 
                                    </div> 
 
                                    <div class="section-description"> 
                                        Pantau proses dari pengumpulan sampai penilaian. 
                                    </div> 
 
                                </div> 
 
                                <div> 
                                    <div class="progress-number"> 
                                        {{ $progress }}% 
                                    </div> 
 
                                    <div class="progress-label"> 
                                        progress 
                                    </div> 
                                </div> 
 
                            </div> 
 
 
                            <div class="progress-track"> 
 
                                <div 
                                    class="progress-fill" 
                                    style="width: {{ $progress }}%" 
                                ></div> 
 
                            </div> 
 
 
                            <div class="progress-grid"> 
 
                                {{-- DIKUMPULKAN --}} 
                                <div class="progress-step step-done"> 
 
                                    <div class="step-icon"> 
                                        📤 
                                    </div> 
 
                                    <div class="step-title"> 
                                        Dikumpulkan 
                                    </div> 
 
                                    <div class="step-description"> 
                                        Tugas berhasil dikumpulkan. 
                                    </div> 
 
                                    <div class="step-status green"> 
                                        ✓ Selesai 
                                    </div> 
 
                                </div> 
 
 
                                {{-- AI --}} 
                                <div class="progress-step {{ $submission->aiAnalysis ? 'step-ai' : 'step-wait' }}"> 
 
                                    <div class="step-icon"> 
                                        🤖 
                                    </div> 
 
                                    <div class="step-title"> 
                                        NEXA AI 
                                    </div> 
 
                                    @if($submission->aiAnalysis) 
 
                                        <div class="step-description"> 
                                            Tugas sudah dianalisis NEXA AI. 
                                        </div> 
 
                                        <div class="step-status purple"> 
                                            ✓ Selesai 
                                        </div> 
 
                                    @else 
 
                                        <div class="step-description"> 
                                            Menunggu analisis AI. 
                                        </div> 
 
                                        <div class="step-status muted"> 
                                            ⏳ Menunggu 
                                        </div> 
 
                                    @endif 
 
                                </div> 
 
 
                                {{-- GURU --}} 
                                <div class="progress-step {{ $submission->teacherReview ? 'step-review' : 'step-wait' }}"> 
 
                                    <div class="step-icon"> 
                                        👨‍🏫 
                                    </div> 
 
                                    <div class="step-title"> 
                                        Review Guru 
                                    </div> 
 
                                    @if($submission->teacherReview) 
 
                                        <div class="step-description"> 
                                            Guru sudah memberikan penilaian. 
                                        </div> 
 
                                        <div class="step-status blue"> 
                                            ✓ Selesai 
                                        </div> 
 
                                    @else 
 
                                        <div class="step-description"> 
                                            Menunggu pemeriksaan guru. 
                                        </div> 
 
                                        <div class="step-status muted"> 
                                            ⏳ Menunggu 
                                        </div> 
 
                                    @endif 
 
                                </div> 
 
 
                                {{-- SELESAI --}} 
                                <div class="progress-step {{ $submission->teacherReview ? 'step-done' : 'step-wait' }}"> 
 
                                    <div class="step-icon"> 
                                        🏆 
                                    </div> 
 
                                    <div class="step-title"> 
                                        Selesai 
                                    </div> 
 
                                    @if($submission->teacherReview) 
 
                                        <div class="step-description"> 
                                            Tugas sudah selesai dinilai. 
                                        </div> 
 
                                        <div class="step-status green"> 
                                            ✓ Selesai 
                                        </div> 
 
                                    @else 
 
                                        <div class="step-description"> 
                                            Belum selesai diproses. 
                                        </div> 
 
                                        <div class="step-status muted"> 
                                            ⏳ Menunggu 
                                        </div> 
 
                                    @endif 
 
                                </div> 
 
                            </div> 
 
                        </div> 
 
                    </div> 
 
                @endif 
 
 
                {{-- HASIL AI --}} 
                @if($submission && $submission->aiAnalysis) 
 
                    @php 
 
                        $aiScore = is_numeric($submission->aiAnalysis->score) 
                            ? max(0, min(100, (int) $submission->aiAnalysis->score)) 
                            : 0; 
 
                        if ($aiScore >= 85) { 
                            $scoreLabel = 'Sangat Baik'; 
                            $scoreClass = 'green'; 
                            $barClass = 'score-green'; 
 
                        } elseif ($aiScore >= 70) { 
                            $scoreLabel = 'Baik'; 
                            $scoreClass = 'blue'; 
                            $barClass = 'score-blue'; 
 
                        } elseif ($aiScore >= 55) { 
                            $scoreLabel = 'Perlu Ditingkatkan'; 
                            $scoreClass = 'orange'; 
                            $barClass = 'score-orange'; 
 
                        } else { 
                            $scoreLabel = 'Perlu Banyak Perbaikan'; 
                            $scoreClass = 'red'; 
                            $barClass = 'score-red'; 
                        } 
 
                    @endphp 
 
                    <div class="evaluation-title"> 
 
                        <h2> 
                            NEXA AI Evaluation 
                        </h2> 
 
                        <p> 
                            Analisis otomatis terhadap tugas yang kamu kumpulkan. 
                        </p> 
 
                    </div> 
 
 
                    <div class="metric-grid"> 
 
                        <div class="metric-card"> 
 
                            <div class="metric-label"> 
                                Score AI 
                            </div> 
 
                            <div class="metric-score"> 
                                {{ $submission->aiAnalysis->score ?? '-' }} 
                            </div> 
 
                            <div class="metric-small"> 
                                / 100 
                            </div> 
 
                        </div> 
 
 
                        <div class="metric-card"> 
 
                            <div class="metric-label"> 
                                Kelengkapan 
                            </div> 
 
                            <div class="metric-text"> 
                                {{ $submission->aiAnalysis->completeness ?? '-' }} 
                            </div> 
 
                        </div> 
 
 
                        <div class="metric-card"> 
 
                            <div class="metric-label"> 
                                Kualitas 
                            </div> 
 
                            <div class="metric-text"> 
                                {{ $submission->aiAnalysis->quality ?? '-' }} 
                            </div> 
 
                        </div> 
 
                    </div> 
 
 
                    {{-- SCORE METER --}} 
                    <div class="nexa-card"> 
 
                        <div class="card-padding"> 
 
                            <div class="score-meter-head"> 
 
                                <div> 
 
                                    <div class="score-meter-title"> 
                                        NEXA AI Score Meter 
                                    </div> 
 
                                    <div class="score-meter-subtitle"> 
                                        Visual hasil evaluasi otomatis terhadap tugas. 
                                    </div> 
 
                                </div> 
 
                                <div class="score-value {{ $scoreClass }}"> 
                                    {{ $aiScore }}/100 
                                </div> 
 
                            </div> 
 
 
                            <div class="score-track"> 
 
                                <div 
                                    class="score-fill {{ $barClass }}" 
                                    style="width: {{ $aiScore }}%" 
                                ></div> 
 
                            </div> 
 
 
                            <div class="score-scale"> 
                                <span>0</span> 
                                <span>25</span> 
                                <span>50</span> 
                                <span>75</span> 
                                <span>100</span> 
                            </div> 
 
                        </div> 
 
                    </div> 


                    {{-- SCORE BREAKDOWN --}} 
                    <div class="nexa-card"> 

                        <div class="card-padding"> 

                            <div class="score-meter-title"> 
                                Breakdown Nilai NEXA AI 
                            </div> 

                            <div class="score-meter-subtitle"> 
                                Nilai dihitung berdasarkan 5 aspek penilaian. 
                            </div> 

                            <div class="score-breakdown-grid"> 

                                <div class="score-breakdown-item"> 
                                    <div class="score-breakdown-top"> 
                                        <span>🎯 Kesesuaian Instruksi</span> 
                                        <strong>
                                            {{ $submission->aiAnalysis->instruction_score ?? 0 }}/30
                                        </strong> 
                                    </div> 

                                    <div class="breakdown-track"> 
                                        <div 
                                            class="breakdown-fill" 
                                            style="width: {{ min(100, max(0, (($submission->aiAnalysis->instruction_score ?? 0) / 30) * 100)) }}%"
                                        ></div> 
                                    </div> 
                                </div> 

                                <div class="score-breakdown-item"> 
                                    <div class="score-breakdown-top"> 
                                        <span>📋 Kelengkapan</span> 
                                        <strong>
                                            {{ $submission->aiAnalysis->completeness_score ?? 0 }}/25
                                        </strong> 
                                    </div> 

                                    <div class="breakdown-track"> 
                                        <div 
                                            class="breakdown-fill" 
                                            style="width: {{ min(100, max(0, (($submission->aiAnalysis->completeness_score ?? 0) / 25) * 100)) }}%"
                                        ></div> 
                                    </div> 
                                </div> 

                                <div class="score-breakdown-item"> 
                                    <div class="score-breakdown-top"> 
                                        <span>✨ Kualitas</span> 
                                        <strong>
                                            {{ $submission->aiAnalysis->quality_score ?? 0 }}/25
                                        </strong> 
                                    </div> 

                                    <div class="breakdown-track"> 
                                        <div 
                                            class="breakdown-fill" 
                                            style="width: {{ min(100, max(0, (($submission->aiAnalysis->quality_score ?? 0) / 25) * 100)) }}%"
                                        ></div> 
                                    </div> 
                                </div> 

                                <div class="score-breakdown-item"> 
                                    <div class="score-breakdown-top"> 
                                        <span>🧹 Kerapian</span> 
                                        <strong>
                                            {{ $submission->aiAnalysis->neatness_score ?? 0 }}/10
                                        </strong> 
                                    </div> 

                                    <div class="breakdown-track"> 
                                        <div 
                                            class="breakdown-fill" 
                                            style="width: {{ min(100, max(0, (($submission->aiAnalysis->neatness_score ?? 0) / 10) * 100)) }}%"
                                        ></div> 
                                    </div> 
                                </div> 

                                <div class="score-breakdown-item"> 
                                    <div class="score-breakdown-top"> 
                                        <span>⏰ Deadline</span> 
                                        <strong>
                                            {{ $submission->aiAnalysis->deadline_score ?? 0 }}/10
                                        </strong> 
                                    </div> 

                                    <div class="breakdown-track"> 
                                        <div 
                                            class="breakdown-fill" 
                                            style="width: {{ min(100, max(0, (($submission->aiAnalysis->deadline_score ?? 0) / 10) * 100)) }}%"
                                        ></div> 
                                    </div> 
                                </div> 

                            </div> 

                            <div class="breakdown-total"> 
                                <span>Total Nilai</span> 
                                <strong>
                                    {{ $submission->aiAnalysis->score ?? 0 }}/100
                                </strong> 
                            </div> 

                        </div> 

                    </div> 
 
 
                    {{-- DEADLINE STATUS --}} 
                    <div class="content-box"> 
 
                        <h3> 
                            ⏰ Status Deadline 
                        </h3> 
 
                        <p> 
                            {{ $submission->aiAnalysis->deadline_status ?? '-' }} 
                        </p> 
 
                    </div> 
 
 
                    {{-- RINGKASAN --}} 
                    <div class="content-box"> 
 
                        <h3> 
                            📄 Ringkasan 
                        </h3> 
 
                        <p> 
                            {{ $submission->aiAnalysis->summary ?? '-' }} 
                        </p> 
 
                    </div> 
 
 
                    {{-- KESESUAIAN --}} 
                    <div class="content-box"> 
 
                        <h3> 
                            🎯 Kesesuaian dengan Instruksi 
                        </h3> 
 
                        <p> 
                            {{ $submission->aiAnalysis->instruction_match ?? '-' }} 
                        </p> 
 
                    </div> 
 
 
                    {{-- KELEBIHAN & KEKURANGAN --}} 
                    <div class="two-column"> 
 
                        <div class="content-box positive"> 
 
                            <h3> 
                                ✓ Yang Sudah Baik 
                            </h3> 
 
                            <p> 
                                {{ $submission->aiAnalysis->strengths ?? '-' }} 
                            </p> 
 
                        </div> 
 
 
                        <div class="content-box negative"> 
 
                            <h3> 
                                ⚠ Yang Perlu Diperbaiki 
                            </h3> 
 
                            <p> 
                                {{ $submission->aiAnalysis->weaknesses ?? '-' }} 
                            </p> 
 
                        </div> 
 
                    </div> 
 
 
                    {{-- SARAN --}} 
                    <div class="content-box suggestion-box"> 
 
                        <h3> 
                            💡 Saran NEXA AI 
                        </h3> 
 
                        <p> 
                            {{ $submission->aiAnalysis->suggestions ?? '-' }} 
                        </p> 
 
                    </div> 
 
 
                    {{-- CHAT --}} 
                    <div class="chat-panel"> 
 
                        <div class="chat-brand"> 
 
                            <div class="chat-icon"> 
                                💬 
                            </div> 
 
                            <div> 
 
                                <div class="chat-label"> 
                                    NEXA AI ASSISTANT 
                                </div> 
 
                                <div class="chat-title"> 
                                    Tanya langsung tentang tugasmu 
                                </div> 
 
                                <div class="chat-description"> 
                                    Diskusikan nilai AI, kelemahan tugas, feedback guru, 
                                    atau tanyakan langkah revisi dengan NEXA AI. 
                                </div> 
 
                            </div> 
 
                        </div> 
 
                        <a 
                            href="{{ route('student.ai-chat', $submission) }}" 
                            class="dark-button" 
                        > 
                            💬 Buka NEXA AI Chat 
                        </a> 
 
                    </div> 
 
 
                @elseif($submission) 
 
                    <div class="nexa-card"> 
 
                        <div class="card-padding"> 
 
                            <div class="section-title-wrap"> 
 
                                <div class="section-icon"> 
                                    🤖 
                                </div> 
 
                                <div> 
 
                                    <h2 class="section-title"> 
                                        NEXA AI belum menganalisis tugas 
                                    </h2> 
 
                                    <p class="section-description"> 
                                        Gunakan tombol Analisis dengan NEXA AI 
                                        pada bagian pengumpulan tugas. 
                                    </p> 
 
                                </div> 
 
                            </div> 
 
                        </div> 
 
                    </div> 
 
                @endif 
 
 
                {{-- NILAI GURU --}} 
                @if($submission) 
 
                    <div class="nexa-card"> 
 
                        <div class="card-padding"> 
 
                            <div class="section-head"> 
 
                                <div class="section-title-wrap"> 
 
                                    <div class="section-icon"> 
                                        👨‍🏫 
                                    </div> 
 
                                    <div> 
 
                                        <h2 class="section-title"> 
                                            Penilaian Guru 
                                        </h2> 
 
                                        <p class="section-description"> 
                                            Nilai dan komentar dari guru setelah tugas diperiksa. 
                                        </p> 
 
                                    </div> 
 
                                </div> 
 
                            </div> 
 
 
                            @if($submission->teacherReview) 
 
                                <div class="teacher-score-grid"> 
 
                                    <div class="teacher-score"> 
 
                                        <div class="teacher-score-label"> 
                                            Nilai Guru 
                                        </div> 
 
                                        <div class="teacher-score-value"> 
                                            {{ $submission->teacherReview->score }} 
                                        </div> 
 
                                        <div class="metric-small"> 
                                            / 100 
                                        </div> 
 
                                    </div> 
 
 
                                    <div class="teacher-score"> 
 
                                        <div class="teacher-score-label"> 
                                            Komentar Guru 
                                        </div> 
 
                                        <div class="teacher-comment"> 
                                            {{ $submission->teacherReview->comment ?? 'Tidak ada komentar.' }} 
                                        </div> 
 
                                    </div> 
 
                                </div> 
 
                            @else 
 
                                <div class="waiting-box"> 
                                    ⏳ Tugas kamu belum diberikan penilaian oleh guru. 
                                </div> 
 
                            @endif 
 
                        </div> 
 
                    </div> 
 
                @endif 
 
            </div> 
 
        </div> 
 
    </div> 
 
 
    <script> 
 
        function startAiLoading(form) { 
 
            const button = form.querySelector('button'); 
 
            const text = button.querySelector('.ai-button-text'); 
 
            const loading = button.querySelector('.ai-button-loading'); 
 
            if (text) { 
                text.classList.add('hidden'); 
            } 
 
            if (loading) { 
                loading.classList.remove('hidden'); 
            } 
 
            button.disabled = true; 
            button.style.opacity = '0.7'; 
            button.style.cursor = 'wait'; 
        } 
 
 
        const deadlineBox = 
            document.getElementById('deadline-box'); 
 
        const countdown = 
            document.getElementById('deadline-countdown'); 
 
 
        if (deadlineBox && countdown) { 
 
            const deadline = 
                new Date( 
                    deadlineBox.dataset.deadline 
                ).getTime(); 
 
 
            function updateCountdown() { 
 
                const now = 
                    new Date().getTime(); 
 
                const distance = 
                    deadline - now; 
 
 
                if (distance <= 0) { 
 
                    countdown.textContent = 
                        '🔴 Deadline telah berakhir'; 
 
                    countdown.style.color = 
                        '#ff7070'; 
 
                    return; 
                } 
 
 
                const days = 
                    Math.floor( 
                        distance / 
                        (1000 * 60 * 60 * 24) 
                    ); 
 
 
                const hours = 
                    Math.floor( 
                        (distance % 
                        (1000 * 60 * 60 * 24)) / 
                        (1000 * 60 * 60) 
                    ); 
 
 
                const minutes = 
                    Math.floor( 
                        (distance % 
                        (1000 * 60 * 60)) / 
                        (1000 * 60) 
                    ); 
 
 
                const seconds = 
                    Math.floor( 
                        (distance % 
                        (1000 * 60)) / 
                        1000 
                    ); 
 
 
                countdown.textContent = 
                    `${days} hari ${hours} jam ${minutes} menit ${seconds} detik`; 
 
            } 
 
 
            updateCountdown(); 
 
            setInterval( 
                updateCountdown, 
                1000 
            ); 
 
        } 
 
    </script> 
 
    <style> 
        .score-green { 
            background: #3bd58d; 
            box-shadow: 0 0 15px rgba(59,213,141,.3); 
        } 
 
        .score-blue { 
            background: #4d8dff; 
            box-shadow: 0 0 15px rgba(77,141,255,.3); 
        } 
 
        .score-orange { 
            background: #f3a64b; 
            box-shadow: 0 0 15px rgba(243,166,75,.3); 
        } 
 
        .score-red { 
            background: #ff6262; 
            box-shadow: 0 0 15px rgba(255,98,98,.3); 
        } 
 
        .orange { 
            color: #f3a64b; 
        } 
 
        .red { 
            color: #ff7070; 
        } 
    </style> 
 
</x-app-layout>