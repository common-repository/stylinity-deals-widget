var stylinityBrands = [];
jQuery(document).ready(function($) {
	jQuery(document).on('widget-updated', function(){
		stylinity$populateDropdown(stylinityBrands);
		var selectField = jQuery(".chosen-select");
		jQuery('.hideBrand').val(selectField.val());
	});
	function requestObj() {
		if (window.XMLHttpRequest) {
			var httpRequest = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			var httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
		}
		if (!httpRequest) {return;}
		httpRequest.onreadystatechange = (function()
		{
			try {
				if (httpRequest.readyState === XMLHttpRequest.DONE) {
					if (httpRequest.status === 200) {
						 var jsonObj = JSON.parse(httpRequest.responseText);
						 stylinityBrands = jsonObj['HtmlCode'];
				
   					     stylinity$populateDropdown(stylinityBrands);
					} else {return;}
				}
			}
			catch(exception) {
				return;
			}
		});
		var u =  'https://localhost:44304/webrequest/getbrandsfordealwidget';
		httpRequest.open('GET', u, true);
	    httpRequest.send();
	}
	requestObj();
	
});

function stylinity$populateDropdown(stylinityBrands){
	
	 var selectField = jQuery(".chosen-select");

	 for (b in stylinityBrands) {
		
		var opt = document.createElement('option');
		opt.value = stylinityBrands[b].Id;
		opt.innerHTML = stylinityBrands[b].Name;
		selectField.append(opt);
	 }
	 stylinity$setDropdown();
	 selectField.selectize();
}

function stylinity$setDropdown(){
	
	 var selectField = jQuery(".chosen-select");


	 var selectedField =jQuery('.hideBrand2');


	 selectField.val(selectedField.val().split(","));
	 selectField.selectize();
}

