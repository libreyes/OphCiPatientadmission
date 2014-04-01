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

<section class="element">
	<header class="element-header">
		<h3 class="element-title"><?php echo $element->elementType->name?></h3>
	</header>
	<div class="element-data">
				<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('time_last_ate'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo CHtml::encode($element->NHSDate('time_last_ate'))?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('time_last_drank'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo CHtml::encode($element->NHSDate('time_last_drank'))?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('procedure_verified'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->procedure_verified ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('procedure_id'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->procedure ? $element->procedure->term : 'None'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('site_verified'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->site_verified ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('site_id'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->site ? $element->site->name : 'None'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('signed_and_witnessed'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->signed_and_witnessed ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('type_of_surgery'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->type_of_surgery ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('site_marked_by_x'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->site_marked_by_x ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('site_marked_by_id'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->site_marked_by ? $element->site_marked_by->username : 'None'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('iol_measurements_verified'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->iol_measurements_verified ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('iol_selected'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->iol_selected ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('comments'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo CHtml::encode($element->comments)?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('signature_timestamp'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo CHtml::encode($element->NHSDate('signature_timestamp'))?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('signature_user_id'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->signature_user ? $element->signature_user->username : 'None'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('signature_role_id'))?></div></div>
			<div class="large-10 column end"><div class="data-value"><?php echo $element->signature_role ? $element->signature_role->username : 'None'?></div></div>
		</div>
	</div>
</section>
