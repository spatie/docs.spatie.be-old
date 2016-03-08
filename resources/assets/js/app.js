const $ = require('jquery');
const viewport = require('viewport-utility');
const hljs = require('highlight.js/lib/highlight');
const vide = require('vide');


(function syntaxHighlighting() {

    hljs.registerLanguage('bash', require('highlight.js/lib/languages/bash'));
    hljs.registerLanguage('php', require('highlight.js/lib/languages/php'));
    hljs.initHighlighting();

})();

(function interfaceGoodies() {


    if(window.location.hash == '#clean'){
        $('html').removeClass('$introduction').addClass('$header-clear-animation');
    }

    $('[data-home-link]').on('click', function (e) {

        e.preventDefault();

        if($('html').hasClass('$introduction')){
            $('html').removeClass('$introduction');
            return;
        }

        window.location = $(this).attr('href');
    });


    viewport.init({
        config: {
            start: 50,
            end: 200,
            small: 900
        }
    });

    $(window).on('scroll.introduction', function () {
        if (viewport.state.started) {
            $('html').removeClass('$introduction');
            $(window).off('scroll.introduction');
        }
    });

    $('.\\$introduction [data-header-video]').vide({
        mp4: '/video/header.mp4',
        webm: '/video/header.webm'
    }, {
        volume: 0,
        playbackRate: 1,
        muted: true,
        loop: true,
        autoplay: true,
        position: '0% 0%',
        posterType: 'none',
        resizing: true,
        bgColor: 'transparent'
    });

    $('[data-nav-switch]').on('click', function () {
        $('html').toggleClass('$nav-mobile');
    });




})();
