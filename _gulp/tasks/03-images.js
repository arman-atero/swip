var
    gulp = require('gulp'),
    paths = require('../config'),
    fs = require('fs'),
    changed = require('gulp-changed'),
    del = require('del'),
    combiner = require('stream-combiner2'),

    browserSync = require('browser-sync');

gulp.task('util:sprite', function() {
    var spritesmith = require('gulp.spritesmith');

    var spriteStreams = [];
    var folders = fs.readdirSync(paths.sprites.src);
    var allFilePath = paths.css.src_for_scss + '_all.scss';
    var allFile = '/** This is a dynamically generated file **/\n\n';

    try {
        del(paths.css.src_for_scss + '/sprites/*.*');
        folders.forEach(function (folder) {
            if (folder[0] === '.') {
                return;
            }

            var image_name = folder + '.png';
            var spritesmith_options = {
                imgName: folder == 'sprite' ? image_name : 'sprite-' + image_name,
                cssName: '_' + folder + '.scss',
                padding: 10,
                imgOpts: {
                    quality: 100
                },
                exportOpts: {
                    quality: 100
                },
                cssTemplate: function (params) {
                    var template = '/* This is a dynamically generated file */\n\n' +
                        (folder == 'sprite' ? '.icon, .sprite' : '.icons-' + folder ) + " {\n" +
                        "   display: block;\n" +
                        "   background-image: url('./img/" + (folder == 'sprite' ? image_name : 'sprite-' + image_name) + "');\n" +
                        "}\n\n";

                    template += (folder == 'sprite' ? '%icon' : '%icons-' + folder ) + " {\n" +
                        "   display: block;\n" +
                        "   background-image: url('./img/" + (folder == 'sprite' ? image_name : 'sprite-' + image_name) + "');\n" +
                        "}\n\n\n";

                    template += "@mixin " + (folder == 'sprite' ? 'icon' : 'icons-' + folder ) + " {\n" +
                        "   display: block;\n" +
                        "   background-image: url('./img/" + (folder == 'sprite' ? image_name : 'sprite-' + image_name) + "');\n" +
                        "}\n\n\n";

                    params.items.forEach(function (item) {
                        template += ".icon-" + item.name + " {\n" +
                            "   background-position: " + item.px.offset_x + " " + item.px.offset_y + ";\n" +
                            "   width: " + item.px.width + ";\n" +
                            "   height: " + item.px.height + ";\n" +
                            "}\n";
                    });

                    params.items.forEach(function (item) {
                        template += "@mixin icon-" + item.name + " {\n" +
                            "   background-position: " + item.px.offset_x + " " + item.px.offset_y + ";\n" +
                            "   width: " + item.px.width + ";\n" +
                            "   height: " + item.px.height + ";\n" +
                            "}\n";
                    });

                    return template;
                }
            };

            var spriteData =
                gulp.src(paths.sprites.src + folder + '/*.*')
                    .pipe(spritesmith(spritesmith_options));

            spriteData.css.pipe(gulp.dest(paths.css.src_for_scss + '/sprites/'));
            spriteData.img.pipe(gulp.dest(paths.sprites.build));

            spriteStreams.push(spriteData.img);

            allFile += '@import "sprites/' + folder + '";\n';
        });
    } catch ($e) {  console.error('ERROR in util:sprite module') }

    if (!spriteStreams.length)
    {
        fs.writeFileSync(allFilePath, allFile);
        return;
    }

    var combined = combiner.obj(spriteStreams);
    combined.on('end', function(){
        fs.writeFileSync(allFilePath, allFile);
    });
    combined.on('error', console.error.bind(console));
    return combined;
});





gulp.task('util:imagemin', function () {
    var imagemin = require('gulp-imagemin');
    var pngquant = require('imagemin-pngquant');

    var combined = combiner.obj([
        gulp.src(paths.img.src),
        changed(paths.img.build),
        (imagemin({
            optimizationLevel: 3,
            progressive: true,
            interlaced: true,
            use: [pngquant()]
        })),
        gulp.dest(paths.img.build),
        browserSync.reload({stream:true})
    ]);
    combined.on('error', console.error.bind(console));
    return combined;
});
