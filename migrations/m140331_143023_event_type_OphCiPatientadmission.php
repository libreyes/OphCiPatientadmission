<?php 
class m140331_143023_event_type_OphCiPatientadmission extends CDbMigration
{
	public function up()
	{
		// --- EVENT TYPE ENTRIES ---

		// create an event_type entry for this event type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphCiPatientadmission'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Clinical events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphCiPatientadmission', 'name' => 'Patient admission','event_group_id' => $group['id']));
		}
		// select the event_type id for this event type name
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphCiPatientadmission'))->queryRow();

		// --- ELEMENT TYPE ENTRIES ---

		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Patient details',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Patient details','class_name' => 'Element_OphCiPatientadmission_PatientDetails', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Patient details'))->queryRow();
		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'NPO status',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'NPO status','class_name' => 'Element_OphCiPatientadmission_NpoStatus', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'NPO status'))->queryRow();

		// element lookup table ophcipatientadmission_patientdetails_translator_present
		$this->createTable('ophcipatientadmission_patientdetails_translator_present', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientadmission_patientdetails_translator_present_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientadmission_patientdetails_translator_present_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientadmission_patientdetails_translator_present_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientadmission_patientdetails_translator_present_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcipatientadmission_patientdetails_translator_present',array('name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_patientdetails_translator_present',array('name'=>'No','display_order'=>2));
		$this->insert('ophcipatientadmission_patientdetails_translator_present',array('name'=>'N/A','display_order'=>3));

		// element lookup table ophcipatientadmission_patientdetails_caregiver_present
		$this->createTable('ophcipatientadmission_patientdetails_caregiver_present', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientadmission_patientdetails_caregiver_present_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientadmission_patientdetails_caregiver_present_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientadmission_patientdetails_caregiver_present_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientadmission_patientdetails_caregiver_present_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcipatientadmission_patientdetails_caregiver_present',array('name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_patientdetails_caregiver_present',array('name'=>'No','display_order'=>2));
		$this->insert('ophcipatientadmission_patientdetails_caregiver_present',array('name'=>'N/A','display_order'=>3));

		// element lookup table ophcipatientadmission_patientdetails_caregiver_relationship
		$this->createTable('ophcipatientadmission_patientdetails_caregiver_relationship', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientadmission_pcr_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientadmission_pcr_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientadmission_pcr_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientadmission_pcr_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcipatientadmission_patientdetails_caregiver_relationship',array('name'=>'Mother','display_order'=>1));
		$this->insert('ophcipatientadmission_patientdetails_caregiver_relationship',array('name'=>'Father','display_order'=>2));
		$this->insert('ophcipatientadmission_patientdetails_caregiver_relationship',array('name'=>'Brother','display_order'=>3));
		$this->insert('ophcipatientadmission_patientdetails_caregiver_relationship',array('name'=>'Sister','display_order'=>4));



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophcipatientadmission_patientdetails', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'translator_present_id' => 'int(10) unsigned NOT NULL', // Translator present
				'name_of_translator' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'', // Name of translator
				'patient_id_verified' => 'tinyint(1) unsigned NOT NULL', // Patient ID verified
				'allergies_verified' => 'tinyint(1) unsigned NOT NULL', // Allergies verified
				'medication_history_verified' => 'tinyint(1) unsigned NOT NULL', // Medication history verified
				'caregiver_present_id' => 'int(10) unsigned NOT NULL', // Caregiver present
				'caregiver_name' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'', // Caregiver name
				'caregiver_relationship_id' => 'int(10) unsigned NULL', // Caregiver relationship
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientadmission_patientdetails_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientadmission_patientdetails_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientadmission_patientdetails_ev_fk` (`event_id`)',
				'KEY `ophcipatientadmission_patientdetails_translator_present_fk` (`translator_present_id`)',
				'KEY `ophcipatientadmission_patientdetails_caregiver_present_fk` (`caregiver_present_id`)',
				'KEY `ophcipatientadmission_patientdetails_caregiver_relationship_fk` (`caregiver_relationship_id`)',
				'CONSTRAINT `et_ophcipatientadmission_patientdetails_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_patientdetails_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_patientdetails_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophcipatientadmission_patientdetails_translator_present_fk` FOREIGN KEY (`translator_present_id`) REFERENCES `ophcipatientadmission_patientdetails_translator_present` (`id`)',
				'CONSTRAINT `ophcipatientadmission_patientdetails_caregiver_present_fk` FOREIGN KEY (`caregiver_present_id`) REFERENCES `ophcipatientadmission_patientdetails_caregiver_present` (`id`)',
				'CONSTRAINT `ophcipatientadmission_patientdetails_caregiver_relationship_fk` FOREIGN KEY (`caregiver_relationship_id`) REFERENCES `ophcipatientadmission_patientdetails_caregiver_relationship` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophcipatientadmission_npostatus', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'time_last_ate' => 'date DEFAULT NULL', // Time last ate
				'time_last_drank' => 'date DEFAULT NULL', // Time last drank
				'procedure_verified' => 'tinyint(1) unsigned NOT NULL', // Procedure verified
				'procedure_id' => 'int(10) unsigned NOT NULL', // Procedure
				'site_verified' => 'tinyint(1) unsigned NOT NULL', // Site verified
				'site_id' => 'int(10) unsigned NOT NULL', // Site
				'signed_and_witnessed' => 'tinyint(1) unsigned NOT NULL', // Signed and witnessed
				'type_of_surgery' => 'tinyint(1) unsigned NOT NULL', // Type of surgery
				'site_marked_by_x' => 'tinyint(1) unsigned NOT NULL', // Site marked by X
				'site_marked_by_id' => 'int(10) unsigned NOT NULL', // Site marked by
				'iol_measurements_verified' => 'tinyint(1) unsigned NOT NULL', // IOL measurements verified
				'iol_selected' => 'tinyint(1) unsigned NOT NULL', // IOL selected
				'comments' => 'text COLLATE utf8_bin DEFAULT \'\'', // Comments
				'signature_timestamp' => 'date DEFAULT NULL', // Signature timestamp
				'signature_user_id' => 'int(10) unsigned NOT NULL', // Signature user
				'signature_role_id' => 'int(10) unsigned NOT NULL', // Signature role
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientadmission_npostatus_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientadmission_npostatus_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientadmission_npostatus_ev_fk` (`event_id`)',
				'KEY `et_ophcipatientadmission_npostatus_procedure_id_fk` (`procedure_id`)',
				'KEY `et_ophcipatientadmission_npostatus_site_id_fk` (`site_id`)',
				'KEY `et_ophcipatientadmission_npostatus_site_marked_by_id_fk` (`site_marked_by_id`)',
				'KEY `et_ophcipatientadmission_npostatus_signature_user_id_fk` (`signature_user_id`)',
				'KEY `et_ophcipatientadmission_npostatus_signature_role_id_fk` (`signature_role_id`)',
				'CONSTRAINT `et_ophcipatientadmission_npostatus_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_npostatus_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_npostatus_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_npostatus_procedure_id_fk` FOREIGN KEY (`procedure_id`) REFERENCES `proc` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_npostatus_site_id_fk` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_npostatus_site_marked_by_id_fk` FOREIGN KEY (`site_marked_by_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_npostatus_signature_user_id_fk` FOREIGN KEY (`signature_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_npostatus_signature_role_id_fk` FOREIGN KEY (`signature_role_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

	}

	public function down()
	{
		// --- drop any element related tables ---
		// --- drop element tables ---
		$this->dropTable('et_ophcipatientadmission_patientdetails');


		$this->dropTable('ophcipatientadmission_patientdetails_translator_present');
		$this->dropTable('ophcipatientadmission_patientdetails_caregiver_present');
		$this->dropTable('ophcipatientadmission_patientdetails_caregiver_relationship');

		$this->dropTable('et_ophcipatientadmission_npostatus');




		// --- delete event entries ---
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphCiPatientadmission'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		// --- delete entries from element_type ---
		$this->delete('element_type', 'event_type_id='.$event_type['id']);

		// --- delete entries from event_type ---
		$this->delete('event_type', 'id='.$event_type['id']);

		// echo "m000000_000001_event_type_OphCiPatientadmission does not support migration down.\n";
		// return false;
		echo "If you are removing this module you may also need to remove references to it in your configuration files\n";
		return true;
	}
}

