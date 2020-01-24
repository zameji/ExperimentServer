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

		n = n.split("_")

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
	import random

	#testgroups = ["1", "J"] #removed 2 because ibex2 is out
	#testgroups_versions = ["".join(x) for x in list(permutations(testgroups, len(testgroups)))]

	# Only allow those where Ibex 2 is the last one
	#testgroups_versions = [x for x in testgroups_versions if x.endswith("2")]

	ibex_1 = ["A", "B", "C", "D", "E", "F", "G", "H"]

	# ibex_2 = ["I"] #had to change to fit with the increased ibex amounts
	# todo: we are droppin-g ibex 2, right?

	jspsych = ["J", "K", "L", "M", "N", "O", "P", "Q"] #removed R which was a placeholder

	#combine the various jspsych versions
	jspsych_versions = ["".join(x) for x in list(permutations(jspsych, len(jspsych)))]

	# combined = []
	# for testgroup in testgroups_versions:
	# 	for js in jspsych_versions:
	# 		for ibx in ibex_1:
	# 			combined.append("_".join([testgroup, js, ibx]))

	# combined = [x for x in list(permutations([ibex_1, ibex_2, jspsych_versions],3))]
	#combined = [x for x in list(permutations([ibex_1, jspsych_versions],2))]
	#combined = [list(iter_product(*x)) for x in combined]
	#combined = ["".join(item) for sublist in combined for item in sublist]
	# combined = jspsych_versions

	# try:
	# 	i = combined.index(n)
	# 	i +=1
	# except:
	# 	i = 0
	# finally:
	# 	i = i%len(combined)

	if "J1_" in n:
		current_order = "1J_"
	else:
		current_order = "J1_"

	current_order += random.choice(jspsych_versions) + "_"

	current_order += (random.choice(ibex_1))

	return current_order


	#return combined[i]

	#For development of Part 2, always return group "EAB"
	# return "EAJ"

if __name__ == "__main__":
	groups = get_counter()
	html = u"""Content-type:text/html\r\n\r\n
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Welcome</title>
		<script src="util_md5.js"></script>
		<!-- Cookie handling JS code. -->
		<script type="text/javascript" src="https://www.psycholinguistics.ml/index/cookie.js"></script>
		<link rel="stylesheet" type="text/css" href="https://www.psycholinguistics.ml/css/global_main.css" />
		<link rel="stylesheet" type="text/css" href="https://www.psycholinguistics.ml/css/global_mainB.css"/>
		<link rel="stylesheet" type="text/css" href="https://www.psycholinguistics.ml/css/Form.css" />
	</head>
	<body style="font-size: medium">
		<div style="text-align:center; margin: 50px;">
			<p>
				<b>Reading English Sentences</b>
			</p>
			<p style="text-align:left">
							This study has to do with the way native English speakers read and understand sentences. You will be asked to do various cognitive tasks, including reading sentences one word at a time.
						</p>
			<p style="text-align:left">
							Risks: This experiment has various parts and may be longer than other quesionnaires or experiments you have participated in before. We see no substantial risks to you in your participation, besides perhaps your own boredom  or loss of time.
						</p>
			<p style="text-align:left">
							Privacy: The data from the experiment is totally confidential, as the researchers involved will never receive your name or identifying details. We receive only your Prolific ID and the answers to demographic questions you have answered on their website.
						</p>
			<p style="text-align:left">
							By checking the box at the end of this page, you confirm the following statements:<br>
							I understand that the experiment I am about to participate in will take around 90 minutes and may consist of repetitive tasks. I voluntarily agree to take part in this experiment under these conditions. <br>
							I consent to the use of my data and its publication in fully anonymized form at a later date.
						</p>
			<p style="text-align:left">
							We would also like to ask you a couple of basic questions. Please answer honestly for the integrity of our research.
						</p>
			<form id="mainform" style="text-align: center" method="post" action="https://www.psycholinguistics.ml/write_data.php" onsubmit="return prepareAndValidate()">
				<input id="internalID" name="internalID" type="hidden" value="not_assigned"/>
				<input id="group" name="group" type="hidden" value='""" + str(groups[0]) + """'/>
				<input id="jspsych_group" name="jspsych_group" type="hidden" value='""" + str(groups[1]) + """'/>
				<input id="ibex_1_group" name="ibex_1_group" type="hidden" value='""" + str(groups[2]) + """'/>
				<table style='border-collapse: collapse;'>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>
							What is your native language?
						</td>
						<td>
							<input name="nativelang" type="radio" value="English" class="obligatory" required="required" id="langEnglish" />
							<label for="langEnglish">
									English
								</label>
							<br />
							<input name="nativelang" type="radio" value="Other" id="langOther"/>
							<label for="langOther">
									Other
								</label>
							<br />
							<br />
							<br />
						</td>
					</tr>
					<tr>
						<td>
							Have you ever reached near-native fluency in another language?
						</td>
						<td>
							<input name="bilingual" type="radio" value="monolingual" class="obligatory" required="required" id="bilingualno" />
							<label for="bilingualno">
									No
								</label>
							<br />
							<input name="bilingual" type="radio" value="latebilingual" id="bilinguallate"/>
							<label for="bilinguallate">
									Yes, after the age of 13
								</label>
							<br />
							<input name="bilingual" type="radio" value="earlybilingual" id="bilingualearly"/>
							<label for="bilingualearly">
									Yes, between the ages of 5 and 13
								</label>
							<br />
							<input name="bilingual" type="radio" value="fullbilingual" id="bilingualfull"/>
							<label for="bilingualfull">
									Yes, in early childhood
								</label>
							<br />
							<br />
							<br />
						</td>
					</tr>
					<tr></tr>
					<td>
							In which country did you spend the majority of your childhood?
						</td>
					<td>
						<input name="origin" type="radio" value="UK" class="obligatory" required="required" id="originUK" />
						<label for="originUK">
									UK
								</label>
						<br />
						<input name="origin" type="radio" value="USA" id="originUSA"/>
						<label for="originUSA">
									USA
								</label>
						<br />
						<input name="origin" type="radio" value="other" id="originother"/>
						<label for="originother">
									Other
								</label>
						<br />
						<br />
						<br />
					</td>
					<tr>
						<td>
						How old are you? (in years)
					</td>
						<td>
							<input id="age" name="age" type="text" size="30" class="obligatory" required="required" />
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<p id="ageerror" style="color: red"></p>
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
							<br />
							<input name="sex" type="radio" value="female" id="csexfemale"/>
							<label for="csexfemale">
								Female
							</label>
							<br />
							<input name="sex" type="radio" value="other" id="csexother"/>
							<label for="csexother">
								Other
							</label>
							<br />
							<br />
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
							<br />
							<input name="edu" type="radio" value="2" id="edu2"/>
							<label for="edu2">
								Associate's degree
							</label>
							<br />
							<input name="edu" type="radio" value="3" id="edu3"/>
							<label for="edu3">
								Bachelor's degree
							</label>
							<br />
							<input name="edu" type="radio" value="4" id="edu4"/>
							<label for="edu4">
								Master's degree
							</label>
							<br />
							<input name="edu" type="radio" value="5" id="edu5"/>
							<label for="edu5">
								PhD / Doctoral degree
							</label>
							<br />
							<br />
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
							<br />
							<input name="handness" type="radio" value="lefthanded" id="lefthanded"/>
							<label for="lefthanded">
								Left-handed
							</label>
							<br />
							<br />
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
							<br />
							<input name="read" type="radio" value="no" id="readno"/>
							<label for="readno">
								No
							</label>
							<br />
							<br />
						</td>
					</tr>
					<tr>
						<td>
						Check this box to confirm that you have read and agree with the <a href="https://www.psycholinguistics.ml/policy2.html" target="_blank">privacy policy</a>.
					</td>
						<td>
							<input id="cookieConsent" name="cookieConsent" type="checkbox" value="yes" />
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<p id="cookieError" style="color: red"></p>
						</td>
					</tr>
				</table>
				<input name="submit" type="submit" value="Submit"/>
			</form>
			<p id="message" style="color: red; text-align: center"></p>
			<p style="text-align: center">
				<span id = "rn"></span>
			</p>
			<!--<p style="text-align: center">-->
			<!--	<span id = "cookies">Cookies: Unchecked</span>-->
			<!--</p>-->
			<!--<p style="text-align: center">-->
			<!--	<span id = "mobile">Device: Approved</span>-->
			<!--</p>-->
		</div>
		<script>

		var message = document.getElementById('message');

		function prepareAndValidate(){
			if (!isValidForm()){
				return false;
				}

			return true;
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

		</script>
	</body>
</html>"""

	update_counter(nextgroup)
	sys.stdout.write(html)
