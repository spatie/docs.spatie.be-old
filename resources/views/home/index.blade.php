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
                <h1>Overview</h1>

                <h2>Laravel</h2>

                <h3><a href="/laravel-activitylog">Laravel-Activitylog Documentation</a></h3>
                <p>Log the activities of your users.</p>

                <h3><a href="/laravel-backup">Laravel-Backup Documentation</a></h3>
                <p>Backup your application and database to any filesystem you like.</p>

                <h3><a href="/laravel-medialibrary">Laravel-Medialibrary Documentation</a></h3>
                <p>Associate files with Eloquent models. Additionally the package can create image manipulations on images and pdfs that have been added in the medialibrary.</p>

                <h3><a href="/laravel-slack-slash-command">Laravel-Slack-Slash-Command Documentation</a></h3>
                <p>Make a Laravel app respond to a slash command from Slack.</p>

                <h3><a href="/laravel-tags">Laravel-Tags Documentation</a></h3>
                <p>A powerful tagging package. Batteries included.</p>

                <h3><a href="/laravel-uptime-monitor">Laravel-Uptime-Monitor Documentation</a></h3>
                <p>A powerful, easy to configure uptime monitor.</p>

                <h2>General PHP</h2>

                <h3><a href="/menu">Menu Documentation</a></h3>
                <p>Html menu generator.</p>

                <h3><a href="/image">Image Documentation</a></h3>
                <p>Manipulate images with an expressive API.</p>

                <hr>
                <p>Find even more <a href="https://spatie.be/en/opensource">Open Source projects</a> on our website.</p>

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
