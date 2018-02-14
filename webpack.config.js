console.log( __dirname );
module.exports = {
    entry: './js/block.jsx',
    output: {
        path: __dirname + '/js' ,
        filename: 'block.build.js',
    },
    module: {
        loaders: [
            {
                test: /.jsx$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
            },
        ],
    },
};