Tool for Laravel Nova Packages Development
==============

[![Latest Stable Version](https://poser.pugx.org/nova-kit/nova-packages-tool/v/stable)](https://packagist.org/packages/nova-kit/nova-packages-tool)
[![Total Downloads](https://poser.pugx.org/nova-kit/nova-packages-tool/downloads)](https://packagist.org/packages/nova-kit/nova-packages-tool)
[![Latest Unstable Version](https://poser.pugx.org/nova-kit/nova-packages-tool/v/unstable)](https://packagist.org/packages/nova-kit/nova-packages-tool)
[![License](https://poser.pugx.org/nova-kit/nova-packages-tool/license)](https://packagist.org/packages/nova-kit/nova-packages-tool)

This library provides a versioning `laravel-nova` mixins dependency for 3rd party packages built for Laravel Nova.

## Why?

`laravel-nova` may introduce breaking and none breaking improvements from time to time. To maintain compatibility all 3rd party packages should rebuild their packages each time Laravel Nova released a new version and depending on the severity of the changes it may result in your application no longer working and you have to remain on older versions.

### Pro

* `nova-kit/nova-packages-tool` reduces the maintaining hurdle for each 3rd party package utilizing `laravel-nova`.
* The `dist` generated file will be reduced since 3rd party package is no longer required to build `laravel-nova` source code.

### Cons

* Each time Laravel Nova made a new release, you need to wait until `nova-kit/nova-packages-tool` make a new compatible release.

## Installation

To install through composer, run the following command from terminal:

```bash 
composer require "nova-kit/nova-packages-tool:^1.0"
```

Next, make sure your application's `composer.json` contains the following command under `script.post-autoload-dump`:

```json
{
  "script" : {
    "post-autoload-dump": [
      "@php artisan vendor:publish --tag=laravel-assets --ansi --force"
    ]
  }
}
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

### Theme Switched Event

Instead of manually registering custom `MutationObserver` on each package, you can now listen to a single `nova-theme-switched` event:

```js
Nova.$on('nova-theme-switched', ({ theme, element }) => {
  if (theme === 'dark') {
    element.add('package-dark')
  } else {
    element.remove('package-dark')
  }
})
```
