
Installation
------------

Either run

```
composer require thefx/yii2-user:dev-master
```

or add

```
"thefx/yii2-blocks": "dev-master"
```

Apply Migrations

```
php yii migrate --migrationPath=@thefx/user/migrations
```

Config

```
'modules' => [
    'user' => [
        'class' => 'thefx\user\Module',
    ],
],
'components' => [
    'user' => [
        'identityClass' => 'thefx\user\models\User',
        'enableAutoLogin' => true,
        'loginUrl' => ['/login'],
    ],
]
```

If you want to prevent registration

```
'user' => [
    'class' => 'thefx\user\Module',
    'controllerMap' => [
        'default' => [
            'class' => 'thefx\user\controllers\DefaultController',
            'allowRegister' => false,
        ],
    ],
],
```


Links

    https://mysite.ru/login
    https://mysite.ru/register
