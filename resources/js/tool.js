if (window.LaravelNova === undefined) {
  window.LaravelNova = require('laravel-nova')
}

if (window.LaravelNova === undefined) {
  window.LaravelNovaUi = require('laravel-nova-ui')
}

Nova.booting(() => {
  let currentTheme = null

  new MutationObserver(() => {
    const element = document.documentElement.classList
    const theme = element.contains('dark') ? 'dark' : 'light'

    if (theme !== currentTheme) {
      Nova.$emit('nova-theme-switched', {
        theme,
        element
      })

      currentTheme = theme
    }
  }).observe(document.documentElement, {
    attributes: true,
    attributeOldValue: true,
    attributeFilter: ['class'],
  })
})
