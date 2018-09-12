const path    = require('path');
const webpack = require('webpack');
const nodeDir = path.join(__dirname, 'node_modules');

module.exports = {
    entry: [
        './resources/assets/js/app.js'
    ],
    output: {
        path: path.resolve(__dirname, 'public/js'),
        filename: 'app.js',
    },
    resolve: {
      alias: {
          "jquery-ui": path.resolve(nodeDir, "jquery-ui/ui/widgets/autocomplete.js")
      }
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
                query: {
                    presets: ['es2015'],
                    plugins: ['syntax-dynamic-import', 'transform-runtime']
                }
            },
        ]
    },
    plugins: [
        new webpack.NoEmitOnErrorsPlugin(),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: 'jquery',
            "window.jQuery": "jquery",
        })
    ],
    stats: {
        colors: true
    }
};