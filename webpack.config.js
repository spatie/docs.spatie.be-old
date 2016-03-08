const autoprefixer = require('autoprefixer');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
    entry: {
        'style': './resources/assets/sass/app.scss',
        'app': './resources/assets/js/app.js',
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
        new ExtractTextPlugin('style.css'),
    ],
    sassLoader: {
        includePaths: ['node_modules'],
    },
    postcss() {
        return [autoprefixer];
    },
};