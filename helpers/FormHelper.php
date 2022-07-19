<?php

namespace settings\helpers;

use settings\models\Settings;
use settings\widgets\StringField;
use settings\widgets\TextField;
use settings\widgets\HTMLField;
use settings\widgets\ArrayField;

class FormHelper
{

    protected static function fieldWidgets(): array
    {
        return [
            Settings::TYPE_STRING => StringField::class,
            Settings::TYPE_TEXT => TextField::class,
            Settings::TYPE_HTML => HTMLField::class,
            Settings::TYPE_ARRAY => ArrayField::class,
        ];
    }

    public static function getField($form, $model): string
    {
        $fieldWidgets = static::fieldWidgets();
        $widgetClass = isset($fieldWidgets[$model->type]) ? $fieldWidgets[$model->type] : $fieldWidgets[Settings::TYPE_STRING];

        return $widgetClass::widget([
            'form'  => $form,
            'model' => $model,
        ]);
    }

}
