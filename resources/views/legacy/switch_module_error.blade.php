<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - pristup nije moguć</title>
    <style>
        :root { color-scheme: light dark; }
        body { margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; background: #f4f5f7; color: #1f2937; }
        @media (prefers-color-scheme: dark) { body { background: #111827; color: #e5e7eb; } .box { background: #1f2937; } }
        .box { max-width: 560px; margin: 16px; padding: 32px; border-radius: 12px; background: #fff; box-shadow: 0 10px 30px rgba(0,0,0,.08); text-align: center; }
        h1 { margin: 0 0 12px; font-size: 48px; font-weight: 700; color: #b91c1c; }
        p { line-height: 1.5; margin: 0 0 16px; }
        a { color: #2563eb; text-decoration: none; font-weight: 600; }
        a:hover { text-decoration: underline; }
        .foot { font-size: 13px; opacity: .7; margin-top: 24px; }
    </style>
</head>
<body>
    <div class="box">
        <h1>403</h1>
        <p>{{ $error_msg ?? 'Pristup nije moguć.' }}</p>
        @if (! empty($url))
            <p><a href="{{ $url }}">Početna strana Kancelarka</a></p>
        @endif
        <p class="foot">{{ date('Y') }} &copy; Paragraf Lex</p>
    </div>
</body>
</html>
