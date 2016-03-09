<!DOCTYPE html>
<html data-viewport class="$viewport-loading {{ ends_with($pagePath, 'introduction') ? '$introduction' : '' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, shrink-to-fit=no">
    <meta name="description" content="@yield('pageDescription')">
    <title>@yield('title') | {{ $siteTitle }} Docs</title>
    <link rel="stylesheet" href="https://cloud.typography.com/6194432/608542/css/fonts.css"/>
    <link rel="stylesheet" href="/build/{{ $assetName }}.style.css">
    <script src="/build/{{ $assetName }}.js" defer></script>
</head>
<body>
@include('_partials.analytics')
<header class="header">
    <a href="#main" class="header_arrow" data-home-link></a>
    <div class="header_background" data-header-background></div>
    <div class="header_content">
        <div class="grid">
            <a href="{{ $baseUrl }}" data-home-link>
                <h1 class="header_title">{{ $siteTitle }} <span class="header_title_version">v.{{ $version }}</span>
                </h1>
                <br>
                <p class="header_slogan">{{ $siteSlogan }}</p>
            </a>
            <div class="header_logos">
                <a href="{{ $gitHubUrl }}" target="_external">
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
        <div class="grid_col -width-1/3">
            <div class="nav">
                <input id="algolia-search" placeholder="Search docs" class="nav_search">
                <nav class="nav_menu">
                    {!! $menu !!}
                </nav>
            </div>
            <div class="nav_button -menu" data-nav-switch>
            </div>
        </div>
        <div class="grid_col -width-2/3">
            <article class="article">
                @yield('content')
            </article>
            @include('_partials.toolbar')
        </div>
    </div>
</main>
<footer class="footer">
    <div class="grid">
        <div class="footer_content">
            © {{ Date('Y') }} • <a href="about-us/">About us</a>
            • <a href="{{ $gitHubUrl }}">Github</a>
        </div>
    </div>
    <a href="#" data-viewport-scroll class="nav_button -bottom">up</a>
</footer>
<script type="text/javascript" src="https://cdn.jsdelivr.net/docsearch.js/1/docsearch.min.js"></script>
<script type="text/javascript"> docsearch({
        apiKey: '7a1f56fb06bd42e657e82bdafe86cef3',
        indexName: 'spatie_be',
        inputSelector: '#algolia-search',
        algoliaOptions: {
            'hitsPerPage': 5,
            'facetFilters': ['{!!   trim($facetFilters) !!}']
        }
    });
</script>
</body>
</html>
