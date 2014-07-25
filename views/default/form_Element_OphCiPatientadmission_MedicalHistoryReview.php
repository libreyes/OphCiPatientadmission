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
		<div class="row field-row">
			<div class="large-3 column">
				<label>Medication history:</label>
			</div>
			<div class="large-9 column end">
				<table>
					<tr>
						<th>Medication</th>
						<th>Route</th>
						<th>Option</th>
						<th>Frequency</th>
						<th>Start date</th>
					</tr>
					<?php if ($medication_history = $this->getMedicationHistory()) {?>
						<?php foreach ($medication_history as $medication) {?>
							<tr>
								<td><?php echo $medication->drug->name?></td>
								<td><?php echo $medication->route->name?></td>
								<td><?php echo $medication->option ? $medication->option->name : '-'?></td>
								<td><?php echo $medication->frequency->name?></td>
								<td><?php echo $medication->NHSDate('start_date')?></td>
							</tr>
						<?php }?>
					<?php }else{?>
						<tr>
							<td colspan="5">
								No medication history has been recorded for this patient.
							</td>
						</tr>
					<?php }?>
				</table>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<label>Allergies history:</label>
			</div>
			<div class="large-9 column end">
				<?php if ($allergies = $this->getAllergiesHistory()) {?>
					<?php foreach ($allergies as $allergy) {?>
						<?php echo $allergy->allergy->name?><br/>
					<?php }?>
				<?php }else{?>
					<tr>
						<td colspan="5">
							No allergies have been recorded for this patient.
						</td>
					</tr>
				<?php }?>
			</div>
		</div>
		<?php echo $form->radioBoolean($element, 'history_reviewed', array(), array('label' => 3, 'field' => 4))?>
	</div>
