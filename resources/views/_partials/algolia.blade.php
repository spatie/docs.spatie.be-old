<script type="text/javascript" src="https://cdn.jsdelivr.net/docsearch.js/1/docsearch.min.js"></script>
<script type="text/javascript"> docsearch({
        apiKey: '7a1f56fb06bd42e657e82bdafe86cef3',
        indexName: 'spatie_be',
        inputSelector: '#algolia-search',
        algoliaOptions: {
            'hitsPerPage': 5,
            'facetFilters': ['project:{{ $package }}', 'version:{{ $version }}']
        }
    });
</script>