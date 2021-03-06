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
    ["John Searle", 1],
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
    ["Jeffrey Gray", 1],
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
    print(str(q_number)+ " " + name)
    string = "<input id='ART_" + str(q_number) + "' name='ART_" + str(q_number) + "' type='checkbox' value='" + str(number) + "' /><tr>" + name + "</tr><br>"
    answers.append(string)
    q_number +=1

random.shuffle(answers)
for item in answers:
    table += item



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
<form id="mainform" style="text-align: center" method="post" action="https://www.psycholinguistics.ml/vocab/write_data2.php">

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

# 1 Sidney Sheldon
# 2 Danielle Steele
# 3 Jackie Collins
# 4 Judith Krantz
# 5 Nora Roberts
# 6 Iris Johansen
# 7 Diana Palmer
# 8 Catherine Anderson
# 9 Joy Fielding
# 10 Nicholas Sparks
# 11 Stephen Hawking
# 12 Stephen J. Gould
# 13 Richard Dawkins
# 14 Thomas Kuhn
# 15 Ernst Mayr
# 16 Douglas Rushkoff
# 17 Amir D. Aczel
# 18 Robert Jordan
# 19 Douglas Adams
# 20 Anne McCaVrey
# 21 William Gibson
# 22 Terry Brooks
# 23 Terry Goodkind
# 24 Piers Anthony
# 25 Arthur C. Clarke
# 26 Ray Bradbury
# 27 Ursula K. Le Guin
# 28 Roland Barthes
# 29 John Searle
# 30 Jean Baudrillard
# 31 Michel Foucault
# 32 Bertrand Russell
# 33 Antonio Damasio
# 34 Daniel Goleman
# 35 Dean Koontz
# 36 John LeCarré
# 37 Robert Ludlum
# 38 Clive Cussler
# 39 Sue Grafton
# 40 Ian Rankin
# 41 P. D. James
# 42 John Saul
# 43 Patricia Cornwell
# 44 Ken Follett
# 45 Noam Chomsky
# 46 Norman Mailer
# 47 Michael Moore
# 48 Eric Schlosser
# 49 Bob Woodward
# 50 Pierre Berton
# 51 Naomi Klein
# 52 John Updike
# 53 W. O. Mitchell
# 54 Alice Munro
# 55 Maeve Binchy
# 56 Carol Shields
# 57 John Irving
# 58 Toni Morrison
# 59 Amy Tan
# 60 Rohinton Mistry
# 61 Sinclair Ross
# 62 Jack Canfield
# 63 Philip C. McGraw
# 64 M. Scott Peck
# 65 Robert Fulghum
# 66 Erma Bombeck
# 67 Jean Vanier
# 68 Stephen R. Covey
# 69 José Saramago
# 70 Yukio Mishima
# 71 Gabriel Garcia Marquez
# 72 Albert Camus
# 73 Umberto Eco
# 74 Milan Kundera
# 75 Paulo Coelho
# 76 W. G. Sebald
# 77 Italo Calvino
# 78 Thomas Mann
# 79 Faith Popcorn
# 80 Jim Collins
# 81 Napoleon Hill
# 82 Robert T. Kiyosaki
# 83 Stephen C. Lundin
# 84 Peter S. Pande
# 85 Kenneth H. Blanchard
# 86 Matt Ridley
# 87 John Maynard Smith
# 88 Diane Ackerman
# 89 Jeffrey Gray
# 90 Joseph LeDoux
# 91 Oliver Sacks
# 92 Naomi Wolf
# 93 Robert D. Kaplan
# 94 Susan Sontag
# 95 Melody Beattie
# 96 Deepak Chopra
# 97 Marianne Williamson
# 98 Peter F. Drucker
# 99 Barry Z. Posner
# 100 M. D. Johnson Spencer
# 101 Lauren Adamson
# 102 Eric Amsel
# 103 Margaritia Azmitia
# 104 Oscar Barbarin
# 105 Reuben Baron
# 106 Gary Beauchamp
# 107 Thomas Bever
# 108 Elliot Blass
# 109 Dale Blyth
# 110 Hilda Borko
# 111 John Condry
# 112 Edward Cornell
# 113 Carl Corter
# 114 Diane Cuneo
# 115 Denise Daniels
# 116 Geraldine Dawson
# 117 Aimee Dorr
# 118 W Patrick Dickson
# 119 Robert Emery
# 120 Frances Fincham
# 121 Martin Ford
# 122 Harold Gardin
# 123 Frank Gresham
# 124 Robert Inness
# 125 Frank Keil
# 126 Reed Larson
# 127 Lynn Liben
# 128 Hugh Lytton
# 129 Franklin Manis
# 130 Morton Mendelson
# 131 James Morgan
# 132 Scott Paris
# 133 Richard Passman
# 134 David Perry
# 135 Miriam Sexton
# 136 K Warner Schaie
# 137 Robert Siegler
# 138 Mark Strauss
# 139 Alister Younger
# 140 Steve Yussen
