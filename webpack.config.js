const autoprefixer = require('autoprefixer');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const webpack = require('webpack');

module.exports = {
    entry: {
        'home.style': './resources/assets/sass/home/home.scss',
        'home': './resources/assets/js/home.js',
        'laravel-backup.style': './resources/assets/sass/laravel-backup/laravel-backup.scss',
        'laravel-backup': './resources/assets/js/laravel-backup.js',
        'laravel-medialibrary': './resources/assets/js/laravel-medialibrary.js',
        'laravel-medialibrary.style': './resources/assets/sass/laravel-medialibrary/laravel-medialibrary.scss',
        'menu': './resources/assets/js/menu.js',
        'menu.style': './resources/assets/sass/menu/menu.scss',
        'laravel-activitylog': './resources/assets/js/laravel-activitylog.js',
        'laravel-activitylog.style': './resources/assets/sass/laravel-activitylog/laravel-activitylog.scss',
        'laravel-slack-slash-command': './resources/assets/js/laravel-slack-slash-command.js',
        'laravel-slack-slash-command.style': './resources/assets/sass/laravel-slack-slash-command/laravel-slack-slash-command.scss',
        'laravel-uptime-monitor': './resources/assets/js/laravel-uptime-monitor.js',
        'laravel-uptime-monitor.style': './resources/assets/sass/laravel-uptime-monitor/laravel-uptime-monitor.scss',
        'laravel-tags': './resources/assets/js/laravel-tags.js',
        'laravel-tags.style': './resources/assets/sass/laravel-tags/laravel-tags.scss',
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
