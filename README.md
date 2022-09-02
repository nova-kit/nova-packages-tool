Tool for Laravel Nova Packages Development
==============

[![Latest Stable Version](https://poser.pugx.org/nova-kit/nova-packages-tool/v/stable)](https://packagist.org/packages/nova-kit/nova-packages-tool)
[![Total Downloads](https://poser.pugx.org/nova-kit/nova-packages-tool/downloads)](https://packagist.org/packages/nova-kit/nova-packages-tool)
[![Latest Unstable Version](https://poser.pugx.org/nova-kit/nova-packages-tool/v/unstable)](https://packagist.org/packages/nova-kit/nova-packages-tool)
[![License](https://poser.pugx.org/nova-kit/nova-packages-tool/license)](https://packagist.org/packages/nova-kit/nova-packages-tool)

This library provides a versioning `laravel-nova` mixins dependency for 3rd party packages built for Laravel Nova.

## Installation

To install through composer, run the following command from terminal:

```bash 
composer require "nova-kit/nova-packages-tool:^1.0"
```

## Usages

First, you need to add webpack.external alias to `laravel-nova` and comment the existing reference to `vendor/laravel/nova/resources/js/mixins/js/packages.js` under `nova.mix.js`:

```js

webpackConfig.externals = {
  vue: 'Vue',
  'laravel-nova': 'LaravelNova'
}

// webpackConfig.resolve.alias = {
//   ...(webpackConfig.resolve.alias || {}),
//   'laravel-nova': path.join(
//   __dirname,
//   'vendor/laravel/nova/resources/js/mixins/packages.js'
//   ),
// }
```

This would allow your package to depends on `laravel-nova` from external source and no longer compiled it locally. 