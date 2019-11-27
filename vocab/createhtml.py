import random
import sys

#source: Shipley & Burlingame 1941

words = [
    ["TALK", "speak", "draw", "eat", "sleep"],
    ["PERMIT", "allow", "sew", "cut", "drive"],
    ["PARDON", "forgive", "pound", "divide", "tell"],
    ["COUCH", "sofa", "pin", "eraser", "glass"],
    ["REMEMBER", "recall", "swim", "number", "defy"],
    ["TUMBLE", "fall", "drink", "dread", "think"],
    ["HIDEOUS", "dreadful", "silvery", "tilted", "young"],
    ["CORDIAL", "hearty", "swift", "muddy", "leafy"],
    ["EVIDENT", "obvious", "green", "afraid", "sceptical"],
    ["IMPOSTER", "pretender", "conductor", "officer", "book"],
    ["MERIT", "deserve", "distrust", "fight", "separate"],
    ["FASCINATE", "enchant", "welcome", "fix", "stir"],
    ["INDICATE", "signify", "defy", "excite", "bicker"],
    ["IGNORANT", "uninformed", "red", "sharp", "precise"],
    ["FORTIFY", "strengthen", "submerge", "vent", "deaden"],
    ["RENOWN", "fame", "length", "head", "loyalty"],
    ["NARRATE", "tell", "yield", "buy", "associate"],
    ["MASSIVE", "large", "bright", "speedy", "low"],
    ["HILARITY", "laughter", "speed", "grace", "malice"],
    ["SMIRCHED", "soiled", "stolen", "pointed", "remade"],
    ["SQUANDER", "waste", "tease", "belittle", "cut"],
    ["CAPTION", "heading", "drum", "ballet", "ape"],
    ["FACILITATE", "help", "turn", "strip", "bewilder"],
    ["JOCOSE", "humorous", "paltry", "fervid", "plain"],
    ["APPRISE", "inform", "reduce", "strew", "delight"],
    ["RUE", "lament", "eat", "dominate", "cure"],
    ["DENIZEN", "inhabitant", "senator", "fish", "atom"],
    ["DIVEST", "dispossess", "intrude", "rally", "pledge"],
    ["AMULET", "charm", "orphan", "dingo", "pond"],
    ["INEXORABLE", "rigid", "involatile", "untidy", "sparse"],
    ["SERRATED", "notched", "dried", "armed", "blunt"],
    ["LISSOM", "loose", "moldy", "supple", "convex"],
    ["MOLLIFY", "mitigate", "direct", "pertain", "abuse"],
    ["PLAGIARIZE", "appropriate", "intend", "revoke", "maintain"],
    ["ORIFICE", "hole", "brush", "building", "lute"],
    ["QUERULOUS", "complaining", "maniacal", "curious", "devout"],
    ["PARIAH", "outcast", "priest", "lentil", "locker"],
    ["ABET", "incite", "waken", "ensue", "placate"],
    ["TEMERITY", "rashness",  "timidity", "desire", "kindness"],
    ["PRISTINE", "first", "vain", "sound", "level"]
]

table = "<table><p><b>Vocabulary</b></p>"
table += "<p style='text-align:left'>In the test below, you are given a word in capital letters. Select the word that means the same thing, or most nearly the same thing, as the capitalized word.</p>"
table += "<p style='text-align:left'>If you don't know, guess.</p>"

q_number = 1

for list in words:
    answers = []
    table += "<tr><td>"+ str(q_number) + ". " + list[0] + ":</td><td>"
    correct = "<input name='vocab_" + str(q_number) +"' type='radio' value='1' class='obligatory' required='required' id='vocab_" + str(q_number) + "_1' />"
    correct += "<label for='vocab_" + str(q_number) + "_1'>" + list[1] + "</label><br />"
    answers.append(correct)
    incorrect_1 = "<input name='vocab_" + str(q_number) +"' type='radio' value='0' class='obligatory' required='required' id='vocab_" + str(q_number) + "_0' />"
    incorrect_1 += "<label for='vocab_" + str(q_number) + "_0'>" + list[2] + "</label><br />"
    answers.append(incorrect_1)
    incorrect_2 = "<input name='vocab_" + str(q_number) +"' type='radio' value='0' class='obligatory' required='required' id='vocab_" + str(q_number) + "_0' />"
    incorrect_2 += "<label for='vocab_" + str(q_number) + "_0'>" + list[3] + "</label><br />"
    answers.append(incorrect_2)
    incorrect_3 = "<input name='vocab_" + str(q_number) +"' type='radio' value='0' class='obligatory' required='required' id='vocab_" + str(q_number) + "_0' />"
    incorrect_3 += "<label for='vocab_" + str(q_number) + "_0'>" + list[4] + "</label><br />"
    answers.append(incorrect_3)
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
<form id="mainform" style="text-align: center" method="post" action="https://www.psycholinguistics.ml/vocab/write_data.php">

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
