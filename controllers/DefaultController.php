<?php

class DefaultController extends BaseEventTypeController
{
	protected $booking_operation;
	protected $unbooked = false;
	protected $booking_procedures;

	public function getMedicationHistory()
	{
		if (!$api = Yii::app()->moduleAPI->get('OphCiAnaestheticassessment')) {
			throw new Exception("Unable to load API for OphCiAnaestheticassessment");
		}
		
		return $api->getMedicationHistoryForPatient($this->patient->id);
	}
}
