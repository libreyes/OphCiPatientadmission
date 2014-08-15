<?php

class m140815_113824_patient_status_element extends OEMigration
{
	public function up()
	{
		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :cn",array(":cn" => "OphCiPatientadmission"))->queryRow();

		$this->insert('element_type',array(
			'name' => 'Patient status',
			'class_name' => 'Element_OphCiPatientadmission_Status',
			'event_type_id' => $et['id'],
			'display_order' => 50,
			'default' => 1,
			'required' => 1,
			'active' => 1,
		));

		$this->createTable('ophcipatientadmission_status', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientadmission_status_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientadmission_status_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophcipatientadmission_status_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientadmission_status_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientadmission_status');

		$this->createTable('et_ophcipatientadmission_status', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'status_id' => 'int(10) unsigned null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientadmission_status_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientadmission_status_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientadmission_status_ev_fk` (`event_id`)',
				'KEY `et_ophcipatientadmission_status_si_fk` (`status_id`)',
				'CONSTRAINT `et_ophcipatientadmission_status_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_status_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_status_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_status_si_fk` FOREIGN KEY (`status_id`) REFERENCES `ophcipatientadmission_status` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('et_ophcipatientadmission_status');

		$this->initialiseData(dirname(__FILE__));
	}

	public function down()
	{
		$this->dropTable('et_ophcipatientadmission_status_version');
		$this->dropTable('et_ophcipatientadmission_status');

		$this->dropTable('ophcipatientadmission_status_version');
		$this->dropTable('ophcipatientadmission_status');

		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :cn",array(":cn" => "OphCiPatientadmission"))->queryRow();

		$this->delete('element_type',"event_type_id = {$et['id']} and class_name = 'Element_OphCiPatientadmission_Status'");
	}
}
