
function saveData(name, data){
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'write_data.php'); // 'write_data.php' is the path to the php file described above.
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(JSON.stringify({filename: name, filedata: data}));
  
  xhr.onreadystatechange = function () {
	if (xhr.status == 200 && xhr.status < 300)
	{
		var response = JSON.parse(xhr.responseText);
		if(response.location){
		  window.location.href = response.location;
		}
	} 
    }
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+ d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookieValue(a) {
	var b = document.cookie.match('(^|[^;]+)\\s*' + a + '\\s*=\\s*([^;]+)');
	return b ? b.pop() : '';
}

function getID() {
	var user_id = getCookieValue("id");
	if (user_id != "") {
		return user_id;
	} else {
		window.location.href = "https://www.psycholinguistics.ml/cookie_error.html?id=none";
	}
}

function insertAfter(el, referenceNode) {
	    referenceNode.parentNode.insertBefore(el, referenceNode);
	}

function getNextJspsych(){
	var sequence = getCookieValue("jspsych_group");
	var progress = getCookieValue("jspsych_progress");
	var next = "https://www.psycholinguistics.ml/cookie_error.html";
	var finalmessage = document.createElement("p");


	if (progress != ""){
	//update progress
	progress = parseInt(progress)
	progress++;
	setCookie("progress", progress, 7);

	//until all three elements done, continue to next test
	if (progress<8){
		sequence = sequence[progress];
		switch (sequence){
				case "J":
					next ="https://www.psycholinguistics.ml/jspsych/experiment.html";//circles-REPLACE LATER WITH VOCAB
					break;
				case "K":
					next ="https://www.psycholinguistics.ml/jspsych_1/static/index.html";//AXCPT
					break;
				case "L":
					next ="https://www.psycholinguistics.ml/jspsych_2/reading_span_web_english.html"; //RST
					break;
				case "M":
					next ="https://www.psycholinguistics.ml/jspsych_3/index.html";//Flanker
					break;
				case "N":
					next ="https://www.psycholinguistics.ml/jspsych_4/index.html";//Ravens
					break;
				case "O":
					next ="https://www.psycholinguistics.ml/jspsych_5/index.html";//Big5
					break;
				case "P":
					next ="https://www.psycholinguistics.ml/jspsych_6/index.html";//Navon
					break;

				default:
					next  = "https://www.psycholinguistics.ml/cookie_error.html";
					}
	}	else {
		next = "https://www.psycholinguistics.ml/finished.html";
	}
	}
	return next;

}
