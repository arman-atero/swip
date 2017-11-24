var
    gulp = require('gulp'),
    rigger = require('gulp-rigger'),
    uglify = require('gulp-uglify'),

    jshint = require('gulp-jshint'),
    jshint_stylish = require('jshint-stylish'),
    combiner = require('stream-combiner2'),

    browserSync = require('browser-sync'),

    paths = require('../config.js');

var environments = require('gulp-environments'),
    development = environments.development,
    production = environments.production;


gulp.task('util:js:plugins', function () {
    var combined = combiner.obj([
        gulp.src(paths.js.plugins.src),
        rigger(),
        uglify({
            compress: false,
            preserveComments: false,
            output: {
                semicolons: true
            }
        }),
        gulp.dest(paths.js.build),
        browserSync.reload({stream:true})
    ]);

    combined.on('error', console.error.bind(console));
    return combined;
});


gulp.task('util:js:scripts', function () {
    var combined = combiner.obj([
        gulp.src(paths.js.script.src),
        rigger(),
        jshint(),
        jshint.reporter(jshint_stylish),
        production(uglify({
            compress: false,
            preserveComments: false,
            output: {
                semicolons: true,
                beautify: true
            }
        })),
        gulp.dest(paths.js.build),
        browserSync.reload({stream:true})
    ]);

    combined.on('error', console.error.bind(console));
    return combined;
});