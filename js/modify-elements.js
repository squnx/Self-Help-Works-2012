var ListHandler = new Object();
var CheckboxHandler = new Object();
var RadioHandler = new Object();

Array.prototype.in_array = function (value) {
  for (var i = 0; i < this.length; i++) {
	if (this[i] == value) {
		return true;
	}
  }

  return false;

};

RadioHandler.getCheckedValue = function(radio_name) {
  oRadio = document.forms[0].elements[radio_name];
  for(var i = 0; i < oRadio.length; i++) { 
	if(oRadio[i].checked) {
		return oRadio[i].value;
	}
  }

  return '';
};

ListHandler.getSelectedIndices = function (oList) {
  var indices = [];
  for(var i = 1; i < oList.options.length; i++) {
	  if(oList.options[i].selected == true) {
		  indices.push(i);
	  }
  }
  return indices;
};

ListHandler.getSelectedValues = function (oList) {
  var sValues = [];
  for(var i = 1; i < oList.options.length; i++) {
	  if(oList.options[i].selected == true) {
		sValues.push(oList.options[i].value);
	  }
  }
  return sValues;
};

ListHandler.getSelectedOptionsDisplayText = function (oList) {
  var sdValues = [];
  for(var i = 1; i < oList.options.length; i++) {
	  if(oList.options[i].selected == true) {
		sdValues.push(oList.options[i].text);
	  }
  }
  return sdValues;
};

ListHandler.getAllValues = function (oList) {
  var aValues = [];

  for(var i = 1; i < oList.options.length; i++) {
	  aValues.push(oList.options[i].value);
  }
  return aValues;
};

ListHandler.getAllOptionsDisplayText = function (oList) {
  var aValues = [];
  for(var i = 1; i < oList.options.length; i++) {
	  aValues.push(oList.options[i].text);
  }
  return aValues;
};

ListHandler.addOption = function (oList, optionName, optionValue) {
  var oOption = document.createElement("option");
  oOption.appendChild(document.createTextNode(optionName));
  oOption.setAttribute("value", optionValue);

  oList.appendChild(oOption);

};

ListHandler.removeOption = function (oList, index) {
  oList.remove(index);
};

CheckboxHandler.isChecked = function (checkboxObj) {
  return(checkboxObj.checked == true);
};

function trim(str) {
  return str.replace(/^\s+|\s+$/g, '');
}

function isEmpty(str) {
  str = trim(str);
  return ((str == null) || (str.length == 0));
}

function isDigit(c) {
  return ((c >= "0") && (c <= "9"));
}

function isInteger(str) {  
  for (var i = 0; i < str.length; i++) {
	var c = str.charAt(i);
	if (!isDigit(c)) {
		return false;
	}
  }

  return true;
}

function disableElement(obj) {
  obj.value = ' - N.A. - ';
  obj.disabled = true;
}

function enableElement(obj) {
  obj.value = '';
  obj.disabled = false;
}

function addToList(menu_nameObj, menu_addObj, howmuchObj, aswhatObj, menu_elementsObj) {
  var menu_name = trim(menu_nameObj.value);
  var menu_add = trim(menu_addObj.value);
  var howmuch = trim(howmuchObj.value);
  
  if(isEmpty(menu_name)) {
	  alert("Please enter your menu name.");
	  return;
  }
  if(isEmpty(menu_add)) {
	  alert("Please enter your added item(s).");
	  return;
  }
  
  if(isEmpty(howmuch) || !isInteger(howmuch)) {
	  alert("Please enter a valid integer");
	  return;
  }
  
  var aswhat_chosen = false;

  for(var i = 1; i < aswhatObj.length; i++) {
	  if(aswhatObj.options[i].selected == true) {
		aswhat_chosen = true;
		var optionName = aswhatObj.options[i].text + ' / ' + menu_name + ' / '  + 'added: ' + menu_add + ' / '  + howmuch + ' gram ' + ' / '; 
		
		var optionValue = aswhatObj.options.length;

		ListHandler.addOption(menu_elementsObj, optionName, optionValue);
		aswhatObj.options[i].selected = false;
		aswhatObj.selectedIndex = -1;
		menu_nameObj.value = '';
		menu_addObj.value = '';
		howmuchObj.value = '';
		
		break;
	  }
  }

  if(!aswhat_chosen) {
	  alert("Please select an AS WHAT option from the drop down list");
  }
}

function removeFromList(menu_elementsObj) {
  for(var i = 1; i < menu_elementsObj.length; i++) {
	if(menu_elementsObj.options[i].selected == true) {
		ListHandler.removeOption(menu_elementsObj, i);		
	}
  }
}

function handleJobExpOption(jobExpObj, currentSalaryObj) {
  if (jobExpObj.options[jobExpObj.selectedIndex].value == 1) {
	  disableElement(currentSalaryObj);
  } else {
	enableElement(currentSalaryObj);
  }
}

function checkEmail(email)
{	
	
  var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
  
  if(pattern.test(email)) {         
	return true;
  } else {   
	return false; 
  }
}

function getFormValues(oForm, skip_elements) {
  var elements = oForm.elements; 
  var data = [];
  var element_value = null;

  for(var i = 0; i < elements.length; i++) {
	var field_type = elements[i].type.toLowerCase();
	var element_name = elements[i].getAttribute("name");
	
	if(!skip_elements.length ||  !skip_elements.in_array(element_name)) {
	switch(field_type) {
		case "text": 
		case "password": 
		case "textarea":
		case "hidden":	
			element_value = elements[i].value;
			data.push(element_name + ': ' + element_value);
			break;
		case "checkbox":
			element_value = CheckboxHandler.isChecked(elements[i]);
			data.push(element_name + ': ' + element_value);
			break;
		case "select-one":
			var ind = elements[i].selectedIndex;
			if(ind > 0) { 
				element_value = elements[i].options[ind].text;
			} else {
				element_value = '';
			}
			data.push(element_name + ': ' + element_value);
			break;
		case "select-multiple":
			var elems = ListHandler.getSelectedOptionsDisplayText(elements[i]);
			element_value = elems.join('\n');
			data.push(element_name + ': ' + element_value);
			break;
		
		default: 
			break;
	}
        }
  }
  return data; 
}

function processFormData(oForm) {
	var skip_elements = ['menu_elements', 'menu_name', 'menu_add', 'howmuch', 'aswhat', 'work_abroad'];
	
	var data = getFormValues(oForm, skip_elements);
	
	var menu_elements_arr = ListHandler.getAllOptionsDisplayText(oForm.menu_elements);
	var work_abroad_option = RadioHandler.getCheckedValue('work_abroad');
	
	data.push('menu_elements_list: ' + menu_elements_arr.join('\n'));
	data.push('work_abroad: ' + work_abroad_option);
	
	alert(data.join('\n--------------------\n'));
}