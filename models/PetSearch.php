<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pet;

/**
 * PetSearch represents the model behind the search form of `app\models\Pet`.
 */
class PetSearch extends Pet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id'], 'integer'],
            [['name', 'species', 'date_of_birth', 'sex', 'breed', 'coat_color', 'coat_type', 'comments', 'behavior_description', 'usual_objects_description'], 'safe'],
            [['weight'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pet::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_of_birth' => $this->date_of_birth,
            'weight' => $this->weight,
            'customer_id' => $this->customer_id,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'species', $this->species])
            ->andFilterWhere(['ilike', 'sex', $this->sex])
            ->andFilterWhere(['ilike', 'breed', $this->breed])
            ->andFilterWhere(['ilike', 'coat_color', $this->coat_color])
            ->andFilterWhere(['ilike', 'coat_type', $this->coat_type])
            ->andFilterWhere(['ilike', 'comments', $this->comments])
            ->andFilterWhere(['ilike', 'behavior_description', $this->behavior_description])
            ->andFilterWhere(['ilike', 'usual_objects_description', $this->usual_objects_description]);

        return $dataProvider;
    }
}
