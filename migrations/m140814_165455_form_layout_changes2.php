<?php

class m140814_165455_form_layout_changes2 extends OEMigration
{
	public function up()
	{
		$this->update("element_type", array("name" => 'Patient history review' ), 'class_name = "Element_OphCiPatientadmission_MedicalHistoryReview"');

		$this->createTable('ophcipatientadmission_procedure_verified', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
			'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'KEY `ophcipatientadmission_procedure_verified_lmui_fk` (`last_modified_user_id`)',
			'KEY `ophcipatientadmission_procedure_verified_cui_fk` (`created_user_id`)',
			'CONSTRAINT `ophcipatientadmission_procedure_verified_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `ophcipatientadmission_procedure_verified_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		$this->versionExistingTable('ophcipatientadmission_procedure_verified');

		$this->insert('ophcipatientadmission_procedure_verified',array('id' => 1, 'name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_procedure_verified',array('id' => 2,'name'=>'No','display_order'=>2));

		$this->createTable('ophcipatientadmission_site_verified', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
			'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'KEY `ophcipatientadmission_site_verified_lmui_fk` (`last_modified_user_id`)',
			'KEY `ophcipatientadmission_site_verified_cui_fk` (`created_user_id`)',
			'CONSTRAINT `ophcipatientadmission_site_verified_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `ophcipatientadmission_site_verified_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		$this->versionExistingTable('ophcipatientadmission_site_verified');
		$this->insert('ophcipatientadmission_site_verified',array('id' => 1,'name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_site_verified',array('id' => 2,'name'=>'No','display_order'=>2));

		$this->createTable('ophcipatientadmission_site_marked_by_x', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
			'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'KEY `ophcipatientadmission_site_marked_by_x_lmui_fk` (`last_modified_user_id`)',
			'KEY `ophcipatientadmission_site_marked_by_x_cui_fk` (`created_user_id`)',
			'CONSTRAINT `ophcipatientadmission_site_marked_by_x_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `ophcipatientadmission_site_marked_by_x_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		$this->versionExistingTable('ophcipatientadmission_site_marked_by_x');

		$this->insert('ophcipatientadmission_site_marked_by_x',array('id' => 1,'name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_site_marked_by_x',array('id' => 2,'name'=>'No','display_order'=>2));

		$this->renameColumn('et_ophcipatientadmission_verification','procedure_verified','procedure_verified_id');
		$this->renameColumn('et_ophcipatientadmission_verification','site_verified','site_verified_id');
		$this->renameColumn('et_ophcipatientadmission_verification','site_marked_by_x','site_marked_by_x_id');
		$this->renameColumn('et_ophcipatientadmission_verification_version','procedure_verified','procedure_verified_id');
		$this->renameColumn('et_ophcipatientadmission_verification_version','site_verified','site_verified_id');
		$this->renameColumn('et_ophcipatientadmission_verification_version','site_marked_by_x','site_marked_by_x_id');

		$this->alterColumn('et_ophcipatientadmission_verification','procedure_verified_id',"int(10) unsigned DEFAULT '2'");
		$this->alterColumn('et_ophcipatientadmission_verification_version','procedure_verified_id',"int(10) unsigned DEFAULT '2'");
		$this->alterColumn('et_ophcipatientadmission_verification','site_verified_id',"int(10) unsigned DEFAULT '2'");
		$this->alterColumn('et_ophcipatientadmission_verification_version','site_verified_id',"int(10) unsigned DEFAULT '2'");
		$this->alterColumn('et_ophcipatientadmission_verification','site_marked_by_x_id',"int(10) unsigned DEFAULT '2'");
		$this->alterColumn('et_ophcipatientadmission_verification_version','site_marked_by_x_id',"int(10) unsigned DEFAULT '2'");

		$this->update('et_ophcipatientadmission_verification',array('procedure_verified_id' => 2));
		$this->update('et_ophcipatientadmission_verification',array('site_verified_id' => 2));
		$this->update('et_ophcipatientadmission_verification',array('site_marked_by_x_id' => 2));

		$this->addForeignKey('et_ophcipatientadmission_verification_procedure_verified_id_fk','et_ophcipatientadmission_verification','procedure_verified_id','ophcipatientadmission_procedure_verified','id');
		$this->addForeignKey('et_ophcipatientadmission_verification_site_verified_id_fk','et_ophcipatientadmission_verification','site_verified_id','ophcipatientadmission_site_verified','id');
		$this->addForeignKey('et_ophcipatientadmission_verification_marked_by_x_id_fk','et_ophcipatientadmission_verification','site_marked_by_x_id','ophcipatientadmission_site_marked_by_x','id');

		$this->createElementType('OphCiPatientadmission', 'IOL Measurements Verified', array('display_order' => 40));
		//$this->createElementType('OphCiPatientadmission', 'Baseline Vitals Assessment', array('display_order' => 50));
		//$this->createElementType('OphCiPatientadmission', 'Patient Status', array('display_order' => 60, 'default' => true));

		$this->createTable('ophcipatientadmission_iol_measurements_verified', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
			'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'KEY `ophcipatientadmission_iol_measurements_verified_lmui_fk` (`last_modified_user_id`)',
			'KEY `ophcipatientadmission_iol_measurements_verified_cui_fk` (`created_user_id`)',
			'CONSTRAINT `ophcipatientadmission_iol_measurements_verified_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `ophcipatientadmission_iol_measurements_verified_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		$this->versionExistingTable('ophcipatientadmission_iol_measurements_verified');

		$this->createTable('ophcipatientadmission_iol_selected', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
			'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'KEY `ophcipatientadmission_iol_selected_lmui_fk` (`last_modified_user_id`)',
			'KEY `ophcipatientadmission_iol_selected_cui_fk` (`created_user_id`)',
			'CONSTRAINT `ophcipatientadmission_iol_selected_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `ophcipatientadmission_iol_selected_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		$this->versionExistingTable('ophcipatientadmission_iol_selected');

		$this->insert('ophcipatientadmission_iol_measurements_verified',array('id' => 1,'name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_iol_measurements_verified',array('id' => 2,'name'=>'No','display_order'=>2));

		$this->insert('ophcipatientadmission_iol_selected',array('id' => 1,'name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_iol_selected',array('id' => 2,'name'=>'No','display_order'=>2));

		$this->createTable('et_ophcipatientadmission_iol_measurements_verified', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'event_id' => 'int(10) unsigned NOT NULL',
			'iol_measurements_verified_id' => "int(10) unsigned DEFAULT '2'",
			'iol_selected_id' => "int(10) unsigned DEFAULT '2'",
			'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'KEY `et_ophcipatientadmission_iol_measurements_verified_lmui_fk` (`last_modified_user_id`)',
			'KEY `et_ophcipatientadmission_iol_measurements_verified_cui_fk` (`created_user_id`)',
			'KEY `et_ophcipatientadmission_iol_measurements_verified_ev_fk` (`event_id`)',
			'KEY `et_ophcipatientadmission_iol_measurements_verified_mv_fk` (`iol_measurements_verified_id`)',
			'KEY `et_ophcipatientadmission_iol_measurements_verified_s_fk` (`iol_selected_id`)',
			'CONSTRAINT `et_ophcipatientadmission_iol_measurements_verified_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `et_ophcipatientadmission_iol_measurements_verified_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `et_ophcipatientadmission_iol_measurements_verified_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			'CONSTRAINT `et_ophcipatientadmission_iol_measurements_verified_mv_fk` FOREIGN KEY (`iol_measurements_verified_id`) REFERENCES `ophcipatientadmission_iol_measurements_verified` (`id`)',
			'CONSTRAINT `et_ophcipatientadmission_iol_measurements_verified_s_fk` FOREIGN KEY (`iol_selected_id`) REFERENCES `ophcipatientadmission_iol_selected` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
		$this->versionExistingTable('et_ophcipatientadmission_iol_measurements_verified');

		$this->dropForeignKey('et_ophcipatientadmission_npostatus_iol_measurements_ver_fk','et_ophcipatientadmission_npostatus');
		$this->dropForeignKey('et_ophcipatientadmission_npostatus_iol_selected_fk','et_ophcipatientadmission_npostatus');
		$this->dropTable('ophcipatientadmission_npostatus_iol_measurements_ver');
		$this->dropTable('ophcipatientadmission_npostatus_iol_selected');
		$this->dropTable('ophcipatientadmission_npostatus_iol_measurements_ver_version');
		$this->dropTable('ophcipatientadmission_npostatus_iol_selected_version');
		$this->dropColumn('et_ophcipatientadmission_npostatus','iol_measurements_verified_id');
		$this->dropColumn('et_ophcipatientadmission_npostatus','iol_selected_id');
		$this->dropColumn('et_ophcipatientadmission_npostatus','comments');

		$this->dropColumn('et_ophcipatientadmission_npostatus_version','iol_measurements_verified_id');
		$this->dropColumn('et_ophcipatientadmission_npostatus_version','iol_selected_id');
		$this->dropColumn('et_ophcipatientadmission_npostatus_version','comments');

	}

	public function down()
	{
		$this->update("element_type", array("name" => 'Medical history review' ), 'class_name = "Element_OphCiPatientadmission_MedicalHistoryReview"');

		$this->dropForeignKey('et_ophcipatientadmission_verification_procedure_verified_id_fk','et_ophcipatientadmission_verification');
		$this->dropForeignKey('et_ophcipatientadmission_verification_site_verified_id_fk','et_ophcipatientadmission_verification');
		$this->dropForeignKey('et_ophcipatientadmission_verification_marked_by_x_id_fk','et_ophcipatientadmission_verification');

		$this->update('et_ophcipatientadmission_verification',array('procedure_verified_id' => 0));
		$this->update('et_ophcipatientadmission_verification',array('site_verified_id' => 0));
		$this->update('et_ophcipatientadmission_verification',array('site_marked_by_x_id' => 0));

		$this->renameColumn('et_ophcipatientadmission_verification','procedure_verified_id','procedure_verified');
		$this->renameColumn('et_ophcipatientadmission_verification','site_verified_id','site_verified');
		$this->renameColumn('et_ophcipatientadmission_verification','site_marked_by_x_id','site_marked_by_x');
		$this->renameColumn('et_ophcipatientadmission_verification_version','procedure_verified_id','procedure_verified');
		$this->renameColumn('et_ophcipatientadmission_verification_version','site_verified_id','site_verified');
		$this->renameColumn('et_ophcipatientadmission_verification_version','site_marked_by_x_id','site_marked_by_x');

		$this->alterColumn('et_ophcipatientadmission_verification','procedure_verified',"tinyint(1) unsigned NOT NULL DEFAULT '0'");
		$this->alterColumn('et_ophcipatientadmission_verification_version','procedure_verified',"tinyint(1) unsigned NOT NULL DEFAULT '0'");
		$this->alterColumn('et_ophcipatientadmission_verification','site_verified',"tinyint(1) unsigned NOT NULL DEFAULT '0'");
		$this->alterColumn('et_ophcipatientadmission_verification_version','site_verified',"tinyint(1) unsigned NOT NULL DEFAULT '0'");
		$this->alterColumn('et_ophcipatientadmission_verification','site_marked_by_x',"tinyint(1) unsigned NOT NULL DEFAULT '0'");
		$this->alterColumn('et_ophcipatientadmission_verification_version','site_marked_by_x',"tinyint(1) unsigned NOT NULL DEFAULT '0'");

		$this->dropTable('ophcipatientadmission_site_verified');
		$this->dropTable('ophcipatientadmission_site_verified_version');
		$this->dropTable('ophcipatientadmission_procedure_verified');
		$this->dropTable('ophcipatientadmission_procedure_verified_version');
		$this->dropTable('ophcipatientadmission_site_marked_by_x');
		$this->dropTable('ophcipatientadmission_site_marked_by_x_version');

		$this->delete('element_type', 'class_name in (
			"Element_OphCiPatientadmission_IOLMeasurementsVerified")'
		);
		/*
		 * ,
			"Element_OphCiPatientadmission_BaselineVitalsAssessment",
			"Element_OphCiPatientadmission_PatientStatus" */


		$this->dropTable('et_ophcipatientadmission_iol_measurements_verified');
		$this->dropTable('et_ophcipatientadmission_iol_measurements_verified_version');
		$this->dropTable('ophcipatientadmission_iol_measurements_verified');
		$this->dropTable('ophcipatientadmission_iol_measurements_verified_version');
		$this->dropTable('ophcipatientadmission_iol_selected');
		$this->dropTable('ophcipatientadmission_iol_selected_version');

		$this->createTable('ophcipatientadmission_npostatus_iol_measurements_ver', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
			'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'KEY `ophcipatientadmission_npostatus_iol_measurements_ver_lmui_fk` (`last_modified_user_id`)',
			'KEY `ophcipatientadmission_npostatus_iol_measurements_ver_cui_fk` (`created_user_id`)',
			'CONSTRAINT `ophcipatientadmission_npostatus_iol_measurements_ver_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `ophcipatientadmission_npostatus_iol_measurements_ver_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		$this->versionExistingTable('ophcipatientadmission_npostatus_iol_measurements_ver');
		$this->insert('ophcipatientadmission_npostatus_iol_measurements_ver',array('id' => 1,'name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_npostatus_iol_measurements_ver',array('id' => 2,'name'=>'No','display_order'=>2));
		$this->insert('ophcipatientadmission_npostatus_iol_measurements_ver',array('id' => 3,'name'=>'N/A','display_order'=>3));

		$this->createTable('ophcipatientadmission_npostatus_iol_selected', array(
			'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
			'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
			'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
			'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'KEY `ophcipatientadmission_npostatus_iol_selected_lmui_fk` (`last_modified_user_id`)',
			'KEY `ophcipatientadmission_npostatus_iol_selected_cui_fk` (`created_user_id`)',
			'CONSTRAINT `ophcipatientadmission_npostatus_iol_selected_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `ophcipatientadmission_npostatus_iol_selected_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		$this->versionExistingTable('ophcipatientadmission_npostatus_iol_selected');
		$this->insert('ophcipatientadmission_npostatus_iol_selected',array('id' => 1,'name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_npostatus_iol_selected',array('id' => 2,'name'=>'No','display_order'=>2));
		$this->insert('ophcipatientadmission_npostatus_iol_selected',array('id' => 3,'name'=>'N/A','display_order'=>3));

		$this->addColumn('et_ophcipatientadmission_npostatus', 'iol_measurements_verified_id', 'int(10) unsigned DEFAULT NULL AFTER time_last_drank');
		$this->addColumn('et_ophcipatientadmission_npostatus', 'iol_selected_id', 'int(10) unsigned DEFAULT NULL AFTER iol_measurements_verified_id');
		$this->addColumn('et_ophcipatientadmission_npostatus', 'comments', 'text COLLATE utf8_bin');
		$this->addColumn('et_ophcipatientadmission_npostatus_version', 'iol_measurements_verified_id', 'int(10) unsigned DEFAULT NULL AFTER time_last_drank');
		$this->addColumn('et_ophcipatientadmission_npostatus_version', 'iol_selected_id', 'int(10) unsigned DEFAULT NULL AFTER iol_measurements_verified_id');
		$this->addColumn('et_ophcipatientadmission_npostatus_version', 'comments', 'text COLLATE utf8_bin');

		$this->addForeignKey('et_ophcipatientadmission_npostatus_iol_measurements_ver_fk','et_ophcipatientadmission_npostatus','iol_measurements_verified_id','ophcipatientadmission_npostatus_iol_measurements_ver','id');
		$this->addForeignKey('et_ophcipatientadmission_npostatus_iol_selected_fk','et_ophcipatientadmission_npostatus','iol_selected_id','ophcipatientadmission_npostatus_iol_selected','id');
	}
}