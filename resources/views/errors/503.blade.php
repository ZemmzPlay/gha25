<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#0b0d14">
    <title>503 · Back shortly | 4th GHA-SCAI Shock Middle East</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('icons/manifest.json') }}">

    <style>
        :root {
            --brand: #D61B42;
            --brand-soft: rgba(214, 27, 66, .16);
            --bg: #0b0d14;
            --card: rgba(255, 255, 255, .06);
            --border: rgba(255, 255, 255, .12);
            --text: #f4f5f8;
            --muted: #a3a8b8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }
        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.55;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient glow */
        body::before, body::after {
            content: "";
            position: fixed;
            border-radius: 50%;
            filter: blur(110px);
            z-index: 0;
            pointer-events: none;
        }
        body::before { width: 520px; height: 520px; background: var(--brand); opacity: .28; top: -180px; right: -120px; }
        body::after  { width: 420px; height: 420px; background: #3b4cca; opacity: .22; bottom: -160px; left: -120px; }

        header, main, footer { position: relative; z-index: 1; }

        header { padding: 28px 24px; display: flex; justify-content: center; }
        header img { height: 48px; width: auto; max-width: 70vw; }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px 20px 40px;
        }
        .card {
            width: 100%;
            max-width: 720px;
            text-align: center;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 48px 32px;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, .45);
            animation: rise .7s ease both;
        }
        @keyframes rise { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }

        /* Heartbeat icon */
        .pulse {
            width: 96px; height: 96px;
            margin: 0 auto 22px;
            border-radius: 50%;
            background: var(--brand-soft);
            display: grid; place-items: center;
            position: relative;
        }
        .pulse::after {
            content: "";
            position: absolute; inset: 0;
            border-radius: 50%;
            border: 2px solid var(--brand);
            animation: ring 2.2s ease-out infinite;
        }
        @keyframes ring { from { transform: scale(1); opacity: .8; } to { transform: scale(1.55); opacity: 0; } }
        .pulse svg { width: 46px; height: 46px; stroke: var(--brand); fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .pulse svg path { stroke-dasharray: 90; stroke-dashoffset: 90; animation: draw 2.2s ease-in-out infinite; }
        @keyframes draw { 0% { stroke-dashoffset: 90; } 55%, 100% { stroke-dashoffset: 0; } }

        .code {
            display: inline-block;
            font-size: 13px; font-weight: 700; letter-spacing: .18em;
            color: var(--brand);
            background: var(--brand-soft);
            padding: 6px 14px;
            border-radius: 999px;
            margin-bottom: 18px;
        }
        h1 { font-size: clamp(28px, 5vw, 42px); line-height: 1.15; font-weight: 800; letter-spacing: -.02em; margin-bottom: 14px; }
        .lead { color: var(--muted); font-size: 17px; max-width: 520px; margin: 0 auto 32px; }

        .event {
            margin: 0 auto 30px;
            padding: 16px 18px;
            border: 1px dashed var(--border);
            border-radius: 14px;
            color: var(--muted);
            font-size: 14px;
        }
        .event strong { display: block; color: var(--text); font-size: 15px; margin-bottom: 2px; }

        .actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        .btn {
            appearance: none; cursor: pointer; text-decoration: none;
            font: inherit; font-weight: 600; font-size: 15px;
            padding: 13px 26px; border-radius: 12px;
            border: 1px solid var(--border);
            color: var(--text); background: transparent;
            transition: transform .15s ease, background .15s ease, box-shadow .15s ease;
        }
        .btn:hover { transform: translateY(-2px); background: rgba(255, 255, 255, .08); }
        .btn.primary { background: var(--brand); border-color: var(--brand); box-shadow: 0 10px 28px rgba(214, 27, 66, .4); }
        .btn.primary:hover { background: #e8244e; }
        .btn:focus-visible { outline: 3px solid #fff; outline-offset: 3px; }

        .status { margin-top: 22px; font-size: 13px; color: var(--muted); }
        .dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #f5a524; margin-right: 8px; animation: blink 1.4s infinite; }
        @keyframes blink { 50% { opacity: .25; } }

        footer { text-align: center; padding: 22px 16px 30px; font-size: 13px; color: var(--muted); }
        footer a { color: var(--text); text-decoration: none; border-bottom: 1px solid var(--border); }
        footer a:hover { border-color: var(--brand); }

        @media (max-width: 520px) {
            .card { padding: 36px 20px; border-radius: 20px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; }
            .pulse svg path { stroke-dashoffset: 0; }
        }
    </style>
</head>
<body>

<header>
    <img src="https://ghascaishock.com/images/global/logo_1757520503.svg" alt="GHA-SCAI Shock Middle East"
         onerror="this.onerror=null;this.src='{{ asset('images/ghaesc-logo.png') }}';">
</header>

<main>
    <section class="card" role="alert" aria-live="polite">
        <div class="pulse" aria-hidden="true">
            <svg viewBox="0 0 24 24"><path d="M3 12h4l2-6 4 12 2-6h6"/></svg>
        </div>

        <span class="code">ERROR 503</span>
        <h1>We'll be right back</h1>
        <p class="lead">
            Our servers are taking a short break for scheduled maintenance.
            We're updating the platform and getting registration ready. Thanks for your patience.
        </p>

        {{-- <div class="event">
            <strong>4th GHA-SCAI Shock Middle East</strong>
            January 15-16, 2027 · Kuwait
        </div> --}}

        <div class="actions">
            <button class="btn primary" onclick="location.reload()">Try again</button>
            <a class="btn" href="mailto:info@ghascaishock.com">Contact us</a>
        </div>

        <p class="status"><span class="dot"></span>Retrying automatically in <span id="retry">30</span>s</p>
    </section>
</main>

<footer>
    &copy; {{ date('Y') }} Gulf Heart Association &middot;
    Meeting organized by <a href="https://zawaya.me/conferences-and-events/" target="_blank" rel="noopener">Zawaya Conferences</a>
</footer>

<script>
    (function () {
        // Auto-retry every 30 seconds
        var left = 30, out = document.getElementById('retry');
        setInterval(function () {
            left--; out.textContent = left;
            if (left <= 0) location.reload();
        }, 1000);
    })();
</script>
</body>
</html>