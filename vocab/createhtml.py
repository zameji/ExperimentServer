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
    ]
syn = {
    0:[3,4], 1:[0,1], 2:[1,3], 3:[3,4], 4:[0,3], 5:[0,3],
    6:[0,4], 7:[1,3], 8:[0,4], 9:[1,3], 10:[0,2], 11:[0,4],
    
    }

table = "<table>"

for index, unit in enumerate(words):
    qname = "Q" + str(index+1) + "A1"
    dkname = "Q" + str(index+1) + "DK"
    table += "<tr><td>"+str(index+1)+".</td><td><input id='"+qname+"' name='"+qname+"' type='checkbox' />"+unit[0]+"</td><td><input id='"+dkname+"' name='"+dkname+"' type='checkbox' />Don't know</td></tr>"
    for i in range(1,3):
        qname = "Q" + str(index+1) + "A"+str(i+1)
        table += "<tr><td></td><td><input id='"+qname+"' name='"+qname+"' type='checkbox' />"+unit[i]+"</td><td></td></tr>"

table += "</table>"
print(table)
