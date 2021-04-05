
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

Configure
---

```
php yii migrate --migrationPath=@app/vendor/yiisoft/yii2/rbac/migrations
```

---
Links

    https://mysite.ru/user/default/login
    https://mysite.ru/user/default/signup

add to routes

    '<_a:(login|logout|register|email-confirm|password-reset-request|password-reset|email-confirm-request)>' => 'user/default/<_a>',

