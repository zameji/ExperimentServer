
with open("write_data.php", "w+") as f:

    php = "$id = $_COOKIE['id'];"

    for i in range(60):
        i += 1
        string = "$big5_q" + str(i) + "= $_POST['Big5_Q" + str(i) + "'];\n"
        php += string

    query = "$query = 'UPDATE vocab SET"
    for i in range(60):
        i += 1
        query+= " big5_q" + str(i) + "='\" .  $big5_q" + str(i) + " . \"',"
    query += ' where prolific_id=id";'

    php += query

    f.write(php)

    print(php)


# """
# $id = $_COOKIE['id'];
# $q1a1 = $_POST['q1a1'];
#
# $query = "update vocab set q1a1='" . $q1a1 .
#   "', q1a2='no' where prolific_id=id";"""
#
# with open("ou.php", "w+") as f:
#   f.write(string_with_php)
