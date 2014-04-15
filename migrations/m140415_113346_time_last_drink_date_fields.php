<?php

class m140415_113346_time_last_drink_date_fields extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophcipatientadmission_npostatus','time_last_ate','datetime not null');
		$this->alterColumn('et_ophcipatientadmission_npostatus','time_last_drank','datetime not null');
	}

	public function down()
	{
		$this->alterColumn('et_ophcipatientadmission_npostatus','time_last_ate','date not null');
		$this->alterColumn('et_ophcipatientadmission_npostatus','time_last_drank','date not null');
	}
}
