<?php

use Core\migration\AbstractMigrationModel;

class m191023_002400_create_user_table extends AbstractMigrationModel
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

        $query = 'create table `user` (
            `id` int primary key auto_increment,
            `login` varchar(50) not null unique ,
            `password` varchar(50) not null,
            `accessToken` varchar(32) not null,
            `firstName` varchar(50),
            `lastName` varchar(50)
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

        $query = 'drop table `user`';

        $connection->execute($query);
    }
}