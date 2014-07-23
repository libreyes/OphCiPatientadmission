<?php

class m140723_090732_element_changes extends CDbMigration
{
	public function up()
	{
		$et = $this->dbConnection->createCommand()->select("*")->from('event_type')->where("class_name = :class_name",array(":class_name" => "OphCiPatientadmission"))->queryRow();

		$this->update('element_type',array('name' => 'Patient identification'),"event_type_id = {$et['id']} and class_name = 'Element_OphCiPatientadmission_PatientDetails'");

		$this->dropTable('ophcipatientadmission_patientdetails_identassign_version');
		$this->dropTable('ophcipatientadmission_patientdetails_identassign');
		$this->dropTable('ophcipatientadmission_patientdetails_identifier_version');
		$this->dropTable('ophcipatientadmission_patientdetails_identifier');
	}

	public function down()
	{
		$this->execute("CREATE TABLE `ophcipatientadmission_patientdetails_identifier` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) COLLATE utf8_bin NOT NULL,
	`display_order` tinyint(1) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `ophcipatientadmission_patientdetails_identifier_lmui_fk` (`last_modified_user_id`),
	KEY `ophcipatientadmission_patientdetails_identifier_cui_fk` (`created_user_id`),
	CONSTRAINT `ophcipatientadmission_patientdetails_identifier_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophcipatientadmission_patientdetails_identifier_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->versionExistingTable('ophcipatientadmission_patientdetails_identifier');

		$this->execute("CREATE TABLE `ophcipatientadmission_patientdetails_identassign` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`element_id` int(10) unsigned NOT NULL,
	`identifier_id` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `ophcipatientadmission_pi_assignment_lmui_fk` (`last_modified_user_id`),
	KEY `ophcipatientadmission_pi_assignment_cui_fk` (`created_user_id`),
	KEY `ophcipatientadmission_pi_assignment_ele_fk` (`element_id`),
	KEY `ophcipatientadmission_pi_assignment_idi_fk` (`identifier_id`),
	CONSTRAINT `ophcipatientadmission_pi_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophcipatientadmission_pi_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophcipatientadmission_pi_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcipatientadmission_patientdetails` (`id`),
	CONSTRAINT `ophcipatientadmission_pi_assignment_idi_fk` FOREIGN KEY (`identifier_id`) REFERENCES `ophcipatientadmission_patientdetails_identifier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->versionExistingTable('ophcipatientadmission_patientdetails_identassign');

		$et = $this->dbConnection->createCommand()->select("*")->from('event_type')->where("class_name = :class_name",array(":class_name" => "OphCiPatientadmission"))->queryRow();

		$this->update('element_type',array('name' => 'Patient details'),"event_type_id = {$et['id']} and class_name = 'Element_OphCiPatientadmission_PatientDetails'");
	}
}
