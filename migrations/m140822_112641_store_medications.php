<?php

class m140822_112641_store_medications extends OEMigration
{
	public function up()
	{
		$this->createTable('ophcipatientadmission_mh_review_medication', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned not null',
				'drug_id' => 'int(10) unsigned not null',
				'route_id' => 'int(10) unsigned not null',
				'option_id' => 'int(10) unsigned null',
				'frequency_id' => 'int(10) unsigned not null',
				'start_date' => 'date not null',
				'end_date' => 'date null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophcipatientadmission_mh_review_medication_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophcipatientadmission_mh_review_medication_cui_fk` (`created_user_id`)',
				'KEY `ophcipatientadmission_mh_review_medication_ele_fk` (`element_id`)',
				'KEY `ophcipatientadmission_mh_review_medication_dru_fk` (`drug_id`)',
				'KEY `ophcipatientadmission_mh_review_medication_rou_fk` (`route_id`)',
				'KEY `ophcipatientadmission_mh_review_medication_opt_fk` (`option_id`)',
				'KEY `ophcipatientadmission_mh_review_medication_fre_fk` (`frequency_id`)',
				'CONSTRAINT `ophcipatientadmission_mh_review_medication_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientadmission_mh_review_medication_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophcipatientadmission_mh_review_medication_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophcipatientadmission_mh_review` (`id`)',
				'CONSTRAINT `ophcipatientadmission_mh_review_medication_dru_fk` FOREIGN KEY (`drug_id`) REFERENCES `drug` (`id`)',
				'CONSTRAINT `ophcipatientadmission_mh_review_medication_rou_fk` FOREIGN KEY (`route_id`) REFERENCES `drug_route` (`id`)',
				'CONSTRAINT `ophcipatientadmission_mh_review_medication_opt_fk` FOREIGN KEY (`option_id`) REFERENCES `drug_route_option` (`id`)',
				'CONSTRAINT `ophcipatientadmission_mh_review_medication_fre_fk` FOREIGN KEY (`frequency_id`) REFERENCES `drug_frequency` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophcipatientadmission_mh_review_medication');
	}

	public function down()
	{
		$this->dropTable('ophcipatientadmission_mh_review_medication_version');
		$this->dropTable('ophcipatientadmission_mh_review_medication');
	}
}
