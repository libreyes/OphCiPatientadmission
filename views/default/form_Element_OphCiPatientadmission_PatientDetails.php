<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>
	<div class="element-fields">
		<?php echo $form->radioButtons($element, 'translator_present_id', CHtml::listData(OphCiPatientadmission_PatientDetails_TranslatorPresent::model()->findAll(array('order'=>'display_order asc')),'id','name'), null, false, false, false, false, array('class' => 'linked-fields', 'data-linked-fields' => 'name_of_translator', 'data-linked-values' => 'Yes'), array('label' => 3, 'field' => 3))?>
		<?php echo $form->textField($element, 'name_of_translator', array('maxlength' => '255', 'hide' => $element->translator_present_id != 1), array(), array('label' => 3, 'field' => 3))?>
		<div class="row field-row">
			<div class="large-3 column"><label></label></div>
			<div class="large-4 column end">
				<?php echo $form->checkBox($element, 'patient_id_verified', array('nowrapper' => true, 'class' => 'linked-fields', 'data-linked-fields' => 'identifiers', 'data-linked-values' => '1'), array('label' => 3, 'field' => 3))?>
			</div>
		</div>
		<?php echo $form->multiSelectList($element, 'identifiers', 'identifiers', 'identifier_id', CHtml::listData(OphCiPatientadmission_PatientDetails_Identifier::model()->findAll(array('order'=>'display_order asc')),'id','name'), array(), array('empty' => '- Please select -', 'label' => 'Two identifiers'), !$element->patient_id_verified, false, null, false, false, array('label' => 3, 'field' => 4))?>
		<div class="row field-row">
			<div class="large-3 column"><label></label></div>
			<div class="large-3 column end">
				<?php echo $form->checkBox($element, 'allergies_verified', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column"><label></label></div>
			<div class="large-3 column end">
				<?php echo $form->checkBox($element, 'medication_history_verified', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
			</div>
		</div>
		<?php echo $form->radioButtons($element, 'caregiver_present_id', CHtml::listData(OphCiPatientadmission_PatientDetails_CaregiverPresent::model()->findAll(array('order'=>'display_order asc')),'id','name'), null, false, false, false, false, array('class' => 'linked-fields', 'data-linked-fields' => 'caregiver_name,caregiver_relationship_id', 'data-linked-values' => 'Yes'), array('label' => 3, 'field' => 3))?>
		<?php echo $form->textField($element, 'caregiver_name', array('maxlength' => '255', 'hide' => $element->caregiver_present_id != 1), array(), array('label' => 3, 'field' => 3))?>
		<?php echo $form->dropDownList($element, 'caregiver_relationship_id', CHtml::listData(OphCiPatientadmission_PatientDetails_CaregiverRelationship::model()->findAll(array('order'=> 'display_order asc')),'id','name'),array('empty'=>'- Please select -'),$element->caregiver_present_id != 1,array('label' => 3, 'field' => 3))?>
	</div>
