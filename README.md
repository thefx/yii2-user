
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

config

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


Links

    https://mysite.ru/login
    https://mysite.ru/register
