function checkSearch() {

	if(document.frmSrch.s.value == "") {
		return false;
	}

	return true;
}

function checkUrl(url) {

	if(url!=''){
		window.open(url, '_blank'); 
	}
}

$(function() {

  "use strict";

	/*Preloader*/
	$(window).load(function() {
		setTimeout(function() {
			$('body').addClass('loaded');      
		}, 300);
	});

});