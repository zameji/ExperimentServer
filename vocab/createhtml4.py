import random
import sys

#Dabrowska 2018, same "shortened version of the Vocabulary Size Test developed by Nation and Beglar"
#https://www.victoria.ac.nz/lals/about/staff/paul-nation#vocab-tests

words = [
    ["SOLDIER: He is a soldier.", "person in the army", "person in a business", "student", "person who uses metal"],
    ["JUG: He was holding a jug.", "A container for pouring liquids", "an informal discussion", "A soft cap", "A weapon that explodes"],
    ["DINOSAUR: The children were pretending to be dinosaurs.", "animals that lived a long time ago", "robbers who work at sea", "very small creatures with human form but with wings", "large creatures with wings that breathe fire"],
    ["PAVE: It was paved.", "covered with a hard surface", "prevented from going through", "divided", "given gold edges"],
    ["ROVE: He couldn't stop roving.", "travelling around", "getting drunk", "making a musical sound through closed lips", "working hard"],
    ["COMPOUND: They made a new compound.", "thing made of two or more parts", "agreement", "group of people forming a business", "guess based on past experience"],
    ["CANDID: Please be candid.", "say what you really think", "be careful", "show sympathy", "show fairness to both sides"],
    ["QUIZ: We made a quiz.", "set of questions", "thing to hold arrows", "serious mistake", "box for birds to make nests in"],
    ["CRAB: Do you like crabs?", "sea creatures that walk sideways", "very thin small cakes", "tight, hard collars", "large black insects that sing at night"],
    ["REMEDY: We found a good remedy.", "way to fix a problem", "place to eat in public", "way to prepare food", "rule about numbers"],
    ["DEFICIT: The company had a large deficit.", "spent a lot more money than it earned", "went down a lot in value", "had a plan for its spending that used a lot of money", "had a lot of money in the bank"],
    ["NUN: We saw a nun.", "woman following a strict religious life", "long thin creature that lives in the earth", "terrible accident", "unexplained bright light in the sky"],
    ["COMPOST: We need some compost.", "rotted plant material", "strong support", "help to feel better", "hard stuff made of stones and sand stuck together"],
    ["MINIATURE: It is a miniature.", "a very small thing of its kind", "an instrument to look at small objects", "a very small living creature", "a small line to join letters in handwriting"],
    ["FRACTURE: They found a fracture.", "break", "small piece", "short coat", "rare jewel"],
    ["DEVIOUS: Your plans are devious.", "tricky", "well-developed", "not well thought out", "more expensive than necessary"],
    ["BUTLER: They have a butler.", "man servant", "machine for cutting up trees", "private teacher", "cool dark room under the house"],
    ["THRESHOLD: They raised the threshold.", "point or line where something changes", "flag", "roof inside a building", "cost of borrowing money"],
    ["STRANGLE: He strangled her.", "killed her by pressing her throat", "gave her all the things she wanted", "took her away by force", "admired her greatly"],
    ["MALIGN: His malign influence is still felt.", "evil", "good", "very important", "secret"],
    ["OLIVE: We bought olives.", "oily fruit", "scented pink or red flowers", "men's clothes for swimming", "tools for digging up weeds"],
    ["STEALTH: They did it by stealth.", "moving secretly with extreme care and quietness", "spending a large amount of money", "hurting someone so much that they agreed to their demands", "taking no notice of problems they met"],
    ["BRISTLE: The bristles are too hard.", "short stiff hairs", "questions", "folding beds", "bottoms of the shoes"],
    ["DEMOGRAPHY: This book is about demography.", "the study of population", "the study of patterns of land use", "the study of the use of pictures to show facts about numbers", "the study of the movement of water"],
    ["AZALEA: This azalea is very pretty.", "small tree with many flowers growing in groups", "light material made from natural threads", "long piece of material worn by women in India", "sea shell shaped like a fan"],
    ["ERRATIC: He was erratic.", "unsteady", "without fault", "very bad", "very polite"],
    ["NULL: His influence was null.", "had no effect", "had good results", "was unhelpful", "was long-lasting"],
    ["ECLIPSE: There was an eclipse.", "The sun hidden by a planet", "a strong wind", "a loud noise of something hitting the water", "The killing of a large number of people"],
    ["LOCUST: There were hundreds of locusts.", "insects with wings", "unpaid helpers", "people who do not eat meat", "brightly coloured wild flowers"],
    ["CABARET: We saw the cabaret.", "song and dance performance", "painting covering a whole wall", "small crawling insect", "person who is half fish, half woman"],
    ["HALLMARK: Does it have a hallmark?", "stamp to show the quality", "stamp to show when to use it by", "mark to show it is approved by the royal family", "mark or stain to prevent copying"],
    ["MONOLOGUE: Now he has a monologue.", "long turn at talking without being interrupted", "single piece of glass to hold over his eye to help him to see better", "position with all the power", "picture made by joining letters together in interesting ways"],
    ["WHIM: He had lots of whims.", "strange ideas with no motive", "old gold coins", "female horses", "sore red lumps"],
    ["REGENT: They chose a regent.", "a ruler acting in place of the king", "an irresponsible person", "a person to run a meeting for a time", "a person to represent them"],
    ["FEN: The story is set in the fens.", "low land partly covered by water", "a piece of high land with few trees", "a block of poor-quality houses in a city", "a time long ago"],
    ["AWE: They looked at the mountain with awe.", "wonder", "worry", "interest", "respect"],
    ["EGALITARIAN: This organization is egalitarian.", "treats everyone who works for it as if they are equal", "does not provide much information about itself to the public", "dislikes change", "frequently asks a court of law for a judgement"],
    ["UPBEAT: I'm feeling really upbeat about it.", "good", "upset", "hurt", "confused"],
    ["PIGTAIL: Does she have a pigtail?", "a rope of hair made by twisting bits together", "a lot of cloth hanging behind a dress", "a plant with pale pink flowers that hang down in short bunches", "a lover"],
    ["RUCK: He got hurt in the ruck.",  "group of players gathered round the ball in some ball games", "hollow between the stomach and the top of the leg", "pushing and shoving", "race across a field of snow"],
    ["EXCRETE: This was excreted recently.", "pushed or sent out", "made clear", "discovered by a science experiment", "put on a list of illegal things"],
    ["YOGA: She has started yoga.", "a form of exercise for body and mind", "handwork done by knotting thread", "a game where a cork stuck with feathers is hit between two players", "a type of dance from eastern countries"],
    ["PUMA: They saw a puma.", "large wild cat", "small house made of mud bricks", "tree from hot, dry countries", "very strong wind that sucks up anything in its path"],
    ["APERITIF: She had an aperitif.", "a drink taken before a meal", "a long chair for lying on with just one place to rest an arm", "a private singing teacher", "a large hat with tall feathers"],
    ["EMIR: We saw the emir.", "Middle Eastern chief with power in his land", "bird with long curved tail feathers", "woman who cares for other people's children in Eastern countries", "house made from blocks of ice"],
    ["HAZE: We looked through the haze.", "unclear air", "small round window in a ship", "strips of wood or plastic to cover a window", "list of names"],
    ["SOLILOQUY: That was an excellent soliloquy!", "speech in the theatre by a character who is alone", "song for six people", "short clever saying with a deep meaning", "entertainment using lights and music"],
    ["ALUM: This contains alum.", "a chemical compound usually involving aluminium", "a poisonous substance from a common plant", "a soft material made of artificial threads", "a tobacco powder once put in the nose"],
    ["CAFFEINE: This contains a lot of caffeine.", "a substance that makes you excited", "a substance that makes you sleepy", "threads from very tough leaves", "ideas that are not correct"],
    ["COVEN: She is the leader of a coven.", "a secret society", "a small singing group", "a business that is owned by the workers", "a group of church women who follow a strict religious life"],
    ["UBIQUITOUS: Many weeds are ubiquitous.", "are found in most countries", "are difficult to get rid of", "have long, strong roots", "die away in the winter"],
    ["ROUBLE: He had a lot of roubles.", "Russian money", "very precious red stones", "distant members of his family", "moral or other difficulties in the mind"],
    ["COMMUNIQUE: I saw their communiqué.", "official announcement", "critical report about an organization", "garden owned by many members of a community", "printed material used for advertising"],
    ["SKYLARK: We watched a skylark.", "small bird that flies high as it sings", "show with aeroplanes flying in patterns", "man-made object going round the earth", "person who does funny tricks"],
    ["ATOLL: The atoll was beautiful.", "low island made of coral round a sea-water lake", "work of art created by weaving pictures from fine thread", "mall crown with many precious jewels worn in the evening by women", "place where a river flows through a narrow place full of large rocks"],
    ["CANONICAL: These are canonical examples.", "regular and widely accepted examples", "examples which break the usual rules", "examples taken from a religious book", "examples discovered very recently"],
    ["MARSUPIAL: It is a marsupial.", "an animal with a pocket for babies", "an animal with hard feet", "a plant that grows for several years", "a plant with flowers that turn to face the sun"],
    ["BAWDY: It was very bawdy.", "rude", "unpredictable", "enjoyable", "rushed"],
    ["THESAURUS: She used a thesaurus.", "a kind of dictionary", "a chemical compound", "a special way of speaking", "an injection just under the skin"],
    ["CORDILLERA: They were stopped by the cordillera.", "a line of mountains", "a special law", "an armed ship", "the eldest son of the king"]
]

table = "<table><p><b>Word Meanings</b></p>"
table += "<p style='text-align:left'>For each capitalized word, select the option that best describes the meaning of that word in the given context.</p>"

q_number = 1

for list in words:
    answers = []
    table += "<tr><td>"+ str(q_number) + ". " + list[0] + "</td><td>"
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
<form id="mainform" style="text-align: center" method="post" action="https://www.psycholinguistics.ml/vocab/write_data4.php">

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
