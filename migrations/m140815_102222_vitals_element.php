<?php

class m140815_102222_vitals_element extends OEMigration
{
	public function up()
	{
		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :cn",array(":cn" => "OphCiPatientadmission"))->queryRow();

		$this->insert('element_type',array(
			'name' => 'Baseline vitals assessment',
			'class_name' => 'Element_OphCiPatientadmission_Vitals',
			'event_type_id' => $et['id'],
			'display_order' => 35,
			'default' => 0,
			'required' => 0,
			'active' => 1,
		));

		$this->createTable('et_ophcipatientadmission_vitals', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'blood_glucose_m_id' => 'int(10) unsigned null',
				'blood_glucose_na' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientadmission_vitals_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientadmission_vitals_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientadmission_vitals_ev_fk` (`event_id`)',
				'KEY `et_ophcipatientadmission_vitals_bgmi_fk` (`blood_glucose_m_id`)',
				'CONSTRAINT `et_ophcipatientadmission_vitals_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_vitals_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_vitals_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_vitals_bgmi_fk` FOREIGN KEY (`blood_glucose_m_id`) REFERENCES `measurement_blood_glucose` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('et_ophcipatientadmission_vitals');

		$this->createTable('ophcipatientadmission_vital', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'timestamp' => 'datetime not null',
				'hr_pulse_m_id' => 'int(10) unsigned NULL',
				'blood_pressure_m_id' => 'int(10) unsigned NULL',
				'rr_m_id' => 'int(10) unsigned NULL',
				'spo2_m_id' => 'int(10) unsigned NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientadmission_vital_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientadmission_vital_cui_fk` (`created_user_id`)',
				'KEY `ophcipatientadmission_vital_ele_fk` (`element_id`)',
				'KEY `ophcipatientadmission_vital_hpmi_fk` (`hr_pulse_m_id`)',
				'KEY `ophcipatientadmission_vital_bpmi_fk` (`blood_pressure_m_id`)',
				'KEY `ophcipatientadmission_vital_rrmi_fk` (`rr_m_id`)',
				'KEY `ophcipatientadmission_vital_spmi_fk` (`spo2_m_id`)',
				'CONSTRAINT `ophcipatientadmission_vital_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientadmission_vital_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientadmission_vital_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcipatientadmission_vitals` (`id`)',
				'CONSTRAINT `ophcipatientadmission_vital_hpmi_fk` FOREIGN KEY (`hr_pulse_m_id`) REFERENCES `measurement_pulse` (`id`)',
				'CONSTRAINT `ophcipatientadmission_vital_bpmi_fk` FOREIGN KEY (`blood_pressure_m_id`) REFERENCES `measurement_blood_pressure` (`id`)',
				'CONSTRAINT `ophcipatientadmission_vital_rrmi_fk` FOREIGN KEY (`rr_m_id`) REFERENCES `measurement_respiratory_rate` (`id`)',
				'CONSTRAINT `ophcipatientadmission_vital_spmi_fk` FOREIGN KEY (`spo2_m_id`) REFERENCES `measurement_spo2` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientadmission_vital');
	}

	public function down()
	{
		$this->dropTable('ophcipatientadmission_vital_version');
		$this->dropTable('ophcipatientadmission_vital');

		$this->dropTable('et_ophcipatientadmission_vitals_version');
		$this->dropTable('et_ophcipatientadmission_vitals');

		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :cn",array(":cn" => "OphCiPatientadmission"))->queryRow();

		$this->delete('element_type',"event_type_id = {$et['id']} and class_name = 'Element_OphCiPatientadmission_Vitals'");
	}
}
