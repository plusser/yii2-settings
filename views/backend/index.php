<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use settings\models\Settings;

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;

$model = new Settings;

?>

<div class="settings-index">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <p><?php echo $this->context->getCreateButton('Создать настройку'); ?></p>

<?php Pjax::begin(); ?>

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'name',
        [
            'attribute' => 'type',
            'filter'    => $model->typeList,
            'value'     => function($data){
                return $data->typeName;
            },
        ],

        $this->context->getActionColumn(),
    ],
]); ?>

<?php Pjax::end(); ?>

</div>
