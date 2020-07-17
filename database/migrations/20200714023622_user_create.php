<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UserCreate extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('user');
        $table->addColumn('username','string',array('limit'=>25,'default'=>'','comment'=>'用户名'));
        $table->addColumn('password','string',['limit'=>255,'comment'=>'用户密码','default'=>password_hash('123456',PASSWORD_DEFAULT)]);
        $table->addColumn('create_time','datetime',['comment'=>'创建时间']);
        $table->addColumn('update_time','datetime',['comment'=>'修改时间']);
        $table->addColumn('delete_time','datetime',['comment'=>'软删除时间','null'=>true]);
        $table->create();
    }
}