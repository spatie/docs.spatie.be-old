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
    hljs.registerLanguage('blade', require('highlight.js/lib/languages/xml'));
    hljs.initHighlighting();

})();

(function smallNav() {

    $('[data-nav-switch]').on('click', function () {
        viewport.root.toggleClass('$nav-small');
    });

    $(window).on('resize scroll', function() {
        if(viewport.state.large){
            viewport.root.removeClass('$nav-small');
        }
    });
})();

(function focusSearch() {
    $('#algolia-search').focus();
})();


(function versionSelection() {

    $('[data-version]').on('click', function(e){

        e.stopPropagation();
        $('[data-versions]').show();
    });

    $('body').on('click', function(){
        $('[data-versions]').hide();
    });
})();

