# ExperimentServer - LEMP stack
Two ibex instances + one JSPsych + landing page.


All connected together through an Nginx server (not included), talking to a lighttpd server to handle Python CGI (not included)


**Access:**
- SSH: keyfile + password (experiment)
- MySQL: root/ubuntu user (ubuntuExperiment2019)

**Filesystem description:**
- Files are located on the server in /home/ubuntu/server/
- Nginx Settings: "nano /etc/nginx/sites-available/ibex"
- Lighttpd Settings 1: "nano /etc/lighttpd/sites-available/ibex.conf"
- Lighttpd Settings 2: "nano /etc/lighttpd/sites-available/ibex_2.conf"
- Backup settings /home/ubuntu/backup/task.sh (frequency controlled through "sudo crontab -e")

**Routing description:**
- Any requests on / go to /home/ubuntu/server/index
- Any requests on /ibex_1/ go to /home/ubuntu/server/ibex
- Any requests on /ibex_2/ go to /home/ubuntu/server/ibex_2
- Any requests on /jspsych/ go to /home/ubuntu/server/jspsych

**To-do:**
- Cache the static files (CSS mostly) in the browser (save server load)
- Regularly check the DB for group balance, adjust the group selection to maintain it
