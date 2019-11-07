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

	testgroups = ["1", "2", "J"]
	testgroups_versions = ["".join(x) for x in list(permutations(testgroups, len(testgroups)))]
	
	ibex_1 = ["A", "B", "C", "D", "E", "F", "G", "H"]
		
	# ibex_2 = ["I"] #had to change to fit with the increased ibex amounts
	# todo: we are dropping ibex 2, right?

	jspsych = ["J", "K", "L", "M", "N", "O", "P"]

	#combine the various jspsych versions
	jspsych_versions = ["".join(x) for x in list(permutations(jspsych, len(jspsych)))]

	combined = []
	for testgroup in testgroups:
		for js in jspsych:
			for ibx in ibex_1:
				combined.append("_".join([testgroup, js, ibx]))
				
	# combined = [x for x in list(permutations([ibex_1, ibex_2, jspsych_versions],3))]
	#combined = [x for x in list(permutations([ibex_1, jspsych_versions],2))]
	#combined = [list(iter_product(*x)) for x in combined]
	#combined = ["".join(item) for sublist in combined for item in sublist]
	# combined = jspsych_versions

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
	groups = get_counter()
	html = u"""Content-type:text/html\r\n\r\n


			<html>
				<head>
						<meta charset="UTF-8">
						<title>Welcome</title>
						<script src="util_md5.js"></script>
						<!-- Cookie handling JS code. -->
						<script type="text/javascript" src="https://www.psycholinguistics.ml/index/util/cookie.js"></script>
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
							We define "native English speakers" as people whose earliest memories involve speaking primarily English and who continue to consider English as their main language of communication. For this study, participants must also have grown up in a primarily English speaking country from the list below and not have become fluent in a foreign language before the age of 13. Participants must also not have or have ever had a learning disability.
						</p>
						<p style="text-align:left">
							We would also like to ask you a couple demographic questions. Please answer honestly for the integrity of our research.
						</p>
						<form id=mainform style="text-align: center" method="post" action="https://www.psycholinguistics.ml/write_data.php">
							<input id=internalID name="internalID" type="hidden" value="not_assigned"/>
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
							<input name="origin" type="radio" value="UK" class="obligatory" required="required" id="originUK" />
								<label for="originUK">
									UK
								</label>
								<br>
							<input name="origin" type="radio" value="USA" id="originUSA"/>
								<label for="originUSA">
									USA
								</label>
								<br>
							<input name="origin" type="radio" value="other" id="originother"/>
								<label for="originother">
									Other
								</label>
								<br>
								<br>
								<br>
						</td>
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
						How often do you read in your free time? (Books, news articles, anything longer than a few paragraphs.)
					</td>
					<td>
						<input name="reading_amt" type="radio" value="1" class="obligatory" required="required" id="type1weekly" />
							<label for="1">
								Rarely or never
							</label><br>
						<input name="reading_amt" type="radio" value="2" id="type3weekly"/>
							<label for="2">
								An hour per week or less
							</label>
							<br>
						<input name="reading_amt" type="radio" value="3" id="type4hours"/>
							<label for="3">
								About three to five hours per week
							</label>
							<br>
						<input name="reading_amt" type="radio" value="4" id="type8hours"/>
							<label for="4">
								About an hour every day
							</label>
							<br>
						<input name="reading_amt" type="radio" value="5" id="typeallday"/>
							<label for="5">
								More than an hour a day
							</label>
							<br>
							<br>
					</td>
				</tr>

				<tr>
					<td>
						Would you say you enjoy reading?
					</td>
					<td>
						<input name="reading_enj" type="radio" value="1" class="obligatory" required="required" id="typeveryslow" />
							<label for="1">
								No, I prefer not to read if I don't have to
							</label>
							<br>
						<input name="reading_enj" type="radio" value="2" id="typeslow"/>
							<label for="2">
								Not really, I read sometimes, but only if something is very interesting to me
							</label>
							<br>
						<input name="reading_enj" type="radio" value="3" id="typemiddle"/>
							<label for="3">
								Kind of, there are some books/sources that I enjoy but others I don't
							</label>
							<br>
						<input name="reading_enj" type="radio" value="4" id="typefast"/>
							<label for="4">
								Yeah, I like reading and have several favorite books/sources
							</label>
							<br>
						<input name="reading_enj" type="radio" value="5" id="typeveryfast"/>
							<label for="5">
								Yes, I am a passionate reader and consider reading one of my favorite hobbies
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
						Check this box to confirm that you agree with the experiment.
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
			<input type="submit" value="Submit" onclick="prepareAndValidate(); return false;">
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

		function prepareAndValidate(){
			if (!isValidForm()){
				return false;
				}
				
			document.getElementById("mainform").submit();

			return false;
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