import random
import sys

#source: Words that Go Together, Dabrowska 2015

words = [
    ["blatant lie", "clear lie", "conspicuous lie", "distinct lie", "recognizable lie"],
    ["blank expression", "frightful expression", "frightful expression", "plain expression", "sinster expression", "terrible expression"],
    ["attact publicity", "bring publicity", "make publicity", "win publicity", "attain publicity"],
    ["fair share", "honest share", "just share", "legitimate share", "reasonable share"],
    ["arouse suspicions", "incite suspicions", "kindle suspicions", "revive suspicions", "stimulate suspicions"],
    ["raise prices","elevate prices", "grow prices", "lift prices", "stimulate prices"],
    ["hazard a guess", "chance a guess", "dare a guess", "gamble a guess", "risk a guess"],
    ["bend rules", "honour rules", "institute rules", "reject rules", "validate rules"],
    ["issue a statement", "believe a statement", "change a statement", "offer a statement", "revise a statement"],
    ["raise standards", "advance standards", "boost standards", "elevate standards", "lift standards"],
    ["boost production", "double production", "enlarge production", "extend production", "redouble production"],
    ["join the ranks", "combine the ranks", "conjoin the ranks", "merge the ranks", "unify the ranks"],
    ["bitter dispute", "cruel dispute", "hard dispute", "harsh dispute", "savage dispute"],
    ["absolute silence", "pure silence", "sheer silence", "stark silence", "supreme silence"],
    ["full confession", "complete confession", "exhaustive confession", "extensive confession", "thorough confession"],
    ["gain popularity", "acquire popularity", "attract popularity", "earn popularity", "get popularity"],
    ["regular employment",  "constant employment", "normal employment", "ordinary employment", "unbroken employment"],
    ["witness an incident", "glimpse an incident", "notice an incident", "observe an incident", "see an incident"],
    ["achieve one's objectives", "complete one's objectives", "finish one's objectives", "follow one's objectives", "tackle one's objectives"],
    ["general direction", "accurate direction", "appropriate direction", "convenient direction", "specific direction"],
    ["divert attention", "apply attention", "dedicate attention", "grasp attention", "sidetrack attention"],
    ["serious problem", "extensive problem", "extreme problem", "significant problem", "vital problem"],
    ["urgent matters", "compelling matters", "critical matters",  "desperate matters", "major matters"],
    ["close similarity", "doubtful similarity",  "evident similarity", "evident similarity", "extreme similarity", "near similarity"],
    ["hear rumours", "contradict rumours", "discover rumours", "know rumours", "tell rumours"],
    ["memorable phrase", "effective phrase", "helpful phrase", "noteworthy phrase", "significant phrase"],
    ["divert suspicion", "distract suspicion", "mislead suspicion", "redirect suspicion", "sidetrack suspicion"],
    ["restore faith", "instil faith", "bring faith", "offer faith", "refresh faith"],
    ["thorough search", "complete search", "full search", "scrupulous search", "total search"],
    ["precise details", "abundant details", "complete details",  "definite details", "small details"],
    ["inflict punishment",  "apply punishment", "deliver punishment", "perform punishment", "provide punishment"],
    ["attractive proposition", "appealing proposition", "charming proposition", "inviting proposition", "seductive proposition"],
    ["dim view", "dark view", "murky view",  "shadowy view", "shady view"],
    ["outspoken critic",  "aggressive critic",  "forthright critic", "frank critic", "open critic"],
    ["odd remark", "peculiar remark", "queer remark", "unnatural remark", "weird remark"],
    ["striking example", "distinct example", "gross example", "recognizable example", "shocking example"],
    ["lodge a complaint", "formulate a complaint", "place a complaint",  "record a complaint", "write a complaint"],
    ["obvious conclusion", "confident conclusion", "evident conclusion", "solid conclusion", "sure conclusion"],
    ["overall responsibility", "general responsibility", "large responsibility", "single responsibility", "unique responsibility"],
    ["refuse an application", "decline an application", "deny an application", "ignore an application", "scrap an application"]
]

table = "<table><p><b>Words that Go Together</b></p>"
table += "<p style='text-align:left'>This questionnaire consists of sets of five phrases. From each set, <b>choose one phrase that sounds the most natural or familiar. If you are not sure, guess. </b>Here are two examples:.</p>"
table += "<p style='text-align:left'>delicate tea <br>feeble tea <br>frail tea <br> powerless tea <br><b> weak tea</b></p>"
table += "<p style='text-align:left'><b>deliver a speech</b> <br>hold a speech <br>perform a speech <br>present a speech <br>utter a speech</p>"
table += "<p style='text-align:left'>The words delicate, feeble, frail, powerless and weak are similar in meaning; but with tea, we would normally use <b>weak</b>. In the second example, <b>deliver</b> a speech sounds more natural than the other choices.</p>"

q_number = 1

for list in words:
    answers = []
    table += "<tr><td>"+ str(q_number) + ". </td><td>"
    correct = "<input name='vocab_" + str(q_number) +"' type='radio' value='1' class='obligatory' required='required' id='vocab_" + str(q_number) + "_1' />"
    correct += "<label for='vocab_" + str(q_number) + "_1'>" + list[0] + "</label><br />"
    answers.append(correct)
    incorrect_1 = "<input name='vocab_" + str(q_number) +"' type='radio' value='0' class='obligatory' required='required' id='vocab_" + str(q_number) + "_0' />"
    incorrect_1 += "<label for='vocab_" + str(q_number) + "_0'>" + list[1] + "</label><br />"
    answers.append(incorrect_1)
    incorrect_2 = "<input name='vocab_" + str(q_number) +"' type='radio' value='0' class='obligatory' required='required' id='vocab_" + str(q_number) + "_0' />"
    incorrect_2 += "<label for='vocab_" + str(q_number) + "_0'>" + list[2] + "</label><br />"
    answers.append(incorrect_2)
    incorrect_3 = "<input name='vocab_" + str(q_number) +"' type='radio' value='0' class='obligatory' required='required' id='vocab_" + str(q_number) + "_0' />"
    incorrect_3 += "<label for='vocab_" + str(q_number) + "_0'>" + list[3] + "</label><br />"
    answers.append(incorrect_3)
    incorrect_4 = "<input name='vocab_" + str(q_number) +"' type='radio' value='0' class='obligatory' required='required' id='vocab_" + str(q_number) + "_0' />"
    incorrect_4 += "<label for='vocab_" + str(q_number) + "_0'>" + list[4] + "</label><br />"
    answers.append(incorrect_4)
    random.shuffle(answers)
    for item in answers:
        table += item
    table += "<br />"
    q_number +=1

table += "</table>"

html = """
<html>
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="https://www.psycholinguistics.ml/css/global_main.css">
	<link rel="stylesheet" type="text/css" href="https://www.psycholinguistics.ml/css/global_mainB.css">
	<link rel="stylesheet" type="text/css" href="https://www.psycholinguistics.ml/css/Form.css">
</head>
<body>
<form id="mainform" style="text-align: center" method="post" action="https://www.psycholinguistics.ml/vocab/write_data3.php">

"""

html += table

html += """

<input name="submit" type="submit" value="Submit"/>
</form>
</body>
</html>
"""

print(html)

# with open("index.html", "w+") as out:
# 	out.write(html)
#
# if "-m" not in sys.argv:
# 	print(html)
#
# print("Done.")
