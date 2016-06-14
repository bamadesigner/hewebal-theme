var gulp = require('gulp');
var minify = require('gulp-minify');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
var rename = require('gulp-rename');

gulp.task('sass', function() {
	gulp.src('scss/style.scss')
		.pipe(sass({outputStyle:'compressed'}))
		.pipe(rename({ suffix: '.min' }))
		.pipe(gulp.dest('css'));
});

gulp.task('compress', function() {
	gulp.src(['js/hewebal.js','js/hewebal-schedule.js'])
		.pipe(minify({
			ext: '.min.js'
		}))
		.pipe(gulp.dest('js'))
});

gulp.task('default',['sass','compress'], function() {
	gulp.watch('scss/style.scss',['sass']);
	gulp.watch(['js/hewebal.js','js/hewebal-schedule.js'],['compress']);
});