<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\bootstrap\Html;
use backend\models\DealingType;
use backend\models\DocumentType;
use backend\models\PropertyView;
use backend\models\PropertyType;
use backend\models\Cabinet;
use backend\models\FloorCovering;
use backend\models\Province;
use backend\models\Facilities;
use backend\models\VilaType;
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
 * @property integer $phone_number1
 * @property integer $phone_number2
 * @property integer $mobile_number
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
    public $province_id;
    public $file;
    public $captcha;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => function() { return date('U'); },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['view_id', 'featured', 'cabinet_id', 'floor_covering_id', 'user_id', 'region_id', 'city_id', 'property_type_id', 'dealing_type_id', 'document_type_id', 'phone_number1', 'phone_number2', 'area_size', 'floor_num', 'number_of_floors', 'number_of_units_in_floor', 'number_of_units', 'price_per_meter_rent', 'total_price', 'total_area', 'vila_type_id', 'front_area', 'alley_width', 'height', 'revisory', 'balcony_area', 'has_store', 'created_at', 'status'], 'integer'],
            [['number_of_rooms', 'number_of_parkings', 'telephone_line_count'], 'string', 'max' => 2],
            [['descriptions', 'address'], 'string'],
            [['region_id', 'city_id', 'property_type_id', 'dealing_type_id', 'document_type_id', 'address', 'phone_number1', 'area_size', 'price_per_meter_rent', 'total_price', 'owner_name', 'province_id'], 'required'],
            [['number_of_rooms'], 'required', 'on' => ['create_apartment','create_villa']],
            [['total_area'], 'required', 'on' => ['create_farm','create_damdari']],
            [['residence_status', 'geographical_pos'], 'string', 'max' => 55],
            [['proeperty_age', 'activities_product', 'building_sell', 'water', 'electric', 'gas', 'equipment'], 'string', 'max' => 100],
            // [['facilities_id'], 'string', 'max' => 255],
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
            [['mobile_number', 'phone_number1', 'phone_number2'], 'string','min' => 11, 'max'=>11],
            [['mobile_number'], 'match', 'pattern' => '/^0[9][0-9]+$/'],
            [['phone_number1', 'phone_number2'], 'match', 'pattern' => '/^0[1-9][0-9]+$/'],
            [
            'captcha',
            \gbksoft\recaptcha\validators\RecaptchaValidator::class,
            'secret' => '6LdYvCoUAAAAAGVi7UkrLMdQS0JwgZJ8P99Nep9j'
            ],

        ];
    }

    /**
     * @inheritdoc
     */

     public function attributeLabels()
     {
         return [
             'id' => Yii::t('app', 'کد ملک'),
             'residence_status' => Yii::t('app', 'وضعیت سکونت'),
             'view.name' => Yii::t('app', 'نما'),
             'view_id' => Yii::t('app', 'نما'),
             'geographical_pos' => Yii::t('app', 'موقعیت جغرافیایی'),
             'proeperty_age' => Yii::t('app', 'سن بنا'),
             'descriptions' => Yii::t('app', 'توضیحات'),
             'cabinet.name' => Yii::t('app', 'کابینت'),
             'cabinet_id' => Yii::t('app', 'کابینت'),
             'floorCovering.name' => Yii::t('app', 'کف پوش'),
             'floor_covering_id' => Yii::t('app', 'کف پوش'),
             'user.email' => Yii::t('app', 'کاربر'),
             'province_id' => Yii::t('app', 'استان'),
             'region.name' => Yii::t('app', 'منطقه'),
             'region_id' => Yii::t('app', 'منطقه'),
             'city.name' => Yii::t('app', 'شهر'),
             'city_id' => Yii::t('app', 'شهر'),
             'propertyType.name' => Yii::t('app', 'نوع ملک'),
             'property_type_id' => Yii::t('app', 'نوع ملک'),
             'dealingType.name' => Yii::t('app', 'نوع قرارداد'),
             'dealing_type_id' => Yii::t('app', 'نوع قرارداد'),
             'documentType.name' => Yii::t('app', 'نوع سند'),
             'document_type_id' => Yii::t('app', 'نوع سند'),
             'address' => Yii::t('app', 'آدرس'),
             'phone_number1' => Yii::t('app', 'شماره تماس 1'),
             'phone_number2' => Yii::t('app', 'شماره تماس 2'),
             'mobile_number' => Yii::t('app', 'تلفن همراه'),
             'area_size' => Yii::t('app', 'متراژ (متر)'),
             'number_of_rooms' => Yii::t('app', 'تعداد اتاق'),
             'floor_num' => Yii::t('app', 'طبقه'),
             'number_of_floors' => Yii::t('app', 'تعداد طبقات'),
             'number_of_units_in_floor' => Yii::t('app', 'تعداد واحد در طبقه'),
             'number_of_units' => Yii::t('app', 'جمع واحد ها'),
             'price_per_meter_rent' => Yii::t('app', 'قیمت متری / اجاره'),
             'total_price' => Yii::t('app', 'قیمت کل / ودیعه'),
             'number_of_parkings' => Yii::t('app', 'تعداد پارکینگ'),
             'facilities_id' => Yii::t('app', 'امکانات'),
             'total_area' => Yii::t('app', 'مساحت زمین (متر)'),
             'toilet_type' => Yii::t('app', 'سرویس بهداشتی'),
             'telephone_line_count' => Yii::t('app', 'Telephone Line Count'),
             'vila_type_id' => Yii::t('app', 'Vila Type ID'),
             'front_area' => Yii::t('app', 'طول بر (متر)'),
             'alley_width' => Yii::t('app', 'عرض گذر (متر)'),
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
             'pic' => Yii::t('app', 'تصاویر ملک'),
             'created_at' => Yii::t('app', 'تاریخ ثبت'),
             'status' => Yii::t('app', 'وضعیت'),
             'featured' => Yii::t('app', 'ویژه'),
             'property_location' => Yii::t('app', 'موقعیت ملک'),
             'captcha' => ''
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

    public function findAllDealingType()
    {
      $dealing_type = DealingType::find()->all();
      return $dealing_type;
    }

    public function findAllDocumentType()
    {
      $document_type = DocumentType::find()->all();
      return $document_type;
    }

    public function findAllView()
    {
      $view = PropertyView::find()->all();
      return $view;
    }

    public function findAllCabinet()
    {
      $cabinet = Cabinet::find()->all();
      return $cabinet;
    }

    public function findAllFloorCovering()
    {
      $floor_covering = FloorCovering::find()->all();
      return $floor_covering;
    }

    public function findAllProvince()
    {
      $province_list = Province::find()->all();
      return $province_list;
    }

    public function findAllPropertyType()
    {
      $property_type = PropertyType::find()->all();
      return $property_type;
    }

    public function findAllFacilities()
    {
      $facilities = Facilities::find()->all();
      return $facilities;
    }

    public function findAllVilaType()
    {
      $vila_type = VilaType::find()->all();
      return $vila_type;
    }

    public function countProperties()
    {
      $allproperties = Property::find()->all();
      $properties = count($allproperties);
      return $properties;
    }

    public function latest5Properties() {
      $latestpr = Property::find()->limit(5)->OrderBy(['created_at' => SORT_DESC])->all();
      return $latestpr;
    }

    public function loadImage($model){
        $find = Pictures::findAll(['agahi_id'=>$this->id]);
        if ($find != null){
            $link = '';
            foreach ($find as $src){
                $img = explode(',', $src->src);
                $link .= Html::img(Yii::$app->params['frontendUrl'].'/'.$img[2] ,['width' => 150,'height'=>150, 'id' => $model->id, 'style' => ['margin' => '5px']]);
            }
        }else{
            $link = Html::img('/uploads/no_image.jpg' ,['width' => 150,'height'=>150]);
        }
        return $link;
    }

    public static function countPendingProperties()
    {
      $pendingpr = Property::find()->where(['status' => 0])->count();
      $count = '<span class="pull-left badge label-danger">'.$pendingpr.'</span>';
      if($pendingpr > 0) {
        return $count;
      }
      else {
        return null;
      }
    }

}
