<?php

class DefaultController extends BaseEventTypeController
{
	protected $booking_operation;
	protected $unbooked = false;
	protected $booking_procedures;

	static protected $action_types = array(
		'validateVital' => self::ACTION_TYPE_FORM,
	);

	public function getMedicationHistory()
	{
		if (!$api = Yii::app()->moduleAPI->get('OphCiAnaestheticassessment')) {
			throw new Exception("Unable to load API for OphCiAnaestheticassessment");
		}
		
		return $api->getMedicationHistoryForPatient($this->patient->id);
	}

	public function actionValidateVital()
	{
		if (!@$_POST['Element_OphCiPatientadmission_Vitals_vitals_editItem'] || !($vital = OphCiPatientadmission_Vital::model()->findByPk($_POST['Element_OphCiPatientadmission_Vitals_vitals_editItem_id']))) {
			$vital = new OphCiPatientadmission_Vital;
		}

		$vital->attributes = $_POST;

		$vital->validate();

		$errors = array();

		foreach ($vital->errors as $field => $error) {
			$errors[$field] = $error[0];
		}

		if (empty($errors)) {
			$vital->timestamp = date('Y-m-d',strtotime($vital->timestamp)).' '.$vital->time.':00';
			$errors['row'] = $this->renderPartial('_vital_row',array('item' => $vital, 'i' => $_POST['i'], 'edit' => true),true);
		}

		echo json_encode($errors);
	}

	protected function setComplexAttributes_Element_OphCiPatientadmission_Vitals($element, $data, $index)
	{
		$vitals = array();

		$safe = OphCiPatientadmission_Vital::model()->safeAttributeNames;

		if (!empty($data['OphCiPatientadmission_Vital'][$safe[0]])) {
			foreach ($data['OphCiPatientadmission_Vital'][$safe[0]] as $i => $first) {
				if (!@$data['OphCiPatientadmission_Vital']['id'][$i] || !($vital = OphCiPatientadmission_Vital::model()->findByPk($data['OphCiPatientadmission_Vital']['id'][$i]))) {
					$vital = new OphCiPatientadmission_Vital;
					$vital->element_id = $element->id;
				}

				foreach ($safe as $attribute) {
					$vital->$attribute = @$data['OphCiPatientadmission_Vital'][$attribute][$i];
				}

				$vital->time = date('H:i',strtotime($vital->timestamp));

				$vitals[] = $vital;
			}
		}

		$element->vitals = $vitals;
	}

	protected function setElementDefaultOptions_Element_OphCiPatientadmission_MedicalHistoryReview($element, $action)
	{
		if ($action == 'create') {
			$medications = array();

			foreach ($this->patient->medications as $medication) {
				$_medication = new OphCiPatientadmission_MedicalHistoryReview_Medication;

				foreach (array('drug_id','route_id','option_id','frequency_id','start_date') as $field) {
					$_medication->$field = $medication->$field;
				}

				$medications[] = $_medication;
			}

			$element->medications = $medications;
		}
	}

	protected function setComplexAttributes_Element_OphCiPatientadmission_MedicalHistoryReview($element, $data, $index)
	{
		$medications = array();

		if (!empty($data['medication_history_drug_ids'])) {
			foreach ($data['medication_history_drug_ids'] as $i => $drug_id) {
				$medication = new OphCiPatientadmission_MedicalHistoryReview_Medication;
				$medication->drug_id = $drug_id;
				$medication->route_id = $data['medication_history_route_ids'][$i];
				$medication->option_id = $data['medication_history_option_ids'][$i];
				$medication->frequency_id = $data['medication_history_frequency_ids'][$i];
				$medication->start_date = $data['medication_history_start_dates'][$i];

				$medications[] = $medication;
			}
		}

		$element->medications = $medications;
	}

	protected function saveComplexAttributes_Element_OphCiPatientadmission_MedicalHistoryReview($element, $data, $index)
	{
		if (empty($data['medication_history_drug_ids'])) {
			$element->updateMedications();
		} else {
			$element->updateMedications($data['medication_history_medication_ids'],$data['medication_history_drug_ids'],$data['medication_history_route_ids'],$data['medication_history_option_ids'],$data['medication_history_frequency_ids'],$data['medication_history_start_dates']);
		}
	}

	protected function setElementDefaultOptions_Element_OphCiPatientadmission_NPOStatus($element, $action)
	{
		if ($action == 'create') {
			$element->time_last_ate = date('j M Y',strtotime('yesterday'));
			$element->time_last_drank = date('j M Y',strtotime('yesterday'));
		}
	}
}
