
/* Module-specific javascript can be placed here */

$(document).ready(function() {
	handleButton($('#et_save'),function() {
	});
	
	handleButton($('#et_cancel'),function(e) {
		if (m = window.location.href.match(/\/update\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/update/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
		}
		e.preventDefault();
	});

	handleButton($('#et_deleteevent'));

	handleButton($('#et_canceldelete'));

	handleButton($('#et_print'),function(e) {
		printIFrameUrl(OE_print_url, null);
		enableButtons();
		e.preventDefault();
	});

	$('select.populate_textarea').unbind('change').change(function() {
		if ($(this).val() != '') {
			var cLass = $(this).parent().parent().parent().attr('class').match(/Element.*/);
			var el = $('#'+cLass+'_'+$(this).attr('id'));
			var currentText = el.text();
			var newText = $(this).children('option:selected').text();

			if (currentText.length == 0) {
				el.text(ucfirst(newText));
			} else {
				el.text(currentText+', '+newText);
			}
		}
	});

	$('#Element_OphCiPatientadmission_PatientDetails_translator_present_id_1').click(function(e) {
		$('#div_Element_OphCiPatientadmission_PatientDetails_name_of_translator').show();
		$('#Element_OphCiPatientadmission_PatientDetails_name_of_translator').select().focus();
	});

	$('#Element_OphCiPatientadmission_PatientDetails_translator_present_id_2').click(function(e) {
		$('#div_Element_OphCiPatientadmission_PatientDetails_name_of_translator').hide();
	});

	$('#Element_OphCiPatientadmission_PatientDetails_translator_present_id_3').click(function(e) {
		$('#div_Element_OphCiPatientadmission_PatientDetails_name_of_translator').hide();
	});

	$('#Element_OphCiPatientadmission_PatientDetails_caregiver_present_id_1').click(function(e) {
		$('#div_Element_OphCiPatientadmission_PatientDetails_caregiver_name').show();
		$('#div_Element_OphCiPatientadmission_PatientDetails_caregiver_relationship_id').show();
		$('#Element_OphCiPatientadmission_PatientDetails_caregiver_name').select().focus();
	});

	$('#Element_OphCiPatientadmission_PatientDetails_caregiver_present_id_2').click(function(e) {
		$('#div_Element_OphCiPatientadmission_PatientDetails_caregiver_name').hide();
		$('#div_Element_OphCiPatientadmission_PatientDetails_caregiver_relationship_id').hide();
	});

	$('#Element_OphCiPatientadmission_PatientDetails_caregiver_present_id_3').click(function(e) {
		$('#div_Element_OphCiPatientadmission_PatientDetails_caregiver_name').hide();
		$('#div_Element_OphCiPatientadmission_PatientDetails_caregiver_relationship_id').hide();
	});
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}
