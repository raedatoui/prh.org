const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const cssnano = require('cssnano');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const TerserJSPlugin = require('terser-webpack-plugin');

function recursiveIssuer(m) {
    if (m.issuer) {
        return recursiveIssuer(m.issuer);
    } else if (m.name) {
        return m.name;
    } else {
        return false;
    }
}

module.exports = {
    entry: {
        bundle: './src/index.js',
        editor: './src/editor.js',
        styleguide: './src/styleguide.js'
    },
    devtool: 'source-map',
    optimization: {
        splitChunks: {
            cacheGroups: {
                appStyles: {
                    name: 'bundle',
                    test: (m, c, entry = 'bundle') =>
                        m.constructor.name === 'CssModule' && recursiveIssuer(m) === entry,
                    chunks: 'all',
                    enforce: true,
                },
                styleguideStyles: {
                    name: 'editor',
                    test: (m, c, entry = 'styleguide') =>
                        m.constructor.name === 'CssModule' && recursiveIssuer(m) === entry,
                    chunks: 'all',
                    enforce: true,
                },
                editorStyles: {
                    name: 'editor',
                    test: (m, c, entry = 'editor') =>
                        m.constructor.name === 'CssModule' && recursiveIssuer(m) === entry,
                    chunks: 'all',
                    enforce: true,
                },
            },
        },
        minimizer: [
            new TerserJSPlugin({
                test: /\.js(\?.*)?$/i,
                exclude: /(node_modules)/,
                extractComments: true,
                sourceMap: true
            }),
            new OptimizeCSSAssetsPlugin({
                assetNameRegExp: /\.optimize\.css$/g,
                cssProcessor: cssnano,
                cssProcessorPluginOptions: {
                    preset: ['default', { discardComments: { removeAll: true } }],
                    sourceMap: true
                },
                canPrint: true
            })],

    },
    plugins: [
        new CleanWebpackPlugin(),
        new MiniCssExtractPlugin({
            filename: 'css/[name].css',
            chunkFilename: '[id].css',
            ignoreOrder: false
        })
    ],
    module:{
        rules: [
            {
                test: [/.js$/],
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: [/.css$|.scss$/],
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            sourceMap: true,
                            hmr: process.env.NODE_ENV === 'development',
                        },
                    },
                    { loader: 'css-loader', options: { sourceMap: true } },
                    { loader: 'sass-loader', options: { sourceMap: true } }
                ]
            },
            {
                test: /\.(png|jpg|gif)$/i,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 8192,
                        },
                    },
                ],
            },
            {
                test: /\.svg$/,
                loader: 'file-loader'
            }
        ],

    },
    output: {
        filename: 'js/[name].js',
        libraryTarget: 'umd',
        path: path.resolve(__dirname, 'dist/'),
        globalObject: `(typeof self !== 'undefined' ? self : this)`
    }
};
