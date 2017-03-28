const gulp = require('gulp');
const gutil = require('gulp-util');
const jshint = require('gulp-jshint');
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
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const includePaths = require('rollup-plugin-includepaths');
const nodeResolve = require('rollup-plugin-node-resolve');
const commonjs = require('rollup-plugin-commonjs');
const modernizr = require('gulp-modernizr');


gulp.task('default', [ 'watch' ]);

gulp.task('html', function(){

  gutil.log('HTML UPDATED');
  return gulp.src('./app/*.html')
    .pipe( gulp.dest('./pub'))
    .pipe(connect.reload());
});

gulp.task('jshint', function(){
  return gulp.src('./app/javascript/**/*.js')
    .pipe( jshint() )
    .pipe( jshint.reporter('jshint-stylish') );
});

gulp.task('cleanImage', function(){
  console.log("CLEAN")
  return del(
    [
      './pub/images/optimized',
      '../images/optimized'
    ],
    {
      force: true,
      dryrun: true
    }
  );
});

gulp.task('images', ['cleanImage'], function(){
  return gulp.src('./app/images/**/*')
  .pipe(changed('../images/optimized'))
  .pipe( image({ svgo: true }) )
  .pipe( gulp.dest( './pub/images/optimized' ) )
  .pipe( gulp.dest( '../images/optimized' ) );
});

gulp.task('modernizr', function() {
  gulp.src('./app/javascript/**/*.js')
    .pipe(modernizr())
    .pipe(gulp.dest("./app/javascript"))
});

gulp.task('sass', function(){
  return gulp.src('./app/scss/main.scss')
    .pipe( sourcemaps.init() )
    .pipe( sass( { outputStyle: 'compressed', includePaths: './node_modules' } ).on( 'error', sass.logError ) ) //compressed  on launch
    .pipe( postcss([ require('autoprefixer') ]) )
    .pipe( sourcemaps.write('.') )
    .pipe( gulp.dest('./pub/stylesheets') )
    .pipe( gulp.dest('../css') ) //send to local git wp dir
    .pipe(connect.reload());
});

gulp.task('sass-lint', function() {
  gulp.src([
    './app/scss/**/*.scss',
    '!./app/scss/partials/_reset.scss'])
      .pipe( sassLint({
        options: {
          configFile: '.sass-lint.yml'
        }
      }) )
      .pipe( sassLint.format() )
      .pipe( sassLint.failOnError() );
});

gulp.task('buildJS', [ 'jshint', 'modernizr', 'images' ], function(){
  return rollup({
    format: "umd", //umd,amd,cjs
    moduleName: "mainBundle", //only for umd
    exports: "named",
    entry: "./app/javascript/main.js",
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
        paths: [ './app/javascript/' ]
      }),
      uglify()
    ]
  })
  .pipe( source( 'main.js', './app/javascript' ) )
  .pipe( buffer() )
  .pipe( sourcemaps.init( { loadMaps: true } ) )
  .pipe( buble() )
  .pipe( rename('bundle.js' ) )
  .pipe( sourcemaps.write('.') )
  .pipe( gulp.dest('./pub/javascript') ) //send to scaffold env
  .pipe( gulp.dest('../js') ) //send to wp dir
  .on('end', function() {
    del(['./app/javascript/modernizr.js']);
  });

});

gulp.task('serve', [ 'build', 'watch'], function(){
  connect.server({
    port: 9000,
    root: ['./pub'],
    livereload: true
  });
});

gulp.task('reload', function(){
  gutil.log("reloaded");
  connect.reload();
});

gulp.task('build', ['images', 'html', 'sass', 'buildJS']);

gulp.task('watch', function(){
  gulp.watch('./app/**/*.html', ['html']);
  gulp.watch('./app/javascript/**/*.js', ['buildJS', 'reload']);
  gulp.watch('./app/scss/**/*.scss', ['sass', 'sass-lint', 'reload']);
  gulp.watch('app/images/**/*', {cwd:'./'}, ['images', 'reload']); // @TODO: move this out of the watch and into the build
});
