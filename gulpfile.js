'use strict';

let gulp = require('gulp');
let sass = require('gulp-sass');
let autoprefixer = require('gulp-autoprefixer');

gulp.task('default', ['sass'], function () {

})

gulp.task('sass', function () {
    return gulp.src('./resources/assets/sass/app.scss')
        .pipe(sass({includePaths: './node_modules'}).on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('./public/css'));
});

gulp.task('sass:watch', function () {
    gulp.watch('./resources/assets/**/*.scss', ['sass']);
});
