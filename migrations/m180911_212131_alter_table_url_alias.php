<?php

use yii\db\Migration;

/**
 * Class m180911_212131_alter_table_url_alias
 */
class m180911_212131_alter_table_url_alias extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('url_alias', 'redirect', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180911_212131_alter_table_url_alias cannot be reverted.\n";

        return false;
    }

}
