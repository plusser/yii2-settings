<?php

namespace settings\widgets;

use yii\bootstrap4\Widget;
use kartik\datetime\DateTimePicker;

class DateTimeField extends Widget
{

    public $view;
    public $form;
    public $model;
    public $attribute = 'value';

    public function run()
    {
        $this->view->registerLinkTag(['rel' => 'stylesheet', 'href' => 'https://use.fontawesome.com/releases/v5.3.1/css/all.css'], 'fontawesome.stylesheet');

        return $this->form->field($this->model, $this->attribute)->widget(DateTimePicker::class, [
            'bsVersion'     => 4,
            'language'      => 'ru',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy hh:ii:00',
            ],
        ]);
    }

}
