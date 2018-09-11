<?php

use yii\db\Migration;

/**
 * Class m180911_151613_create_table
 */
class m180911_151613_create_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('url_alias', [
            'id' => $this->primaryKey(),
            'alias' => $this->string()->notNull(),
            'route' => $this->string()->notNull(),
            'params' => $this->string()->notNull()->defaultValue('a:0:{}'),
            'hash' => $this->string(32)->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(1),
        ]);
    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('url_alias');
    }
}
