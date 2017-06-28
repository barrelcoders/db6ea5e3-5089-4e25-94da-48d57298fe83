<?php

/**
 * This is the model class for table "tbl_paybands".
 *
 * The followings are the available columns in table 'tbl_paybands':
 * @property string $ID
 * @property string $DESCRIPTION
 * @property string $GRADE_PAY
 *
 * The followings are the available model relations:
 * @property TblEmployee[] $tblEmployees
 */
class Paybands extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_paybands';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DESCRIPTION, GRADE_PAY, PAY_DETAILS, GRADE_TYPE, GROUP, SANCTIONED_POST', 'required'),
			array('DESCRIPTION, GRADE_PAY, PAY_DETAILS, GRADE_TYPE, GROUP, SANCTIONED_POST', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, DESCRIPTION, GRADE_PAY, PAY_DETAILS, GRADE_TYPE, GROUP, SANCTIONED_POST', 'safe', 'on'=>'search'),
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
			'tblEmployees' => array(self::HAS_MANY, 'TblEmployee', 'GRADE_PAY_ID_FK'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'DESCRIPTION' => 'Description',
			'GRADE_PAY' => 'Grade Pay',
			'PAY_DETAILS' =>'PAY DETAILS',
			'IS_GAZETTED' =>'IS_GAZETTED',
			'SANCTIONED_POST'=>'SANCTIONED_POST'
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('DESCRIPTION',$this->DESCRIPTION,true);
		$criteria->compare('GRADE_PAY',$this->GRADE_PAY,true);
		$criteria->compare('PAY_DETAILS',$this->PAY_DETAILS,true);
		$criteria->compare('GRADE_TYPE',$this->GRADE_TYPE,true);
		$criteria->compare('GROUP',$this->GROUP,true);
		$criteria->compare('SANCTIONED_POST',$this->SANCTIONED_POST,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paybands the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
