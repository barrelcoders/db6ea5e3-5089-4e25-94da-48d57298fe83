<?php

/**
 * This is the model class for table "tbl_changes".
 *
 * The followings are the available columns in table 'tbl_changes':
 * @property string $ID
 * @property string $BILL_ID_FK
 * @property string $TITLE
 * @property integer $STATUS
 */
class Changes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_changes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BILL_ID_FK, TITLE, STATUS', 'required'),
			array('STATUS', 'numerical', 'integerOnly'=>true),
			array('BILL_ID_FK', 'length', 'max'=>10),
			array('TITLE', 'length', 'max'=>10000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, BILL_ID_FK, TITLE, STATUS', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'BILL_ID_FK' => 'Bill Id Fk',
			'TITLE' => 'Title',
			'STATUS' => 'Status',
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
		$criteria->compare('BILL_ID_FK',$this->BILL_ID_FK,true);
		$criteria->compare('TITLE',$this->TITLE,true);
		$criteria->compare('STATUS',$this->STATUS);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Changes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
