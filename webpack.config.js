const autoprefixer = require('autoprefixer');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const webpack = require('webpack');

module.exports = {
    entry: {
        'laravel-backup.style': './resources/assets/sass/laravel-backup/laravel-backup.scss',
        'laravel-backup': './resources/assets/js/laravel-backup.js',
        'laravel-medialibrary': './resources/assets/js/laravel-medialibrary.js',
        'laravel-medialibrary.style': './resources/assets/sass/laravel-medialibrary/laravel-medialibrary.scss',
        'menu': './resources/assets/js/menu.js',
        'menu.style': './resources/assets/sass/menu/menu.scss',
    },
    output: {
        path: 'public/build',
        filename: '[name].js',
    },
    module: {
        loaders: [
            {
                test: /\.scss$/,
                loader: ExtractTextPlugin.extract('style', 'css!sass!postcss'),
            },
            {
                test: /\.svg$/,
                loader: 'url',
            },
        ],
    },
    resolve: {
        extensions: ['', '.js', '.css', '.scss'],
    },
    plugins: [
        new ExtractTextPlugin('[name].css'),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
        })
    ],
    sassLoader: {
        includePaths: ['node_modules'],
    },
    postcss() {
        return [autoprefixer];
    },
};
