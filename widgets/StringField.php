<?php

namespace settings\widgets;

use yii\bootstrap4\Widget;

class StringField extends Widget
{

    public $view;
    public $form;
    public $model;
    public $attribute = 'value';

    public function run()
    {
        return $this->form->field($this->model, $this->attribute)->textInput(['maxlength' => true]);
    }

}
