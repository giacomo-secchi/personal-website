const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const CompressionPlugin = require('compression-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');


module.exports = {
  mode: 'development',
  entry: {
    main: path.resolve(__dirname, './src/js/main.js'),
    print: path.resolve(__dirname, './src/scss/print.scss'),
  },
  output: {
    // // filename: 'main.js',
    // path: path.resolve(__dirname, 'dist'),
    filename: '[name].min.js',
    path: __dirname + '/dist',
    clean: true,
  },
  plugins: [
    new MiniCssExtractPlugin({
      // Options similar to the same options in webpackOptions.output
      // both options are optional
      filename: "[name].min.css",
    }),
    new CompressionPlugin({
      algorithm: 'gzip',
    })
  ],
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ],
      },
      {
        test: /\.svg$/,
        use: [
          {
            loader: "svg-sprite-loader",
            options: {
              extract: true,
              spriteFilename: `bootstrap-icons.svg`
            }
          },
        ],
        include: [
          path.resolve(__dirname, 'node_modules/bootstrap-icons')
        ]
      }
    ],
  },
  optimization: {
    minimize: true,
    minimizer: [
      // For webpack@5 you can use the `...` syntax to extend existing minimizers (i.e. `terser-webpack-plugin`), uncomment the next line
      // `...`,
      new CssMinimizerPlugin(),
      new TerserPlugin(),
    ],
  },
};