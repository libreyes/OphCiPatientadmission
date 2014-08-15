<?php

class m140815_113026_npo_status_should_be_optional extends CDbMigration
{
	public function up()
	{
		$this->update('element_type',array('required'=>0),"class_name in ('Element_OphCiPatientadmission_NpoStatus')");
	}

	public function down()
	{
		$this->update('element_type',array('required'=>1),"class_name in ('Element_OphCiPatientadmission_NpoStatus')");
	}
}
