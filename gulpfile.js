//node -v 14.6.0

const { watch, series, src, dest } = require("gulp");
const options = require("./config.js");

var browserSync = require("browser-sync").create();
var postcss = require("gulp-postcss");
const imagemin = require("gulp-imagemin");
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass')(require('sass'));

//CSS
function cssTask(cb) {
    const tailwindcss = require('tailwindcss');
    return src(`${options.paths.src.css}/*.scss`).pipe(sass().on('error', sass.logError))
    .pipe(dest(options.paths.src.css))
    .pipe(postcss([
        tailwindcss(options.config.tailwindjs),
        require('autoprefixer'),
        require('cssnano')({
            preset: 'default',
        }),
    ]))
    .pipe(concat({ path: 'style.css'}))
    .pipe(dest(options.paths.dist.css))
    //.pipe(browserSync.stream());
    cb();
}

//JS
function jsTask(cb) {
	return src(`${options.paths.src.js}/*.js`)
    .pipe(concat('scripts.min.js'))
    .pipe(uglify())
    .pipe(dest(options.paths.dist.js))
    .pipe(browserSync.stream());
    cb();
}

// Task for minifying images
function imageminTask(cb) {
    return src("./src/images/*")
        .pipe(imagemin())
        .pipe(dest("./dist/images"));
    cb();
}

// Serve from browserSync server
function browsersyncServe(cb) {
    browserSync.init({
        proxy: `${options.config.proxy}`,
    });
    cb();
}

function browsersyncReload(cb) {
    browserSync.reload();
    cb();
}

// Watch Files & Reload browser after tasks
function watchTask() {
    watch(`${options.paths.root}**/*.html`, series(cssTask, browsersyncReload));
    watch(`${options.paths.root}**/*.php`, series(cssTask, browsersyncReload));
    watch(`${options.paths.src.base}/**/*.scss`, series(cssTask, browsersyncReload));
    watch(`${options.paths.src.js}/*.js`, series(jsTask, browsersyncReload));
    watch(`${options.paths.root}/tailwind.config.js`, series(cssTask, browsersyncReload));
}

// Default Gulp Task
exports.default = series(cssTask, jsTask, browsersyncServe, watchTask);
exports.css = cssTask;
exports.js = jsTask;
exports.images = imageminTask;
