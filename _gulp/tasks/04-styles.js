var
    gulp = require('gulp'),
    paths = require('../config'),

    changed = require('gulp-changed'),
    rigger = require('gulp-rigger'),
    sass = require('gulp-sass'),
    minifycss = require('gulp-minify-css'),
    combiner = require('stream-combiner2'),

    browserSync = require('browser-sync');

var environments = require('gulp-environments'),
    development = environments.development,
    production = environments.production;


var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var mqpacker = require('css-mqpacker');
var colorRgbaFallback = require("postcss-color-rgba-fallback");
var cssgrace = require('cssgrace');

var processors = [
    autoprefixer({browsers: ['last 4 versions', 'safari 5', 'ie 7','ie 8', 'ie 9', 'opera 12.1']}),
    colorRgbaFallback,
    cssgrace,
    mqpacker({ sort: true })
];

gulp.task('util:sass', function () {
    return combiner.obj([
        gulp.src(paths.css.src),
        rigger(),
        sass({errLogToConsole: true, indentedSyntax: true}),
        postcss(processors),
        production(minifycss({
            keepBreaks : false,
            keepSpecialComments : 0,
            shorthandCompacting : false
        })),
        gulp.dest( paths.css.build ),
        browserSync.stream()
    ]);
});
