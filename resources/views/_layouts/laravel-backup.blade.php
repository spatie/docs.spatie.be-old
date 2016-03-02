<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, shrink-to-fit=no">
    <meta name="description" content="@yield('pageDescription')">
    <title>@yield('title') | Docs</title>
    <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/6194432/608542/css/fonts.css" />
    <link rel="stylesheet" href="/css/app.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
    <header class="header">
        <div class="header_background">
        </div>
        <div class="grid">
            <div class="grid_col -2/3">
                <a href="/laravel-backup/v3">
                    <h1 class="header_title">Laravel Backup <span class="header_title_version">v.3</span></h1>
                </a>
            </div>
            <div class="grid_col -1/3">
                <div class="header_logos">
                    <a href="https://spatie.be" target="_external"><img class=header_logo src="/images/spatie.svg" alt="spatie"></a>
                    <a href="https://github.com/spatie/laravel-backup" target="_external"><img class=header_logo src="/images/github.svg" alt="Github"></a>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="grid">
            <div class="grid_col -1/3">
                <nav class="nav">
                {!! navigation()->backup() !!}
                </nav>
            </div>
            <div class="grid_col -2/3">
                <article class="article">
                @yield('content')
                </article>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer_background">
        </div>
        <div class="grid">
            © {{ Date('Y') }} • <a href="about-us/">About us</a>
            • <a href="https://github.com/spatie/laravel-backup">Github</a>
        </div>
        <div class="visual"></div>
    </footer>
</body>
</html>
