<!DOCTYPE html>
<html data-viewport class="$viewport-loading">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, shrink-to-fit=no">
    <meta name="description" content="@yield('pageDescription')">
    <title>@yield('title') | Docs</title>
    <link rel="stylesheet" href="https://cloud.typography.com/6194432/608542/css/fonts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/styles/default.min.css">
    <link rel="stylesheet" href="/build/style.css">
    <script src="/build/app.js" defer></script>
</head>
<body>

<h1>pagePath {{ $pagePath  }}</h1>
<h1>introPage {{ ends_with($pagePath, 'introduction') ? 'yup' : 'no no no' }}</h1>
    <header class="header">
        <div class="header_background" data-header-video></div>
        <div class="header_overlay"></div>
        <div class="header_content">
            <div class="grid">
                <a href="/laravel-backup/v3">
                    <h1 class="header_title">Laravel Backup <span class="header_title_version">v.3</span></h1>
                    <div>
                        <p class="header_slogan">Someday you'll thank us for this</p>
                    </div>
                </a>
                <div class="header_logos">
                    <a href="https://spatie.be" target="_external"><img class=header_logo src="/images/spatie.svg" alt="spatie"></a>
                    <a href="https://github.com/spatie/laravel-backup" target="_external"><img class=header_logo src="/images/github.svg" alt="Github"></a>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="grid">
            <div class="grid_col -width-1/3">

                <input id="algolia-search" placeholder="Search docs" class="algolia_search">

                <nav class="nav">
                {!! navigation()->backup() !!}
                </nav>
            </div>
            <div class="grid_col -width-2/3">
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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/docsearch.js/1/docsearch.min.js"></script>
    <script type="text/javascript"> docsearch({
            apiKey: '7a1f56fb06bd42e657e82bdafe86cef3',
            indexName: 'spatie_be',
            inputSelector: '#algolia-search',
            algoliaOptions: {
                'hitsPerPage': 5,
                'facetFilters': ['project:laravel-backup']
        }
        });
    </script>

</body>
</html>
