<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m161005_121131_create_user_table extends Migration
{
    /**
     * @inheritdoc
     *
     *
     */

    public function up()
    {

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci';
        }

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->char(64),
            'password' => $this->char(32),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
