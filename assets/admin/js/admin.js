function starter() {
	var el = jQuery("div[id*='_starter_widget_'] .acf-field");

	var num = 0;
	var body = jQuery('body');
	num = el.length;
	console.log(num);
	if (num > 0) {
		var remove = el.closest('.widget-content').children('.starter-no-acf');
		console.log(remove);
		remove.attr('data-display', 'none');
		remove.hide();
	}
}
function starter_remove_fields() {
	jQuery('.widget .acf-field').remove();
}
jQuery(document).ready(starter);


