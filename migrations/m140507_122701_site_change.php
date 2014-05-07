<?php

class m140507_122701_site_change extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('et_ophcipatientadmission_npostatus_site_id_fk','et_ophcipatientadmission_npostatus');
		$this->dropIndex('et_ophcipatientadmission_npostatus_site_id_fk','et_ophcipatientadmission_npostatus');
		$this->renameColumn('et_ophcipatientadmission_npostatus','site_id','eye_id');
		$this->createIndex('et_ophcipatientadmission_npostatus_eye_id_fk','et_ophcipatientadmission_npostatus','eye_id');
		$this->addForeignKey('et_ophcipatientadmission_npostatus_eye_id_fk','et_ophcipatientadmission_npostatus','eye_id','eye','id');
	}

	public function down()
	{
		$this->dropForeignKey('et_ophcipatientadmission_npostatus_eye_id_fk','et_ophcipatientadmission_npostatus');
		$this->dropIndex('et_ophcipatientadmission_npostatus_eye_id_fk','et_ophcipatientadmission_npostatus');
		$this->renameColumn('et_ophcipatientadmission_npostatus','eye_id','site_id');
		$this->createIndex('et_ophcipatientadmission_npostatus_site_id_fk','et_ophcipatientadmission_npostatus','site_id');
		$this->addForeignKey('et_ophcipatientadmission_npostatus_site_id_fk','et_ophcipatientadmission_npostatus','site_id','site','id');
	}
}
