
var button_delete = document.getElementById('button_delete');
var button_edit 	= document.getElementById('button_edit');

function setDeleteParameter(data1, data2){
	button_delete.href = "delete_data.php?tb=" + data1 + "&" + "nomer=" + data2;
}

function setEditParameter(data1, data2){
	button_edit.href = "edit-penumpang.php?tb=" + data1 + "&" + "nomer=" + data2;
}

function cekAccessibility(){
	var field_password = document.getElementById('field_password').value;
	return field_password;
}