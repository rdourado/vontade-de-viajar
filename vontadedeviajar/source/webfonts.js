const fs = require('fs');
const webfontsGenerator = require('webfonts-generator');
const folder = './icons/';

fs.readdir(folder, (err, files) => {
	if (!files) return;

	const regex = new RegExp(/\.svg$/i);
	const fontFiles = files
		.map(file => folder + file)
		.filter(file => regex.test(file));

	if (!fontFiles.length) return;

	webfontsGenerator({
		files: fontFiles,
		dest: '../assets/fonts',
		cssDest: './css/_icons.scss',
		cssTemplate: './webfonts.hbs',
		cssFontsUrl: '../fonts',
		types: ['eot', 'woff2', 'woff', 'ttf', 'svg'],
		// normalize: true,
		fontHeight: 1001,
		templateOptions: {
			classPrefix: 'icon',
			baseSelector: '.icon'
		}
	}, function(error) {
		error ? console.log('Fail!', error) : console.log('Done!');
	});
});
