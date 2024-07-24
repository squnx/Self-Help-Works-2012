function resetForm() {
	document.forms[0].reset()
}

function submitForm() {
	
	document.forms[0].submit("hello");
    
}


	function lbstokg(pounds) {
	weight = pounds * .45359237
	return weight

}

function ftToInch(feet) {
	cinches = feet * 12;
	return cinches
}

function inchesToCm (totalInches) {
	ctotalInches = totalInches * 2.54
	return ctotalInches
	}
function metresToCm (metres) {
	return metres * 100
}
function calculateHeight(feet, inches) {
	
		convertedInches = ftToInch(feet);
		totalInches = convertedInches + inches;
		
		return inchesToCm(totalInches);
}

function calculateBMI(){

	doc = document.bmi

	if (doc.weight.value == "" || isNaN(doc.weight.value) || doc.weight.value <= 0)
	{
		alert("Please enter a number greater than 0 for weight."); 
		document.bmi.weight.value = "";
		document.bmi.weight.focus();
		return;
		
	}
	if ( doc.height1.value == "" || isNaN(doc.height1.value) || doc.height1.value <= 0)
	{
		alert("Please enter a number greater than 0 for height."); 
		document.bmi.height1.value = "";
		document.bmi.height1.focus();
		return;
		
	}
	if (doc.height2.value == "" || isNaN(doc.height2.value) || doc.height2.value < 0)
	{
		alert("Please enter a number greater than 0 for height."); 
		document.bmi.height2.value = "";
		document.bmi.height2.focus();
		return;
		
	}


	weight = doc.weight.value
	
	var uom = doc.weightuom.selectedIndex

	if (uom == 0) 
		{
			weight = lbstokg(weight)
		}
	
	height1uom = doc.height1uom.selectedIndex
	height2uom = doc.height2uom.selectedIndex
	

	if (height1uom == 0 && height2uom == 0)
	{
		feet = parseInt(doc.height1.value);
		inches = parseInt(doc.height2.value);
		htInCm = calculateHeight(feet, inches);
	}
	else if (height1uom == 1 && height2uom == 1)
	{
		metres = parseInt(doc.height1.value);
		cm = parseInt(doc.height2.value);
		convertedCm = metresToCm(metres);
		
		htInCm = convertedCm + cm;
	}
	else {
		alert("Please make both units of measure for your height the same.");
		return;
	}
	var bmi = (weight / htInCm / htInCm) * 10000
		bmi = roundOff(bmi, 1)
	/*if (!is_nav4){
	document.getElementById('calcresult').style.visibility='visible';
	document.getElementById('calcresultline').style.visibility='visible';
		
	}*/
	doc.bmi.value = bmi
	doc.bmi.focus();

}
function roundOff(value, precision)
{
        value = "" + value //convert value to string
        precision = parseInt(precision);

        var whole = "" + Math.round(value * Math.pow(10, precision));

        var decPoint = whole.length - precision;

        if(decPoint != 0)
        {
                result = whole.substring(0, decPoint);
                result += ".";
                result += whole.substring(decPoint, whole.length);
        }
        else
        {
                result = whole;
        }
        return result;
}