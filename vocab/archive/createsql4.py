import sys

query = "CREATE TABLE vocabB (prolific_id VARCHAR(24) PRIMARY KEY NOT NULL, "
for i in range(60):
    i += 1
    query+= " vocabB_q" + str(i) + " VARCHAR(16),"

# remove the last comma
query = query[0:-1]

query += ");"


# Finally, we write the PHP code to the PHP file
with open("sql4.txt", "w+") as f:

    f.write(query)

# Unless the flag -m is raised, print the script to the console
if "-m" not in sys.argv:
    print(query)

print("Done.")
sys.exit(0)
