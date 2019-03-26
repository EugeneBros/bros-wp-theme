var gulp     = require('gulp'),
		sass     = require('gulp-sass'),
		concat   = require('gulp-concat'),
		uglify   = require('gulp-uglifyjs'),
		cssnano  = require('gulp-cssnano'),
		rename   = require('gulp-rename'),
		imagemin = require('gulp-imagemin');

gulp.task('sass', function() {
	return gulp.src('css/src/**/*.scss')
	.pipe(sass())
	.pipe(cssnano())
	.pipe(rename({suffix: '.min'}))
	.pipe(gulp.dest('css'))
});

gulp.task('css-libs', ['sass'], function() {
	return gulp.src('css/libs.css')
	.pipe(cssnano())
	.pipe(rename({suffix: '.min'}))
	.pipe(gulp.dest('css'));
});

gulp.task('common-js', function() {
	return gulp.src([
		'js/src/**/*.js'
	])
	.pipe(concat('common.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('js'));
});

gulp.task('js', ['common-js'], function() {
	return gulp.src([
		'libs/jquery/jquery.min.js',
	])
	.pipe(concat('libs.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('js'));
});

gulp.task('imagemin', function() {
	return gulp.src('img/src/**/*')
	.pipe(imagemin())
	.pipe(gulp.dest('img')); //Before send on product delete folder /img/src
});

gulp.task('watch', ['css-libs', 'js'], function() {
	gulp.watch('css/src/**/*.scss', ['sass']);
	gulp.watch(['libs/**/*.js', 'js/src/**/*.js'], ['js']);
});

gulp.task('default', ['watch']);