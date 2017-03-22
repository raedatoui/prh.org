const gulp = require('gulp');
const gutil = require('gulp-util');
const jshint = require('gulp-jshint');
const sass = require('gulp-sass');
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


gulp.task('default', [ 'watch' ]);

gulp.task('html', function(){

  gutil.log('HTML UPDATED');
  return gulp.src('./app/*.html')
    .pipe( gulp.dest('./pub'))
    .pipe(connect.reload());
});

gulp.task('jshint', ['buildJS'], function(){
  return gulp.src('./app/javascript/**/*.js')
    .pipe( jshint() )
    .pipe( jshint.reporter('jshint-stylish') );
});

gulp.task('images', ['cleanImage'], function(){
  return gulp.src('./app/images/**/*')
  .pipe( image({ svgo: true }) )
  .pipe( gulp.dest( './pub/images' ) )
  .pipe( gulp.dest( '../images/build-images' ) )
  .pipe( changed('prhstaging.org/wp-content/themes/prh-wp-theme/images/build-images', {cwd:'../../'}) ) //check for changes from previous version
  .pipe( gulp.dest('../../prhstaging.org/wp-content/themes/prh-wp-theme/images/build-images') ); //send to prhstaging.org
});

gulp.task('sass', [], function(){
  return gulp.src('./app/scss/main.scss')
  .pipe( sourcemaps.init() )
  .pipe( sass( { outputStyle: 'compressed', includePaths: './node_modules' } ).on( 'error', sass.logError ) ) //compressed  on launch
  .pipe( postcss([ require('autoprefixer') ]) )
  .pipe( sourcemaps.write('.') )
  .pipe( gulp.dest('./pub/stylesheets') )
  .pipe( gulp.dest('../css') ) //send to local git wp dir
  .pipe( changed('prhstaging.org/wp-content/themes/prh-wp-theme/css', {cwd:'../../'}) ) //check for changes from previous version
  .pipe( gulp.dest('../../prhstaging.org/wp-content/themes/prh-wp-theme/css') ) //send to prhstaging.org
  .pipe(connect.reload());
});

gulp.task('buildJS', [ 'images' ], function(){
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
  .pipe( changed('prhstaging.org/wp-content/themes/prh-wp-theme/js', {cwd:'../../'}) ) //check for changes from previous version
  .pipe( gulp.dest('../../prhstaging.org/wp-content/themes/prh-wp-theme/js') ); //send to prhstaging.org
});

gulp.task('serve', ['images', 'watch'], function(){
  connect.server({
    port: 9000,
    root: ['./pub'],
    livereload: true
  });
});

gulp.task('serve', ['images', 'watch'], function(){
  connect.server({
    port: 9000,
    root: ['./pub'],
    livereload: true
  });
});

gulp.task('cleanImage', function(){
  console.log("CLEAN")
  return del(
    [
      './pub/images',
      '../images/build-images',
      '../../prhstaging.org/wp-content/themes/prh-wp-theme/images/build-images'
    ],
    {
      force: true,
      dryrun: true
    }
  );
});

gulp.task('updateWPTheme', function(){
  //This task will take changes from the local git dir and push up to the local phrstaging.org directory
  gutil.log("WP CHANGED");
  return gulp.src('../*')
    .pipe( changed('prhstaging.org/wp-content/themes/prh-wp-theme', {cwd:'../../'}) )
    .pipe( gulp.dest('../../prhstaging.org/wp-content/themes/prh-wp-theme'))
});


gulp.task('reload', function(){
  gutil.log("reloaded");
  connect.reload();
});

gulp.task('watch', function(){
  gulp.watch('./app/**/*.html', ['html']);
  gulp.watch('./app/javascript/**/*.js', ['jshint', 'reload']);
  gulp.watch('./app/scss/**/*.scss', ['sass', 'reload']);
  gulp.watch('**/*.php',{cwd:'../'},['updateWPTheme']);
  gulp.watch('app/images/**/*', {cwd:'./'}, ['images', 'reload']);

});
