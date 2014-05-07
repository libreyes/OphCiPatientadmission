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

<section class="element <?php echo $element->elementType->class_name?>"
	data-element-type-id="<?php echo $element->elementType->id?>"
	data-element-type-class="<?php echo $element->elementType->class_name?>"
	data-element-type-name="<?php echo $element->elementType->name?>"
	data-element-display-order="<?php echo $element->elementType->display_order?>">
	<header class="element-header">
		<h3 class="element-title"><?php echo $element->elementType->name; ?></h3>
	</header>
	<div class="element-fields">
		<input type="hidden" name="Element_OphCiPatientadmission_NpoStatus[booking_event_id]" value="<?php echo $element->id ? $element->booking_event_id : @$_GET['booking_event_id']?>" />
		<div class="row field-row">
			<div class="large-3 column">
				<label for="Element_OphCiPatientadmission_NpoStatus_time_last_ate_0">
					<?php echo $element->getAttributeLabel('time_last_ate')?>:
				</label>
			</div>
			<div class="large-4 column end">
				<?php echo $form->datePicker($element, 'time_last_ate', array('maxDate' => 'today'), array('style'=>'width: 110px; display: inline-block;','nowrapper' => true,'null' => true))?>
				<?php echo $form->textField($element, 'time_last_ate_time', array('nowrapper' => true, 'style' => 'width: 50px; display: inline-block;'))?>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<label for="Element_OphCiPatientadmission_NpoStatus_time_last_drank_0">
					<?php echo $element->getAttributeLabel('time_last_drank')?>:
				</label>
			</div>
			<div class="large-4 column end">
				<?php echo $form->datePicker($element, 'time_last_drank', array('maxDate' => 'today'), array('style'=>'width: 110px; display: inline-block;','nowrapper' => true,'null' => true))?>
				<?php echo $form->textField($element, 'time_last_drank_time', array('nowrapper' => true, 'style' => 'width: 50px; display: inline-block;'))?>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column"><label></label></div>
			<div class="large-3 column end">
				<?php echo $form->checkBox($element, 'procedure_verified', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
			</div>
		</div>
		<div id="div_Element_OphCiPatientadmission_NpoStatus_procedure_id" class="row field-row">
			<div class="large-3 column">
				<label for="Element_OphCiPatientadmission_NpoStatus_procedure_id">
					<?php echo $element->getAttributeLabel('procedure_id')?>:
				</label>
			</div>
			<div class="large-3 column end">
				<?php foreach ($element->procedures as $procedure) {?>
					<div><?php echo $procedure->term?></div>
					<input type="hidden" name="<?php echo get_class($element)?>[procedure_id][]" value="<?php echo $procedure->id?>" />
				<?php }?>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column"><label></label></div>
			<div class="large-3 column end">
				<?php echo $form->checkBox($element, 'site_verified', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
			</div>
		</div>
		<div id="div_Element_OphCiPatientadmission_NpoStatus_eye_id" class="row field-row">
			<div class="large-3 column">
				<label for="Element_OphCiPatientadmission_NpoStatus_eye_id">
					<?php echo $element->getAttributeLabel('eye_id')?>:
				</label>
			</div>
			<div class="large-3 column end">
				<?php echo $element->eye->name?>
				<input type="hidden" name="Element_OphCiPatientadmission_NpoStatus[eye_id]" value="<?php echo $element->eye_id?>" />
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<label>Consent:</label>
			</div>
			<div class="large-9 column">
				<?php echo $form->checkBox($element, 'signed_and_witnessed', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
				<?php echo $form->checkBox($element, 'type_of_surgery', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
				<?php echo $form->checkBox($element, 'correct_site_confirmed', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column"><label></label></div>
			<div class="large-9 column end">
				<?php echo $form->checkBox($element, 'site_marked_by_x', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
			</div>
		</div>
		<?php echo $form->dropDownList($element, 'site_marked_by_id', CHtml::listData(User::model()->findAll(array('order'=> 'first_name asc, last_name asc')),'id','fullName'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 3))?>
		<div class="row field-row">
			<div class="large-3 column"><label></label></div>
			<div class="large-3 column end">
				<?php echo $form->checkBox($element, 'iol_measurements_verified', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column"><label></label></div>
			<div class="large-3 column end">
				<?php echo $form->checkBox($element, 'iol_selected', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
			</div>
		</div>
		<?php echo $form->textArea($element, 'comments', array('rows' => 6, 'cols' => 80), false, array(), array('label' => 3, 'field' => 4))?>
		<?php echo $form->datePicker($element, 'signature_timestamp', array('maxDate' => 'today'), array('style'=>'width: 110px;','null' => true), array('label' => 3, 'field' => 2))?>
		<?php echo $form->dropDownList($element, 'signature_user_id', CHtml::listData(User::model()->findAll(array('order'=> 'first_name asc, last_name asc')),'id','fullName'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 3))?>
		<?php echo $form->dropDownList($element, 'signature_role_id', CHtml::listData(User::model()->findAll(array('order'=> 'first_name asc, last_name asc')),'id','fullName'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 3))?>
	</div>
</section>
