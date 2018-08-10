// Defining requirements
var gulp = require('gulp');
var plumber = require('gulp-plumber');
var watch = require('gulp-watch');
var cssnano = require('gulp-cssnano');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var merge2 = require('merge2');
var imagemin = require('gulp-imagemin');
var ignore = require('gulp-ignore');
var rimraf = require('gulp-rimraf');
var clone = require('gulp-clone');
var merge = require('gulp-merge');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var del = require('del');
var cleanCSS = require('gulp-clean-css');
var gulpSequence = require('gulp-sequence');
var replace = require('gulp-replace');
var autoprefixer = require('gulp-autoprefixer');

// Configuration file to keep your code DRY
var cfg = require('./gulpconfig.json');
var paths = cfg.paths;

// 压缩 js 文件
// 在命令行使用 gulp script 启动此任务
gulp.task('jscompress', function () {
    // 1. 找到文件
    return gulp.src('assets/Config/editormd.js')
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(uglify()) //压缩
        .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(rename({suffix: '.min'})) //重命名
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('assets/Config')); //另存文件
});

// 压缩 css 文件
// 在命令行使用 gulp csscompress 启动此任务
gulp.task('csscompress', function () {
    return gulp.src('assets/Config/editormd.css')
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(cleanCSS({compatibility: '*'})) //压缩
        .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(rename({suffix: '.min'})) //重命名
        .pipe(cssnano({discardComments: {removeAll: true}})) //压缩
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('assets/Config')); //另存文件
});

// 启动browser-sync服务
// 在命令行使用 gulp browser-sync 启动此任务
gulp.task('browser-sync', function () {
    browserSync.init(cfg.browserSyncWatchFiles, cfg.browserSyncOptions);
});

// 启动监视服务
// 在命令行使用 gulp watch 启动此任务
gulp.task('watch', ['browser-sync'], function () {
    gulp.watch('assets/Config/editormd.js', ['jscompress']);
    gulp.watch('assets/Config/editormd.css', ['csscompress']);
});

// 默认任务
gulp.task('default', ['watch']);