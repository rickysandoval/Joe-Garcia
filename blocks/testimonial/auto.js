ccmValidateBlockForm = function() {
	
	if ($('#field_1_textarea_text').val() == '') {
		ccm_addError('Missing required text: Quote');
	}

	if ($('#field_2_textbox_text').val() == '') {
		ccm_addError('Missing required text: Author');
	}


	return false;
}
