/**
 * Created by miguelplazas on 29/04/16.
 */

module.exports = function (grunt) {

    var path = require('path');

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        ngAnnotate: {
            options: {
                singleQuotes: true,
                //regexp: '^(ng\n?[\\ ]+(.*)|(module.*))$'
            },
            app: {
                files: {
                    'app/Resources/public/min-safe/js/controllers.js': [
                        'app/Resources/Angular/controllers/masterController.js',
                        'app/Resources/Angular/controllers/customer/MainController.js',
                        'app/Resources/Angular/controllers/customer/NewController.js',
                        'app/Resources/Angular/controllers/appointment/MainController.js',
                        'app/Resources/Angular/controllers/appointment/NewController.js'
                    ],
                    'app/Resources/public/min-safe/app.js': ['app/Resources/Angular/app.js']
                }
            }
        },

        bower: {
            install: {
                options: {
                    targetDir: './app/Resources/public/assets',
                    layout: function(type, component, source) {
                        var renamedType = type;
                        if (type == 'js') renamedType = 'js/lib';
                        else if (type == 'js/map') renamedType = 'js/lib';
                        else if (type == 'js/js') renamedType = 'js/js';
                        else if (type == 'js/lang') renamedType = 'js/lib/lang';
                        else if (type == 'css') renamedType = 'css/lib';
                        else if (type == 'fonts') renamedType = 'fonts';
                        else if (type == 'css/img') renamedType = 'css';
                        else if (type == 'src') renamedType = 'src';
                        return path.join(renamedType);;
                    },
                    install: true,
                    verbose: false,
                    cleanTargetDir: false,
                    cleanBowerDir: false,
                    bowerOptions: {}
                }
            }
        },

        cssmin : {
            bundled:{
                src: 'app/Resources/public/assets/css/lib.css',
                dest: 'web/assets/css/lib.min.css'
            }
        },

        uglify : {

            js: {
                files: {
                    'web/assets/js/lib.min.js': ['app/Resources/public/assets/js/lib.js']
                }
            },

            app: {
                files: {
                    'web/assets/js/app.min.js': ['app/Resources/public/app/app.js']
                }
            }
        },

        sass: {
            dist: {
                files: {
                    'app/Resources/public/assets/css/lib/main.css': 'app/Resources/template/sass/main.scss'

                }
            }
        },


        concat: {
            options: {
                stripBanners: true
            },

            css: {
                src: [
                    'app/Resources/public/assets/css/lib/font-awesome.css',
                    'app/Resources/public/assets/css/lib/angular-material.css',
                    'app/Resources/public/assets/css/lib/animate.css',
                    'app/Resources/public/assets/css/lib/c3.css',
                    'app/Resources/public/assets/css/lib/ionicons.css',
                    'app/Resources/public/assets/css/lib/main.css',
                    'app/Resources/public/assets/css/lib/angular-material-icons.css',
                    'app/Resources/template/css/admin.css'
                ],
                dest: 'app/Resources/public/assets/css/lib.css'
            },
            js : {
                src : [
                    'app/Resources/public/assets/js/lib/angular.js',
                    'app/Resources/public/assets/js/lib/angular-ui-router.js',
                    'app/Resources/public/assets/js/lib/angular-animate.js',
                    'app/Resources/public/assets/js/lib/angular-aria.js',
                    'app/Resources/public/assets/js/lib/angular-messages.js',
                    'app/Resources/public/assets/js/lib/angular-chart.js',
                    'app/Resources/public/assets/js/lib/angular-resource.js',
                    'app/Resources/public/assets/js/lib/angular-route.js',
                    'app/Resources/public/assets/js/lib/angular-touch.js',
                    'app/Resources/public/assets/js/lib/angular-material.js',
                    'app/Resources/public/assets/js/lib/angular-cookies.js',
                    'app/Resources/public/assets/js/lib/angular-material-icons.js',
                    'app/Resources/public/assets/js/lib/lodash.js',
                    'app/Resources/public/assets/js/lib/restangular.js',
                    'app/Resources/public/assets/js/lib/c3.js',
                    'app/Resources/public/assets/js/lib/d3.js',
                    'app/Resources/public/assets/js/lib/ui-navbar.js'
                ],
                dest: 'app/Resources/public/assets/js/lib.js'
            },

            app: {
                src: ['app/Resources/public/min-safe/app.js', 'app/Resources/public/min-safe/js/*.js'],
                dest: 'app/Resources/public/app/app.js'

            }
        },

        copy: {
            fonts: {
                expand: true,
                cwd: 'app/Resources/public/assets/fonts',
                src: '*',
                dest: 'web/assets/fonts/'
            },
            images: {
                expand: true,
                cwd: 'app/Resources/template/img',
                src: '*',
                dest: 'web/assets/img/'
            }
        },

        watch: {
            angularJs: {
                files: ['Gruntfile.js', 'app/Resources/Angular/**/*.js'],
                tasks: ['ngAnnotate', 'concat:app', 'uglify:app']
            }

        }



    });

    grunt.loadNpmTasks('grunt-bower-task');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-ng-annotate');
    grunt.loadNpmTasks('grunt-contrib-watch');



    grunt.registerTask('full', ['bower', 'copy', 'ngAnnotate', 'concat', 'cssmin', 'uglify']);
    grunt.registerTask('default', ['ngAnnotate', 'concat:app', 'uglify:app', 'watch']);

};