
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const isProd = process.env.NODE_ENV === 'production';
const WP_HOST = process.env.WP_HOST || 'wp.local'; // set your local WP host

module.exports = {
  entry: { main: path.resolve(__dirname, 'src/index.jsx') },
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'dist/assets'),
    publicPath: '/assets/',
    clean: true
  },
  mode: isProd ? 'production' : 'development',
  devtool: isProd ? 'source-map' : 'eval-cheap-module-source-map',
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: { loader: 'babel-loader' } // Babel 7.28.x + loader v10
      },
      {
        test: /\.css$/,
        use: [
          isProd ? MiniCssExtractPlugin.loader : 'style-loader',
          { loader: 'css-loader', options: { sourceMap: !isProd } },
          { loader: 'postcss-loader', options: { sourceMap: !isProd } }
        ]
      }
    ]
  },
  resolve: { extensions: ['.js', '.jsx'] },
  plugins: [new MiniCssExtractPlugin({ filename: 'main.css' })],
  devServer: {
    host: 'localhost',
    port: 3000,
    hot: true,
    static: false,
    headers: { 'Access-Control-Allow-Origin': '*' },
    // IMPORTANT: match the WP origin to pass new security checks (5.2.1+)
    // https://nvd.nist.gov/vuln/detail/CVE-2025-30360
    allowedHosts: [WP_HOST], // e.g., 'wp.local'
    devMiddleware: { writeToDisk: false }
  }
};
