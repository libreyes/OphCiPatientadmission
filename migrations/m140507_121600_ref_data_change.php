<?php

class m140507_121600_ref_data_change extends CDbMigration
{
	public function up()
	{
		$this->update('ophcipatientadmission_patientdetails_caregiver_relationship',array('name' => 'Relative'),'id=3');
		$this->update('ophcipatientadmission_patientdetails_caregiver_relationship',array('name' => 'Other'),'id=4');
	}

	public function down()
	{
		$this->update('ophcipatientadmission_patientdetails_caregiver_relationship',array('name' => 'Brother'),'id=3');
		$this->update('ophcipatientadmission_patientdetails_caregiver_relationship',array('name' => 'Sister'),'id=4');
	}
}
