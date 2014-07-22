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

<h4 class="elementTypeName"><?php echo $element->elementType->name?></h4>
<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('time_last_ate'))?></td>
			<td><span class="big"><?php echo CHtml::encode($element->NHSDate('time_last_ate'))?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('time_last_drank'))?></td>
			<td><span class="big"><?php echo CHtml::encode($element->NHSDate('time_last_drank'))?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('procedure_verified'))?></td>
			<td><span class="big"><?php echo $element->procedure_verified ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('procedure_id'))?></td>
			<td><span class="big"><?php echo $element->procedure ? $element->procedure->term : 'None'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('site_verified'))?></td>
			<td><span class="big"><?php echo $element->site_verified ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('site_id'))?></td>
			<td><span class="big"><?php echo $element->site ? $element->site->name : 'None'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('signed_and_witnessed'))?></td>
			<td><span class="big"><?php echo $element->signed_and_witnessed ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('type_of_surgery'))?></td>
			<td><span class="big"><?php echo $element->type_of_surgery ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('site_marked_by_x'))?></td>
			<td><span class="big"><?php echo $element->site_marked_by_x ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('site_marked_by_id'))?></td>
			<td><span class="big"><?php echo $element->site_marked_by ? $element->site_marked_by->username : 'None'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('iol_measurements_verified_id'))?></td>
			<td><span class="big"><?php echo $element->iol_measurements_verified ? $element->iol_measurements_verified->name : 'Not specified'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('iol_selected_id'))?></td>
			<td><span class="big"><?php echo $element->iol_selected ? $element->iol_selected->name : 'Not specified'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('comments'))?></td>
			<td><span class="big"><?php echo CHtml::encode($element->comments)?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('signature_timestamp'))?></td>
			<td><span class="big"><?php echo CHtml::encode($element->NHSDate('signature_timestamp'))?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('signature_user_id'))?></td>
			<td><span class="big"><?php echo $element->signature_user ? $element->signature_user->username : 'None'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('signature_role_id'))?></td>
			<td><span class="big"><?php echo $element->signature_role ? $element->signature_role->username : 'None'?></span></td>
		</tr>
	</tbody>
</table>

