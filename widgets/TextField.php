<?php

namespace settings\widgets;

use yii\bootstrap4\Widget;

class TextField extends Widget
{

    public $view;
    public $form;
    public $model;
    public $attribute = 'value';

    public function run()
    {
        return $this->form->field($this->model, $this->attribute)->textarea(['maxlength' => true, 'rows' => 12]);
    }

}
