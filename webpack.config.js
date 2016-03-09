const autoprefixer = require('autoprefixer');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const webpack = require('webpack');

module.exports = {
    entry: {
        'backup.style': './resources/assets/sass/backup/backup.scss',
        'backup': './resources/assets/js/backup.js',
        'medialibrary': './resources/assets/js/medialibrary.js',
        'medialibrary.style': './resources/assets/sass/medialibrary/medialibrary.scss',
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