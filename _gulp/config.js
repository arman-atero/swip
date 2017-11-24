var
    gulp = require('gulp'),
//reload = browserSync.reload,
    // jade = require('gulp-jade'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    changed = require('gulp-changed'),
    uglify = require('gulp-uglify'),
    jshint = require('gulp-jshint'),
    stylish = require('jshint-stylish'),
    combiner = require('stream-combiner2');




var path_src = './_src';
var path_build = '../wp-content/themes/SwipWorld';

var paths = {
    path_src : path_src,
    path_build : path_build,

    path_git : './.git',
    server_port : 9000,
    version_file : 'version.json',

    // пути относительно корня SRC (для from) и BUILD (для to)
    copy : [
        {from : '/js/jquery/*.*',       to : '/js/'},
        {from : '/template/**/*.*',        to : '/'},
        {from : '/template/**/.*',        to : '/'}
    ],

    fonts : {
        src : path_src + '/fonts/',
        build : path_build + '/fonts/',
        watch : path_src + '/fonts/**/*.woff2'
    },

    // SRC = WATCH. по умолчанию слушаем только главные файлы на изменение.
    // Так как нам не требуется менять плагины постоянно, а только их список, то и слушать папку с плагинами нет смысла
    js : {
        plugins : {
            src : path_src + '/js/plugins.js'
        },
        script : {
            src : path_src + '/js/script.js'
        },
        build : path_build + '/js/',
        auto_generate : path_src + '/js/_auto-generate/script.js'
    },

    img : {
        src: [
            path_src + '/img/**/*.*',
            '!' + path_src + '/img/sprites/**/*.*'
        ],
        build: path_build + '/img/',
        watch : [
            path_src + '/img/**/*.*',
            '!' +  path_src + '/img/sprites/**/*.*'
        ]
    },

    sprites : {
        src: path_src + '/img/sprites/',
        build : path_src + '/img/',
        watch: path_src + '/img/sprites/**/*.*'
    },

    css : {
        src : path_src + '/scss/style.sass',
        src_for_scss : path_src + '/scss/_auto-generate/',
        build : path_build,
        watch : [
            path_src +'/scss/*.sass',
            path_src +'/scss/(components|plugins)/*.s*ss',
            '!' + path_src +'/scss/_auto-generate/sprites/**/*.*'
        ]
    },

    resources : [
        path_src + '/template/*.*',
        '!' + path_src + '/*.*___jb_tmp___'
    ]
};




module.exports = paths;