<?php

class DefaultController extends BaseEventTypeController
{
	protected $booking_operation;
	protected $unbooked = false;
	protected $booking_procedures;

	protected function initActionCreate()
	{
		parent::initActionCreate();

		if (isset($_GET['booking_event_id'])) {
			if (!$api = Yii::app()->moduleAPI->get('OphTrOperationbooking')) {
				throw new Exception('invalid request for booking event');
			}
			if (!$this->booking_operation = $api->getOperationForEvent($_GET['booking_event_id'])) {
				throw new Exception('booking event not found');
			}
		}
		elseif (isset($_GET['unbooked'])) {
			$this->unbooked = true;
		}
	}

	public function actionCreate()
	{
		$errors = array();

		if (!empty($_POST)) {
			if (preg_match('/^booking([0-9]+)$/',@$_POST['SelectBooking'],$m)) {
				$this->redirect(array('/OphCiPatientadmission/Default/create?patient_id='.$this->patient->id.'&booking_event_id='.$m[1]));
			}

			$errors = array('Operation' => array('Please select a booked operation'));
		}

		if ($this->booking_operation || $this->unbooked) {
			parent::actionCreate();
		} else {
			// set up form for selecting a booking for the Op note
			$bookings = array();

			if ($api = Yii::app()->moduleAPI->get('OphTrOperationbooking')) {
				$bookings = $api->getOpenBookingsForEpisode($this->episode->id);
			}

			$this->title = !empty($bookings) ? 'Please select booking' : 'No bookings created';
			$this->event_tabs = array(
				array(
					'label' => !empty($bookings) ? 'Select a booking' : 'No bookings created',
					'active' => true,
				),
			);
			$cancel_url = ($this->episode) ? '/patient/episode/'.$this->episode->id : '/patient/episodes/'.$this->patient->id;
			$this->event_actions = array(
				EventAction::link('Cancel',
					Yii::app()->createUrl($cancel_url),
					null, array('class' => 'button small warning')
				)
			);

			$this->render('select_event',array(
				'errors' => $errors,
				'bookings' => $bookings,
			));
		}
	}

	protected function setElementDefaultOptions_Element_OphCiPatientadmission_NpoStatus($element, $action)
	{
		if ($action == 'create') {
			if (!$api = Yii::app()->moduleAPI->get('OphTrOperationbooking')) {
				throw new Exception("Unable to activate operation booking api");
			}

			if (!$procedures = $api->getProceduresForOperation($_GET['booking_event_id'])) {
				throw new Exception("Procedures not found for operation booking event: ".$_GET['booking_event_id']);
			}

			if (!$operation = $api->getOperationForEvent($_GET['booking_event_id'])) {
				throw new Exception("Operation not found for booking event: ".$_GET['booking_event_id']);
			}

			$element->procedures = $procedures;

			$eye = $api->getEyeForOperation($_GET['booking_event_id']);

			$element->eye_id = $eye->id;
			$element->time_last_drank = $operation->booking->session_date;
		}
	}
}
