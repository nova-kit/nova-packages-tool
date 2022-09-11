window.LaravelNova = require('laravel-nova')

Nova.booting(() => {
  new MutationObserver(() => {
    const element = document.documentElement.classList
    const theme = element.contains('dark') ? 'dark' : 'light'

    Nova.$emit('nova-theme-switched', {
      theme,
      element
    })
  }).observe(document.documentElement, {
    attributes: true,
    attributeOldValue: true,
    attributeFilter: ['class'],
  })
})
