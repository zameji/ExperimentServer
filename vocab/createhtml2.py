import random
import sys

## Author recognition task
#source: Acheson et al. 2008, Hintz & Brysbaert 2019, Mar et al 2006 (updated version with different genres, what we use here)

authors = [
    ["Sidney Sheldon", 1],
    ["Danielle Steele", 1],
    ["Jackie Collins", 1],
    ["Judith Krantz", 1],
    ["Nora Roberts", 1],
    ["Iris Johansen", 1],
    ["Diana Palmer", 1],
    ["Catherine Anderson", 1],
    ["Joy Fielding", 1],
    ["Nicholas Sparks", 1],
    ["Stephen Hawking", 1],
    ["Stephen J. Gould", 1],
    ["Richard Dawkins", 1],
    ["Thomas Kuhn", 1],
    ["Ernst Mayr", 1],
    ["Douglas Rushkoff", 1],
    ["Amir D. Aczel", 1],
    ["Robert Jordan", 1],
    ["Douglas Adams", 1],
    ["Anne McCaVrey", 1],
    ["William Gibson", 1],
    ["Terry Brooks", 1],
    ["Terry Goodkind", 1],
    ["Piers Anthony", 1],
    ["Arthur C. Clarke", 1],
    ["Ray Bradbury", 1],
    ["Ursula K. Le Guin", 1],
    ["Roland Barthes", 1],
    ["Jean Baudrillard", 1],
    ["Michel Foucault", 1],
    ["Bertrand Russell", 1],
    ["Antonio Damasio", 1],
    ["Daniel Goleman", 1],
    ["Dean Koontz", 1],
    ["John LeCarré", 1],
    ["Robert Ludlum", 1],
    ["Clive Cussler", 1],
    ["Sue Grafton", 1],
    ["Ian Rankin", 1],
    ["P. D. James", 1],
    ["John Saul", 1],
    ["Patricia Cornwell", 1],
    ["Ken Follett", 1],
    ["Noam Chomsky", 1],
    ["Norman Mailer", 1],
    ["Michael Moore", 1],
    ["Eric Schlosser", 1],
    ["Bob Woodward", 1],
    ["Pierre Berton", 1],
    ["Naomi Klein", 1],
    ["John Updike", 1],
    ["W. O. Mitchell", 1],
    ["Alice Munro", 1],
    ["Maeve Binchy", 1],
    ["Carol Shields", 1],
    ["John Irving", 1],
    ["Toni Morrison", 1],
    ["Amy Tan", 1],
    ["Rohinton Mistry", 1],
    ["Sinclair Ross", 1],
    ["Jack Canfield", 1],
    ["Philip C. McGraw", 1],
    ["M. Scott Peck", 1],
    ["Robert Fulghum", 1],
    ["Erma Bombeck", 1],
    ["Jean Vanier", 1],
    ["Stephen R. Covey", 1],
    ["José Saramago", 1],
    ["Yukio Mishima", 1],
    ["Gabriel Garcia Marquez", 1],
    ["Albert Camus", 1],
    ["Umberto Eco", 1],
    ["Milan Kundera", 1],
    ["Paulo Coelho", 1],
    ["W. G. Sebald", 1],
    ["Italo Calvino", 1],
    ["Thomas Mann", 1],
    ["Faith Popcorn", 1],
    ["Jim Collins", 1],
    ["Napoleon Hill", 1],
    ["Robert T. Kiyosaki", 1],
    ["Stephen C. Lundin", 1],
    ["Peter S. Pande", 1],
    ["Kenneth H. Blanchard", 1],
    ["Matt Ridley", 1],
    ["John Maynard Smith", 1],
    ["Diane Ackerman", 1],
    ["JeVrey Gray", 1],
    ["Joseph LeDoux", 1],
    ["Oliver Sacks", 1],
    ["Naomi Wolf", 1],
    ["Robert D. Kaplan", 1],
    ["Susan Sontag", 1],
    ["Melody Beattie", 1],
    ["Deepak Chopra", 1],
    ["Marianne Williamson", 1],
    ["Peter F. Drucker", 1],
    ["Barry Z. Posner", 1],
    ["M. D. Johnson Spencer", 1],
    ["Lauren Adamson", -1], #foils start here
    ["Eric Amsel", -1],
    ["Margaritia Azmitia", -1],
    ["Oscar Barbarin", -1],
    ["Reuben Baron", -1],
    ["Gary Beauchamp", -1],
    ["Thomas Bever", -1],
    ["Elliot Blass", -1],
    ["Dale Blyth", -1],
    ["Hilda Borko", -1],
    ["John Condry", -1],
    ["Edward Cornell", -1],
    ["Carl Corter", -1],
    ["Diane Cuneo", -1],
    ["Denise Daniels", -1],
    ["Geraldine Dawson", -1],
    ["Aimee Dorr", -1],
    ["W Patrick Dickson", -1],
    ["Robert Emery", -1],
    ["Frances Fincham", -1],
    ["Martin Ford", -1],
    ["Harold Gardin", -1],
    ["Frank Gresham", -1],
    ["Robert Inness", -1],
    ["Frank Keil", -1],
    ["Reed Larson", -1],
    ["Lynn Liben", -1],
    ["Hugh Lytton", -1],
    ["Franklin Manis", -1],
    ["Morton Mendelson", -1],
    ["James Morgan", -1],
    ["Scott Paris", -1],
    ["Richard Passman", -1],
    ["David Perry", -1],
    ["Miriam Sexton", -1],
    ["K Warner Schaie", -1],
    ["Robert Siegler", -1],
    ["Mark Strauss", -1],
    ["Alister Younger", -1],
    ["Steve Yussen", -1]
]

table = "<table><p><b>Authors</b></p>"
table += "<p style='text-align:left'>The following list of names contains some authors and non-authors. Check the box next to the name of all authors you know (that is, anyone who has written at least one book).</p>"
table += "<p style='text-align:left'>If you don't know, do not guess. You will lose a point for every name you select who is not an author.</p>"

q_number = 1
answers = []

for name, number in authors:
    #table += "<tr><td>"+ str(q_number) + ". " + name + ":</td><td>"
    string = "<input id='ART_" + name + "_" + str(number) + "' name='" + name + "_" + str(number) + "' type='checkbox' value='yes' /><tr>" + name + "</tr><br>"
    answers.append(string)

random.shuffle(answers)
for item in answers:
    table += item

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
