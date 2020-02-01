
var button_delete = document.getElementById('button_delete');
var button_edit 	= document.getElementById('button_edit');
var currentUrl = "http://localhost" + window.location.pathname;

function setDeleteParameter(data1, data2){
	button_delete.href = "delete_data.php?tb=" + data1 + "&" + "nomer=" + data2;
}

function setEditParameter(data1, data2){
	
	//window.location.href = currentUrl + "?tb=" + data1 + "&" + "nomer=" + data2;
	history.pushState({
		id : 'homepage'
	}, 'Home | My App', currentUrl + "?tb=" + data1 + "&" + "nomer=" + data2);
	//button_edit.href = "edit-penumpang.php?tb=" + data1 + "&" + "nomer=" + data2;
}

document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) {
      resetUrl();
    }
};

function resetUrl(){
	history.pushState({
		id : 'homepage'
	}, 'Home | My App', currentUrl);
}

function cekAccessibility(){
	var field_password = document.getElementById('field_password').value;
	return field_password;
}

function show_data(data){
	row_parameter = document.getElementById('row' + data);
	if(row_parameter.style.opacity == "1"){
		row_parameter.style.display = "none";
		row_parameter.style.opacity = "0";
		row_parameter.style.maxHeight = "0px";
	}else{
		row_parameter.style.display = "table-row";
		row_parameter.style.opacity = "1";
		row_parameter.style.maxHeight = "200px";
	}
}