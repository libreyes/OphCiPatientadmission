<?php
/**
 * This migration adds lookup tables for "iol_measurements_verified" and "iol_selected" columns.
 * These fields were previously of type "tinyint(1) unsigned NOT NULL", thus their
 * values will either be 0 (default) or 1.
 *
 * We'll change the values to point to id's in the lookup table as follows:
 * 0 => 2 (No)
 * 1 => 1 (Yes)
 */
class m140722_103331_add_iol_question_options extends OEMigration
{
	public function up()
	{
		$this->createIolMeasurementsVerifiedLookup();
		$this->createIolSelectedLookup();
		$this->refreshTableSchema('et_ophcipatientadmission_npostatus');
	}

	public function down()
	{
		$this->destroyIolMeasurementsVerifiedLookup();
		$this->destroyIolSelectedLookup();
		$this->refreshTableSchema('et_ophcipatientadmission_npostatus');
	}

	private function createIolMeasurementsVerifiedLookup()
	{

		/*
		NOTE: foreign key identifier and table names have been intentionally shortened to be less than 64 chars (which is the mysql limit)
		 */

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
			'CONSTRAINT `ophcipatientadmission_npostatus_iol_measurements_ver_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophcipatientadmission_npostatus_iol_measurements_ver',array('name'=>'Yes','display_order'=>1));
		$this->insert('ophcipatientadmission_npostatus_iol_measurements_ver',array('name'=>'No','display_order'=>2));
		$this->insert('ophcipatientadmission_npostatus_iol_measurements_ver',array('name'=>'N/A','display_order'=>3));

		$this->alterColumn('et_ophcipatientadmission_npostatus', 'iol_measurements_verified', 'int(10) unsigned DEFAULT NULL');
		$this->renameColumn('et_ophcipatientadmission_npostatus', 'iol_measurements_verified', 'iol_measurements_verified_id');

		$this->update('et_ophcipatientadmission_npostatus',array('iol_measurements_verified_id' => 2),'iol_measurements_verified_id=0');

		$this->addForeignKey(
			'et_ophcipatientadmission_npostatus_iol_measurements_ver_fk',
			'et_ophcipatientadmission_npostatus',
			'iol_measurements_verified_id',
			'ophcipatientadmission_npostatus_iol_measurements_ver',
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

		$this->update('et_ophcipatientadmission_npostatus',array('iol_selected_id'=>2),'iol_selected_id=0');

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
		$this->update('et_ophcipatientadmission_npostatus',array('iol_measurements_verified_id' => 0),'iol_measurements_verified_id=1');
		$this->dropForeignKey('et_ophcipatientadmission_npostatus_iol_measurements_ver_fk', 'et_ophcipatientadmission_npostatus');
		$this->renameColumn('et_ophcipatientadmission_npostatus', 'iol_measurements_verified_id', 'iol_measurements_verified');
		$this->alterColumn('et_ophcipatientadmission_npostatus', 'iol_measurements_verified', 'tinyint(1) unsigned NOT NULL');
		$this->dropTable('ophcipatientadmission_npostatus_iol_measurements_ver');
	}

	private function destroyIolSelectedLookup()
	{
		$this->update('et_ophcipatientadmission_npostatus',array('iol_selected_id'=>0),'iol_selected_id=1');
		$this->dropForeignKey('et_ophcipatientadmission_npostatus_iol_selected_fk', 'et_ophcipatientadmission_npostatus');
		$this->renameColumn('et_ophcipatientadmission_npostatus', 'iol_selected_id', 'iol_selected');
		$this->alterColumn('et_ophcipatientadmission_npostatus', 'iol_selected', 'tinyint(1) unsigned NOT NULL');
		$this->dropTable('ophcipatientadmission_npostatus_iol_selected');
	}
}