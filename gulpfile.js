/* ######################################
 GULP PLUGINS
 ###################################### */
var gulp                = require('gulp'),
    replace             = require('gulp-replace'),
    rename              = require("gulp-rename"),
    less                = require('gulp-less'),
    concat              = require('gulp-concat'),
    concatCss           = require('gulp-concat-css'),
    uglyfly             = require('gulp-uglyfly'),
    imagemin            = require('gulp-imagemin'),
    del                 = require('del'),
    runSequence         = require('run-sequence').use(gulp),
    parameter           = require('./parameters.json'),
    lessPluginCleanCSS  = require('less-plugin-clean-css'),
    cleancss            = new lessPluginCleanCSS({ advanced: true });

/* ######################################
 VARS & FILES
 ###################################### */
// fichier LESS du thème à écouter en watch
var lessFiles   = './wp-content/themes/' + parameter.name + '/css/{,**/}*.less';
// fichiers LESS du thème à compiler et minifier
var lessFilesToMinify     = [
    './wp-content/themes/' + parameter.name + '/css/styles.less',
    './wp-content/themes/' + parameter.name + '/css/backoffice/admin.less',
    './wp-content/themes/' + parameter.name + '/css/backoffice/login.less',
    './wp-content/themes/' + parameter.name + '/css/backoffice/editor.less'
];
// fichiers CSS externes à concaténer avec le fichier CSS final du site
var cssFilesArray = [
    //ex : 
    //'path/monfichier.css',
    //'path/monfichier2.css',
];
// tous les fichiers Javascript du thème et externes
var jsFiles     = [
    './wp-content/themes/' + parameter.name + '/components/jquery/dist/jquery.min.js',
    './wp-content/themes/' + parameter.name + '/components/bootstrap/dist/js/bootstrap.min.js',
    './wp-content/themes/' + parameter.name + '/js/main.js'
];
// toutes les images du thème
var imgFiles    = './wp-content/themes/' + parameter.name + '/images/{,**/}*.{png,jpg,jpeg,gif,svg,ico}'; // fichiers images à compresser

/* ######################################
 COPY Task : duplication du thème starter en thème au nom du client
 ###################################### */
gulp.task('copy', function() {
    gulp.src('./wp-content/themes/starter/**/*')
        .pipe(gulp.dest('./wp-content/themes/' + parameter.name + '/'));
});

/* ######################################
 REPLACE task : remplacement du mot "starter" par le nom du client partout
 ###################################### */
gulp.task('replace', function() {
    //copie des fichiers du dossier "src" à la racine du site avec remplacement de "starter" par le nom du client
    gulp.src(['./src/wp-config-default.php', './src/.gitignore', './src/.bowerrc', './src/starter.sql'])
        .pipe(replace('starter.local', parameter.url))
        .pipe(replace('starter', parameter.name))
        .pipe(replace('Starter', parameter.name.charAt(0).toUpperCase() + parameter.name.slice(1)))
        .pipe(gulp.dest('./'));

    //remplacement du mot "starter" dans le fichier styles.css du thème client
    gulp.src(['./wp-content/themes/starter/style.css'])
        .pipe(replace('Starter', parameter.name.charAt(0).toUpperCase() + parameter.name.slice(1)))
        .pipe(gulp.dest('./wp-content/themes/' + parameter.name + '/'));

    //le fichier modèle de langue (traduction) est renommé au nom du thème client (obligatoire pour que la trad marche)
    gulp.src(['./wp-content/themes/starter/languages/starter.pot'])
        .pipe(rename(parameter.name + '.pot'))
        .pipe(gulp.dest('./wp-content/themes/' + parameter.name + '/languages/'));

    //on supprime le fichier de langues POT par défaut
    return del(['./wp-content/themes/' + parameter.name + '/languages/starter.pot']);
});

/* ######################################
 CSS task : compilation less, réordonnancement et minification css, puis copie des fichiers finaux dans le dossier css/min du thème
 ###################################### */
gulp.task('css', function (cb) {
    gulp.src(lessFilesToMinify)
        .pipe(less({
            plugins: [cleancss]
        })) // Compilation
        .pipe(rename({ // on prefixe le fichier avec "min" pour signifier qu'il est minifié
            suffix: '.min'
        }))
        .pipe(gulp.dest('./wp-content/themes/' + parameter.name + '/css/min/')); // copie du fichier css final et minifié dans le dossier css pour les styles du sites

    // Concaténation des fichiers CSS externes avec fichier CSS final minifié du site
    var cssFiles = ['./wp-content/themes/' + parameter.name + '/css/min/styles.min.css'].concat(cssFilesArray);

    gulp.src(cssFiles)
        .pipe(concatCss("styles.min.css")) // Nom du fichier CSS final
        .pipe(gulp.dest('./wp-content/themes/' + parameter.name + '/css/min/')); // copie du less dans le dossier css pour les styles du sites

    cb();
});

/* ######################################
 JS task : minification et concaténation JS puis copie du fichier final dans le dossier js/min du thème
 ###################################### */
gulp.task('js', function() {
    return gulp.src(jsFiles)
        .pipe(uglyfly())
        .pipe(concat('main.min.js'))
        .pipe(gulp.dest('./wp-content/themes/' + parameter.name + '/js/min/'));
});

/* ######################################
 IMG task : optimisation des images du thème
 ###################################### */
gulp.task('img', function () {
    return gulp.src(imgFiles)
        .pipe(imagemin({
            svgoPlugins: [{
                removeViewBox: false
            }, {
                cleanupIDs: false
            }]
        }))
        .pipe(gulp.dest('./wp-content/themes/' + parameter.name + '/images/'));
});

/* ######################################
 WATCH task : on surveille la modif des fichiers LESS, JS et IMAGES, pour relancer les tâches associées si modification
 ###################################### */
gulp.task('watch', function () {
    gulp.watch([lessFiles, cssFilesArray], ['css']);
    gulp.watch([jsFiles], ['js']);
    gulp.watch([imgFiles], ['img']);
});

/* ######################################
 BUILD task : éxécution des tâches personnalisation client du theme wordpress
 ###################################### */
gulp.task('build', function(callback) {
    runSequence(['copy', 'replace'], 'img', callback);
});

/* ######################################
 COMPILE task : compile le less et créé le fichier optimisé CSS final, concatène et optimise les fichiers JS
 ###################################### */
gulp.task('compile', function(callback) {
    runSequence(['css', 'js'], callback);
});

/* ######################################
 DEFAULT task : à lancer via le raccourci 'gulp' en mode dev
 ###################################### */
gulp.task('default', [
    'compile',
    'watch'
]);