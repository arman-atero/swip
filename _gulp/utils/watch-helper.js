var gulp = require('gulp'),
    browserSync = require('browser-sync'),
    runSequence = require('run-sequence');

module.exports = function(command, cb) {
    return function(events, done) {
        gulp.start(command);
    }
}
