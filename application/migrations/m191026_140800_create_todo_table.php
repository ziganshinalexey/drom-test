<?php

use Core\migration\AbstractMigrationModel;

class m191026_140800_create_todo_table extends AbstractMigrationModel
{
    /**
     * Метод накатывает миграцию.
     *
     * @return void
     *
     * @throws Exception
     */
    public function up(): void
    {
        $connection = $this->getDatabaseComponent()->getConnection();

        $query = 'create table `todo` (
            `id` int primary key auto_increment,
            `name` varchar(255) not null,
            `isCompleted` boolean not null,
            `userId` int not null
        )';

        $connection->execute($query);
    }

    /**
     * Метод откатывает миграцию.
     *
     * @return void
     *
     * @throws Exception
     */
    public function down(): void
    {
        $connection = $this->getDatabaseComponent()->getConnection();

        $query = 'drop table `todo`';

        $connection->execute($query);
    }
}