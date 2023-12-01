const path = require('path')

module.exports = {
	mode: 'development',

	entry: {
		bundle: './assets/js/src/index.js',
	},

	output: {
		filename: '[name].js',
		path: path.resolve(__dirname, 'assets/js'),
	},

	externals: {
		jquery: 'jQuery',
	},

	plugins: [],

	module: {
		rules: [
			{
				enforce: 'pre',
				test: /.(js|jsx)$/,
				include: [path.resolve(__dirname, 'assets/js/src')],
				loader: 'eslint-loader',
			},
			{
				test: /.(js|jsx)$/,
				include: [path.resolve(__dirname, 'assets/js/src')],
				loader: 'babel-loader',

				options: {
					plugins: ['syntax-dynamic-import'],

					presets: [
						[
							'@babel/preset-env',
							{
								modules: false,
							},
						],
					],
				},
			},
		],
	},

	optimization: {
		splitChunks: {
			cacheGroups: {
				vendors: {
					priority: -10,
					test: /[\\/]node_modules[\\/]/,
				},
			},

			chunks: 'async',
			minChunks: 1,
			minSize: 30000,
			name: true,
		},
	},
}
