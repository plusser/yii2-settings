<?php 

namespace settings;

use Yii;

class Module extends \yii\base\Module
{

    public $patternPrefix = 'settings';
    public $backendMode = false;

    public static $instance;

    public function init()
    {
        parent::init();

        if(($app = Yii::$app) instanceof \yii\web\Application && $this->backendMode){
            $app->getUrlManager()->addRules([
                ['class' => 'yii\web\UrlRule', 'pattern' => $this->patternPrefix, 'route' => $this->id . '/backend/index', ],
                ['class' => 'yii\web\UrlRule', 'pattern' => $this->patternPrefix . '/create', 'route' => $this->id . '/backend/create', ],
                ['class' => 'yii\web\UrlRule', 'pattern' => $this->patternPrefix . '/<id>', 'route' => $this->id . '/backend/view', ],
                ['class' => 'yii\web\UrlRule', 'pattern' => $this->patternPrefix . '/update/<id>', 'route' => $this->id . '/backend/update', ],
                ['class' => 'yii\web\UrlRule', 'pattern' => $this->patternPrefix . '/delete/<id>', 'route' => $this->id . '/backend/delete', ],
            ], false);
        }

        if($app instanceof yii\console\Application){
            if(!isset($app->controllerMap['migrate'])){
                $app->controllerMap['migrate'] = [
                    'class' => 'yii\console\controllers\MigrateController',
                ];
            }

            $app->controllerMap['migrate']['migrationNamespaces'][] = 'settings\migrations';
        }

        static::$instance = $this;
    }

}
