function pilleSetupLabel() {
	if (jQuery('.check-row input').length) {
		jQuery('.check-row').each(function(){
			jQuery(this).addClass('check-off');
			jQuery(this).removeClass('check-on');
		});
		jQuery('.check-row input:checked').each(function(){
			jQuery(this).parent('div').addClass('check-on');
			jQuery(this).parent('div').removeClass('check-off');
		});
	};
	if (jQuery('.radio-row input').length) {
		jQuery('.radio-row').each(function(){ 
			jQuery(this).addClass('radio-off');
			jQuery(this).removeClass('radio-on');
		});
		jQuery('.radio-row input:checked').each(function(){ 
			jQuery(this).parent('div').addClass('radio-on');
			jQuery(this).parent('div').removeClass('radio-off');
		});
	};
};

jQuery(document).ready(function() {
	jQuery('.check-row label, .radio-row label').click(function() {
		pilleSetupLabel();
	});
	pilleSetupLabel(); 
});
