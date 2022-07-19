<?php

namespace settings\models;

use yii\data\ActiveDataProvider;
use settings\models\Settings;

class SettingsSearch extends Settings
{

    public function rules()
    {
        return [
            [['id', 'name', 'value'], 'safe'],
            [['type'], 'integer'],
        ];
    }

    public function search($params)
    {
        $query = Settings::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if($this->validate()){
            $query->andFilterWhere(['type' => $this->type])
                ->andFilterWhere(['like', 'id', $this->id])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'value', $this->value]);
        }

        return $dataProvider;
    }

}
