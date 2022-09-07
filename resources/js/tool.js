window.LaravelNova = require('laravel-nova')

Nova.booting(app => {
  new MutationObserver(() => {
    const element = document.documentElement.classList
    const theme = element.contains('dark') ? 'light' : 'dark'

    Nova.$emit('package: theme-switched', {
      theme,
      element
    })
  }).observe(document.documentElement, {
    attributes: true,
    attributeOldValue: true,
    attributeFilter: ['class'],
  })
})