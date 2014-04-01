<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the model class for table "et_ophcipatientadmission_npostatus".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property string $time_last_ate
 * @property string $time_last_drank
 * @property integer $procedure_verified
 * @property integer $procedure_id
 * @property integer $site_verified
 * @property integer $site_id
 * @property integer $signed_and_witnessed
 * @property integer $type_of_surgery
 * @property integer $site_marked_by_x
 * @property integer $site_marked_by_id
 * @property integer $iol_measurements_verified
 * @property integer $iol_selected
 * @property string $comments
 * @property string $signature_timestamp
 * @property integer $signature_user_id
 * @property integer $signature_role_id
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property Procedure $procedure
 * @property Site $site
 * @property User $site_marked_by
 * @property User $signature_user
 * @property User $signature_role
 */

class Element_OphCiPatientadmission_NpoStatus extends BaseEventTypeElement
{
	public $time_last_ate_time;
	public $time_last_drank_time;

	/**
	 * Returns the static model of the specified AR class.
	 * @return the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'et_ophcipatientadmission_npostatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, time_last_ate, time_last_drank, procedure_verified, procedure_id, site_verified, site_id, signed_and_witnessed, type_of_surgery, site_marked_by_x, site_marked_by_id, iol_measurements_verified, iol_selected, comments, signature_timestamp, signature_user_id, signature_role_id, time_last_ate_time, time_last_drank_time', 'safe'),
			array('time_last_ate, time_last_drank, procedure_verified, procedure_id, site_verified, site_id, signed_and_witnessed, type_of_surgery, site_marked_by_x, site_marked_by_id, iol_measurements_verified, iol_selected, comments, signature_timestamp, signature_user_id, signature_role_id, ', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, time_last_ate, time_last_drank, procedure_verified, procedure_id, site_verified, site_id, signed_and_witnessed, type_of_surgery, site_marked_by_x, site_marked_by_id, iol_measurements_verified, iol_selected, comments, signature_timestamp, signature_user_id, signature_role_id, ', 'safe', 'on' => 'search'),
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
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
			'procedure' => array(self::BELONGS_TO, 'Procedure', 'procedure_id'),
			'site' => array(self::BELONGS_TO, 'Site', 'site_id'),
			'site_marked_by' => array(self::BELONGS_TO, 'User', 'site_marked_by_id'),
			'signature_user' => array(self::BELONGS_TO, 'User', 'signature_user_id'),
			'signature_role' => array(self::BELONGS_TO, 'User', 'signature_role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'time_last_ate' => 'Time last ate',
			'time_last_drank' => 'Time last drank',
			'procedure_verified' => 'Procedure verified',
			'procedure_id' => 'Procedure(s)',
			'site_verified' => 'Site verified',
			'site_id' => 'Site',
			'signed_and_witnessed' => 'Signed and witnessed',
			'type_of_surgery' => 'Type of surgery',
			'site_marked_by_x' => 'Site marked by X',
			'site_marked_by_id' => 'Site marked by',
			'iol_measurements_verified' => 'IOL measurements verified',
			'iol_selected' => 'IOL selected',
			'comments' => 'Comments',
			'signature_timestamp' => 'Signature timestamp',
			'signature_user_id' => 'Signature user',
			'signature_role_id' => 'Signature role',
			'time_last_ate_time' => 'Time last ate',
			'time_last_drank_time' => 'Time last drank',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('time_last_ate', $this->time_last_ate);
		$criteria->compare('time_last_drank', $this->time_last_drank);
		$criteria->compare('procedure_verified', $this->procedure_verified);
		$criteria->compare('procedure_id', $this->procedure_id);
		$criteria->compare('site_verified', $this->site_verified);
		$criteria->compare('site_id', $this->site_id);
		$criteria->compare('signed_and_witnessed', $this->signed_and_witnessed);
		$criteria->compare('type_of_surgery', $this->type_of_surgery);
		$criteria->compare('site_marked_by_x', $this->site_marked_by_x);
		$criteria->compare('site_marked_by_id', $this->site_marked_by_id);
		$criteria->compare('iol_measurements_verified', $this->iol_measurements_verified);
		$criteria->compare('iol_selected', $this->iol_selected);
		$criteria->compare('comments', $this->comments);
		$criteria->compare('signature_timestamp', $this->signature_timestamp);
		$criteria->compare('signature_user_id', $this->signature_user_id);
		$criteria->compare('signature_role_id', $this->signature_role_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	public function setDefaultOptions()
	{
		$this->time_last_ate_time = date('H:i');
		$this->time_last_drank_time = date('H:i');
	}

	protected function afterValidate()
	{
		if (!preg_match('/^([0-9]{1,2}):([0-9]{2})$/',$this->time_last_ate_time,$m) || $m[1] > 23 || $m[2] > 59) {
			$this->addError('time_last_ate_time','Invalid time format for '.$this->getAttributeLabel('time_last_ate_time'));
		} else {
			$this->time_last_ate = date('Y-m-d',strtotime($this->time_last_ate)).' '.str_pad($m[1],2,"0",STR_PAD_LEFT).":".$m[2].":00";
		}

		if (!preg_match('/^([0-9]{1,2}):([0-9]{2})$/',$this->time_last_drank_time,$m) || $m[1] > 23 || $m[2] > 59) {
			$this->addError('time_last_drank_time','Invalid time format for '.$this->getAttributeLabel('time_last_drank_time'));
		} else {
			$this->time_last_drank = date('Y-m-d',strtotime($this->time_last_drank)).' '.str_pad($m[1],2,"0",STR_PAD_LEFT).":".$m[2].":00";
		}

		return parent::afterValidate();
	}
}
?>
