// Gulp ======================================================================
gulp = require("gulp");
jade = require("gulp-jade");
htmlmin = require("gulp-htmlmin");
sass = require("gulp-sass");
autoprefixer = require("gulp-autoprefixer");
cssnano = require("gulp-cssnano");
coffee = require("gulp-coffee");
browserSync = require("browser-sync");
rename = require("gulp-rename");

const path = require("path");
const fs = require("fs");

// Functions =================================================================
gulp.task("sync", function() {
  return browserSync({
    proxy: "localhost:8888",
    ui: false,
    port: 8888,
  });
});

gulp.task("sync", function() {
  return browserSync({
    server: "",
  });
});

// Compile SCSS
gulp.task("scss", function() {
  return gulp
    .src("scss/style.scss")
    .pipe(sass())
    .on("error", sass.logError)
    .pipe(
      autoprefixer({
        browsers: ["last 2 versions"],
        cascade: false,
      })
    )
    .pipe(cssnano())
    .pipe(gulp.dest(""))
    .pipe(
      browserSync.reload({
        stream: true,
      })
    );
});

gulp.task("default", function() {
  gulp.run("sync");

  gulp.watch("./*.php").on("change", function() {
    browserSync.reload;
  });

  gulp.watch("./scss/*", function() {
    return gulp.run("scss");
  });
});
