const gulp = require( 'gulp' );
const gutil = require( 'gulp-util' );
const eslint = require( 'gulp-eslint' );
const sass = require( 'gulp-sass' );
const sassLint = require( 'gulp-sass-lint' );
const image = require( 'gulp-image' );
const postcss = require( 'gulp-postcss' );
const changed = require( 'gulp-changed' );
const autoprefixer = require( 'autoprefixer' );
const cssnano = require( 'cssnano' );
const del = require( 'del' );
const sourcemaps = require( 'gulp-sourcemaps' );
const buble = require( 'gulp-buble' );
const rename = require( 'gulp-rename' );
const connect = require( 'gulp-connect' );
const rollup = require('rollup-stream');
const uglify = require( 'rollup-plugin-uglify' );
const minify = require( 'uglify-js-harmony' ).minify;
const source = require( 'vinyl-source-stream' );
const buffer = require( 'vinyl-buffer' );
const includePaths = require( 'rollup-plugin-includepaths' );
const nodeResolve = require( 'rollup-plugin-node-resolve' );
const commonjs = require( 'rollup-plugin-commonjs' );
const modernizr = require( 'gulp-modernizr' );
const { series, parallel } = require('gulp');

// Asset Pathing
const projSrcDir = './app';
const projDestDir = './pub';

const projHtmlSrc = projSrcDir + '/*.html';

const projImgSrc = projSrcDir + '/images/**/*';
const pubImgDest = projDestDir + '/images/optimized';
const localImgDest = '../images/optimized';

const projJsSrcDir = projSrcDir + '/javascript';
const projJsSrc =  projJsSrcDir + '/**/*.js';
const pubJsDest = projDestDir + '/javascript';
const localJsDest = '../js';

const projSassEntry = [ projSrcDir + '/scss/main.scss', projSrcDir + '/scss/editor.scss', projSrcDir + '/scss/styleguide.scss' ];
const projSassSrc = projSrcDir + '/scss/**/*.scss';
const pubSassDest = projDestDir + '/stylesheets';
const localSassDest = '../css';

// gulp.task( 'default', [ 'watch' ]);

function html() {
	return gulp.src( projHtmlSrc )
		.pipe( gulp.dest( projDestDir ) )
		.pipe( connect.reload() );
}

function cleanImages() {
	return del(
		[
			'../images/optimized/**/*',
			pubImgDest,
			'!.gitignore'
		],
		{
			force: true,
			dryrun: true
		}
	);
}

function buildImages() {
	return gulp.src( projImgSrc )
	.pipe( changed( localImgDest ) )
	.pipe( image({ svgo: true }) )
	.pipe( gulp.dest( pubImgDest ) )
	.pipe( gulp.dest( localImgDest ) );
}

function images(done) {
	return series(cleanImages, buildImages)(done);
}

function modernizrFn() {
	return gulp.src( projJsSrc )
		.pipe( modernizr({
			cache: true,
			options: [
				'setClasses',
				'addTest',
				'html5printshiv',
				'testProp',
				'fnBind'
			],
			tests: [
				'backgroundcliptext',
				'touchevents'
			]
		}) )
		.pipe( gulp.dest( projJsSrcDir ) );
}

function buildCSS() {
	return gulp.src( projSassEntry )
		.pipe( sourcemaps.init() )
		.pipe( sass({ outputStyle: 'compressed', includePaths: './node_modules' })
		.on( 'error', sass.logError ) ) //compressed  on launch
		.pipe( postcss([ autoprefixer() ]) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( pubSassDest ) )
		.pipe( gulp.dest( localSassDest ) ) //send to local git wp dir
		.pipe( connect.reload() );
}

function lintCSS() {
	return gulp.src([
		projSassSrc,
		'!./app/scss/partials/_reset.scss',
		'!./app/scss/vendor/*.scss' ])
			.pipe( sassLint({
				options: {
					configFile: '.sass-lint.yml'
				}
			}) )
			.pipe( sassLint.format() )
			.pipe( sassLint.failOnError() );
}

function css(done) {
	return series(lintCSS, buildCSS)(done);
}

function buildJS() {
	return rollup({
				format: 'iife',
				name: 'mainBundle', //only for umd
				exports: 'named',
				input: projJsSrcDir + '/main.js',
				sourcemap: true,
				plugins: [
					nodeResolve({
						mainFields: ['jsnext', 'main'],
						preferBuiltins: true,
						browser: true
					}),
					commonjs({
						ignoreGlobal: true,
						namedExports: {
							'./node_modules/gsap': [ 'TweenMax', 'EasePack' ]
						}
					}),
					includePaths({
						paths: [ projJsSrcDir + '/' ]
					}),
					uglify.uglify({}, minify )
				]
			})
		.pipe( source( 'main.js', projJsSrcDir ) )
		.pipe( buffer() )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( buble() )
		.pipe( rename( 'bundle.js' ) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( pubJsDest ) ) //send to scaffold env
		.pipe( gulp.dest( localJsDest ) ); //send to wp dir
		// .on( 'end', function() {
		// 	del([ projJsSrcDir + '/modernizr.js' ]);
		// });
	// done();
}

function lintJS() {
	return gulp.src([ projJsSrc, '!node_modules/**', '!vendor/*.js' ])
		.pipe( eslint() )
		.pipe( eslint.format() );
}

function js(done) {
	return series(lintJS, modernizrFn, buildJS)(done);
}

function serve() {
	connect.server({
		port: 9000,
		root: [ projDestDir ],
		livereload: true
	});
}

function reload() {
	gutil.log( 'reloaded' );
	connect.reload();
}

function watch() {
	gulp.watch( './app/**/*.html', html);
	gulp.watch( projJsSrc, buildJS,  reload);
	gulp.watch( projSassSrc, buildCSS, reload);

}

exports.html = html;
exports.watch = watch;
exports.build = parallel(images, html, css, js);
exports.lintJS = lintJS;
exports.buildJS = buildJS;
exports.lintCSS = lintCSS;
exports.buildCSS = css;
exports.lint = series(lintCSS, lintJS);

exports.serve = function serveFn(done){
	series(parallel(images, html, css, js), watch);
	serve();
	done();
};

exports.server = serve;
