<?php

namespace settings\migrations;

use yii\db\Migration;
use yii\rbac\Item as rbacItem;
use rbacUserManager\components\MigrationTrait;

/**
 * Создание таблицы `settings`.
 */
class m220719_154657_create_settings_table extends Migration
{

    use MigrationTrait;

    protected $tableName = 'settings';

    protected $authItems = [
        'permissions'   => [
            [
                'name'          => 'settingsCreate',
                'ruleName'      => null,
                'description'   => 'Разрешение создавать новые настройки.',
            ],
            [
                'name'          => 'settingsDelete',
                'ruleName'      => null,
                'description'   => 'Разрешение удалять настройки.',
            ],
            [
                'name'          => 'settingsIndex',
                'ruleName'      => null,
                'description'   => 'Разрешение просматривать список настроек.',
            ],
            [
                'name'          => 'settingsUpdate',
                'ruleName'      => null,
                'description'   => 'Разрешение обновлять настройки.',
            ],
            [
                'name'          => 'settingsView',
                'ruleName'      => null,
                'description'   => 'Разрешение просматривать настройки.',
            ],
        ],
        'roles'         => [
            [
                'name'          => 'settingsManager',
                'ruleName'      => null,
                'description'   => 'Управление настройками.',
                'children'      => [
                    'settingsCreate'    => rbacItem::TYPE_PERMISSION,
                    'settingsDelete'    => rbacItem::TYPE_PERMISSION,
                    'settingsIndex'     => rbacItem::TYPE_PERMISSION,
                    'settingsUpdate'    => rbacItem::TYPE_PERMISSION,
                    'settingsView'      => rbacItem::TYPE_PERMISSION,
                    'fileManager'       => rbacItem::TYPE_PERMISSION,
                    'user'              => rbacItem::TYPE_ROLE,
                ],
            ],
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if(!$this->tableExists()){
            $this->createTable($this->tableName, [
                'id'    => $this->string(255)->notNull(),
                'name'  => $this->string()->notNull()->unique(),
                'value' => $this->db->schema->createColumnSchemaBuilder('LONGTEXT')->null(),
                'type'  => $this->db->schema->createColumnSchemaBuilder('TINYINT', 1)->notNull()->defaultValue(1),
            ]);

            $this->addPrimaryKey('pk_' . $this->tableName, $this->tableName, 'id');
        }

        $this->addPermissions($this->authItems['permissions']);
        $this->addRoles($this->authItems['roles']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->tableExists() && $this->dropTable($this->tableName);

        $this->deletePermissions($this->authItems['permissions']);
        $this->deleteRoles($this->authItems['roles']);
    }

    protected function tableExists()
    {
        return !is_null($this->db->schema->getTableSchema($this->tableName));
    }

}
