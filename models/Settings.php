<?php

namespace settings\models;

use yii\db\ActiveRecord;
use settings\widgets\StringField;
use settings\widgets\TextField;
use settings\widgets\HTMLField;
use settings\widgets\SwitchField;
use settings\widgets\DateTimeField;
use settings\widgets\ArrayField;

class Settings extends ActiveRecord
{

    const TYPE_STRING = 1;
    const TYPE_TEXT = 2;
    const TYPE_HTML = 3;
    const TYPE_SWITCH = 4;
    const TYPE_DATE_TIME = 5;
    const TYPE_ARRAY = 6;

    public static function tableName()
    {
        return 'settings';
    }

    public function rules()
    {
        return [
            [['id', 'name', 'type'], 'required'],
            [['id', 'name'], 'string', 'max' => 255],
            [['id', 'name'], 'trim'],
            [['id'], 'match', 'pattern' => '/^[a-z0-9_\-.:]*$/i'],
            [['type'], 'integer'],
            [['type'], 'in', 'range' => array_keys($this->typeList)],
            [['type'], 'default', 'value' => static::TYPE_STRING],
            [['value'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'name'  => 'Название',
            'value' => 'Значение',
            'type'  => 'Тип',
        ];
    }

    public function getTypeList()
    {
        return [
            static::TYPE_STRING     => 'Строка',
            static::TYPE_TEXT       => 'Текст',
            static::TYPE_HTML       => 'HTML',
            static::TYPE_SWITCH     => 'Чекбокс',
            static::TYPE_DATE_TIME  => 'Дата',
            static::TYPE_ARRAY      => 'Массив',
        ];
    }

    public function getTypeName(): string
    {
        return $this->typeList[$this->type] ?? '';
    }

    public function getTypeWidgetList()
    {
        return [
            static::TYPE_STRING => StringField::class,
            static::TYPE_TEXT => TextField::class,
            static::TYPE_HTML => HTMLField::class,
            static::TYPE_SWITCH => SwitchField::class,
            static::TYPE_DATE_TIME => DateTimeField::class,
            static::TYPE_ARRAY => ArrayField::class,
        ];
    }

    public function getTypeWidgetClassName(): string
    {
        return $this->typeWidgetList[$this->type] ?? '';
    }

    public function getTypeWidget($view, $form)
    {
        if(!empty($C = $this->typeWidgetClassName)){
            return $C::widget([
                'view'  => $view,
                'form'  => $form,
                'model' => $this,
            ]);
        }
    }

    public function beforeSave($insert)
    {
        if($result = parent::beforeSave($insert)){
            $this->packValue();
        }

        return $result;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $this->unpackValue();
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->unpackValue();
    }

    protected function packValue()
    {
        $this->value = serialize($this->value);
    }

    protected function unpackValue()
    {
        if(!is_null($this->value)){
            $this->value = unserialize($this->value);
        }
    }

}
