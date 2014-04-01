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
	<?php echo $form->datePicker($element, 'time_last_ate', array('maxDate' => 'today'), array('style'=>'width: 110px;'), array('label' => 3, 'field' => 2))?>
	<?php echo $form->datePicker($element, 'time_last_drank', array('maxDate' => 'today'), array('style'=>'width: 110px;'), array('label' => 3, 'field' => 2))?>
	<div class="row field-row">
		<div class="large-3 column"><label></label></div>
		<div class="large-3 column end">
			<?php echo $form->checkBox($element, 'procedure_verified', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
		</div>
	</div>
	<?php echo $form->dropDownList($element, 'procedure_id', CHtml::listData(Procedure::model()->findAll(array('order'=> 'term asc')),'id','term'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 3))?>
	<div class="row field-row">
		<div class="large-3 column"><label></label></div>
		<div class="large-3 column end">
			<?php echo $form->checkBox($element, 'site_verified', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
		</div>
	</div>
	<?php echo $form->dropDownList($element, 'site_id', CHtml::listData(Site::model()->findAll(array('order'=> 'name asc')),'id','name'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 3))?>
	<div class="row field-row">
		<div class="large-3 column"><label></label></div>
		<div class="large-3 column end">
			<?php echo $form->checkBox($element, 'signed_and_witnessed', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column"><label></label></div>
		<div class="large-3 column end">
			<?php echo $form->checkBox($element, 'type_of_surgery', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column"><label></label></div>
		<div class="large-3 column end">
			<?php echo $form->checkBox($element, 'site_marked_by_x', array('nowrapper' => true), array('label' => 3, 'field' => 3))?>
		</div>
	</div>
	<?php echo $form->dropDownList($element, 'site_marked_by_id', CHtml::listData(User::model()->findAll(array('order'=> 'username asc')),'id','username'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 3))?>
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
	<?php echo $form->datePicker($element, 'signature_timestamp', array('maxDate' => 'today'), array('style'=>'width: 110px;'), array('label' => 3, 'field' => 2))?>
	<?php echo $form->dropDownList($element, 'signature_user_id', CHtml::listData(User::model()->findAll(array('order'=> 'username asc')),'id','username'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 3))?>
	<?php echo $form->dropDownList($element, 'signature_role_id', CHtml::listData(User::model()->findAll(array('order'=> 'username asc')),'id','username'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 3))?>
	</div>
</section>
