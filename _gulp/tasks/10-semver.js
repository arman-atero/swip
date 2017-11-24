var gulp = require('gulp'),
    paths = require('../config'),
    del = require('del'),
    bump = require('gulp-bump');



gulp.task('semver:patch', function(cb){
    return gulp.src(paths.version_file)
        .pipe(bump())
        .pipe(gulp.dest('./'))
});
gulp.task('semver:minor', function(cb){
    return gulp.src(paths.version_file)
        .pipe(bump({type: 'minor'}))
        .pipe(gulp.dest('./'))
});
gulp.task('semver:major', function(cb){
    return gulp.src(paths.version_file)
        .pipe(bump({type: 'major'}))
        .pipe(gulp.dest('./'))
});
gulp.task('semver:reset', function(cb){
    return gulp.src(paths.version_file)
        .pipe(bump({version: '0.1.0'}))
        .pipe(gulp.dest('./'))
});
