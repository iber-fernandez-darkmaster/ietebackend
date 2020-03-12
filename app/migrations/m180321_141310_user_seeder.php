<?php

use yii\db\Migration;

/**
 * Class m180321_141310_user_seeder
 */
class m180321_141310_user_seeder extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // $Faker = Faker\Factory::create("es");
        /**
         * register of super admin
         * and first user
         */
        // this ID is 1
        $this->insert('user',[
            'id'=> 1,
            'username'=> 'admin',
            'email'=> 'admin@admin.com',
            'rol'=> 'admin',
            'password_hash'=> Yii::$app->security->generatePasswordHash('admin'),
            'auth_key'=> Yii::$app->security->generateRandomString(),
            'status'=> 10,
            'created_at'=> 1,
            'updated_at'=> 1
        ]);
        // this ID is 2
        $this->insert('user',[
            'id'=> 2,
            'username'=> 'administrador',
            'email'=> 'admin@admin.com',
            'rol'=> 'administrador',
            'password_hash'=> Yii::$app->security->generatePasswordHash('administrador'),
            'auth_key'=> Yii::$app->security->generateRandomString(),
            'status'=> 10,
            'created_at'=> 1,
            'updated_at'=> 1
        ]);
        // this ID is 3
        $this->insert('user',[
            'username'=> 'editor',
            'email'=> 'editor@editor.com',
            'rol'=> 'editor',            
            'password_hash'=> Yii::$app->security->generatePasswordHash('editor'),
            'auth_key'=> Yii::$app->security->generateRandomString(),
            'status'=> 10,
            'created_at'=> 1,
            'updated_at'=> 1
        ]);
        // // this ID is 4
        // $this->insert('user',[
        //     'username'=> 'secretaria',
        //     'email'=> 'secretaria@secretaria.com',
        //     'rol'=> 'secretaria',            
        //     'password_hash'=> Yii::$app->security->generatePasswordHash('secretaria'),
        //     'auth_key'=> Yii::$app->security->generateRandomString(),
        //     'status'=> 10,
        //     'created_at'=> 1,
        //     'updated_at'=> 1
        // ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // $this->delete('news', ['id' => 1]);
        $this->truncateTable('user');

        return false;
    }
}
