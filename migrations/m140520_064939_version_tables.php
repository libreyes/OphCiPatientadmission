<?php

class m140520_064939_version_tables extends OEMigration
{
	public $tables = array(
		'et_ophcipatientadmission_npostatus',
		'et_ophcipatientadmission_patientdetails',
		'ophcipatientadmission_npostatus_procedure_assignment',
		'ophcipatientadmission_patientdetails_caregiver_present',
		'ophcipatientadmission_patientdetails_cr',
		'ophcipatientadmission_patientdetails_identassign',
		'ophcipatientadmission_patientdetails_identifier',
		'ophcipatientadmission_patientdetails_translator_present',
	);

	public function up()
	{
		foreach ($this->tables as $table) {
			$this->versionExistingTable($table);
		}
	}

	public function down()
	{
		foreach ($this->tables as $table) {
			$this->dropTable($table.'_version');
		}
	}
}
