<?php

use yii\db\Migration;

/**
 * Class m180911_212427_alter_table_url_alias
 */
class m180911_212427_alter_table_url_alias extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('url_alias', 'redirect_code', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180911_212427_alter_table_url_alias cannot be reverted.\n";

        return false;
    }

}
