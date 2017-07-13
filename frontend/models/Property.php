<?php

namespace frontend\models;

use Yii;
use backend\models\Pictures;
/**
 * This is the model class for table "property".
 *
 * @property integer $id
 * @property string $residence_status
 * @property integer $view_id
 * @property string $geographical_pos
 * @property string $proeperty_age
 * @property string $descriptions
 * @property integer $cabinet_id
 * @property integer $floor_covering_id
 * @property integer $user_id
 * @property integer $region_id
 * @property integer $city_id
 * @property integer $property_type_id
 * @property integer $dealing_type_id
 * @property integer $document_type_id
 * @property string $address
 * @property integer $area_size
 * @property integer $number_of_rooms
 * @property integer $floor_num
 * @property integer $number_of_floors
 * @property integer $number_of_units_in_floor
 * @property integer $number_of_units
 * @property integer $price_per_meter_rent
 * @property integer $total_price
 * @property integer $number_of_parkings
 * @property string $facilities_id
 * @property integer $total_area
 * @property string $toilet_type
 * @property integer $telephone_line_count
 * @property integer $parking_count
 * @property integer $vila_type_id
 * @property integer $front_area
 * @property integer $alley_width
 * @property string $owner_name
 * @property string $activities_product
 * @property string $building_sell
 * @property integer $height
 * @property integer $revisory
 * @property integer $balcony_area
 * @property integer $has_store
 * @property string $water
 * @property string $electric
 * @property string $gas
 * @property string $equipment
 * @property string $pic
 * @property integer $created_at
 * @property integer $status
 *
 * @property Inbox[] $inboxes
 * @property PropertyView $view
 * @property VilaType $vilaType
 * @property User $user
 * @property Cabinet $cabinet
 * @property City $city
 * @property FloorCovering $floorCovering
 * @property Region $region
 * @property PropertyType $propertyType
 * @property DealingType $dealingType
 * @property DocumentType $documentType
 */
class Property extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['view_id', 'cabinet_id', 'floor_covering_id', 'user_id', 'region_id', 'city_id', 'property_type_id', 'dealing_type_id', 'document_type_id', 'area_size', 'number_of_rooms', 'floor_num', 'number_of_floors', 'number_of_units_in_floor', 'number_of_units', 'price_per_meter_rent', 'total_price', 'number_of_parkings', 'total_area', 'telephone_line_count', 'parking_count', 'vila_type_id', 'front_area', 'alley_width', 'height', 'revisory', 'balcony_area', 'has_store', 'created_at', 'status'], 'integer'],
            [['descriptions', 'address', 'pic'], 'string'],
            [['user_id', 'region_id', 'city_id', 'property_type_id', 'dealing_type_id', 'document_type_id', 'address', 'area_size', 'number_of_rooms', 'price_per_meter_rent', 'total_price', 'owner_name'], 'required'],
            [['residence_status', 'geographical_pos'], 'string', 'max' => 55],
            [['proeperty_age', 'activities_product', 'building_sell', 'water', 'electric', 'gas', 'equipment'], 'string', 'max' => 100],
            [['facilities_id'], 'string', 'max' => 255],
            [['toilet_type'], 'string', 'max' => 50],
            [['owner_name'], 'string', 'max' => 75],
            [['view_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertyView::className(), 'targetAttribute' => ['view_id' => 'id']],
            [['vila_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => VilaType::className(), 'targetAttribute' => ['vila_type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['cabinet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cabinet::className(), 'targetAttribute' => ['cabinet_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['floor_covering_id'], 'exist', 'skipOnError' => true, 'targetClass' => FloorCovering::className(), 'targetAttribute' => ['floor_covering_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['property_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PropertyType::className(), 'targetAttribute' => ['property_type_id' => 'id']],
            [['dealing_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DealingType::className(), 'targetAttribute' => ['dealing_type_id' => 'id']],
            [['document_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentType::className(), 'targetAttribute' => ['document_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'residence_status' => Yii::t('app', 'Residence Status'),
            'view_id' => Yii::t('app', 'View ID'),
            'geographical_pos' => Yii::t('app', 'Geographical Pos'),
            'proeperty_age' => Yii::t('app', 'Proeperty Age'),
            'descriptions' => Yii::t('app', 'Descriptions'),
            'cabinet_id' => Yii::t('app', 'Cabinet ID'),
            'floor_covering_id' => Yii::t('app', 'Floor Covering ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'city_id' => Yii::t('app', 'City ID'),
            'property_type_id' => Yii::t('app', 'Property Type ID'),
            'dealing_type_id' => Yii::t('app', 'Dealing Type ID'),
            'document_type_id' => Yii::t('app', 'Document Type ID'),
            'address' => Yii::t('app', 'Address'),
            'area_size' => Yii::t('app', 'Area Size'),
            'number_of_rooms' => Yii::t('app', 'Number Of Rooms'),
            'floor_num' => Yii::t('app', 'Floor Num'),
            'number_of_floors' => Yii::t('app', 'Number Of Floors'),
            'number_of_units_in_floor' => Yii::t('app', 'Number Of Units In Floor'),
            'number_of_units' => Yii::t('app', 'Number Of Units'),
            'price_per_meter_rent' => Yii::t('app', 'Price Per Meter Rent'),
            'total_price' => Yii::t('app', 'Total Price'),
            'number_of_parkings' => Yii::t('app', 'Number Of Parkings'),
            'facilities_id' => Yii::t('app', 'Facilities ID'),
            'total_area' => Yii::t('app', 'Total Area'),
            'toilet_type' => Yii::t('app', 'Toilet Type'),
            'telephone_line_count' => Yii::t('app', 'Telephone Line Count'),
            'parking_count' => Yii::t('app', 'Parking Count'),
            'vila_type_id' => Yii::t('app', 'Vila Type ID'),
            'front_area' => Yii::t('app', 'Front Area'),
            'alley_width' => Yii::t('app', 'Alley Width'),
            'owner_name' => Yii::t('app', 'Owner Name'),
            'activities_product' => Yii::t('app', 'Activities Product'),
            'building_sell' => Yii::t('app', 'Building Sell'),
            'height' => Yii::t('app', 'Height'),
            'revisory' => Yii::t('app', 'Revisory'),
            'balcony_area' => Yii::t('app', 'Balcony Area'),
            'has_store' => Yii::t('app', 'Has Store'),
            'water' => Yii::t('app', 'Water'),
            'electric' => Yii::t('app', 'Electric'),
            'gas' => Yii::t('app', 'Gas'),
            'equipment' => Yii::t('app', 'Equipment'),
            'pic' => Yii::t('app', 'Pic'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInboxes()
    {
        return $this->hasMany(Inbox::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getView()
    {
        return $this->hasOne(PropertyView::className(), ['id' => 'view_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVilaType()
    {
        return $this->hasOne(VilaType::className(), ['id' => 'vila_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabinet()
    {
        return $this->hasOne(Cabinet::className(), ['id' => 'cabinet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFloorCovering()
    {
        return $this->hasOne(FloorCovering::className(), ['id' => 'floor_covering_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyType()
    {
        return $this->hasOne(PropertyType::className(), ['id' => 'property_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDealingType()
    {
        return $this->hasOne(DealingType::className(), ['id' => 'dealing_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['id' => 'document_type_id']);
    }

    public function findPictures($id)
    {
      $pictures = Pictures::find()->where(['agahi_id' => $id])->all();
      return $pictures;
    }

    public function findSimilarProperties($id)
    {
      $model = Property::find()->where(['id' => $id])->one();
      $property = Property::find()->where(['property_type_id' => $model->property_type_id])->andWhere(['not',['id'=>$id]])->andWhere(['status' => 1])->limit(5);
      return $property;
    }

    public function get_option($option)
    {
      $options = \backend\models\Options::find()->where(['option_name' => $option])->one();
      return $options->option_value;
    }

    public function show_logo()
    {
      $logo = \backend\models\SiteLogo::find()->one();
      return $logo->src;
    }

    public function get_social($id)
    {
      $social = \backend\models\SocialOptions::find()->where(['social_id' => $id])->andWhere(['status' => 1])->one();
      if($social != null)
      return $social->value;
      else return null;
    }
}
