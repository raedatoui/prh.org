const gulp = require('gulp');
const gutil = require('gulp-util');
const jshint = require('gulp-jshint');
const sass = require('gulp-sass');
const del = require('del');
const rollup = require('rollup-stream');
const uglify = require('rollup-plugin-uglify');
const sourcemaps = require('gulp-sourcemaps');
const buble = require('gulp-buble');
const rename = require('gulp-rename');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const includePaths = require('rollup-plugin-includepaths');
const nodeResolve = require('rollup-plugin-node-resolve');
const commonjs = require('rollup-plugin-commonjs');


//gulp.task('default', ['watch']);
gulp.task('default', ['sass']);

gulp.task('jshint', function(){
  return gulp.src('./app/javascript/**/*.js')
  .pipe( jshint() )
  .pipe( jshint.reporter('jshint-stylish') );
});

gulp.task('watch', function(){
  gulp.watch('./app/javascript/**/*.js', ['jshint']);
  gulp.watch('./app/scss/**/*.scss', ['sass']);
});

gulp.task('sass', [], function(){
  return gulp.src('./app/scss/skeleton.scss')
  .pipe( sourcemaps.init() )
  .pipe( sass( { outputStyle: 'compressed' } ).on( 'error', sass.logError ) )
  .pipe( sourcemaps.write('.') )
  .pipe( gulp.dest('./pub/assets/stylesheets') );
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
  .pipe( gulp.dest('./pub/assets/javascript'));

});




// gulp.task('clean', function () {
//     //del('docs');
//     //eturn del('main.css*');
// });
