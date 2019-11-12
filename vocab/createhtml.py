words = [["no", "yes", "yeah"], ["small", "tiny", "whatever"]]
syn = {0 : [1,2], 1:[0,1]}

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
