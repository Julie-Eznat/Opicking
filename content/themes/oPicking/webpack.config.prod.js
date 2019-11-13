// Fichier de configuration à utiliser dans un environnement de production

const webpack = require("webpack");
const path = require("path");
const TerserPlugin = require('terser-webpack-plugin');
const MiniCSSExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const autoprefixer = require('autoprefixer');

let config = {
  entry: [
    './app/js/app.js',
    './app/scss/main.scss',
  ],
  mode: 'production',
  output: {
    path: path.resolve(__dirname, "./public"),
    filename: "js/app.js"
  },
  optimization: {
    minimizer: [
      new TerserPlugin({
        cache: true,
        parallel: true,
        sourceMap: false,
      }),
      new OptimizeCSSAssetsPlugin({}),
    ],
  },
  module: {
    rules: [
      // Sass
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          MiniCSSExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              plugins: function() {
                return autoprefixer({
                  browsers: ['last 4 versions']
                });
              }
            }
          },
          'sass-loader'
        ]
      },
      // Images
      {
        test: /\.(jpg|jpeg|png|svg|gif)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'images/',
              publicPath: '../images'
            }
          }
        ]
      },
      // Fonts
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
        use: [
          {
            loader: 'file-loader',
            options: {
                name: '[name].[ext]',
                outputPath: 'fonts/',
                publicPath: '../fonts'
            }
          },
          
        
        ]
      }
    ],
  },
  plugins: [
    new MiniCSSExtractPlugin({
      filename: 'css/style.css'
    }),
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
    }),
    new CopyPlugin([
      {
        from: 'app/assets/**',
        to: '.',
        toType: 'dir',
        transformPath: (targetPath) => targetPath.replace(/^app\/assets\//, '')
      }
    ]),
  ]
};

module.exports = config;
