var gulp = require('gulp'),
    paths = require('../config'),
    START = require('../utils/watch-helper'),
    browserSync = require('browser-sync'),
    runSequence = require('run-sequence'),
    del = require('del'),
    watch = require('gulp-watch');

var environments = require('gulp-environments'),
    development = environments.development,
    production = environments.production;

gulp.task('server', function(cb){
    browserSync.init({
        server: {
            baseDir: paths.path_build
        },
        port: paths.server_port,
        open: "local",
        reloadOnRestart: true,
        browser: "google chrome",
        ui: false,
        reloadDelay: 200
    });
});

gulp.task('clean', function(cb){
    return del(paths.path_build, cb);
});
gulp.task('build', function() {
    return runSequence(
        'util:sprite',
        [
            'util:copy',
            'util:fonts',
            'util:js:plugins',
            'util:js:scripts',

        ],
        'util:imagemin',
        'util:sass'
    )
});
gulp.task('rebuild', function() {
    return runSequence(
        'clean',
        'build'
    )
});

gulp.task('watch', function() {
    gulp.start('server');

    watch( paths.resources,         START('util:copy')         );
    watch( paths.js.plugins.src,    START('util:js:plugins')   );
    watch( paths.js.script.src,     START('util:js:scripts')    );
    watch( paths.fonts.watch,       {events: ['add', 'change']}, START('util:fonts')        );
    watch( paths.css.watch,         START('util:sass')         );
    watch( paths.img.watch,         {events: ['add', 'change']}, START('util:imagemin')     );
    watch( paths.sprites.watch,     START('util:sprite')       );
});

gulp.task('deploy', function() {
    environments.current(production);

    runSequence(
        'build',
        //'semver:minor',
        'git:commit',
        'git:push'
    )
});

gulp.task('release', function() {
    environments.current(production);

    runSequence(
        'rebuild',
        //'semver:major',
        'git:commit',
        'git:push'
    )
});