<?php

class m140507_141113_remove_fields extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('et_ophcipatientadmission_npostatus_signature_user_id_fk','et_ophcipatientadmission_npostatus');
		$this->dropIndex('et_ophcipatientadmission_npostatus_signature_user_id_fk','et_ophcipatientadmission_npostatus');
		$this->dropColumn('et_ophcipatientadmission_npostatus','signature_user_id');

		$this->dropForeignKey('et_ophcipatientadmission_npostatus_signature_role_id_fk','et_ophcipatientadmission_npostatus');
		$this->dropIndex('et_ophcipatientadmission_npostatus_signature_role_id_fk','et_ophcipatientadmission_npostatus');
		$this->dropColumn('et_ophcipatientadmission_npostatus','signature_role_id');

		$this->dropColumn('et_ophcipatientadmission_npostatus','signature_timestamp');
	}

	public function down()
	{
		$this->addColumn('et_ophcipatientadmission_npostatus','signature_timestamp','date default null');

		$this->addColumn('et_ophcipatientadmission_npostatus','signature_user_id','int(10) unsigned null');
		$this->createIndex('et_ophcipatientadmission_npostatus_signature_user_id_fk','et_ophcipatientadmission_npostatus','signature_user_id');
		$this->addForeignKey('et_ophcipatientadmission_npostatus_signature_user_id_fk','et_ophcipatientadmission_npostatus','signature_user_id','user','id');

		$this->addColumn('et_ophcipatientadmission_npostatus','signature_role_id','int(10) unsigned null');
		$this->createIndex('et_ophcipatientadmission_npostatus_signature_role_id_fk','et_ophcipatientadmission_npostatus','signature_role_id');
		$this->addForeignKey('et_ophcipatientadmission_npostatus_signature_role_id_fk','et_ophcipatientadmission_npostatus','signature_role_id','user','id');
	}
}
