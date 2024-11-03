# msap-manage-tenant



## Getting started

Change「.env.example」 to 「.env」

---
## Install
```
$ composer install
$ npm install
$ npm run build
$ php artisan mirgate
$ php artisan db:seed
$ php artisan serve
```
---
## Create css file

1. Create file in css in resources/css
2. In file vite.config.js
3. Add file css just create to input array
```
input: [
    'resources/css/app.css',
    'resources/css/layout.css', //new css file
    'resources/js/app.js',
    'resources/js/layout.js',
    'resources/js/tenant.js',
],
```
4. Rerun
```
$ npm run build
```
---
## Create js file

1. Create file in js in resources/js
2. In file resources/js/app.js
3. Import file css just create
```
$ import './layout'; // new js file
```
4. Rerun
```
$ npm run build
```
---
## Use css/js file vite
In head tag add code:
```
$ @vite(['resources/css/app.css', 'resources/css/layout.css', 'resources/js/app.js'])
```
