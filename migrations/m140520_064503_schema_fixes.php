<?php

class m140520_064503_schema_fixes extends CDbMigration
{
	public $tables = array(
		'ophcipatientadmission_patientdetails_caregiver_relationship' => 'ophcipatientadmission_patientdetails_cr',
		'ophcipatientadmission_patientdetails_identifier_assignment' => 'ophcipatientadmission_patientdetails_identassign',
	);

	public function up()
	{
		$event_type = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphCiPatientadmission"))->queryRow();
		$this->update('element_type',array('required'=>1),"event_type_id = {$event_type['id']}");

		foreach ($this->tables as $from => $to) {
			$this->renameTable($from,$to);
		}
	}

	public function down()
	{
		$event_type = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphCiPatientadmission"))->queryRow();
		$this->update('element_type',array('required'=>null),"event_type_id = {$event_type['id']}");

		foreach ($this->tables as $to => $from) {
			$this->renameTable($from,$to);
		}
	}
}
