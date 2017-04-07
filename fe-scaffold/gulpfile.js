const gulp = require('gulp');
const gutil = require('gulp-util');
const eslint = require('gulp-eslint');
const sass = require('gulp-sass');
const sassLint = require('gulp-sass-lint');
const image = require('gulp-image');
const postcss = require('gulp-postcss');
const changed = require('gulp-changed');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const del = require('del');
const sourcemaps = require('gulp-sourcemaps');
const buble = require('gulp-buble');
const rename = require('gulp-rename');
const connect = require('gulp-connect');
const rollup = require('rollup-stream');
const uglify = require('rollup-plugin-uglify');
const minify = require('uglify-js-harmony').minify;
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const includePaths = require('rollup-plugin-includepaths');
const nodeResolve = require('rollup-plugin-node-resolve');
const commonjs = require('rollup-plugin-commonjs');
const modernizr = require('gulp-modernizr');

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

const projSassEntry = projSrcDir + '/scss/main.scss';
const projSassSrc = projSrcDir + '/scss/**/*.scss';
const pubSassDest = projDestDir + '/stylesheets';
const localSassDest = '../css';

gulp.task('default', [ 'watch' ]);

gulp.task('html', function(){
	gutil.log('HTML UPDATED');
	return gulp.src(projHtmlSrc)
		.pipe( gulp.dest(projDestDir))
		.pipe(connect.reload());
});

gulp.task('js-lint', function(){
	return gulp.src([ projJsSrc , '!node_modules/**'])
		.pipe(eslint())
		.pipe(eslint.format());
});

gulp.task('cleanImage', function(){
	console.log("CLEAN")
	return del(
		[
			localImgDest,
			pubImgDest,
			"!.gitignore"
		],
		{
			force: true,
			dryrun: true
		}
	);
});

gulp.task('images', ['cleanImage'], function(){
	return gulp.src(projImgSrc)
	.pipe(changed(localImgDest))
	.pipe( image({ svgo: true }) )
	.pipe( gulp.dest(pubImgDest) )
	.pipe( gulp.dest(localImgDest) );
});

gulp.task('modernizr', function() {
	gulp.src(projJsSrc)
		.pipe(modernizr({
			cache: true,
			options: [
				'setClasses',
				'addTest',
				'html5printshiv',
				'testProp',
				'fnBind'
			],
			tests: [
				'backgroundcliptext'
			]
		}))
		.pipe(gulp.dest(projJsSrcDir))
});

gulp.task('sass', function(){
	return gulp.src(projSassEntry)
		.pipe( sourcemaps.init() )
		.pipe( sass( { outputStyle: 'compressed', includePaths: './node_modules' } )
		.on( 'error', sass.logError ) ) //compressed  on launch
		.pipe( postcss([ autoprefixer() ]) )
		.pipe( sourcemaps.write('.') )
		.pipe( gulp.dest(pubSassDest) )
		.pipe( gulp.dest(localSassDest) ) //send to local git wp dir
		.pipe(connect.reload());
});

gulp.task('sass-lint', function() {
	gulp.src([
		projSassSrc,
		'!./app/scss/partials/_reset.scss'])
			.pipe( sassLint({
				options: {
					configFile: '.sass-lint.yml'
				}
			}) )
			.pipe( sassLint.format() )
			.pipe( sassLint.failOnError() );
});

gulp.task('buildJS', [ 'js-lint', 'modernizr' ], function(){
	return rollup({
		format: 'umd', //umd,amd,cjs
		moduleName: 'mainBundle', //only for umd
		exports: 'named',
		entry: projJsSrcDir + '/main.js',
		sourceMap: true,
		plugins: [
			nodeResolve({
				jsnext: true,
				main: true,
				preferBuiltins: true,
				browser: true,
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
			uglify({}, minify)
		]
	})
	.pipe( source( 'main.js', projJsSrcDir ) )
	.pipe( buffer() )
	.pipe( sourcemaps.init( { loadMaps: true } ) )
	.pipe( buble() )
	.pipe( rename('bundle.js' ) )
	.pipe( sourcemaps.write('.') )
	.pipe( gulp.dest(pubJsDest) ) //send to scaffold env
	.pipe( gulp.dest(localJsDest) ) //send to wp dir
	.on('end', function() {
		del([projJsSrcDir + '/modernizr.js']);
	});

});

gulp.task('serve', [ 'build', 'watch'], function(){
	connect.server({
		port: 9000,
		root: [projDestDir],
		livereload: true
	});
});

gulp.task('reload', function(){
	gutil.log('reloaded');
	connect.reload();
});

gulp.task('build', ['images', 'html', 'sass', 'buildJS']);

gulp.task('watch', function(){
	gulp.watch('./app/**/*.html', ['html']);
	gulp.watch(projJsSrc, ['buildJS', 'reload']);
	gulp.watch(projSassSrc, ['sass', 'sass-lint', 'reload']);
});
