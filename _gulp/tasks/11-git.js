var gulp = require('gulp'),
    paths = require('../config'),
    git = require('gulp-git');

var getProjVersion = require('../utils/project-version.js');
var current_version = getProjVersion();


gulp.task('git:commit', function(cb){
    check_git_hook();

    return gulp.src('.')
        .pipe(git.add({quiet: true}))
        .pipe(git.commit("version: " + getProjVersion(), {
            quiet: true
        }));
});

gulp.task('git:push', function(cb){
    return git.push('origin', 'master', function (err) {
        if (err) throw err;
    });
});

var check_git_hook = function() {
    var fs = require('fs');
    var gitHookPath = './.git/hooks/pre-commit';
    var gitHook = fs.readFileSync('./pre-commit.example');

    if (!fs.existsSync(gitHookPath)) {
        fs.writeFileSync(gitHookPath, gitHook);
    }
}