/**
 * jspsych-dotcomparison
 * Or Duek
 *
 * plugin for running the dot comparison task in jspsych
 *
 * documentation: docs.jspsych.org
 *
 **/

(function($) {
	jsPsych.plugins["dotComparison-button"] = (function() {

		var plugin = {};

		plugin.trial = function(display_element, params) {

			// if any trial variables are functions
			// this evaluates the function and replaces
			// it with the output of the function
			params = jsPsych.pluginAPI.evaluateFunctionParameters(params);

            var trial = {};
            // create the ratio trials
            trial.ratio = params.ratio;
            trial.condition = params.condition;
            trial.choices = params.choices || [];
            trial.response_ends_trial = true;
            // timing parameters
            trial.timing_response = params.timing_response || -1; // if -1, then wait for response forever


			// this array holds handlers from setTimeout calls
			// that need to be cleared if the trial ends early
			var setTimeoutHandlers = [];
			var rt; // setting rt variable to save reation time
			if (trial.ratio == '1:2') {
				console.log('1:2');
				// set amount of dots per color

				var lessDot = Math.floor((Math.random() * 5) + 5); // the lowest amount
				var moreDot = lessDot*2;
			} else if (trial.ratio== '3:4') {
				console.log('3:4');
				var lessDot = Math.floor((Math.random() * 10) + 5);
				var moreDot = lessDot*4/3;
			} else if (trial.ratio == '5:6') {
				console.log('5:6');
				var lessDot = Math.floor((Math.random() * 11) + 5);
				var moreDot = lessDot*6/5;
			} else if (trial.ratio=='7:8') {
				console.log('7:8');
				var lessDot = Math.floor((Math.random() * 12) + 5);
				var moreDot = lessDot*8/7;
			}

			lessDot = Math.round(lessDot);
			moreDot = Math.round(moreDot);

			// setting baseSize of dot and variance
			var baseSize = 15;
			var variance = 4.7;
			var actualRatio = moreDot/lessDot;

			console.log(lessDot);
			console.log(moreDot);
			console.log(actualRatio);


			// function to get random intiger between min and max
			function getRandomIntInclusive(min, max) {
  				return Math.floor(Math.random() * (max - min + 1)) + min;
						}
			function getRandomArbitrary(min, max) {
  				  return Math.random() * (max - min) + min;
				}


			lessDotSize = new Array (lessDot);
			moreDotSize = new Array (moreDot);
			// build dot size and places
			function areaCalc() {
				//var random = new Radnom(); // create instance of random library
				// method to calculate dor sizes (and place?) according to equal area for both groups
				var rand = getRandomArbitrary(-35,35)/100 +1;
				// the lesser number area = basesize * number of dots.
				var lessSum = 0;
				for (i=0;i<lessDot-1;i++) {
					rand = getRandomArbitrary(-35,35)/100 + 1;
					var x = baseSize * rand;
					lessDotSize[i]=x;
					lessSum += x;
					}
				lessDotSize[lessDot-1] = (baseSize * lessDot) - lessSum;
				// larger no. area = less area / number of dots (which will become the new basesize)
				// in area condition the base size of dot is the average size of the lessdot
				var moreSum = 0;
				var moreArea = baseSize * lessDot;
				for (i=0;i<moreDot-1;i++) {
					rand = getRandomArbitrary(-35,35)/100 +1;
					var x = (moreArea / moreDot) * rand;
					moreDotSize[i] = x;
					moreSum+=x;
				}
				moreDotSize[moreDot-1] = moreArea - moreSum;



			}

			//areaCalc();
			var sum = 0;
			var sumMore = 0;
			function averageCalc() {
				// here the average of each color needs to be the same.
				sum = 0;
				for (i=0;i<lessDot-1;i++) {
					var rand = getRandomArbitrary(-35,35)/100 + 1;
					var x = baseSize * rand;

					lessDotSize[i]=x;
					sum += x;
					}
					lessDotSize[lessDot-1] = (baseSize * lessDot) - sum;
				for (i=0;i<moreDot-1;i++) {
					var rand = getRandomArbitrary(-35,35)/100 + 1; // get random no. -35% to + 35%
					moreDotSize[i]=baseSize * rand;
					sumMore += baseSize * rand;
				}
					moreDotSize[moreDot-1] = (baseSize * moreDot) - sumMore;


			}

			var s = Snap(800,600); // create a snap canvas
			// create rectangle to make background color
			var rect = s.rect(0,0,800,800);
			rect.attr ({
			 fill: "Gray"
			 });
			// create fixation point

			var text = s.text(400,300,"+");
			text.attr({
				fill: "white",
				'font-size': 50
			});

			setTimeout(function () {
                text.attr({
                    fill: "Gray"
                });
            }, 1000);
			// should change this delay with wait for Keypress.

			// begin creating circles
			function createCircle (x,y,size) {
				this.x = x;
				this.y = y;
				this.size = size;
				return s.circle(x,y,size);
			}
			// function that checks collision

			function intersectRect(r1, r2) {
			    var r1 = r1.getBBox();    //BOUNDING BOX OF THE FIRST OBJECT
			    var r2 = r2.getBBox();    //BOUNDING BOX OF THE SECOND OBJECT
			    return !(r2.x > r1.x2 ||
				           r2.x2 < r1.x ||
				           r2.y > r1.y2 ||
				           r2.y2 < r1.y);
				}
			// should create function to set places of dots.
			// each set is in different place (divided but user doesn't see it)
			// original task sets yellow in the left and blue in the right

			// create coordinates for circles
			function coordinates(min,max) {   // max is maximux x-right value for canves differences (betwen yellow and blue)
					var x = getRandomIntInclusive(min,max);
					var y = getRandomIntInclusive(50,550);
					return [x,y];
			}
			// if collision then throw another coordinates
			function checkCollision(circle, array) {
				var checking = 0;
				for (i=0;i<array.length;i++) {
					var circleTwo = array[i];

					if (intersectRect(circle, circleTwo)) {
						checking +=1;

					} else {
						checking = checking;
					}
					//return intersectRect(circle, array[i])

				}
				return checking;
			}

	///

			// setting answer variable to compare for correct or incorrect
			var answer;
			var start_time; // adding a variable to as a start time of experiment
			function runTrial() {
			//	document.removeEventListener('keydown',runTrial());
				console.log("RunTrial");
				// kill keyboard listeners
				//if(typeof keyboardListener !== 'undefined'){
				//	jsPsych.pluginAPI.cancelKeyboardResponse(keyboardListener);
				//}

				if (trial.condition == "area") {
					areaCalc();
				} else if (trial.condition == "average") {
					averageCalc();
				}

				// now should wait for press before moving to show dots on screen
				// choose which color will be more or less
				if (Math.random() < 0.5) {
					lessColor = "Blue";
					moreColor = "Yellow";
					var xLessmin = 50;
					var xLessmax = 350;
					var xMoremin = 420;
					var xMoremax = 760;
					answer = 74; // insert the right key to press

				} else {
					lessColor = "Yellow";
					moreColor = "Blue";
					xLessmin = 420;
					xLessmax =  760;
					xMoremin = 50;
					xMoremax = 350;
					answer = 70;
				}
				console.log(lessColor);


				var lessPlaceList = []; // array of circle objects of the less group


				var x = getRandomIntInclusive(xLessmin,xLessmax);
				var y = getRandomIntInclusive(50,500);
				var circle = new createCircle(x,y,lessDotSize[0]);
				// circle.attr ({
				// 		fill: lessColor
				// 	});

				lessPlaceList.push(circle);
				var lessGroup = s.group(circle); // creating a group of circles
				for (i=1;i<lessDot;i++) {
					// adding small script that makes Blue always on left side and yellow on right (as in original task)
					var cord = coordinates(xLessmin,xLessmax);
					var x = cord[0];
					var y =cord[1];
					// here I should check for colission and return different values before creating the circle
					var circle = new createCircle(x,y,lessDotSize[i]);
					var check = checkCollision(circle,lessPlaceList);
					console.log(check);
					while (check>=1) {
						cord = coordinates(xLessmin,xLessmax);
						x = cord[0];
						y = cord[1];
						circle.attr({
							cx: x,
							cy: y });
						check =checkCollision(circle,lessPlaceList);
						}
					lessGroup = s.group(lessGroup,circle);
					console.log(lessGroup);
				 	lessPlaceList.push(circle);
					// circle.attr ({
					// 	fill: lessColor
					// });

				}

				var morePlaceList = []; // array of circle objects of the more group
				var x = getRandomIntInclusive(xMoremin,xMoremax);
				var y = getRandomIntInclusive(50,500);
				var circle = new createCircle(x,y,moreDotSize[0]);
				// circle.attr ({
				// 		fill: moreColor
				// 	});
				morePlaceList.push(circle);
				var moreGroup = s.group(circle);
				for (i=1;i<moreDot;i++) {
					var cord = coordinates(xMoremin,xMoremax);
					var x = cord[0];
					var y =cord[1];
					var circle = new createCircle(x,y,moreDotSize[i]);
					var check = checkCollision(circle,morePlaceList);
					console.log(check);
					while (check>=1) {

						cord = coordinates(xMoremin,xMoremax);
						x = cord[0];
						y = cord[1];
						circle.attr({
							cx: x,
							cy: y });
						check =checkCollision(circle,morePlaceList);

					}
					moreGroup = s.group(moreGroup,circle);
					console.log(moreGroup);
					morePlaceList.push(circle);
					// circle.attr ({
					// 	fill: moreColor
					// });
				}
				// coloring both dots
				lessGroup.attr({fill: lessColor});
				moreGroup.attr({fill: moreColor}); // change color to whole group at once


				// adding end to runTrial() if not a callback function.
				// removing dots from screen
				setTimeout(function () {
                    moreGroup.remove();
                    lessGroup.remove();
                    rect.attr ({
                        fill: s.image("static/images/random_background.png",0,0,30,30).pattern(0,0,30,30)
                    });
                },500);

                // should add mask here.
                start_time = (new Date()).getTime();  // start measuring time elapsed until response

			}

			 setTimeout(runTrial,1250);
			 function ask() {
			 	var askWhich = s.text(300,350, storage.getTranslation("questionMoreDots")/*"Which color has more dots? [f] Blue  [j] Yellow?"*/); askWhich.attr({
                    fill: "white",
                    'font-size': 20
                });



								rect.attr ({
                    fill: "Gray"
                });
								// create two button for blue and yellow
								var block1 = s.circle(250, 450, 50,50);
								var block2 = s.circle(550,450,50,50);
								block1.attr({
									fill:"blue"
								})
								block2.attr({
									fill:"yellow"
								})
								var btn1 = s.group(block1);
								var btn2 = s.group(block2);
								btn1.click( function( ev  ) {
								    btn1.attr({ opacity: 0.5 });
										rt = (new Date()).getTime() - start_time - 1250; //delay of runTrial
										var response = 70;
										after_response(response);
								    });
								btn2.click( function( ev  ) {
								    btn2.attr({ opacity: 0.5 });
										rt = (new Date()).getTime() - start_time - 1250; //delay of runTrial
										var response = 74;
										after_response(response);
								    });
              //  setKeyboardListener();
			 }

			 setTimeout(ask, 2500);
				// store response
					var response = {rt: -1, key: -1};
				// function to end trial when it is time
				var end_trial = function() {

					// kill any remaining setTimeout handlers
					for (var i = 0; i < setTimeoutHandlers.length; i++) {
						clearTimeout(setTimeoutHandlers[i]);
					}

					// kill keyboard listeners
					if(typeof keyboardListener !== 'undefined'){
						jsPsych.pluginAPI.cancelKeyboardResponse(keyboardListener);
					}
					// setting variable of correct or incorrect answer (0 or 1)
					if (answer==response) {
						var crtAnswer = 1;

					} else {
						crtAnswer = 0;
					}
					// gather the data to store for the trial
					var trial_data = {
						"rt": rt,  // adding minux delay (should be 2500 or something like it). Same delay as ask()
						"lessDot": lessDot,
						"moreDot": moreDot,
						"actualRatio": actualRatio,
						"recPress": response,
						"moreColor": moreColor,
						"Answer": crtAnswer

					};

					jsPsych.data.write(trial_data);

					// clear the display
					display_element.html('');



					// move on to the next trial
					jsPsych.finishTrial();
				};

				// function to handle responses by the subject
				var after_response = function(info) {

					// after a valid response, the stimulus will have the CSS class 'responded'
					// which can be used to provide visual feedback that a response was recorded
					$("#jspsych-single-stim-stimulus").addClass('responded');

					// only record the first response
					if(response.key == -1){
						response = info;
					}

					if (trial.response_ends_trial) {
						end_trial();
					}
				};

                function setKeyboardListener () {
                    if(JSON.stringify(trial.choices) != JSON.stringify(["none"])) {
                        var keyboardListener = jsPsych.pluginAPI.getKeyboardResponse({
                            callback_function: after_response,
                            valid_responses: trial.choices,
                            rt_method: 'date',
                            persist: false,
                            allow_held_key: false
                        });
                    }
                }

				// hide image if timing is set
				if (trial.timing_stim > 0) {
					var t1 = setTimeout(function() {
						$('#jspsych-single-stim-stimulus').css('visibility', 'hidden');
					}, trial.timing_stim);
					setTimeoutHandlers.push(t1);
				}

				// end trial if time limit is set
				if (trial.timing_response > 0) {
					var t2 = setTimeout(function() {
						end_trial();
					}, trial.timing_response);
					setTimeoutHandlers.push(t2);
				}
			//} this is end of runTrial if I want to put everything in callback function


	};

		return plugin;
	})();
})(jQuery);
