<?php

class m140729_153255_no_booking_link_and_element_changes extends OEMigration
{
	public function up()
	{
		$this->dropForeignKey('et_ophcipatientadmission_npostatus_booking_event_id_fk','et_ophcipatientadmission_npostatus');
		$this->dropColumn('et_ophcipatientadmission_npostatus','booking_event_id');
		$this->dropColumn('et_ophcipatientadmission_npostatus_version','booking_event_id');

		$this->dropForeignKey('et_ophcipatientadmission_npostatus_eye_id_fk','et_ophcipatientadmission_npostatus');
		$this->dropColumn('et_ophcipatientadmission_npostatus','eye_id');
		$this->dropColumn('et_ophcipatientadmission_npostatus_version','eye_id');

		$this->dropTable('ophcipatientadmission_npostatus_procedure_assignment_version');
		$this->dropTable('ophcipatientadmission_npostatus_procedure_assignment');

		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :cn",array(":cn" => "OphCiPatientadmission"))->queryRow();

		$this->insert('element_type',array(
			'event_type_id' => $et['id'],
			'display_order' => 25,
			'name' => 'Site and procedure verification',
			'class_name' => 'Element_OphCiPatientadmission_Verification',
			'default' => 1,
			'required' => 1,
		));

		$this->createTable('et_ophcipatientadmission_verification', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'procedure_verified' => 'tinyint(1) unsigned not null',
				'site_verified' => 'tinyint(1) unsigned not null',
				'signed_and_witnessed' => 'tinyint(1) unsigned not null',
				'type_of_surgery' => 'tinyint(1) unsigned not null',
				'correct_site_confirmed' => 'tinyint(1) unsigned not null',
				'site_marked_by_x' => 'tinyint(1) unsigned not null',
				'site_marked_by_id' => 'int(10) unsigned null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcipatientadmission_verification_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcipatientadmission_verification_cui_fk` (`created_user_id`)',
				'KEY `et_ophcipatientadmission_verification_ev_fk` (`event_id`)',
				'KEY `et_ophcipatientadmission_verification_smbi_fk` (`site_marked_by_id`)',
				'CONSTRAINT `et_ophcipatientadmission_verification_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_verification_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_verification_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcipatientadmission_verification_smbi_fk` FOREIGN KEY (`site_marked_by_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('et_ophcipatientadmission_verification');

		foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophcipatientadmission_npostatus")->order("id asc")->queryAll() as $row) {
			$this->insert('et_ophcipatientadmission_verification',array(
				'id' => $row['id'],
				'event_id' => $row['event_id'],
				'procedure_verified' => $row['procedure_verified'],
				'site_verified' => $row['site_verified'],
				'signed_and_witnessed' => $row['signed_and_witnessed'],
				'type_of_surgery' => $row['type_of_surgery'],
				'correct_site_confirmed' => $row['correct_site_confirmed'],
				'site_marked_by_x' => $row['site_marked_by_x'],
				'site_marked_by_id' => $row['site_marked_by_id'],
				'last_modified_user_id' => $row['last_modified_user_id'],
				'last_modified_date' => $row['last_modified_date'],
				'created_user_id' => $row['created_user_id'],
				'created_date' => $row['created_date'],
			));

			foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophcipatientadmission_npostatus_version")->where("id = {$row['id']}")->order('version_id asc')->queryAll() as $v) {
				$this->insert('et_ophcipatientadmission_verification_version',array(
					'id' => $row['id'],
					'version_id' => $v['version_id'],
					'version_date' => $v['version_date'],
					'event_id' => $v['event_id'],
					'procedure_verified' => $v['procedure_verified'],
					'site_verified' => $v['site_verified'],
					'signed_and_witnessed' => $v['signed_and_witnessed'],
					'type_of_surgery' => $v['type_of_surgery'],
					'correct_site_confirmed' => $v['correct_site_confirmed'],
					'site_marked_by_x' => $v['site_marked_by_x'],
					'site_marked_by_id' => $v['site_marked_by_id'],
					'last_modified_user_id' => $v['last_modified_user_id'],
					'last_modified_date' => $v['last_modified_date'],
					'created_user_id' => $v['created_user_id'],
					'created_date' => $v['created_date'],
				));
			}
		}

		$this->dropColumn('et_ophcipatientadmission_npostatus','procedure_verified');
		$this->dropColumn('et_ophcipatientadmission_npostatus','site_verified');
		$this->dropColumn('et_ophcipatientadmission_npostatus','signed_and_witnessed');
		$this->dropColumn('et_ophcipatientadmission_npostatus','type_of_surgery');
		$this->dropForeignKey('et_ophcipatientadmission_npostatus_site_marked_by_id_fk','et_ophcipatientadmission_npostatus');
		$this->dropColumn('et_ophcipatientadmission_npostatus','site_marked_by_id');
		$this->dropColumn('et_ophcipatientadmission_npostatus','site_marked_by_x');
		$this->dropColumn('et_ophcipatientadmission_npostatus','correct_site_confirmed');

		$this->dropColumn('et_ophcipatientadmission_npostatus_version','procedure_verified');
		$this->dropColumn('et_ophcipatientadmission_npostatus_version','site_verified');
		$this->dropColumn('et_ophcipatientadmission_npostatus_version','signed_and_witnessed');
		$this->dropColumn('et_ophcipatientadmission_npostatus_version','type_of_surgery');
		$this->dropColumn('et_ophcipatientadmission_npostatus_version','site_marked_by_id');
		$this->dropColumn('et_ophcipatientadmission_npostatus_version','site_marked_by_x');
		$this->dropColumn('et_ophcipatientadmission_npostatus_version','correct_site_confirmed');
	}

	public function down()
	{
		$this->addColumn('et_ophcipatientadmission_npostatus_version','procedure_verified','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus_version','site_verified','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus_version','signed_and_witnessed','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus_version','type_of_surgery','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus_version','site_marked_by_id','int(10) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus_version','site_marked_by_x','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus_version','correct_site_confirmed','tinyint(1) unsigned not null');

		$this->addColumn('et_ophcipatientadmission_npostatus','procedure_verified','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus','site_verified','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus','signed_and_witnessed','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus','type_of_surgery','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus','site_marked_by_x','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus','site_marked_by_id','int(10) unsigned null');
		$this->addForeignKey('et_ophcipatientadmission_npostatus_site_marked_by_id_fk','et_ophcipatientadmission_npostatus','site_marked_by_id','user','id');
		$this->addColumn('et_ophcipatientadmission_npostatus','correct_site_confirmed','tinyint(1) unsigned not null');

		foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophcipatientadmission_verification")->order("id asc")->queryAll() as $row) {
			$this->update('et_ophcipatientadmission_npostatus',array(
					'procedure_verified' => $row['procedure_verified'],
					'site_verified' => $row['site_verified'],
					'signed_and_witnessed' => $row['signed_and_witnessed'],
					'type_of_surgery' => $row['type_of_surgery'],
					'site_marked_by_x' => $row['site_marked_by_x'],
					'site_marked_by_id' => $row['site_marked_by_id'],
					'correct_site_confirmed' => $row['correct_site_confirmed'],
				),"event_id = {$row['event_id']}");

			foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophcipatientadmission_verification_version")->where("id = {$row['id']}")->order('version_id asc')->queryAll() as $v) {
				$this->update('et_ophcipatientadmission_npostatus_version',array(
						'procedure_verified' => $v['procedure_verified'],
						'site_verified' => $v['site_verified'],
						'signed_and_witnessed' => $v['signed_and_witnessed'],
						'type_of_surgery' => $v['type_of_surgery'],
						'site_marked_by_x' => $v['site_marked_by_x'],
						'site_marked_by_id' => $v['site_marked_by_id'],
						'correct_site_confirmed' => $v['correct_site_confirmed'],
					),"event_id = {$row['event_id']} and version_id = {$v['version_id']}");
			}
		}

		$this->dropTable('et_ophcipatientadmission_verification_version');
		$this->dropTable('et_ophcipatientadmission_verification');

		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :cn",array(":cn" => "OphCiPatientadmission"))->queryRow();

		$this->delete('element_type',"event_type_id = {$et['id']} and class_name = 'Element_OphCiPatientadmission_Verification'");

		$this->execute("CREATE TABLE `ophcipatientadmission_npostatus_procedure_assignment` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`element_id` int(10) unsigned NOT NULL,
	`procedure_id` int(10) unsigned NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `ophcipatientadmission_npostatus_procedure_assignment_lmui_fk` (`last_modified_user_id`),
	KEY `ophcipatientadmission_npostatus_procedure_assignment_cui_fk` (`created_user_id`),
	KEY `ophcipatientadmission_npostatus_procedure_assignment_ele_fk` (`element_id`),
	KEY `ophcipatientadmission_npostatus_procedure_assignment_proc_fk` (`procedure_id`),
	CONSTRAINT `ophcipatientadmission_npostatus_procedure_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophcipatientadmission_npostatus_procedure_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophcipatientadmission_npostatus_procedure_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcipatientadmission_npostatus` (`id`),
	CONSTRAINT `ophcipatientadmission_npostatus_procedure_assignment_proc_fk` FOREIGN KEY (`procedure_id`) REFERENCES `proc` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->versionExistingTable('ophcipatientadmission_npostatus_procedure_assignment');

		$this->addColumn('et_ophcipatientadmission_npostatus','eye_id','int(10) unsigned not null');
		$this->addColumn('et_ophcipatientadmission_npostatus_version','eye_id','int(10) unsigned not null');
		$this->addForeignKey('et_ophcipatientadmission_npostatus_eye_id_fk','et_ophcipatientadmission_npostatus','eye_id','eye','id');

		$this->addColumn('et_ophcipatientadmission_npostatus','booking_event_id','int(10) unsigned null');
		$this->addColumn('et_ophcipatientadmission_npostatus_version','booking_event_id','int(10) unsigned null');
		$this->addForeignKey('et_ophcipatientadmission_npostatus_booking_event_id_fk','et_ophcipatientadmission_npostatus','booking_event_id','event','id');
	}
}
