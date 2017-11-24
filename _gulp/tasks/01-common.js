var gulp = require('gulp'),
    del = require('del'),
    changed = require('gulp-changed'),
    paths = require('../config');



gulp.task('util:copy', function() {
    paths.copy.forEach(function(item){
        gulp.src( paths.path_src + item.from )
            .pipe(changed(paths.path_build + item.to))
            .pipe(gulp.dest(paths.path_build + item.to));
    });
});

gulp.task('util:fonts', function(done) {
    del(paths.fonts.build + '/**/*.*').then(function(){
        gulp.src(paths.fonts.src + '/**/*.*')
            .pipe(gulp.dest(paths.fonts.build))
            .on('end', function() {
                var template = [
                    '@font-face {\n',
                    '  font-family: "{{fontName}}";\n',
                    '  font-style: normal;\n',
                    '  font-weight: normal;\n',
                    "  src: url('../fonts/{{fontName}}.eot');\n",
                    "  src: url('../fonts/{{fontName}}.eot?#iefix') format('embedded-opentype'),\n",
                    "       {{woff2}},\n",
                    "       url('../fonts/{{fontName}}.woff') format('woff'),\n",
                    "       url('../fonts/{{fontName}}.ttf') format('truetype'),\n",
                    "       url('../fonts/{{fontName}}.svg#{{fontName}}') format('svg');\n",
                    '}\n',
                    '@mixin font-{{fontName}} {\n',
                    '   font-family: "{{fontName}}", "Arial", sans-serif\n',
                    '}\n',
                    '\n\n'
                ].join('');

                var fs = require('fs');
                var folder = fs.readdirSync( paths.fonts.src );

                var allFile = '/** This is a dynamically generated file **/\n\n';
                var allFilePath = paths.css.src_for_scss + '_fonts.scss';

                folder.forEach(function(file) {
                    if (file[0] === '.')
                        return;

                    var regexResult = file && file.match(/^(.+)\.(woff2)$/);
                    if (regexResult) {
                        var tmpl = template;

                        var stats = fs.statSync( paths.fonts.src + file );
                        var fileSizeInBytes = stats["size"];
                        if (fileSizeInBytes > 30000) {
                            tmpl = tmpl
                                .replace(/{{woff2}}/g, "url('../fonts/{{fontName}}.woff2') format('woff2')");
                        } else {
                            tmpl = tmpl
                                .replace(/{{woff2}}/g, "url('data:application/x-font-{{fontType}};base64,{{base64}}') format('{{fontType}}')");
                        }

                        var fileName = regexResult[1],
                            fontType = regexResult[2],
                            fontName = fileName.replace(/_/g, ' ').replace(/\./g, '_').replace(/\ /g, '_'),
                            file_content = fs.readFileSync(paths.fonts.src + file),
                            base64 = file_content.toString('base64');

                        tmpl = tmpl
                            .replace(/{{fontName}}/g, fontName)
                            .replace(/{{fontType}}/g, fontType)
                            .replace('{{base64}}', base64);

                        allFile += tmpl + ';\n';
                    }
                });
                fs.writeFileSync(allFilePath, allFile);
                done();
            });
    });
});