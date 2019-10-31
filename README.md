# Core framework (DROM test)
Так как по условию задания нельзя было использовать фреймверки на PHP, было решено написать свой.
Проект состоит из двух основных контейнеров (php7.3 + apache и db(mysql:8)) и одного вспомогательного (phpmyadmin).

Требования
---
docker-compose: "^1.24.1"

Установка
---
```docker-compose up -d --build```

```docker exec drom-test_db_1 mysql -u root -p123 -e "CREATE DATABASE todo"```

Ошибка, которая может случиться `ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2)`
Не получилось разобраться. Лечится ожиданием в 10-15 секунд и повторным исполнением команды.

```docker exec drom-test_apache_1 php core.php migrate/up```

[TODO application](http://0.0.0.0:8001)

[PMA](http://0.0.0.0:8002) (root/123)

Описание
---
Проект имеет 2 точки входа
 * var/www/www/index.php (Для Apache).
 * var/www/core.php (Для консоли).

Проект не использует пакетного менеджера, так как все компоненты написаны самостоятельно. 
Автозагрузка файлов работает через конфигурацию пространства имен `/var/www/vendor/namespaces.php`.
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
        Route::COMPONENT_NAME     => [
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
Консольное приложение реализует интерфейс взаимодействия с проектом внутри контейнера apache. 
Сейчас реализованы только методы применения и отмены миграций. 
В консольном приложении не реализован функционал возврата кодов. 

Веб приложение конфигурируется аналогичным способом, только имеет больше компонентов и другой класс приложения.

Доступные (рабочие) урлы:
 * http://0.0.0.0 - страница авторизации.
 * http://0.0.0.0/user/login - страница авторизации.
 * http://0.0.0.0/user/register - страница регистрации.
 * http://0.0.0.0/todo/index - страница дел.
 
Рендер страницы происходит вне зависимости от прав пользователя (залогиненный или нет). Ajax запросы же проверяются на наличие прав и в случае неуспеха сервер возвращает 403 ошибку. 
