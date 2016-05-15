/**
 *
 *  RhythmicExcellence
 *  Copyright 2016 SonnY. All rights reserved.
 *
 *  Licensed under the MIT License
 *  You may obtain a copy of the License at
 *
 *  http://andreasonny.mit-license.org
 *
 */

'use strict';

// This gulpfile makes use of new JavaScript features.
// Babel handles this without us having to do anything. It just works.
// You can read more about the new JavaScript features here:
// https://babeljs.io/docs/learn-es2015/

import gulp from 'gulp';
import del from 'del';
import * as gutil from 'gulp-util';
import runSequence from 'run-sequence';
import gulpLoadPlugins from 'gulp-load-plugins';
import pkg from './package.json';

const $ = gulpLoadPlugins();

const bases = {
  dist: 'content/themes/RhythmicExcellence/',
  src: 'content/themes/RhythmicExcellence_dev/',
  tmp: '.temp/',
},

paths = {
  html: '*.*',
  fonts: 'fonts/**/*',
  images: 'img/**/*',
  sass: 'styles/main.scss',
  css: 'styles/vendor/*.*',
  scripts: 'scripts/*.js',
},

BANNER = [
  '\n',
  '  RhythmicExcellence',
  '  ==================',
  '  version v' + pkg.version,
  '  created by ' + pkg.author.name + ' <' + pkg.author.email + '>',
  '  link ' + pkg.homepage,
  '  license ' + pkg.license,
  '',
],

VERSION_BANNER = '\n RhythmicExcellence\n v' + pkg.version +
                  '\n created by ' + pkg.author.name + ' <' + pkg.author.email + '>' +
                  '\n license ' + pkg.license + '\n',

AUTOPREFIXER_BROWSERS = [
  'ie >= 9',
  'ie_mob >= 10',
  'ff >= 30',
  'chrome >= 34',
  'safari >= 7',
  'opera >= 23',
  'ios >= 7',
  'android >= 4.4',
  'bb >= 10',
];

gulp.task('banner', () =>
  gutil.log(gutil.colors.magenta(BANNER.join('\n')))
);

// Delete the distribution theme folder
gulp.task('clean', ['banner'], () => {
  del([
    bases.dist,
    bases.tmp,
  ]).then(paths => {
    gutil.log('Deleting temp files from:\n', paths.join('\n'));
  });
});

// Lint JavaScript
gulp.task('lint', () =>
  gulp.src(bases.src + paths.scripts)
    .pipe($.eslint())
    .pipe($.eslint.format())
);

gulp.task('styles', () => {
  gulp.src([
      bases.src + paths.css,
      bases.src + paths.sass,
    ])
    .pipe($.sass({
      precision: 5,
      outputStyle: 'expanded',
      sourceComments: true,
    }).on('error', $.sass.logError))
    .pipe($.concat('app.min.css'))
    .pipe(gulp.dest(bases.dist + 'styles'));
});

// Compile and automatically prefix stylesheets
gulp.task('styles:build', () => {
  gulp.src([
      bases.src + paths.css,
      bases.src + paths.sass,
    ])
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      precision: 5,
    }).on('error', $.sass.logError))
    .pipe($.concat('app.css'))
    .pipe(gulp.dest(bases.src + 'styles'))

    // .pipe($.uncss({
    //   html: [
    //     'http://stage.rhythmicexcellence.sonnywebdesign.com',
    //     'http://stage.rhythmicexcellence.sonnywebdesign.com/rhythmic-gymnastics/',
    //     'http://stage.rhythmicexcellence.sonnywebdesign.com/calendar/calendar/'
    //   ],
    //   media: [
    //     '(max-width: 400px) handheld and (orientation: landscape)',
    //     '(min-width: 400px) handheld and (orientation: landscape)'
    //   ]
    // }))
    // Concatenate and minify styles

    .pipe($.cssnano({
      autoprefixer: AUTOPREFIXER_BROWSERS,
      safe: true,
      discardComments: { removeAll: true },
    }))
    .pipe($.size({
      title: 'styles',
    }))
    .pipe($.header('/**<%= banner %>**/\n', {
      banner: VERSION_BANNER,
    }))
    .pipe($.rename('app.min.css'))
    .pipe($.sourcemaps.write('.'))
    .pipe(gulp.dest(bases.dist + 'styles'));
});

// Concatenate and minify JavaScript. Optionally transpiles ES2015 code to ES5.
gulp.task('scripts', () =>
  gulp.src([
      // Note: Since we are not using useref in the scripts build pipeline,
      //       you need to explicitly list your scripts here in the right order
      //       to be correctly concatenated
      bases.src + 'bower_components/jquery/dist/jquery.min.js',
      bases.src + 'scripts/fixElements.js',
      bases.src + 'scripts/fixImages.js',
      bases.src + 'scripts/gMap.js',
      bases.src + 'scripts/readMore.js',
      bases.src + 'scripts/responsiveMenu.js',
      bases.src + 'scripts/scrollTop.js',
      bases.src + 'scripts/submitForm.js',
      bases.src + 'scripts/app.js',
    ])
    .pipe($.newer(bases.tmp + 'scripts'))
    .pipe($.sourcemaps.init())
    .pipe($.babel())
    .pipe($.sourcemaps.write())
    .pipe($.concat('app.min.js'))
    .pipe(gulp.dest(bases.tmp + 'scripts'))
    .pipe($.uglify({
      preserveComments: false,
    }))
    .pipe($.header('/**<%= banner %>**/\n', {
      banner: VERSION_BANNER,
    }))

    // Output files
    .pipe($.size({
      title: 'scripts',
    }))
    .pipe($.sourcemaps.write('.'))
    .pipe(gulp.dest(bases.dist + 'scripts'))
);

gulp.task('replace', ['copy'], () =>
  gulp.src([
      bases.src + 'header.php',
      bases.src + 'footer.php',
    ])
    .pipe($.htmlReplace({
      css:      '<link rel="stylesheet" href="<?php bloginfo(\'' +
                'template_directory\');?>/styles/app.min.css">',
      js:       '<script src="<?php bloginfo(\'template_directory\'' +
                ');?>/scripts/app.min.js" async></script>',
      version:  '<!--' + VERSION_BANNER + '-->',
    }))
    .pipe(gulp.dest(bases.dist))
);

gulp.task('minifyHtml', ['replace'], () =>
  gulp.src([
      bases.dist + '*.php',
    ])
    .pipe($.minifyInline())
    .pipe(gulp.dest(bases.dist))
);

// Copy all files at the root level (app)
gulp.task('copy', () =>
  gulp.src([
    bases.src + '/*.*',
    bases.src + '*' + paths.fonts,
  ], {
    dot: true,
  }).pipe(gulp.dest(bases.dist))
    .pipe($.size({
      title: 'copy',
    }))
);

// Copy all files at the root level (app)
gulp.task('themeName', function() {
  del([
    bases.dist + '/_style.css',
  ]);

  return gulp.src([
      bases.src + '/_style.css',
    ])
    .pipe($.rename('style.css'))
    .pipe(gulp.dest(bases.dist));
});

// Optimize images
gulp.task('images', () =>
  gulp.src(paths.images, {
    cwd: bases.src,
  })
    .pipe($.imagemin({
      progressive: true,
      optimizationLevel: 7,
    }))
    .pipe($.flatten())
    .pipe(gulp.dest(bases.dist + 'img'))
    .pipe($.size({
      title: 'images',
    }))
);

gulp.task('images:uploads', () =>
  gulp.src('**/*', {
      cwd: 'content/uploads',
    })
    .pipe($.imagemin({
      progressive: true,
      optimizationLevel: 7,
    }))
    .pipe(gulp.dest('content/uploads'))
    .pipe($.size({
      title: 'uploads',
    }))
);

gulp.task('watch', function () {
  gulp.watch(bases.src + 'styles/**/*', ['styles']);
  gulp.watch(bases.src + paths.scripts, ['scripts']);
  gulp.watch(bases.src + '*.php', ['minifyHtml']);
  gulp.watch(bases.src + paths.images, ['images']);
});


// Build production files
gulp.task('build', ['clean'], cb =>
  runSequence(
    'styles:build',
    ['lint', 'scripts', 'images', 'images:uploads'],
    'minifyHtml',
    'themeName',
    cb
  )
);

gulp.task('default', ['clean'], function(cb) {
  runSequence(
    'styles',
    ['lint', 'scripts', 'images'],
    'minifyHtml',
    'watch',
    cb
  );
});
