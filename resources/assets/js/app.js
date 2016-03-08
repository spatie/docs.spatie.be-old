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

    viewport.init({
        config: {
            start: 100,
            end: 200,
            small: 900
        }
    });

    $(window).on('scroll.introduction', function(){
        if(viewport.state.started){
            $('html').removeClass('$introduction');
            $(window).off('scroll.introduction');
        }
    })

    $('[data-header-video]').vide({
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
        bgColor: 'transparent',
    })

})();
