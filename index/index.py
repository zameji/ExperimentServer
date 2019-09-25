import os
import types
import sys
import cgi

WORKING_DIR = "/home/ubuntu/server/index"
SERVER_STATE_DIR = "server_state"

HAVE_FLOCK = False
if (sys.version.split(' ')[0]) >= '2.4': # File locking doesn't seem to work with Python <2.5
	try:
		import fcntl # For flock.
		if 'flock' in dir(fcntl) and \
				type(fcntl.flock) == types.BuiltinFunctionType:
			HAVE_FLOCK = True
	except:
		pass

def lock_and_open(filename, mode):
	f = open(filename, mode)
	if HAVE_FLOCK:
		fcntl.flock(f.fileno(), 2)
	return f

def get_counter():
	try:
		f = lock_and_open(os.path.join(WORKING_DIR, SERVER_STATE_DIR, 'counter'), "r")
		n = f.read().strip()
		f.close()
		return n
	except (IOError, ValueError), e:
		sys.exit(1)

def set_counter(n):
	try:
		f = lock_and_open(os.path.join(WORKING_DIR, SERVER_STATE_DIR, 'counter'), "w")
		f.write(str(n))
		f.close()
	except IOError, e:
		sys.exit(1)

def update_counter(update_func):
	try:
		f = lock_and_open(os.path.join(WORKING_DIR, SERVER_STATE_DIR, 'counter'), "r+")
		n = f.read().strip()
		newn = update_func(n)
		f.truncate(0)
		f.seek(0)
		f.write(str(newn))
		f.close()
	except IOError, e:
		sys.exit(1)

def nextgroup(n):
	#"A"-D" --> ibex_1/experiment.html
	#"E" --> ibex_2/experiment
	#"J" --> jspsych/experiment.html
	from itertools import product as iter_product
	from itertools import permutations

	ibex_1 = ["A", "B", "C", "D", "E", "F", "G", "H"]
	# ibex_2 = ["I"] #had to change to fit with the increased ibex amounts
	# todo: we are dropping ibex 2, right?

	jspsych = ["J", "K", "L", "M", "N"]

	#combine the various jspsych versions
	jspsych_versions = ["".join(x) for x in list(permutations(jspsych, len(jspsych)))]
	
	# combined = [x for x in list(permutations([ibex_1, ibex_2, jspsych_versions],3))]
	combined = [x for x in list(permutations([ibex_1, jspsych_versions],2))]
	combined = [list(iter_product(*x)) for x in combined]
	combined = ["".join(item) for sublist in combined for item in sublist]

	try:
		i = combined.index(n)	
		i +=1
	except:
		i = 0
	finally:
		i = i%len(combined)
	
	return combined[i]

	#For development of Part 2, always return group "EAB"
	# return "EAJ"

if __name__ == "__main__":
	html = u"""Content-type:text/html\r\n\r\n
			<meta charset="UTF-8">

			<html>
				<head>
						<title>Welcome</title>
						<script src="util_md5.js"></script>
						<link rel="stylesheet" type="text/css" href="https://www.psycholinguistics.ml/css/global_main.css">
						<link rel="stylesheet" type="text/css" href="https://www.psycholinguistics.ml/css/global_mainB.css">
						<link rel="stylesheet" type="text/css" href="https://www.psycholinguistics.ml/css/Form.css">
				</head>

				<body style="font-size: medium">
					<div style="text-align:center; margin: 50px;">
						<p>
							<b>Reading English Sentences</b>
						</p>
						<p style="text-align:left">
							This study has to do with the way native English speakers read and understand sentences.
						</p>
						<p style="text-align:left">
							We define "native English speakers" as people whose earliest memories involve speaking primarily English and who continue to consider English as their main language of communication. For this study, participants must also have grown up in a primarily English speaking country from the list below and not have became fluent in a foreign language before the age of 13.
						</p>
						<p style="text-align:left">
							We would also like to ask you a couple demographic questions. Please answer honestly for the integrity of our research. <b>Note: We cannot accept submissions from people who are left-handed or who have ever had a learning disability.</b>
						</p>
						<form id=mainform style="text-align: center" method="post" onsubmit="return prepareAndValidate();" action="https://www.psycholinguistics.ml/write_data.php">
							<input id=next name="next" type="hidden" value="https://www.psycholinguistics.ml"/>
							<input id=internalID name="internalID" type="hidden" value="not_assigned"/>
							<input id=group name="group" type="hidden" value='""" + str(get_counter()) + """'/>
							<table style='border-collapse: collapse;'>
									<tr>
										<td colspan="2">
											Please enter your Prolific ID:
										</td>
									</tr>
								<tr>
									<td colspan="2">
										<textarea id=prolificID name="prolificID" maxlength=50 class="obligatory" required="required" rows="2" cols="40"></textarea>
										<br />
									</td>
								</tr>
								<tr>
								<tr />
								<tr>
									<td>
										What is your native language?
									</td>
									<td>
										<input name="nativelang" type="radio" value="English" class="obligatory" required="required" id="langEnglish" />
											<label for="langEnglish">
												English
											</label>
											<br>
										<input name="nativelang" type="radio" value="Other" id="langOther"/>
											<label for="langOther">
												Other
											</label>
											<br>
											<br>
											<br>
									</td>
								</tr>
								<tr>
									<td>
										Have you ever reached fluency in another language?
									</td>
									<td>
										<input name="bilingual" type="radio" value="monolingual" class="obligatory" required="required" id="bilingualno" />
											<label for="bilingualno">
												No
											</label>
											<br>
										<input name="bilingual" type="radio" value="latebilingual" id="bilinguallate"/>
											<label for="bilinguallate">
												Yes, after the age of 13
											</label>
											<br>
										<input name="bilingual" type="radio" value="earlybilingual" id="bilingualearly"/>
											<label for="bilingualearly">
												Yes, between the ages of 5 and 13
											</label>
											<br>
										<input name="bilingual" type="radio" value="fullbilingual" id="bilingualfull"/>
											<label for="bilingualfull">
												Yes, in early childhood
											</label>
											<br>
											<br>
											<br>
									</td>
								</tr>
								<tr>
									<td>
										In which country did you spend the majority of your childhood?
									</td>
									<td>
										<input name="origin" type="radio" value="UK" class="obligatory" required="required" id="originEngland" />
											<label for="originUK">
												UK
											</label>
											<br>
										<input name="origin" type="radio" value="USA" id="originIreland"/>
											<label for="originUSA">
												USA
											</label>
											<br>
										<input name="origin" type="radio" value="other" id="originWales"/>
											<label for="originother">
												Other
											</label>
											<br>
											<br>
											<br>
									</td>
								<tr>
									<br>
									<td colspan="2">
										If you wish to explain your language background, please do so below:
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<textarea name="write_something" maxlength=1000 rows="5" cols="40"></textarea>
										<br>
									</td>
								</tr>

							<tr>
								<td>
									How old are you? (in years)
								</td>
								<td>
									<input id=age name="age" type="text" size="30" class="obligatory" required="required" />
								</td>
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<p id="ageerror" style="color: red">
									</p>
								</td>
							</tr>
							<tr>
								<td>
									What gender do you identify with?
								</td>
								<td>
									<input name="sex" type="radio" value="male" class="obligatory" required="required" id="csexmale" />
										<label for="csexmale">
											Male
										</label>
										<br>
									<input name="sex" type="radio" value="female" id="csexfemale"/>
										<label for="csexfemale">
											Female
										</label>
										<br>
									<input name="sex" type="radio" value="other" id="csexother"/>
										<label for="csexother">
											Other
										</label>
										<br>
										<br>
								</td>
							</tr>

							<tr>
								<td>
									What is your highest level of education?
								</td>
								<td>
									<input name="edu" type="radio" value="1" class="obligatory" required="required" id="edu1" />
										<label for="edu1">
											High school or less
										</label>
										<br>
									<input name="edu" type="radio" value="2" id="edu2"/>
										<label for="edu2">
											Associate's degree
										</label>
										<br>
									<input name="edu" type="radio" value="3" id="edu3"/>
										<label for="edu3">
											Bachelor's degree
										</label>
										<br>
									<input name="edu" type="radio" value="4" id="edu4"/>
										<label for="edu4">
											Master's degree
										</label>
										<br>
									<input name="edu" type="radio" value="5" id="edu5"/>
										<label for="edu5">
											PhD / Doctoral degree
										</label>
										<br>
										<br>
								</td>
							</tr>

							<tr>
								<td>
									How often do you type on a computer?
								</td>
								<td>
									<input name="typing" type="radio" value="typerarely" class="obligatory" required="required" id="type1weekly" />
										<label for="type1weekly">
											One or two days per week
										</label><br>
									<input name="typing" type="radio" value="type3weekly" id="readno"/>
										<label for="type3weekly">
											Three or four days per week
										</label>
										<br>
									<input name="typing" type="radio" value="type3hours" id="type4hours"/>
										<label for="type4hours">
											One to four hours every day
										</label>
										<br>
									<input name="typing" type="radio" value="type8hours" id="type8hours"/>
										<label for="type8hours">
											Five to eight hours every day
										</label>
										<br>
									<input name="typing" type="radio" value="typeallday" id="typeallday"/>
										<label for="typeallday">
											More than eight hours every day
										</label>
										<br>
										<br>
								</td>
							</tr>

							<tr>
								<td>
									How would you rate your typing speed?
								</td>
								<td>
									<input name="typingspeed" type="radio" value="typeveryslow" class="obligatory" required="required" id="typeveryslow" />
										<label for="typeslow">
											Very slow
										</label>
										<br>
									<input name="typingspeed" type="radio" value="typeslow" id="typeslow"/>
										<label for="typeslow">
											Pretty slow
										</label>
										<br>
									<input name="typingspeed" type="radio" value="typemiddle" id="typemiddle"/>
										<label for="typemiddle">
											Neither slow nor fast
										</label>
										<br>
									<input name="typingspeed" type="radio" value="typefast" id="typefast"/>
										<label for="typefast">
											Pretty fast
										</label>
										<br>
									<input name="typingspeed" type="radio" value="typeveryfast" id="typeveryfast"/>
										<label for="typeveryfast">
											Very fast
										</label>
										<br>
										<br>
								</td>
							</tr>

							<tr>
								<td>
									Are you right-handed or left-handed?
								</td>
								<td>
									<input name="handness" type="radio" value="righthanded" class="obligatory" required="required" id="righthanded" />
										<label for="righthanded">
											Right-handed
										</label>
										<br>
									<input name="handness" type="radio" value="lefthanded" id="lefthanded"/>
										<label for="lefthanded">
											Left-handed
										</label>
										<br>
										<br>
								</td>
							</tr>

							<tr>
								<td>
									Do you or have you ever had a reading disability?
								</td>
								<td>
									<input name="read" type="radio" value="yes" class="obligatory" required="required" id="readyes" />
										<label for="readyes">
											Yes
										</label>
										<br>
									<input name="read" type="radio" value="no" id="readno"/>
										<label for="readno">
											No
										</label>
										<br>
										<br>
								</td>
							</tr>
							<tr>
								<td>
									Check this box to confirm that you agree with us using cookies to personalize the experiment.
								</td>
								
								<td>
									<input id="cookieConsent" name="cookieConsent" type="checkbox" value="yes" />
								</td>							
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<p id="cookieError" style="color: red">
									</p>
								</td>
							</tr>							
							
							
						</table>
						<input type="submit" value="Submit">
					</form>

					<p id=message style="color: red; text-align: center"></p>
					<p style="text-align: center"><span id = rn></span></p>
					<p style="text-align: center"><span id = cookies>Cookies: Unchecked</span></p>
					<p style="text-align: center"><span id = mobile>Mobile: No</span></p>
					<p style="text-align: center"><a href="https://www.psycholinguistics.ml/policy.html">Cookies notice - Privacy policy</a></p>
				  </div>

				<script>
					var group = document.getElementById("group").value;
					var message = document.getElementById('message');
					var cookiesOn = false;

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

					function checkCookie(id) {
						var user_id = getCookieValue("id");
						if (user_id != "" && user_id.startsWith(document.getElementById("prolificID").value)) {
							return user_id;
						} else {
							form_id = document.getElementById("prolificID").value
							id = form_id+"_"+id;
							setCookie("id", id, 7);
							return id;
						}
					}

					function uniqueMD5() {
						// Time zone.
						var s = "" + new Date().getTimezoneOffset() + ':';
						s += new Date().getTime();
						s += Math.random();

						// Whether or not cookies are turned on.
						if (cookiesOn)
							s += "C";

						// Screen dimensions and color depth.
						var width = screen.width ? screen.width : 1;
						var height = screen.height ? screen.height : 1;
						var colorDepth = screen.colorDepth ? screen.colorDepth : 1;
						s += width + ':' + height + ':' + colorDepth;

						var id = b64_md5(s);
						id = checkCookie(id);

						return id;
					}

					function checkCookiesEnabled(){
						setCookie("TEST", "TEST", 0.0001);
						if (getCookieValue("TEST") == "TEST"){
							document.getElementById("cookies").innerHTML = "Cookies: ON";
							cookiesOn = true;
							} else {
							form_next.value = "https://www.psycholinguistics.ml/";
							document.getElementById("mainform").style.display = "none";
							message.innerHTML = "<br /><br />Cannot proceed without cookies.<br />Turn cookies on and reload the page."
						}
						return cookiesOn;
						}

					function prepareAndValidate(){
						if (!isValidForm()){
							return false;
							}

						if (!checkCookiesEnabled()){
							return false;
						}

						prepare();

						return true;
					}

					function prepare() {
						form_next = document.getElementById("next");
						form_group = document.getElementById("group");
						form_id = document.getElementById("internalID");

						form_id.value = uniqueMD5();
						if (getCookieValue("group") == ""){setCookie("group", form_group.value, 7)};
						if (getCookieValue("progress") == ""){setCookie("progress", 0, 7);}

						switch(form_group.value[getCookieValue("progress")]){
							case "A":
							case "B":
							case "C":
							case "D":
							case "E":
							case "F":
							case "G":
							case "H":
								form_next.value = "https://www.psycholinguistics.ml/ibex_1/experiment.html";
								break;

							case "J":
								form_next.value = "https://www.psycholinguistics.ml/jspsych/experiment.html";
								break;							
								
							case "K":
								form_next.value = "https://www.psycholinguistics.ml/jspsych_1/index.html";
								break;							

							case "L":
								form_next.value = "https://www.psycholinguistics.ml/jspsych_2/reading_span_web_english.html";
								break;							

							case "M":
								form_next.value = "https://www.psycholinguistics.ml/jspsych_3/index.html";
								break;				
								
							case "N":
								form_next.value = "https://www.psycholinguistics.ml/jspsych_4/index.html";
								break;												

							default:
								form_next.value = "https://www.psycholinguistics.ml/cookie_error.html";

							}
						}

					function isValidForm() {
						var valid = true;
						
						re = /^\d+$/
						if (!re.test(document.getElementById("age").value)){							
							document.getElementById("ageerror").innerHTML = "Age must be a number";
							valid = false;
                                                }

						if (!document.getElementById("cookieConsent").checked){
							document.getElementById("cookieError").innerHTML = "Cannot proceed without your consent"
							valid = false;
						}

							return valid;
						}

					form_next = document.getElementById("next");

					var isMobile = false; //initiate as false
					// device detection
					if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
						|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
						isMobile = true;}

					if (isMobile){
						form_next.value = "https://www.psycholinguistics.ml/";
						message.innerHTML = "Mobile devices not supported.<br />Please use a computer.";
						document.getElementById("mobile").innerHTML = "Mobile: Yes";
						}

					</script>
					</body>
					</html>"""

	update_counter(nextgroup)
	sys.stdout.write(html)
