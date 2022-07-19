<?php

namespace settings\widgets;

use yii\bootstrap4\Widget;
use kartik\switchinput\SwitchInput;

class SwitchField extends Widget
{

    public $view;
    public $form;
    public $model;
    public $attribute = 'value';

    public function run()
    {
        \Yii::$app->params['bsVersion'] = 4; // Fix of bootstrap version bug

        return $this->form->field($this->model, $this->attribute)->widget(SwitchInput::class, [
            'bsVersion'     => 4,
            'type'          => SwitchInput::CHECKBOX,
            'pluginOptions' => [
                'onColor'   => 'success',
                'onText'    => 'Да',
                'offColor'  => 'danger',
                'offText'   => 'Нет',
            ],
        ]);
    }

}
