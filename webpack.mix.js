let mix = require('laravel-mix')
let path = require('path')

require('./nova.mix')

mix
  .js('resources/js/tool.js', 'dist')
  .vue({ version: 3 })
  .sourceMaps()
  .setPublicPath('dist')
  .alias({
    '@': path.join(__dirname, 'vendor/laravel/nova/resources/js'),
  })
  .nova('nova-kit/nova-packages-tool')
