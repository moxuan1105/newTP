<?php

use think\migration\Migrator;

class StaffCreate extends Migrator
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
        $table = $this->table('staffs');
        $table->addColumn('work_no', 'string', ['comment' => '员工工号']);
        $table->addColumn('name', 'string', ['comment' => '员工姓名']);
        $table->addColumn('indirect_type', 'string', ['comment' => '间直接类型']);
        $table->addColumn('position', 'string', ['comment' => '资位']);
        $table->addColumn('m_position', 'string', ['comment' => '管理职  Management position']);
        $table->addColumn('staff_type', 'string', ['comment' => '员工用工类型']);
        $table->addColumn('sex', 'string', ['length' => 1, 'comment' => '性别 F female 女性 | M male 男性']);
        $table->addColumn('business_division', 'string', ['comment' => '事业处']);
        $table->addColumn('factory_division', 'string', ['comment' => '厂处']);
        $table->addColumn('department', 'string', ['comment' => '部']);
        $table->addColumn('class', 'string', ['comment' => '课']);
        $table->addColumn('create_time', 'datetime', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'datetime', ['comment' => '修改时间']);
        $table->create();
    }
}
