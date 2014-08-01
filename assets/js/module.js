
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

	$('.Element_OphCiPatientadmission_NpoStatus').on('change', [
		'#Element_OphCiPatientadmission_NpoStatus_time_last_ate_0',
		'#Element_OphCiPatientadmission_NpoStatus_time_last_drank_0',
	].join(','), function(e) {
		if(typeof e.target.id != 'undefined' && $('#'+e.target.id).val().trim() == ''){
			switch(e.target.id) {
				case 'Element_OphCiPatientadmission_NpoStatus_time_last_ate_0':
					$('#Element_OphCiPatientadmission_NpoStatus_time_last_ate_time').val('');
					break;
				case 'Element_OphCiPatientadmission_NpoStatus_time_last_drank_0':
					$('#Element_OphCiPatientadmission_NpoStatus_time_last_drank_time').val('');
					break;
				default:
					return;
			}
		}
		console.log('in costante escalation' + e.target.id);
	});
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}
