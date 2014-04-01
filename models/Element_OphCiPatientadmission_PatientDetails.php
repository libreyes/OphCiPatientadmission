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
 * This is the model class for table "et_ophcipatientadmission_patientdetails".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $translator_present_id
 * @property string $name_of_translator
 * @property integer $patient_id_verified
 * @property integer $allergies_verified
 * @property integer $medication_history_verified
 * @property integer $caregiver_present_id
 * @property string $caregiver_name
 * @property integer $caregiver_relationship_id
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property OphCiPatientadmission_PatientDetails_TranslatorPresent $translator_present
 * @property OphCiPatientadmission_PatientDetails_CaregiverPresent $caregiver_present
 * @property OphCiPatientadmission_PatientDetails_CaregiverRelationship $caregiver_relationship
 */

class Element_OphCiPatientadmission_PatientDetails extends BaseEventTypeElement
{
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
		return 'et_ophcipatientadmission_patientdetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, translator_present_id, name_of_translator, patient_id_verified, allergies_verified, medication_history_verified, caregiver_present_id, caregiver_name, caregiver_relationship_id', 'safe'),
			array('translator_present_id, patient_id_verified, allergies_verified, medication_history_verified, caregiver_present_id', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, translator_present_id, name_of_translator, patient_id_verified, allergies_verified, medication_history_verified, caregiver_present_id, caregiver_name, caregiver_relationship_id, ', 'safe', 'on' => 'search'),
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
			'translator_present' => array(self::BELONGS_TO, 'OphCiPatientadmission_PatientDetails_TranslatorPresent', 'translator_present_id'),
			'caregiver_present' => array(self::BELONGS_TO, 'OphCiPatientadmission_PatientDetails_CaregiverPresent', 'caregiver_present_id'),
			'caregiver_relationship' => array(self::BELONGS_TO, 'OphCiPatientadmission_PatientDetails_CaregiverRelationship', 'caregiver_relationship_id'),
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
			'translator_present_id' => 'Translator present',
			'name_of_translator' => 'Name of translator',
			'patient_id_verified' => 'Patient ID /wristband verified with two identifiers',
			'allergies_verified' => 'Allergies verified',
			'medication_history_verified' => 'Medication history verified',
			'caregiver_present_id' => 'Caregiver present',
			'caregiver_name' => 'Caregiver name',
			'caregiver_relationship_id' => 'Caregiver relationship',
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
		$criteria->compare('translator_present_id', $this->translator_present_id);
		$criteria->compare('name_of_translator', $this->name_of_translator);
		$criteria->compare('patient_id_verified', $this->patient_id_verified);
		$criteria->compare('allergies_verified', $this->allergies_verified);
		$criteria->compare('medication_history_verified', $this->medication_history_verified);
		$criteria->compare('caregiver_present_id', $this->caregiver_present_id);
		$criteria->compare('caregiver_name', $this->caregiver_name);
		$criteria->compare('caregiver_relationship_id', $this->caregiver_relationship_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	protected function afterValidate()
	{
		if ($this->translator_present_id == 1) {
			if (!$this->name_of_translator) {
				$this->addError('name_of_translator',$this->getAttributeLabel('name_of_translator').' cannot be blank');
			}
		} else {
			$this->name_of_translator = '';
		}

		if ($this->caregiver_present_id == 1) {
			if (!$this->caregiver_name) {
				$this->addError('caregiver_name',$this->getAttributeLabel('caregiver_name').' cannot be blank');
			}
			if (!$this->caregiver_relationship_id) {
				$this->addError('caregiver_relationship_id',$this->getAttributeLabel('caregiver_relationship_id').' cannot be blank');
			}
		} else {
			$this->caregiver_name = '';
			$this->caregiver_relationship_id = null;
		}

		return parent::afterValidate();
	}
}
?>
