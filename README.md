## CoreUI Vue Starter Kit

<p align="center">
<a href="https://github.com/kastsecho/coreui-vue-starter-kit/actions"><img src="https://github.com/kastsecho/coreui-vue-starter-kit/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/kastsecho/coreui-vue-starter-kit"><img src="https://img.shields.io/packagist/dt/kastsecho/coreui-vue-starter-kit" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/kastsecho/coreui-vue-starter-kit"><img src="https://img.shields.io/packagist/v/kastsecho/coreui-vue-starter-kit" alt="Latest Stable Version"></a>
<a href="https://herd.laravel.com/new?starter-kit=kastsecho/coreui-vue-starter-kit"><img src="https://img.shields.io/badge/Install%20with%20Herd-f55247?logo=laravel&logoColor=white"></a>
</p>

## Features
* Authentication
  * Log in / Register
  * Email Verification
  * Password Confirmation
  * Update Profile
  * Update Password
* Design
  * Responsive
  * Dark Mode

## Upcoming Features
* Laravel Fortify
  * 2FA Enable / Disable
  * 2FA Verification

## Tech Stack
* [Laravel](https://laravel.com)
* [Laravel Fortify](https://laravel.com/docs/fortify)
* [CoreUI for Vue](https://coreui.io/vue)
* [Vite](https://vitejs.dev)
* [Vue.js](https://vuejs.org)

## Installation

```php
laravel new project --using=kastsecho/coreui-vue-starter-kit
cp .env.example .env
php artisan key:generate
php artisan migrate
npm ci && npm run build
```
