<?php

class m140507_191043_nullable_foreign_keys extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophcipatientadmission_patientdetails','translator_present_id','int(10) unsigned null');
		$this->alterColumn('et_ophcipatientadmission_patientdetails','caregiver_present_id','int(10) unsigned null');
		$this->alterColumn('et_ophcipatientadmission_npostatus','eye_id','int(10) unsigned null');
		$this->alterColumn('et_ophcipatientadmission_npostatus','site_marked_by_id','int(10) unsigned null');
		$this->alterColumn('et_ophcipatientadmission_npostatus','time_last_ate','datetime null');
		$this->alterColumn('et_ophcipatientadmission_npostatus','time_last_drank','datetime null');
	}

	public function down()
	{
    $this->alterColumn('et_ophcipatientadmission_patientdetails','translator_present_id','int(10) unsigned not null');
    $this->alterColumn('et_ophcipatientadmission_patientdetails','caregiver_present_id','int(10) unsigned not null');
    $this->alterColumn('et_ophcipatientadmission_npostatus','eye_id','int(10) unsigned not null');
    $this->alterColumn('et_ophcipatientadmission_npostatus','site_marked_by_id','int(10) unsigned not null');
		$this->alterColumn('et_ophcipatientadmission_npostatus','time_last_ate','datetime not null');
		$this->alterColumn('et_ophcipatientadmission_npostatus','time_last_drank','datetime not null');
	}
}
