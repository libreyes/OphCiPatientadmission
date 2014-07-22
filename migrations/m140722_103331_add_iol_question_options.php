<?php

/*
We do the following:
* Create 2 new tables for the options for the 2 iol questions
* Create FK entries to the new tables in the et_ophcipatientadmission_patientdetails table
*  * iol_measurements_verified_id
*  * iol_selected_id
* Create models from the tables using gii
*/

class m140722_103331_add_iol_question_options extends OEMigration
{
	public function up()
	{
		$this->createIolMeasurementsVerifiedLookup();
		$this->createIolSelectedLookup();
	}

	public function down()
	{
		$this->destroyIolMeasurementsVerifiedLookup();
		$this->destroyIolSelectedLookup();
	}

	private function createIolMeasurementsVerifiedLookup()
	{

		/*
		NOTE: foreign key identifier names have been intentionally shortened to be less than 64 chars (which is the mysql limit)
		 */

		$this->createTable('ophcipatientadmission_npostatus_iol_measurements_verified', array(
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
			'CONSTRAINT `ophcipatientadmission_npostatus_iol_measurements_ver_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcipatientadmission_npostatus_iol_measurements_verified',array('name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_npostatus_iol_measurements_verified',array('name'=>'No','display_order'=>2));
		$this->insert('ophcipatientadmission_npostatus_iol_measurements_verified',array('name'=>'N/A','display_order'=>3));

		$this->alterColumn('et_ophcipatientadmission_npostatus', 'iol_measurements_verified', 'int(10) unsigned DEFAULT NULL');
		$this->renameColumn('et_ophcipatientadmission_npostatus', 'iol_measurements_verified', 'iol_measurements_verified_id');

		$this->addForeignKey(
			'et_ophcipatientadmission_npostatus_iol_measurements_ver_fk',
			'et_ophcipatientadmission_npostatus',
			'iol_measurements_verified_id',
			'ophcipatientadmission_npostatus_iol_measurements_verified',
			'id'
		);
	}

	private function createIolSelectedLookup()
	{
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
			'CONSTRAINT `ophcipatientadmission_npostatus_iol_selected_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcipatientadmission_npostatus_iol_selected',array('name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_npostatus_iol_selected',array('name'=>'No','display_order'=>2));
		$this->insert('ophcipatientadmission_npostatus_iol_selected',array('name'=>'N/A','display_order'=>3));

		$this->alterColumn('et_ophcipatientadmission_npostatus', 'iol_selected', 'int(10) unsigned DEFAULT NULL');
		$this->renameColumn('et_ophcipatientadmission_npostatus', 'iol_selected', 'iol_selected_id');

		$this->addForeignKey(
			'et_ophcipatientadmission_npostatus_iol_selected_fk',
			'et_ophcipatientadmission_npostatus',
			'iol_selected_id',
			'ophcipatientadmission_npostatus_iol_selected',
			'id'
		);
	}

	private function destroyIolMeasurementsVerifiedLookup()
	{
		$this->dropForeignKey('et_ophcipatientadmission_npostatus_iol_measurements_ver_fk', 'et_ophcipatientadmission_npostatus');
		$this->renameColumn('et_ophcipatientadmission_npostatus', 'iol_measurements_verified_id', 'iol_measurements_verified');
		$this->alterColumn('et_ophcipatientadmission_npostatus', 'iol_measurements_verified', 'tinyint(1) unsigned NOT NULL');
		$this->dropTable('ophcipatientadmission_npostatus_iol_measurements_verified');
	}

	private function destroyIolSelectedLookup()
	{
		$this->dropForeignKey('et_ophcipatientadmission_npostatus_iol_selected_fk', 'et_ophcipatientadmission_npostatus');
		$this->renameColumn('et_ophcipatientadmission_npostatus', 'iol_selected_id', 'iol_selected');
		$this->alterColumn('et_ophcipatientadmission_npostatus', 'iol_selected', 'tinyint(1) unsigned NOT NULL');
		$this->dropTable('ophcipatientadmission_npostatus_iol_selected');
	}
}