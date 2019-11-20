import random
import sys

## Author recognition task
#source: Acheson et al. 2008, Hintz & Brysbaert 2019

authors = [
        "Maya Angelou",
        "Isaac Asimov",
        "Jean M. Auel",
        "James Clavell",
        "Jackie Collins",
        "Isabel Allende",
        "Margaret Atwood",
        "Ann Beattie",
        "Samuel Beckett",
        "Saul Bellow",
        "T. C. Boyle",
        "Ray Bradbury",
        "Willa Cather",
        "Raymond Chandler",
        "Tom Clancy",
        "Clive Cussler",
        "Nelson Demille",
        "Umberto Eco",
        "T. S. Elliot",
        "Ralph Ellison",
        "Nora Ephron",
        "William Faulkner",
        "Dick Francis",
        "Stephen King",
        "Judith Krantz",
        "Robert Ludlum",
        "James Michener",
        "F. Scott Fitzgerald",
        "Sue Grafton",
        "John Grisham",
        "Ernest Hemmingway",
        "Brian Herbert",
        "Tony Hillerman",
        "John Irving",
        "Kazuo Ishiguro",
        "James Joyce",
        "Jonathan Kellerman",
        "Wally Lamb",
        "Harper Lee",
        "Jack London",
        "Bernard Malamud",
        "Gabriel García Márquez",
        "Anne McCaffrey",
        "Margaret Mitchell",
        "Toni Morrison",
        "Sidney Sheldon",
        "Danielle Steel",
        "J. R. R. Tolkien",
        "Alice Walker",
        "Vladimir Nabokov",
        "Joyce Carol Oates",
        "Michael Ondaatje",
        "George Orwell",
        "James Patterson",
        "Thomas Pynchon",
        "Ayn Rand",
        "Salmon Rushdie",
        "J. D. Salinger",
        "Jane Smiley",
        "Paul Theroux",
        "Kurt Vonnegut",
        "E. B. White",
        "Thomas Wolfe",
        "Virginia Woolf",
        "Herman Wouk"
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
<form id="mainform" style="text-align: center" method="post" action="https://www.psycholinguistics.ml/jspsych_5/write_data.php">

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
