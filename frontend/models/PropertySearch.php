<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Property;

/**
 * PropertySearch represents the model behind the search form about `frontend\models\Property`.
 */
class PropertySearch extends Property
{
  public $q;
  public $min_price;
  public $max_price;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'view_id', 'cabinet_id', 'floor_covering_id', 'user_id', 'region_id', 'city_id', 'property_type_id', 'dealing_type_id', 'document_type_id', 'phone_number1', 'phone_number2', 'mobile_number', 'area_size', 'floor_num', 'number_of_floors', 'number_of_units_in_floor', 'number_of_units', 'price_per_meter_rent', 'total_price', 'total_area', 'vila_type_id', 'front_area', 'alley_width', 'height', 'revisory', 'balcony_area', 'has_store', 'created_at', 'status'], 'integer'],
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
     /**
      * Creates data provider instance with search query applied
      *
      * @param array $params
      *
      * @return ActiveDataProvider
      */
     public function search($params)//This is only used by the search box's NOT THE DROP DOWN CATEGORIES
     {

         $query = Property::find();//find all cases
         $dataProvider = new ActiveDataProvider([
             'query' => $query,
         ]);

         $this->load($params);

         if (!$this->validate()) {
             // uncomment the following line if you do not want to any records when validation fails
             // $query->where('0=1');
             return $dataProvider;
         }

        if($_GET['PropertySearch']['q'] != null){
            $q = $_GET['PropertySearch']['q'];
            $region = Region::find()->where(['like', 'name', $q])->select(['id']);
            $city = City::find()->where(['like', 'name', $q])->select(['id']);
            $province_id = Province::find()->where(['like', 'name', $q])->one();

            $province = City::find()->where(['province_id' => $province_id])->asArray()->select('id')->all();
            $prarray = array_column($province, 'id');
            $pro = Property::find()->where(['in', 'city_id', $prarray])->all();

            $query->andFilterWhere(['region_id' => $region])
                  ->orFilterWhere(['city_id' => $city])
                  ->orFilterWhere(['in', 'city_id', $pro]);
        }

        // echo '<pre>';
        // print_r($_GET);
        // // print_r($province);
        // die();
        $query->andFilterWhere(['dealing_type_id' => $this->dealing_type_id])
        ->andFilterWhere(['property_type_id' => $this->property_type_id]);

        if(isset($_GET['number_of_rooms'])) { $query->andFilterWhere(['in', 'number_of_rooms', $_GET['number_of_rooms']]);}
        if(isset($_GET['total_price'])) { $query->andFilterWhere(['between', 'total_price', $_GET['PropertySearch']['min_price'], $_GET['PropertySearch']['max_price']]);}

        if(isset($_GET['PropertySearch']['area_size'])) {
          $area_size = $_GET['PropertySearch']['area_size'];

          if($area_size == '50') {
            $query->andFilterWhere(['between', 'area_size', 0, 50]);
          }
          elseif($area_size == '50-100'){
            $query->andFilterWhere(['between', 'area_size', 50, 100]);
          }
          elseif($area_size == '100-150'){
            $query->andFilterWhere(['between', 'area_size', 100, 150]);
          }
          elseif($area_size == '150-200'){
            $query->andFilterWhere(['between', 'area_size', 150, 200]);
          }
          elseif($area_size == '200'){
            $query->andFilterWhere(['between', 'area_size', 200, 5000]);
          }
        }

         // This is different to the above, as in it filters where a string may be part of the result.
         //Example::  SHOW * FROM table WHERE `name`  LIKE  $this->name;
        //  $query->andFilterWhere(['like', 'name', $this->name])
        //      ->andFilterWhere(['like', 'neutral_citation', $this->neutral_citation])
        //      ->andFilterWhere(['like', 'all_ER', $this->all_ER])
        //      ->andFilterWhere(['like', 'building_law_R', $this->building_law_R])
        //      ->andFilterWhere(['like', 'const_law_R', $this->const_law_R])
        //      ->andFilterWhere(['like', 'const_law_J', $this->const_law_J])
        //      ->andFilterWhere(['like', 'CILL', $this->CILL])
        //      ->andFilterWhere(['like', 'adj_LR', $this->adj_LR]);

         return $dataProvider;//return the filters
     }
}
