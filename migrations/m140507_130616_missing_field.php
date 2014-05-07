<?php

class m140507_130616_missing_field extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophcipatientadmission_npostatus','correct_site_confirmed','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophcipatientadmission_npostatus','correct_site_confirmed');
	}
}
