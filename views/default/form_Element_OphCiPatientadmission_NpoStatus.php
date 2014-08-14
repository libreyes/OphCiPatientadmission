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
				<label for="Element_OphCiPatientadmission_NpoStatus_time_last_ate_0">
					<?php echo $element->getAttributeLabel('time_last_ate')?>:
				</label>
			</div>
			<div class="large-4 column end">
				<?php echo $form->datePicker($element, 'time_last_ate', array('maxDate' => 'today'), array('style'=>'width: 110px; display: inline-block;','nowrapper' => true,'null' => true))?>
				<?php echo $form->timePicker($element, 'time_last_ate_time', array('showTimeNowButton' => false), array('nowrapper' => true))?>
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
				<?php echo $form->timePicker($element, 'time_last_drank_time', array('showTimeNowButton' => false), array('nowrapper' => true))?>
			</div>
		</div>
	</div>
