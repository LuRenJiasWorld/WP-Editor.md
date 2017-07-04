/**
 * Created by Jaxson on 2017/4/13.
 */
var gulp = require('gulp');
var gutil = require('gulp-util');
var uglify = require('gulp-uglify');
var combiner = require('stream-combiner2');
var watchPath = require('gulp-watch-path'); //监视项目
var sourcemaps = require('gulp-sourcemaps'); //js压缩
var minifycss = require('gulp-minify-css'); //css压缩
var imagemin = require('gulp-imagemin'); //图片压缩

//捕获异常，防止打断watch工作
var handleError = function (err) {
    var colors = gutil.colors;
    console.log('\n');
    gutil.log(colors.red('Error!'));
    gutil.log('fileName: ' + colors.red(err.fileName));
    gutil.log('lineNumber: ' + colors.red(err.lineNumber));
    gutil.log('message: ' + err.message);
    gutil.log('plugin: ' + colors.yellow(err.plugin))
};

//输出log日志
gulp.task('default', function () {
    gutil.log('message');
    gutil.log(gutil.colors.red('error'));
    gutil.log(gutil.colors.green('message:') + "some")
});

//javascript编译文件输出
gulp.task('uglifyjs', function () {
    var combined = combiner.obj([
        gulp.src('lib/**/*.js'),
        sourcemaps.init(),
        uglify(),
        sourcemaps.write('./'),
        gulp.dest('dist/lib/')
    ]);
    combined.on('error', handleError)
});

//监视项目 压缩改动后的脚本文件js
gulp.task('watchjs', function () {
    gulp.watch('lib/**/*.js', function (event) {
        var paths = watchPath(event, 'lib/', 'dist/');
        gutil.log(gutil.colors.green(event.type) + ' ' + paths.srcPath);
        gutil.log('Dist ' + paths.distPath);
        var combined = combiner.obj([
            gulp.src(paths.srcPath),
            uglify(),
            sourcemaps.write('./'),//压缩资源库
            gulp.dest(paths.distDir)
        ]);
        combined.on('error', handleError)
    })
});

//监视项目 压缩改动后的样式表文件css
gulp.task('watchcss', function () {
    gulp.watch('lib/**/*.css', function (event) {
        var paths = watchPath(event, 'lib/', 'dist/');
        gutil.log(gutil.colors.green(event.type) + ' ' + paths.srcPath);
        gutil.log('Dist ' + paths.distPath);
        gulp.src(paths.srcPath)
            .pipe(sourcemaps.init())
            .pipe(minifycss())
            .pipe(sourcemaps.write('./'))
            .pipe(gulp.dest(paths.distDir))
    })
});

//样式表任务
gulp.task('minifycss', function () {
    gulp.src('lib/**/*.css')
        .pipe(sourcemaps.init())
        .pipe(minifycss())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('dist/lib/'))
});

//监视项目
gulp.task('default', [
        // build
    'uglifyjs', 'minifycss',
        // watch
    'watchjs', 'watchcss'
    ]
);