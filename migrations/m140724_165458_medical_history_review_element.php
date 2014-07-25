<?php

class m140724_165458_medical_history_review_element extends OEMigration
{
	public function up()
	{
		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphCiPatientadmission"))->queryRow();

		$this->insert('element_type',array(
			'event_type_id' => $et['id'],
			'name' => 'Medical history review',
			'class_name' => 'Element_OphCiPatientadmission_MedicalHistoryReview',
			'display_order' => 20,
			'default' => 1,
			'required' => 1,
		));

		$this->createTable('et_ophcipatientadmission_mh_review', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'history_reviewed' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientadmission_mh_review_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientadmission_mh_review_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientadmission_mh_review_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophcipatientadmission_mh_review_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_mh_review_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_mh_review_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('et_ophcipatientadmission_mh_review');

		$this->update('element_type',array('display_order' => 10),"event_type_id = {$et['id']} and class_name = 'Element_OphCiPatientadmission_PatientDetails'");
		$this->update('element_type',array('display_order' => 30),"event_type_id = {$et['id']} and class_name = 'Element_OphCiPatientadmission_NpoStatus'");

		$this->dropColumn('et_ophcipatientadmission_patientdetails','allergies_verified');
		$this->dropColumn('et_ophcipatientadmission_patientdetails_version','allergies_verified');
		$this->dropColumn('et_ophcipatientadmission_patientdetails','medication_history_verified');
		$this->dropColumn('et_ophcipatientadmission_patientdetails_version','medication_history_verified');
	}

	public function down()
	{
		$this->addColumn('et_ophcipatientadmission_patientdetails','medication_history_verified','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_patientdetails_version','medication_history_verified','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_patientdetails','allergies_verified','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_patientdetails_version','allergies_verified','tinyint(1) unsigned not null');

		$this->dropTable('et_ophcipatientadmission_mh_review_version');
		$this->dropTable('et_ophcipatientadmission_mh_review');

		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphCiPatientadmission"))->queryRow();

		$this->delete('element_type',"event_type_id = {$et['id']} and class_name = 'Element_OphCiPatientadmission_MedicalHistoryReview'");

		$this->update('element_type',array('display_order' => 99),"event_type_id = {$et['id']} and class_name = 'Element_OphCiPatientadmission_PatientDetails'");
		$this->update('element_type',array('display_order' => 100),"event_type_id = {$et['id']} and class_name = 'Element_OphCiPatientadmission_NpoStatus'");
	}
}
