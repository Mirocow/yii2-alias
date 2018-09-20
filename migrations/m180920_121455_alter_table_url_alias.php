<?php

use yii\db\Migration;

/**
 * Class m180920_121455_alter_table_url_alias
 */
class m180920_121455_alter_table_url_alias extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('url_alias', 'source', $this->string(255)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180920_121455_alter_table_url_alias cannot be reverted.\n";

        return false;
    }

}
