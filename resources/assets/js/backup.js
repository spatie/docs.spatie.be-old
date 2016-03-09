const $ = require('jquery');
const viewport = require('viewport-utility');
const hljs = require('highlight.js/lib/highlight');
const vide = require('vide');

viewport.init({
    config: {
        start: 50,
        end: 200,
        small: 900,
    },
});

(function syntaxHighlighting() {

    hljs.registerLanguage('bash', require('highlight.js/lib/languages/bash'));
    hljs.registerLanguage('php', require('highlight.js/lib/languages/php'));
    hljs.initHighlighting();

})();

(function introductionScroll() {

    if (window.location.hash == '#clean') {
        makeHeaderSmall().addClass('$header-clear-animation');
    }

    $(window).on('scroll.introduction', function () {
        if (viewport.state.started) {
            makeHeaderSmall();
            $(window).off('scroll.introduction');
        }
    });

    $('[data-home-link]').on('click', function (e) {

        e.preventDefault();

        if ($('html').hasClass('$introduction')) {
            makeHeaderSmall();
            return;
        }

        window.location = $(this).attr('href');
    });

    function makeHeaderSmall() {
        return $('html').removeClass('$introduction');
    }

})();

(function backupVideo() {

    $('.\\$introduction [data-backup-video]').vide({
        mp4: '/video/header.mp4',
        webm: '/video/header.webm',
    }, {
        volume: 0,
        playbackRate: 1,
        muted: true,
        loop: true,
        autoplay: true,
        position: '0% 0%',
        posterType: 'none',
        resizing: true,
        bgColor: 'transparent',
    });

})();

(function smallNav() {

    $('[data-nav-switch]').on('click', function () {
        $('html').toggleClass('$nav-small');
    });

})();
