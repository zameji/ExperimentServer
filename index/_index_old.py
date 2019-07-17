import os
import types
import sys
import cgi

WORKING_DIR = "/home/ubuntu/index"
SERVER_STATE_DIR = "server_state"

HAVE_FLOCK = False
if (sys.version.split(' ')[0]) >= '2.4': # File locking doesn't seem to work with Python <2.5
	try:
		import fcntl # For flock.
		if 'flock' in dir(fcntl) and \
				type(fcntl.flock) == types.BuiltinFunctionType:
			HAVE_FLOCK = True
	except:
		pass

def lock_and_open(filename, mode):
	f = open(filename, mode)
	if HAVE_FLOCK:
		fcntl.flock(f.fileno(), 2)
	return f

def get_counter():
	try:
		f = lock_and_open(os.path.join(WORKING_DIR, SERVER_STATE_DIR, 'counter'), "r")
		n = int(f.read().strip())
		f.close()
		return n
	except (IOError, ValueError), e:
		sys.exit(1)
def set_counter(n):
	try:
		f = lock_and_open(os.path.join(WORKING_DIR, SERVER_STATE_DIR, 'counter'), "w")
		f.write(str(n))
		f.close()
	except IOError, e:
		sys.exit(1)

def update_counter(update_func):
	try:
		f = lock_and_open(os.path.join(WORKING_DIR, SERVER_STATE_DIR, 'counter'), "r+")
		n = int(f.read().strip())
		newn = update_func(n)
		f.truncate(0)
		f.seek(0)
		f.write(str(newn))
		f.close()
	except IOError, e:
		sys.exit(1)

def mod_3(n):
	n += 1
	return n%3

if __name__ == "__main__":
	html = u"""Content-type:text/html\r\n\r\n
		<meta charset="UTF-8">

		<html>
				  <head>
						<title>Welcome</title>
						<script src="util_md5.js"></script>
				  </head>
				<body>
				  <div>
						<h1 style="text-align: center"><a id=link href = "https://www.psycholinguistics.ml/">Continue</a></h1>
						<p style="text-align: center"><span id = rn></span></p>
						<p style="text-align: center"><span id = cookies>Cookies: OFF</span></p>
						<p style="text-align: center"><span id = mobile>Mobile: No</span></p>
				  </div>

				<script>
				  var group = '"""
	html += str(get_counter())
	html += """';
		var link = document.getElementById('link');
				
		function setCookie(cname, cvalue, exdays) {
		  var d = new Date();
		  d.setTime(d.getTime() + (exdays*24*60*60*1000));
		  var expires = "expires="+ d.toUTCString();
		  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		function getCookieValue(a) {
		  var b = document.cookie.match('(^|[^;]+)\\s*' + a + '\\s*=\\s*([^;]+)');
				return b ? b.pop() : '';
		}
		
		function checkCookie(id) {
			var user_id = getCookieValue("id");
			if (user_id != "") {
				return user_id;
			} else {
				setCookie("id", id, 7);
				return id;
			}
		}		
		
		cookiesOn = false;
		setCookie("TEST", "TEST", 0.01);
		if (getCookieValue("TEST") == "TEST"){
			document.getElementById("cookies").innerHTML = "Cookies: ON";
			cookiesOn = true;
			} else {
			link.href = "https://www.psycholinguistics.ml/";
			link.innerHTML = "Cannot proceed without cookies.<br />Turn cookies on and reload the page."
			}

		var isMobile = false; //initiate as false
		// device detection
		if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
		    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
		    isMobile = true;}

		if (isMobile){
			link.href = "https://www.psycholinguistics.ml/";
			link.innerHTML = "Mobile devices not supported.<br />Please use a computer.";
			document.getElementById("mobile").innerHTML = "Mobile: Yes"
			}
		
		if (cookiesOn){
			var goTo = "index";
			setCookie("testGroup", group, 7);
			setCookie("progress", 0, 7);
			
			switch(group[getCookieValue("progress")]){
				case "0":
					link.href = "https://www.psycholinguistics.ml/ibex_1/experiment.html";
					goTo = "ibex-1";
					break;
					
				case "1":
					link.href = "https://www.psycholinguistics.ml/ibex_2/experiment.html";
					goTo = "ibex-2";
					break;

				case "2":
					link.href = "https://www.psycholinguistics.ml/jspsych/experiment.html";
					goTo = "jsPsych";
					break;				
				}
				
			//document.getElementById("rn").innerHTML = "Group: " + group + " - " + goTo;		
			document.getElementById("rn").innerHTML = "Group: " + group + " - " + goTo;		
			

			function uniqueMD5() {
				// Time zone.
				var s = "" + new Date().getTimezoneOffset() + ':';
				s += new Date().getTime();
				s += Math.random();

				// Whether or not cookies are turned on.
				if (cookiesOn)
					s += "C";

				// Screen dimensions and color depth.
				var width = screen.width ? screen.width : 1;
				var height = screen.height ? screen.height : 1;
				var colorDepth = screen.colorDepth ? screen.colorDepth : 1;
				s += width + ':' + height + ':' + colorDepth;

				var id = b64_md5(s);
				id = checkCookie(id);

				return id;
			}
			
			var id = uniqueMD5();
					
			}
	
		</script>
		</body>
        </html>"""

	update_counter(mod_3)
	sys.stdout.write(html)