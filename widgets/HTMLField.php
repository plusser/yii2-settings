<?php 

namespace settings\widgets;

use Yii;
use yii\bootstrap\Widget;
use dosamigos\tinymce\TinyMce;

class HTMLField extends Widget
{

    public $view;
    public $form;
    public $model;
    public $attribute = 'value';

    public function run()
    {
        return $this->form->field($this->model, $this->attribute)->widget(TinyMce::className(), [
            'options' => ['rows' => 12],
            'language' => 'ru',
            'clientOptions' => [
                'plugins' => [
                    'advlist autolink lists link charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste image',
                ],
                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
                'file_picker_callback' => \alexantr\elfinder\TinyMCE::getFilePickerCallback(Yii::$app->urlManager->createUrl(['elfinder/tinymce'])),

            ],
        ]);
    }

}