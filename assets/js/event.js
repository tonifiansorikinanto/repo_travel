
var button_delete = document.getElementById('button_delete');
var button_edit 	= document.getElementById('button_edit');
var currentUrl = "http://localhost" + window.location.pathname;

var check_input = document.getElementsByClassName('check_input');

var selectItems = [];

var cari_nomer = document.getElementById('cari_nomer');

function setDeleteParameter(data1, data2){
	button_delete.href = "delete_data.php?tb=" + data1 + "&" + "nomer=" + data2;
}

function setInputParameter(data1){
	setTimeout(function(){ document.getElementById("pass_cs").focus(); }, 500);

	history.pushState({
		id : 'homepage'
	}, 'Home | My App', currentUrl + "?tb=" + data1);
}

function setEditParameter(data1, data2){
	setTimeout(function(){ document.getElementById("pass_sv").focus(); }, 500);
	
	//window.location.href = currentUrl + "?tb=" + data1 + "&" + "nomer=" + data2;
	history.pushState({
		id : 'homepage'
	}, 'Home | My App', currentUrl + "?tb=" + data1 + "&" + "id_edit=" + data2);
	//button_edit.href = "edit-penumpang.php?tb=" + data1 + "&" + "nomer=" + data2;
}

function setSearchParameter(data1){
  history.pushState({
		id : 'homepage'
	}, 'Home | My App', currentUrl + "?tb=" + data1 + "&" + "cari-data=" + cari_nomer.value);

	document.location.reload(true);
}

function set_id(data1, data2, data3){
	setTimeout(function(){ document.getElementById("text_mobil").focus(); }, 500);

	if(document.getElementById(data2).checked){

		for(var y = 0; y <= selectItems.length; y++){
			var index = selectItems.indexOf(data1);		

			if (index > -1) {
			  selectItems.splice(index, 1);
			}
		}

		selectItems.push(data1);

	}else{
		for(var x = 0; x <= selectItems.length; x++){
			var index = selectItems.indexOf(data1);
			if (index > -1) {
			  selectItems.splice(index, 1);
			}
		}
		
	}


	history.pushState({
		id : 'homepage'
	}, 'Home | My App', currentUrl + "?tb=" + data3 + "&id=" + selectItems.join("-"));
}

document.onkeydown = function(evt) {
  evt = evt || window.event;
  if (evt.keyCode == 27) {
    resetUrl();
  }
};


//function untuk tombol print 

var print_button = document.getElementById('print_button');

print_button.onclick = function(){
	var goto_print_url = '' + window.location.href + '';
	//var goto_print_url = goto_print_url.replace(,'');
	var goto_print_url = goto_print_url.replace(currentUrl, '');

	// /window.location = "print_file.php" + goto_print_url;
	window.open("print_file.php" + goto_print_url, "_blank");
}


var button_select =  document.getElementsByClassName('button_select');

for(var z = 0; z < button_select.length; z++){
	button_select[z].onclick = function(){
		setTimeout(function(){ document.getElementById("text_mobil").focus(); }, 500);
	}
}

// cari_nomer.onkeydown = function(evt, data1) {
//   evt = evt || window.event;
//   if (evt.keyCode == 13) {

//     history.pushState({
// 			id : 'homepage'
// 		}, 'Home | My App', currentUrl + "?tb=" + data1 + "&" + "cari-data=" + cari_nomer.value);

// 		document.location.reload(true);
//   }

// };

function resetUrl(){
	history.pushState({
		id : 'homepage'
	}, 'Home | My App', window.location.href);
}

function resetUrlClear(){
	history.pushState({
		id : 'homepage'
	}, 'Home | My App', currentUrl);

	for(var z = 1; z <= check_input.length; z++){
		var data3 = "checkid" + z + "";
		document.getElementById(data3).checked = false;		

		selectItems = [];
	}
}

function cekAccessibility(){
	var field_password = document.getElementById('field_password').value;
	return field_password;
}


function show_data(data){
	row_parameter = document.getElementById('row' + data);
	if(row_parameter.style.opacity == "1"){
		row_parameter.style.opacity = "0";
		row_parameter.style.transform = "translateX(-200px)";
		row_parameter.style.transition = "all 0.5s";

		setTimeout(function(){
			row_parameter.style.display = "none";
		}, 250);

	}else{
		row_parameter.style.transition = "4s";
		row_parameter.style.display = "table-row";

		setTimeout(function(){
			row_parameter.style.opacity = "1";
			row_parameter.style.transform = "translateX(0px)";
			row_parameter.style.transition = "all 0.3s";
		}, 100);

	}
}



var row_show = document.getElementsByClassName('row_show');
var row_hidden = document.getElementsByClassName('row_hidden');

var next_button = document.getElementById('next_button');
var prev_button = document.getElementById('prev_button');

var data_total = document.getElementById('data_total');

var start_index = 10;

next_button.onclick = function(){
	if(start_index < row_show.length){
		start_index += 10;
		console.log(start_index);
	}
	table_pagination_meta(start_index);
};

prev_button.onclick = function(){
	if(start_index != 10){
		start_index -= 10;
		console.log(start_index);
	}

	table_pagination_meta(start_index);
};

function table_pagination_meta(start_index){

	data_total.innerHTML = row_show.length;

	for(var w = 0; w < row_show.length; w++){
		var minimW = start_index - 10;
		var y = w - 1;

		if(w < minimW || w >= start_index){
			row_hidden[w].style.opacity = "0";
			row_hidden[w].style.transform = "translateX(-200px)";
			row_hidden[w].style.display = "none";
		
			row_show[w].style.display = "none";

			//show_data(w);
		}else{
			row_show[w].style.display = "table-row";
			//row_hidden[w].style.display = "table-row";
		}

	}
}

window.onload = function(){
	table_pagination_meta(start_index);
};


//table_pagination.outerHTML = "";