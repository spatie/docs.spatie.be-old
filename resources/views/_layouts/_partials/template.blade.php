<!DOCTYPE html>
<html data-viewport class="$viewport-loading">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, shrink-to-fit=no">
    <meta name="description" content="@yield('pageDescription')">
    <title>@yield('title') | {{ $siteTitle }} Docs</title>
    <link rel="stylesheet" href="https://cloud.typography.com/6194432/608542/css/fonts.css"/>
    <link rel="stylesheet" href="/build/{{ $package }}.style.css">
    <script src="/build/{{ $package }}.js" defer></script>
</head>
<body>
@include('_partials.analytics')
<header class="header">
    <div class="header_background" data-header-background></div>
    <div class="header_content">
        <div class="grid">
            <div class="header_caption">

                {{-- Without dropdown --}}
                {{--
                <h1 class="header_caption_title">
                    <a href="/{{ $package }}/{{ $version }}" >{{ $siteTitle }}</a>
                    <span class="header_caption_version">v.{{ substr($version, 1) }}</span>
                </h1>
                --}}
                {{-- End without dropdown --}}

                {{-- With dropdown --}}
                <h1 class="header_caption_title">
                    <a class="header_caption_title_link" href="/{{ $package }}/{{ $version }}" >{{ $siteTitle }}</a>
                    @if (count($versions) > 1)
                        <a href="#" data-version class="header_version -selectable">
                            v.{{ substr($version, 1) }}
                            <span class="header_version_caret"></span>
                        </a>
                    @endif
                </h1>
                @if (count($versions) > 1)
                    <ul data-versions class="header_version_dropdown" style="display:none" >
                        @foreach($versions as $v)
                            <li class="{{ $version === $v ? '-current' : '' }}">
                                <a href="/{{ $package }}/{{ $v }}" >v.{{ substr($v, 1) }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                {{-- End with dropdown --}}
                <br>
                <p class="header_caption_slogan">{!! $siteSlogan !!}</p>
            </div>
            <div class="header_logos">
                <a href="{{ $githubUrl }}" target="_external">
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
                    {!! menu() !!}
                </nav>
            </div>
            <div class="nav_button -menu" data-nav-switch>
            </div>
        </div>
        <div class="grid_col -width-2/3">
            <article class="article">
                @yield('content')

                @include('_partials.pagination')

            </article>
            @include('_partials.toolbar')
        </div>
    </div>
</main>
<footer class="footer">
    <div class="grid">
        <div class="footer_content">
            © {{ Date('Y') }} • <a href="/">Spatie Docs</a>
            • <a href="{{ $githubUrl }}">Github</a>
        </div>
    </div>
    <a href="#" data-viewport-scroll class="nav_button -bottom">up</a>
</footer>

@include('_partials.algolia')

</body>
</html>
