<?php

namespace settings\widgets;

use Yii;
use yii\bootstrap4\Widget;
use dosamigos\tinymce\TinyMce;
use fileManager\Module as FileManagerModule;

class HTMLField extends Widget
{

    public $view;
    public $form;
    public $model;
    public $attribute = 'value';

    public function run()
    {
        return $this->form->field($this->model, $this->attribute)->widget(TinyMce::class, [
            'options'       => ['rows' => 12],
            'language'      => 'ru',
            'clientOptions' => [
                'relative_urls'             => false,
                'remove_script_host'        => true,
                'convert_urls'              => true,
                'file_picker_callback'      => \alexantr\elfinder\TinyMCE::getFilePickerCallback(Yii::$app->urlManager->createUrl([FileManagerModule::$instance->id . '/elfinder/tinymce'])),
                'extended_valid_elements'   => 'b,i,b/strong,i/em',
                'toolbar'                   => 'undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
                'plugins'                   => [
                    'advlist', 'autolink', 'lists', 'link', 'charmap', 'print', 'preview', 'anchor',
                    'searchreplace', 'visualblocks', 'code', 'fullscreen', 'textcolor',
                    'insertdatetime', 'media', 'table', 'contextmenu', 'paste', 'image',
                ],
            ],
        ]);
    }

}
