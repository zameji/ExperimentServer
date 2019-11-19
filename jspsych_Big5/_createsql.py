sql = "CREATE TABLE big5 (prolific_id VARCHAR(24) PRIMARY KEY, "
for i in range(1,61):
	sql += "big5_q" + str(i) + " VARCHAR(16), "
	
sql = sql[0:-1]

sql += ");"

with open("sql.txt", "w+") as out:
	out.write(sql)
