#!/usr/bin/env node

var gulp = require("gulp")
var watch = require("gulp-watch")
var gutil = require("gulp-util")
var gulpIf = require("gulp-if")
var coffee = require("gulp-coffee")
var concat = require("gulp-concat")
var uglify = require("gulp-uglify")
var sass = require("gulp-sass")
var autoprefixer = require('gulp-autoprefixer')
var cleanCSS = require("gulp-clean-css")
var pug = require("gulp-pug")
var jsonminify = require('gulp-jsonminify');
var cordova = require("cordova")
var bower = require("bower")
var del = require("del")
var fse = require("fs-extra")
var path = require("path")
var bowerResourceStack = require("./bower_resources.json")
var Comb = require('csscomb');
var config = require('./.csscomb.json');
var comb = new Comb(config);
var rename = require("gulp-rename");

process.env.GULP_DEV = 'false'

gulp.task("default", ["js-libs", "coffee", "sass", "pug", "php"])

gulp.task("bower", function() {
  bower.commands.install()
    .on("log", function(data) {
      gutil.log("bower", gutil.colors.cyan(data.id), data.message)
    })
    .on("error", handleError)
    .on("end", function() {
      resources()
    })
})

gulp.task("js-libs", function() {
  gulp.src([
      "./bower_components/jquery/dist/jquery.min.js",
      "./bower_components/foundation-sites/dist/foundation.js",
      "./bower_components/what-input/what-input.js",
      "./bower_components/motion-ui/dist/motion-ui.min.js"
    ])
    .pipe(gulpIf((process.env.GULP_DEV !== "true"), uglify({mangle: false})))
    .pipe(concat("libs.js"))
    .pipe(gulp.dest("./www/js"))
})

gulp.task("coffee", function() {
  gulp.src([
      "./src/coffee/**/*.coffee"
    ])
    .pipe(coffee({bare: true}).on("error", handleError))
    .pipe(gulpIf((process.env.GULP_DEV !== "true"), uglify({mangle: false})))
    .pipe(concat("app.js"))
    .pipe(gulp.dest("./www/js"))
})

gulp.task("sass", function() {
  sassOptions = { errLogToConsole: true, includePaths: ['bower_components/foundation-sites', 'bower_components/motion-ui'] }
  if (process.env.GULP_DEV !== "true") sassOptions['outputStyle'] = "compressed"

  comb.processPath('./src/sass/');

  gulp.src("./src/sass/**/*.scss")
    .pipe(sass(sassOptions))
    .pipe(autoprefixer('last 2 version', 'Chrome', 'Safari', 'ie_mob', 'and_chr'))
    .pipe(gulpIf((process.env.GULP_DEV !== "true"), cleanCSS({keepSpecialComments: 0})))
    .pipe(gulp.dest("./www/css"))
})

gulp.task("pug", function() {
  gulp.src("./src/pug/*.pug")
    .pipe(pug({pretty: true}).on("error", handleError))
    .pipe(rename(function (path) {
      if (process.env.GULP_DEV !== "true") path.extname = ".php";
      return path;
    }))
    .pipe(gulp.dest("./www/"))
})

gulp.task("php", function() {
  src  = "./src/php/*.php"
  dest = "./www"
  gulp.src([src]).pipe(gulp.dest(dest));
})

gulp.task("watch", function() {
  gulp.watch([
          "./src/coffee/**/*.coffee",
          "./src/sass/*.scss",
          "./src/pug/**/*.pug",
        ],
    ["default"]).on("error", handleError)
})

gulp.task("clean", function() {
  del("./www/**/*.html")
  del("./www/css/**/*.css")
  del("./www/fonts/**/*")
  del("./www/js/**/*.js*")
  del("./www/js/**/*.map*")
  del("./www/i18n/**/*.json*")
})

function resources(){
  prepare(bowerResourceStack)
}

function prepare(resourceStack){
  for (var i = 0; i < resourceStack.length; i++) {
    src  = resourceStack[i][0]
    dest = resourceStack[i][1]
    gutil.log(" ● cp ", src, gutil.colors.green(" → "), dest)

    if (fse.existsSync(src)) {
      fse.ensureDirSync(path.dirname(dest))
      fse.copy(src, dest, function(err) {
        if (err) return gutil.log(gutil.colors.red(err))
      })
    } else {
      gutil.log(gutil.colors.red(" ✗ Source file does not exist: " + src))
      this.emit("err")
    }
  }
}

function handleError(err) {
  gutil.log(gutil.colors.red(" ✗ " + err))
  this.emit("end")
}
