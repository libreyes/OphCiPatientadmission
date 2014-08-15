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
		<?php $form->widget('application.widgets.Records', array(
			'form' => $form,
			'element' => $element,
			'model' => new OphCiPatientadmission_Vital,
			'field' => 'vitals',
			'validate_method' => '/OphCiPatientadmission/default/validateVital',
			'row_view' => 'protected/modules/OphCiPatientadmission/views/default/_vital_row.php',
			'columns' => array(
				array(
					'width' => 5,
					'field_width' => 6,
					'fields' => array(
						array('field' => 'pulse_m','type' => 'pulse'),
						array('field' => 'blood_pressure_m','type' => 'blood_pressure'),
						array('field' => 'rr_m','type' => 'rr'),
						array('field' => 'spo2_m','type' => 'spo2'),
					),
				),
			),
			'no_items_text' => 'No vitals have been recorded.',
			'add_button_text' => 'Add vital',
			'use_last_button_text' => 'Input last recorded vital signs',
		))?>
		<div id="div_Element_OphCiPatientadmission_Vitals_blood_glucose_m" class="row field-row">
			<div class="large-3 column">
				<label for="Element_OphCiPatientadmission_Vitals_blood_glucose_m">
					<?php echo $element->getAttributeLabel('blood_glucose_m')?>:
				</label>
			</div>
			<div class="large-1 column">
				<input type="hidden" name="<?php echo CHtml::modelName($element)?>[blood_glucose_m]" value="" />
				<?php echo $form->bloodGlucoseMeasurement($element,array('nowrapper' => true, 'disabled' => $element->blood_glucose_na), array('label' => 3, 'field' => 1))?>
			</div>
			<div class="large-2 column end">
				<?php echo $form->checkBox($element, 'blood_glucose_na', array('nowrapper' => true))?>
			</div>
		</div>
	</div>
