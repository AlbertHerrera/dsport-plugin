// Load Gulp...of course
var gulp = require( 'gulp' );
var watch = require('gulp-watch')
var rename = require('gulp-rename');
var sass = require( 'gulp-sass' );
var uglify = require( 'gulp-uglify' );

var autoprefixer = require( 'gulp-autoprefixer' );
var sourcemaps = require( 'gulp-sourcemaps' );
var styleSRC =   './src/scss/shuffleStyles.scss';
var styleASS = './assets/css/';
var browserify = require( 'browserify' );
var babelify = require( 'babelify' );
var source = require( 'vinyl-source-stream' );
var buffer = require( 'vinyl-buffer' );
var browserSync = require ('browser-sync').create();

var jsSRC = 'shuffleScript.js';
var jsFolder = 'src/js/';
var jsASS = './assets/js/';

var jsWatch = 'src/js/**/*.js';
var styleWatch = 'src/scss/**/*.scss';

var jsFILES = [jsSRC];

gulp.task('styles', function(){
  gulp.src( styleSRC )
       .pipe ( sourcemaps.init())
       .pipe(sass({
       errorLogToConsole: true,
       outputStyle: 'compressed'
       }))
      .on('error', console.error.bind(console))
      .pipe( autoprefixer({browsers: ['last 2 versions'],cascade: false}))
      .pipe(rename({suffix: '.min'}))
      .pipe( sourcemaps.write( './' ))
      .pipe(gulp.dest( styleASS ));
});

gulp.task('js', function(){
  jsFILES.map(function ( entry ){
    return browserify({
      entries: [jsFolder + entry]
    })
    .transform(babelify,{presets: ['env']})
    .bundle()
    .pipe(source( entry ) )
    .pipe( rename({extname: '.min.js'}) )
    .pipe(buffer())
    .pipe (sourcemaps.init({ loadMaps:true }) )
    .pipe(uglify())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(jsASS))
  });
});


gulp.task('default',['styles','js']);

gulp.task('watch', ['default'], function(){
  gulp.watch( styleWatch , ['styles']);
  gulp.watch( jsWatch , ['js']);

});
