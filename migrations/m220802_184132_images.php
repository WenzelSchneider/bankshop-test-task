<?php

use yii\db\Migration;

/**
 * Class m220802_184132_images
 */
class m220802_184132_images extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('images', [
            'id' => $this->primaryKey(),
            'filename' => $this->string()->notNull()->unique(),
            'upload' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('post');
    }
    
}
