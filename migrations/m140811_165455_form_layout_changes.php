<?php

class m140811_165455_form_layout_changes extends OEMigration
{
	public function up()
	{
		$this->delete('ophcipatientadmission_patientdetails_caregiver_present', 'name="N/A"');
		$this->dropForeignKey('ophcipatientadmission_patientdetails_caregiver_relationship_fk','et_ophcipatientadmission_patientdetails');
		$this->dropForeignKey('ophcipatientadmission_patientdetails_caregiver_present_fk','et_ophcipatientadmission_patientdetails');
		$this->renameColumn('et_ophcipatientadmission_patientdetails','caregiver_relationship_id','caregiver_relationship1_id');
		$this->renameColumn('et_ophcipatientadmission_patientdetails','caregiver_name','caregiver_name1');
		$this->renameColumn('et_ophcipatientadmission_patientdetails','caregiver_present_id','caregivers_present_id');
		$this->renameColumn('et_ophcipatientadmission_patientdetails_version','caregiver_relationship_id','caregiver_relationship1_id');
		$this->renameColumn('et_ophcipatientadmission_patientdetails_version','caregiver_name','caregiver_name1');
		$this->renameColumn('et_ophcipatientadmission_patientdetails_version','caregiver_present_id','caregivers_present_id');
		$this->addForeignKey('ophcipatientadmission_patientdetails_caregivers_present_fk','et_ophcipatientadmission_patientdetails',
			'caregivers_present_id','ophcipatientadmission_patientdetails_caregiver_present','id');
		$this->addForeignKey('ophcipatientadmission_patientdetails_caregiver_relationship1_fk','et_ophcipatientadmission_patientdetails',
			'caregiver_relationship1_id','ophcipatientadmission_patientdetails_cr','id');
		$this->addColumn('et_ophcipatientadmission_patientdetails','caregiver_relationship2_id','int(10) unsigned DEFAULT NULL AFTER caregiver_relationship1_id');
		$this->addColumn('et_ophcipatientadmission_patientdetails','caregiver_name2',"varchar(255) COLLATE utf8_bin DEFAULT '' AFTER caregiver_name1");
		$this->addColumn('et_ophcipatientadmission_patientdetails_version','caregiver_relationship2_id','int(10) unsigned DEFAULT NULL AFTER caregiver_relationship1_id');
		$this->addColumn('et_ophcipatientadmission_patientdetails_version','caregiver_name2',"varchar(255) COLLATE utf8_bin DEFAULT '' AFTER caregiver_name1");
		$this->addForeignKey('ophcipatientadmission_patientdetails_caregiver_relationship2_fk','et_ophcipatientadmission_patientdetails',
			'caregiver_relationship2_id','ophcipatientadmission_patientdetails_cr','id');
		$this->update("element_type", array("default" => 0 ), 'class_name = "Element_OphCiPatientadmission_NpoStatus"');
	}

	public function down()
	{
		$this->insert('ophcipatientadmission_patientdetails_caregiver_present', array('name' => 'N/A', 'display_order' => 3));
		$this->dropForeignKey('ophcipatientadmission_patientdetails_caregiver_relationship2_fk','et_ophcipatientadmission_patientdetails');
		$this->dropForeignKey('ophcipatientadmission_patientdetails_caregiver_relationship1_fk','et_ophcipatientadmission_patientdetails');
		$this->dropForeignKey('ophcipatientadmission_patientdetails_caregivers_present_fk','et_ophcipatientadmission_patientdetails');
		$this->dropColumn('et_ophcipatientadmission_patientdetails', 'caregiver_relationship2_id');
		$this->dropColumn('et_ophcipatientadmission_patientdetails', 'caregiver_name2');
		$this->renameColumn('et_ophcipatientadmission_patientdetails','caregiver_relationship1_id','caregiver_relationship_id');
		$this->renameColumn('et_ophcipatientadmission_patientdetails','caregiver_name1','caregiver_name');
		$this->renameColumn('et_ophcipatientadmission_patientdetails','caregivers_present_id','caregiver_present_id');
		$this->addForeignKey('ophcipatientadmission_patientdetails_caregiver_relationship_fk','et_ophcipatientadmission_patientdetails',
			'caregiver_relationship_id','ophcipatientadmission_patientdetails_cr','id');
		$this->addForeignKey('ophcipatientadmission_patientdetails_caregiver_present_fk','et_ophcipatientadmission_patientdetails',
			'caregiver_present_id','ophcipatientadmission_patientdetails_caregiver_present','id');

		$this->dropColumn('et_ophcipatientadmission_patientdetails_version', 'caregiver_relationship2_id');
		$this->dropColumn('et_ophcipatientadmission_patientdetails_version', 'caregiver_name2');
		$this->renameColumn('et_ophcipatientadmission_patientdetails_version','caregiver_relationship1_id','caregiver_relationship_id');
		$this->renameColumn('et_ophcipatientadmission_patientdetails_version','caregiver_name1','caregiver_name');
		$this->renameColumn('et_ophcipatientadmission_patientdetails_version','caregivers_present_id','caregiver_present_id');
		$this->update("element_type", array("default" => 1 ), 'class_name = "Element_OphCiPatientadmission_NpoStatus"');
	}
}
