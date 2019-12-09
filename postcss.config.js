module.exports = {
	plugins: [
		require( 'autoprefixer' ),
		require( 'pixrem' )( {
			atrules: true,
		} ),
		require( 'perfectionist' )( {
			cascade: false,
			indentChar: '\t',
			indentSize: 1,
			trimLeadingZero: false,
		} ),
	],
};
