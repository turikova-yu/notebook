<?php

use yii\db\Migration;

/**
 * Class m230618_162234_table_note
 */
class m230618_162234_table_note extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%note}}', [
            'id' => $this->primaryKey(),
            'title'=> $this->string()->notNull()->unique()->comment('заголовок'),
            'text' => $this->text()-> comment('текст записи'),
            'created_at'=> $this->timestamp()->notNull()->comment('дата создания'),
            'updated_at'=> $this->timestamp()->comment('дата редактирования'),
            'user_id'=> $this->integer()->comment('id пользователя-автора'),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_user_id_note',
            'note',
            'user_id',
            'user',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'FK_user_id_note',
            'note'
        );
        $this->dropTable('{{%note}}');
    }
}