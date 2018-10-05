const autoprefixer = require('autoprefixer');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const webpack = require('webpack');

module.exports = {
    entry: {
        'home.style': './resources/sass/home/home.scss',
        'home': './resources/js/home.js',
        'laravel-backup.style': './resources/sass/laravel-backup/laravel-backup.scss',
        'laravel-backup': './resources/js/laravel-backup.js',
        'laravel-medialibrary': './resources/js/laravel-medialibrary.js',
        'laravel-medialibrary.style': './resources/sass/laravel-medialibrary/laravel-medialibrary.scss',
        'laravel-event-projector': './resources/js/laravel-event-projector.js',
        'laravel-event-projector.style': './resources/sass/laravel-event-projector/laravel-event-projector.scss',
        'menu': './resources/js/menu.js',
        'menu.style': './resources/sass/menu/menu.scss',
        'laravel-activitylog': './resources/js/laravel-activitylog.js',
        'laravel-activitylog.style': './resources/sass/laravel-activitylog/laravel-activitylog.scss',
        'laravel-slack-slash-command': './resources/js/laravel-slack-slash-command.js',
        'laravel-slack-slash-command.style': './resources/sass/laravel-slack-slash-command/laravel-slack-slash-command.scss',
        'laravel-uptime-monitor': './resources/js/laravel-uptime-monitor.js',
        'laravel-uptime-monitor.style': './resources/sass/laravel-uptime-monitor/laravel-uptime-monitor.scss',
        'image': './resources/js/image.js',
        'image.style': './resources/sass/image/image.scss',
        'laravel-tags': './resources/js/laravel-tags.js',
        'laravel-tags.style': './resources/sass/laravel-tags/laravel-tags.scss',
        'laravel-server-monitor': './resources/js/laravel-server-monitor.js',
        'laravel-server-monitor.style': './resources/sass/laravel-server-monitor/laravel-server-monitor.scss',
        'laravel-html': './resources/js/laravel-html.js',
        'laravel-html.style': './resources/sass/laravel-html/laravel-html.scss',
        'laravel-blade-x': './resources/js/laravel-blade-x.js',
        'laravel-blade-x.style': './resources/sass/laravel-blade-x/laravel-blade-x.scss',
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
