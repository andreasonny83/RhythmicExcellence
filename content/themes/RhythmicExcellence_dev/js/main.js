requirejs.config({

	paths: {
		'requireLib': 'require'
	},

	shim: {
		'jquery': {
			exports: '$'
		}
	},

	waitSeconds: 0,
});

require([
	'domReady',
	'app'
],
function( domReady, App ) {
	domReady( App.initialize );
});
