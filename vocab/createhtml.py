import random

words = [
    ["tiny", "faded", "new", "large", "big"], #0
    ["shovel", "spade", "needle", "oak", "club"], #1
    ["walk", "rob", "juggle", "steal", "discover"], #2
    ["finish", "embellish", "cap", "squeak", "talk"], #3
    ["recall", "flex", "efface", "remember", "divest"], #4
    ["implore", "fancy", "recant", "beg", "answer"], #5
    ["deal", "claim", "plea", "recoup", "sale"], #6
    ["mindful", "negligent", "neurotic", "lax", "delectable"], #7
    ["quash", "evade", "enumerate", "assist", "defeat"], #8
    ["entrapment", "partner", "fool", "companion", "mirror"], #9
    ["junk", "squeeze", "trash",  "punch", "crack"], #10
    ["trivial", "crude", "presidential", "flow", "minor"], #11
    ["prattle", "siren", "couch", "chatter", "good"], #12
    ["above", "slow", "over", "pierce", "what"], #13
    ["assail", "designate", "arcane", "capitulate", "specify"], #14
    ]

table = "<table>"

q_number = 1

for list in words:
    answers = []
    table += "<tr><td>"+ str(q_number) + ". " + list[0] + ":</td><td>"
    correct = "<input name='vocab_" + str(q_number) +"' type='radio' value='1' class='obligatory' required='required' id='" + list[1] + "' />"
    correct += "<label for='" + list[1] + "'>" + list[1] + "</label><br />"
    answers += correct
    incorrect_1 = "<input name='vocab_" + str(q_number) +"' type='radio' value='0' class='obligatory' required='required' id='" + list[2] + "' />"
    incorrect_1 += "<label for='" + list[2] + "'>" + list[2] + "</label><br />"
    answers += incorrect_1
    incorrect_2 = "<input name='vocab_" + str(q_number) +"' type='radio' value='0' class='obligatory' required='required' id='" + list[3] + "' />"
    incorrect_2 += "<label for='" + list[3] + "'>" + list[3] + "</label><br />"
    answers += incorrect_2
    incorrect_3 = "<input name='vocab_" + str(q_number) +"' type='radio' value='0' class='obligatory' required='required' id='" + list[4] + "' />"
    incorrect_3 += "<label for='" + list[4] + "'>" + list[4] + "</label><br />"
    answers += incorrect_3
    answers = random.shuffle(answers)
    print(answers)
q_number +=1


table += "</table>"
print(table)
