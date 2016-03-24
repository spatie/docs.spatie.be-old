const viewport = require('viewport-utility');
const hljs = require('highlight.js/lib/highlight');

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
    hljs.registerLanguage('html', require('highlight.js/lib/languages/xml'));
    hljs.initHighlighting();

})();

(function smallNav() {

    $('[data-nav-switch]').on('click', function () {
        $('html').toggleClass('$nav-small');
    });

})();
