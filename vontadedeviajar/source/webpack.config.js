module.exports = function(env = {}) {
    const prod = !!env.production;

    const babel = {
        test: /\.jsx?$/,
        use: [{
            loader: 'babel-loader',
            options: {
                presets: ['env']
            }
        }]
    };

    return {
        devtool: prod ? '' : 'inline-source-map',
        plugins: [],
        module: {
            rules: [babel]
        }
    };
};
