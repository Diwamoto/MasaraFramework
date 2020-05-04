var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');
sass.compiler = require('node-sass');
// Static server
gulp.task('browser-sync', function() {
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });
});
gulp.task('sass', function () {
    gulp.src('sass/*.scss')
    .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
    .pipe(gulp.dest('css'));
    browserSync.reload;
});
gulp.watch("css/*.css").on("change", browserSync.reload);
gulp.watch("js/*.js").on("change", browserSync.reload);
gulp.watch('sass/*.scss', ['sass']);
gulp.watch("*.html").on("change", browserSync.reload);
gulp.task('default', ['browser-sync','sass']);