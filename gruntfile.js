
// Gruntfile.js
module.exports = function (grunt) {
  require('load-grunt-tasks')(grunt); // loads browserSync, watch, shell, concurrent

  const proxyUrl = process.env.WP_PROXY_URL || 'http://wp.local'; // <-- set your local WP URL

  grunt.initConfig({
    browserSync: {
      dev: {
        bsFiles: { src: ['dist/assets/*.js', 'dist/assets/*.css', '**/*.php', 'tailwind.config.js'] },
        options: { proxy: proxyUrl, open: false, notify: true, watchTask: true }
      }
    },
    watch: {
      scripts: { files: ['src/**/*.{js,jsx,css}'], tasks: [], options: { spawn: false } },
      config:  { files: ['postcss.config.js'] },
      php:     { files: ['**/*.php'] }
    },
    shell: {
      webpackWatch: { command: 'npm run webpack:watch' },
      webpackBuild: { command: 'npm run webpack:build' },
      webpackServe: { command: 'npm run serve' }
    },
    concurrent: {
      options: { logConcurrentOutput: true },
      dev: ['shell:webpackWatch', 'browserSync', 'watch'],
      hmr: ['shell:webpackServe', 'browserSync', 'watch']
    }
  });

  grunt.registerTask('dev', ['concurrent:dev']);
  grunt.registerTask('hmr', ['concurrent:hmr']);
  grunt.registerTask('build', ['shell:webpackBuild']);
};
