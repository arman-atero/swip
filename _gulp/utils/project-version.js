var fs = require('fs'),
    paths = require('../config');

module.exports = function () {
    if (fs.existsSync('./.default')) {
        return "0.0.1";
    }
    var file = fs.readFileSync(paths.version_file, 'utf8');
    return JSON.parse(file).version;
}