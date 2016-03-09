require('./_base');
const vide = require('vide');

(function headerVideo() {

    $('.\\$introduction [data-header-background]').vide({
        mp4: '/video/backup/header.mp4',
        webm: '/video/backup/header.webm',
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
