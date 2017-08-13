<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Property;

/**
 * PropertySearch represents the model behind the search form about `backend\models\Property`.
 */
class PropertySearch extends Property
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'view_id', 'cabinet_id', 'floor_covering_id', 'user_id', 'region_id', 'city_id', 'property_type_id', 'dealing_type_id', 'document_type_id', 'phone_number1', 'phone_number2', 'mobile_number', 'area_size', 'floor_num', 'number_of_floors', 'number_of_units_in_floor', 'number_of_units', 'price_per_meter_rent', 'total_price', 'total_area', 'vila_type_id', 'front_area', 'alley_width', 'height', 'revisory', 'balcony_area', 'has_store', 'created_at', 'status', 'featured'], 'integer'],
            [['residence_status', 'geographical_pos', 'proeperty_age', 'descriptions', 'address', 'number_of_rooms', 'number_of_parkings', 'facilities_id', 'toilet_type', 'telephone_line_count', 'owner_name', 'activities_product', 'building_sell', 'water', 'electric', 'gas', 'equipment', 'pic'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Property::find();

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
            'view_id' => $this->view_id,
            'cabinet_id' => $this->cabinet_id,
            'floor_covering_id' => $this->floor_covering_id,
            'user_id' => $this->user_id,
            'region_id' => $this->region_id,
            'city_id' => $this->city_id,
            'property_type_id' => $this->property_type_id,
            'dealing_type_id' => $this->dealing_type_id,
            'document_type_id' => $this->document_type_id,
            'phone_number1' => $this->phone_number1,
            'phone_number2' => $this->phone_number2,
            'mobile_number' => $this->mobile_number,
            'area_size' => $this->area_size,
            'floor_num' => $this->floor_num,
            'number_of_floors' => $this->number_of_floors,
            'number_of_units_in_floor' => $this->number_of_units_in_floor,
            'number_of_units' => $this->number_of_units,
            'price_per_meter_rent' => $this->price_per_meter_rent,
            'total_price' => $this->total_price,
            'total_area' => $this->total_area,
            'vila_type_id' => $this->vila_type_id,
            'front_area' => $this->front_area,
            'alley_width' => $this->alley_width,
            'height' => $this->height,
            'revisory' => $this->revisory,
            'balcony_area' => $this->balcony_area,
            'has_store' => $this->has_store,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'featured' => $this->featured,
        ]);

        $query->andFilterWhere(['like', 'residence_status', $this->residence_status])
            ->andFilterWhere(['like', 'geographical_pos', $this->geographical_pos])
            ->andFilterWhere(['like', 'proeperty_age', $this->proeperty_age])
            ->andFilterWhere(['like', 'descriptions', $this->descriptions])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'number_of_rooms', $this->number_of_rooms])
            ->andFilterWhere(['like', 'number_of_parkings', $this->number_of_parkings])
            ->andFilterWhere(['like', 'facilities_id', $this->facilities_id])
            ->andFilterWhere(['like', 'toilet_type', $this->toilet_type])
            ->andFilterWhere(['like', 'telephone_line_count', $this->telephone_line_count])
            ->andFilterWhere(['like', 'owner_name', $this->owner_name])
            ->andFilterWhere(['like', 'activities_product', $this->activities_product])
            ->andFilterWhere(['like', 'building_sell', $this->building_sell])
            ->andFilterWhere(['like', 'water', $this->water])
            ->andFilterWhere(['like', 'electric', $this->electric])
            ->andFilterWhere(['like', 'gas', $this->gas])
            ->andFilterWhere(['like', 'equipment', $this->equipment])
            ->andFilterWhere(['like', 'pic', $this->pic]);

        return $dataProvider;
    }
}
