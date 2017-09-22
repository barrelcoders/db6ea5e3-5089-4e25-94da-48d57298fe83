<?php

/**
 * This is the model class for table "tbl_pay_matrix".
 *
 * The followings are the available columns in table 'tbl_pay_matrix':
 * @property string $PAY_BAND
 * @property string $GRADE_PAY
 * @property string $LEVEL
 * @property string $INDEX
 * @property string $BASIC
 * @property string $ID
 */
class PayMatrix extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pay_matrix';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PAY_BAND, GRADE_PAY, BASIC', 'required'),
			array('PAY_BAND', 'length', 'max'=>100),
			array('GRADE_PAY', 'length', 'max'=>45),
			array('LEVEL, INDEX, BASIC', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PAY_BAND, GRADE_PAY, LEVEL, INDEX, BASIC, ID', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function getTEXT()
    {
      return "Basic: ".$this->BASIC." (Level: ".$this->LEVEL.", Index: ".$this->INDEX.")";
    }
   
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PAY_BAND' => 'Pay Band',
			'GRADE_PAY' => 'Grade Pay',
			'LEVEL' => 'Level',
			'INDEX' => 'Index',
			'BASIC' => 'Basic',
			'ID' => 'ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('PAY_BAND',$this->PAY_BAND,true);
		$criteria->compare('GRADE_PAY',$this->GRADE_PAY,true);
		$criteria->compare('LEVEL',$this->LEVEL,true);
		$criteria->compare('INDEX',$this->INDEX,true);
		$criteria->compare('BASIC',$this->BASIC,true);
		$criteria->compare('ID',$this->ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayMatrix the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
