<!DOCTYPE html>
<html data-viewport class="$viewport-loading">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, shrink-to-fit=no">
    <meta name="description" content="Documentation overview for Open Source packages from Spatie.">
    <title>Open Source Docs | Spatie</title>
    <link rel="stylesheet" href="https://cloud.typography.com/6194432/608542/css/fonts.css"/>
    <link rel="stylesheet" href="/build/home.style.css">
    <script src="/build/home.js" defer></script>
</head>
<body>
@include('_partials.analytics')
<header class="header">
    <div class="header_background" data-header-background></div>
    <div class="header_content">
        <div class="grid">
            <div class="header_caption">
                <h1 class="header_caption_title">
                    <a href="/" >Spatie Docs</a>
                </h1>
                <br>
                <p class="header_caption_slogan">Documentation for our comprehensive packages</p>
            </div>
            <div class="header_logos">
                <a href="https://github.com/spatie" target="_external">
                    @include('_partials.svg.github')
                </a>
                <a href="https://spatie.be" target="_external">
                    @include('_partials.svg.spatie')
                </a>
            </div>
        </div>
    </div>
</header>
<main class="main" id="main">
    <div class="grid">
        <div class="grid_col -width-2/3">
            <article class="article">
                <h1>Docs not found</h1>

                <div class="alert -info">
                <p>We know nothing about <strong>{{ ltrim($_SERVER['REQUEST_URI'], '/') }}</strong> — or it has yet to be written.<br>
                    Help us out on <a href="https://github.com/spatie/docs.spatie.be" target="_external">Github</a> if you know more.
                </p>
                </div>
                <hr>
                <p>What do we know? These are all available documentation sections:</p>
                @include('home._partials.overview')

                <hr>
                <p>Find even more <a href="https://spatie.be/en/opensource">Open Source projects</a> on our website.</p>.</p>

            </article>
        </div>
    </div>
</main>
<footer class="footer">
    <div class="grid">
        <div class="footer_content">
            © {{ date('Y') }} • <a href="https://spatie.be/">Spatie</a>
            • <a href="https://github.com/spatie">Github</a>
        </div>
    </div>
    <a href="#" data-viewport-scroll class="nav_button -bottom">up</a>
</footer>
</body>
</html>
