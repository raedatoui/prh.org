const gulp = require('gulp');
const gutil = require('gulp-util');
const jshint = require('gulp-jshint');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const buble = require('gulp-buble');
const rename = require('gulp-rename');
const connect = require('gulp-connect');
//const del = require('del');
const rollup = require('rollup-stream');
const uglify = require('rollup-plugin-uglify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const includePaths = require('rollup-plugin-includepaths');
const nodeResolve = require('rollup-plugin-node-resolve');
const commonjs = require('rollup-plugin-commonjs');


gulp.task('default', [ 'watch' ]);

gulp.task('html', function(){

  gutil.log('HTML UPDATED');

  return gulp.src('./app/*.html')
  .pipe( gulp.dest('./pub'))
  .pipe(connect.reload());
});

gulp.task('js', function(){
  return gulp.src('./app/javascript/**/*.js')
  .pipe( jshint() )
  .pipe( jshint.reporter('jshint-stylish') );
});


gulp.task('sass', [], function(){
  return gulp.src('./app/scss/main.scss')
  .pipe( sourcemaps.init() )
  //.pipe( sass( { outputStyle: 'compressed' } ).on( 'error', sass.logError ) )
  .pipe( sass( { outputStyle: 'uncompressed' } ).on( 'error', sass.logError ) )
  .pipe( sourcemaps.write('.') )
  .pipe( gulp.dest('./pub/stylesheets') )
  .pipe(connect.reload());
});


gulp.task('build', function(){
  //gulp.src('./app/javascript/*.js')
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
      //uglify()
    ]
  })
  .pipe( source( 'main.js', './app/javascript' ) )
  .pipe( buffer() )
  .pipe( sourcemaps.init( { loadMaps: true } ) )
  .pipe( buble() )
  .pipe( rename('bundle.js' ) )
  .pipe( sourcemaps.write('.'))
  .pipe( gulp.dest('./pub/javascript'));

});

gulp.task('serve', ['watch'], function(){
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

gulp.task('watch', function(){
  gulp.watch('./app/**/*.html', ['html']);
  gulp.watch('./app/javascript/**/*.js', ['js', 'reload']);
  gulp.watch('./app/scss/**/*.scss', ['sass', 'reload']);
});
