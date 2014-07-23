<?php

class m140723_081722_iol_version_tables extends OEMigration
{
	public function up()
	{
		$this->versionExistingTable('ophcipatientadmission_npostatus_iol_measurements_ver');
		$this->versionExistingTable('ophcipatientadmission_npostatus_iol_selected');

		$this->alterColumn('et_ophcipatientadmission_npostatus_version', 'iol_measurements_verified', 'int(10) unsigned DEFAULT NULL');
		$this->renameColumn('et_ophcipatientadmission_npostatus_version', 'iol_measurements_verified', 'iol_measurements_verified_id');
		$this->update('et_ophcipatientadmission_npostatus_version',array('iol_measurements_verified_id'=>2),'iol_measurements_verified_id=0');

		$this->alterColumn('et_ophcipatientadmission_npostatus_version', 'iol_selected', 'int(10) unsigned DEFAULT NULL');
		$this->renameColumn('et_ophcipatientadmission_npostatus_version', 'iol_selected', 'iol_selected_id');
		$this->update('et_ophcipatientadmission_npostatus_version',array('iol_selected_id'=>2),'iol_selected_id=0');

		$this->refreshTableSchema('et_ophcipatientadmission_npostatus_version');
	}

	public function down()
	{
		$this->alterColumn('et_ophcipatientadmission_npostatus_version', 'iol_measurements_verified', 'tinyint(1) unsigned NOT NULL');
		$this->renameColumn('et_ophcipatientadmission_npostatus_version', 'iol_measurements_verified_id', 'iol_measurements_verified');
		$this->update('et_ophcipatientadmission_npostatus_version',array('iol_measurements_verified'=>0),'iol_measurements_verified=2');

		$this->alterColumn('et_ophcipatientadmission_npostatus_version', 'iol_selected', 'tinyint(1) unsigned NOT NULL');
		$this->renameColumn('et_ophcipatientadmission_npostatus_version', 'iol_selected_id', 'iol_selected');
		$this->update('et_ophcipatientadmission_npostatus_version',array('iol_selected'=>0),'iol_selected=2');

		$this->refreshTableSchema('et_ophcipatientadmission_npostatus_version');

		$this->dropTable('ophcipatientadmission_npostatus_iol_measurements_ver_version');
		$this->dropTable('ophcipatientadmission_npostatus_iol_selected_version');
	}
}