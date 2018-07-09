const webpack = require('webpack');
const path = require('path');
const CleanWebpackPlugin = require('clean-webpack-plugin');
//const UglifyJsPlugin = require('uglifyjs-webpack-plugin')

module.exports = {
    entry: {
        polyfills: ['./src/js/polyfills.js'],
        global: ['./src/js/global.js'],
        iolazy: ['./src/js/iolazy.js'],
        photoswipe: ['./src/js/photoswipe.js']
    },
    module: {
        rules: [
            {
                test: /\.js?$/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            babelrc: false,
                            presets: [['env', { modules: false }], 'stage-0'],
                            plugins: ['transform-regenerator', 'transform-runtime']
                        }
                    }
                ],
                exclude: /node_modules/
            },
            {
                test: /\.css$/,
                use: [
                    'style-loader'
                ]
            },
            {
                test: /\.(png|svg|jpg|gif)$/,
                use: [
                    'file-loader'
                ]
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                use: [
                    'file-loader'
                ]
            }
        ]
    },
    plugins: [
        //new UglifyJsPlugin(),
        new webpack.HotModuleReplacementPlugin(),
        new CleanWebpackPlugin(['public/js']),
    ],
    output: {
        filename: '[name].bundle.js',
        path: path.resolve(__dirname, 'public/js'),
        publicPath: '/public'
    },
};