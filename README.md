Settings
====
db stored settings

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist plusser/yii2-settings "*"
```

or add

```
"plusser/yii2-settings": "*"
```

to the require section of your `composer.json` file.

Simple configuration:

1. Add settings module to your web and console config.

```
[
  ...
    'bootstrap' => [ ..., 'settings', ]
    'modules' => [
      ...
        'settings' => [
            'class' => 'settings\Module',
            //'backendMode' => true, # for backend only
        ],
      ...
    ],
  ...
]
```
2. Run migrations:

```
php yii migrate/up

```
