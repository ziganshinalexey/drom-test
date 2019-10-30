# Core framework (DROM test)
Так как по условию задания нельзя было использовать фреймверки на PHP, было решено написать свой.
Проект состоит из двух основных контейнеров (php7.3 + apache и db(mysql:8)) и одного вспомогательного (phpmyadmin).

Требования
---
docker-compose: "^1.24.1"

Установка
---
```docker-compose up -d```

```docker exec drom-test_apache_1 php core.php migrate/up```

[TODO application](http://0.0.0.0:8001)

[PMA](http://0.0.0.0:8002) (root/123)

Описание
---
Проект имеет 2 точки входа
 * var/www/www/index.php (Для Apache).
 * var/www/core.php (Для консоли).

Проект не использует пакетного менеджера, так как все компоненты написаны самостоятельно. Автозагрузка файлов работает через кофигурацию пространства имен `/var/www/vendor/namespaces.php`.
Приложение имеет ключевой класс `Core\Core::class`, который имеет функцию инициализации приложения, функцию создания объекта с зависимостями и доступ к объекту приложения.
Для инициализации консольного приложения его необходимо сконфигурировать:
 * Задать класс, реализующий `Core\application\interfaces\console\IApplication::class`.
 * Задать список компонентов, необходимый для работы приложения.
Пример текущей конфигурации:
```php
return [
    'class'         => Application::class,
    'componentList' => [
        Request::COMPONENT_NAME   => [
            'class' => Request::class,
        ],
        'route'                   => [
            'class'         => Route::class,
            'controllerMap' => [
                'migrate' => ['class' => MigrateController::class],
            ],
        ],
        Migration::COMPONENT_NAME => [
            'class'         => Migration::class,
            'factory'       => [
                'class'  => MigrationFactory::class,
                'config' => [
                    MigrationFactory::DOWN_OPERATION => ['class' => DownOperation::class],
                    MigrationFactory::UP_OPERATION   => ['class' => UpOperation::class],
                ],
            ],
            'migrationPath' => dirname(__FILE__, 2) . '/migrations',
        ],
        DataBase::COMPONENT_NAME  => [
            'class'   => DataBase::class,
            'factory' => [
                'class'  => DBFactory::class,
                'config' => [
                    DBFactory::CONNECTION => [
                        'class'    => Connection::class,
                        'host'     => 'db',
                        'username' => 'root',
                        'passwd'   => '123',
                        'dbname'   => 'todo',
                    ],
                    DBFactory::RESULT     => ['class' => DataResult::class],
                ],
            ],
        ],
    ],
];
``` 
Консольное приложение реализует интерфейс взаимодейстия с проектом внутри контейнера apache. Сейчас реализованы только методы применения и отмены миграций. В консольном приложении не реализован функционал возврата кодов. 
