const defaultConfig = require( './node_modules/@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const ExtraneousFileCleanupPlugin = require( 'webpack-extraneous-file-cleanup-plugin' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );

module.exports = ( env, argv ) => {
	return {
		mode: argv.mode,
		entry: {
			main: './assets/src/js/main.js',
		},
		output: {
			path: path.resolve( __dirname, 'assets/dist' ),
			filename: './js/[name].js',
			publicPath: '../',
		},
		performance: {
			hints: false,
			maxEntrypointSize: 512000,
			maxAssetSize: 512000,
		},
		devtool: false,
		optimization: {
			minimize: false,
		},
		module: {
			rules: [
				{
					test: /\.js?$/,
					exclude: /node_modules/,
					use: [
						{
							loader: 'babel-loader',
						},
						...( ! argv.watch ? [
							{
								loader: 'eslint-loader',
								options: {
									configFile: ( 'production' === argv.mode ) ? '.eslintrc.prod' : '.eslintrc',
								},
							},
						] : [] ),
					],
				},
				{
					test: /\.scss$/,
					use: ExtractTextPlugin.extract( {
						fallback: 'style-loader',
						use: [
							{
								loader: 'css-loader',
								options: {
									import: false,
									importLoaders: 2,
								},
							},
							'postcss-loader',
							'sass-loader',
						],
					} ),
				},
			],
		},
		resolve: {
			extensions: [ '.js', '.jsx' ],
		},
		plugins: [
			...defaultConfig.plugins,
			new ExtractTextPlugin( './css/style.css' ),
			...( ! argv.watch ? [
				new StyleLintPlugin( {
					configFile: '.stylelintrc',
					context: 'assets/src/scss',
				} ),
			] : [] ),
			...( process.env.NODE_ENV === 'production' ? [
				new CleanWebpackPlugin(),
				new ExtraneousFileCleanupPlugin( {
					extensions: [ '.php' ],
					minBytes: 128,
				} ),
			] : [] ),
		],
		externals: {
			jquery: 'jQuery',
		},
	};
};
