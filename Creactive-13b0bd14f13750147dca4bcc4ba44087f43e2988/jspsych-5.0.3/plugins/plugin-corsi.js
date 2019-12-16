/* 
Corsi plugin. to use and operate corsi block.
accepts sequences (in arrays). 
direction ("forward" or "backward") - to set if user need to repeat same suqence or backwards.
timing_response - how many second to wait from first click until moving to next step
*/
  jsPsych.plugins['plugin-corsi'] = (function(){

    var plugin = {};

    plugin.trial = function(display_element, trial){

      trial = jsPsych.pluginAPI.evaluateFunctionParameters(trial);
      display_element.append('<canvas id="myCanvas" width="800" height="600">Your browser does not support the HTML5 canvas tag.</canvas>');
      
      // var timeout to use when time elapsed more then needed.
      var setTimeoutHandlers = [];
     

      function Shape(x, y, w, h, fill) {
            this.x = x;
            this.y = y;
            this.w = w;
            this.h = h;
            this.fill = fill;
        }
        
        // get canvas element.
        var elem = document.getElementById('myCanvas');
        if (elem && elem.getContext) {
          // list of rectangles to render
          var rects = [];
          rects.push(new Shape(20, 20, 100, 100, "#333"));  //building the rectangels
          rects.push(new Shape(400, 15, 100, 100, "#333"));
          rects.push(new Shape(650, 50, 100, 100, "#333"));
          rects.push(new Shape(260, 120, 100,100, "#333"));
          rects.push(new Shape(600,300,100,100,"#333"));
          rects.push(new Shape(150,320,100,100,"#333"));
          rects.push(new Shape(15,400,100,100,"#333"));
          rects.push(new Shape(200,450,100,100,"#333"));
          rects.push(new Shape(450,400,100,100,"#333"));
          rects.push(new Shape(660,450,100,100,"#333"));
        // get context
        var context = elem.getContext('2d');
        if (context) {

            for (var i = 0, len = rects.length; i < len; i++) {
              //display_element.append[rects[i]];
              context.fillRect(rects[i].x, rects[i].y, rects[i].w, rects[i].h);
            }

        }
      }

      //display_element.append('<p>This is the first paragraph</p>');
      //display_element.append('<p>This is the second paragraph</p>');
      function change_color(rect,delay1,delay2) {
       setTimeout(function() { context.fillStyle= "Yellow";
        context.fillRect(rect.x,rect.y,rect.w,rect.h);
        }, delay1);
        var myVar = setTimeout(function(){
        context.fillStyle="Black";
        context.fillRect(rect.x,rect.y,rect.w,rect.h);
      }, delay2); }// wait for 1000ms.

      function change_c(rect) {
        context.fillStyle= "Yellow";
        context.fillRect(rect.x,rect.y,rect.w,rect.h);
        var myVar = setTimeout(function(){
        context.fillStyle="Black";
        context.fillRect(rect.x,rect.y,rect.w,rect.h);
      }, 1000); 
      }

      function showRectangles() {
        //alert("Ready?");
        document.removeEventListener("mousedown", showRectangles);
        $("#readyPopup").remove();
        
        var rectTrial = trial.stimulus;
        var rectstr=[];
        delay1=0;
        delay2=1000;
        for (var i=0; i<rectTrial.length; i++) {
          rectangle=rectTrial[i];
          rectstr.push(rectangle);
          console.log(rectstr);
          delay1= delay1 + 1000;
          delay2= delay2 + 1000;
          change_color(rects[rectangle],delay1,delay2);
          
          }
          // build a function that wil listen to mouse clicks just after sequence was finished
        setTimeout(function() {
          console.log("Timeout called");
          document.getElementById("myCanvas").addEventListener('click', checkCol);
        }, delay2);  
           
         return rectstr;
      }
      
      function runTrial() {
        display_element.append("<div id=\"readyPopup\">" + storage.getTranslation("ReadyPopupText") + "</div>");
        document.addEventListener('mousedown', showRectangles);
      }
      
      // function to check collision
      function collides(rects, x, y) {
          var isCollision = false;
          for (var i = 0, len = rects.length; i < len; i++) {
              var left = rects[i].x, right = rects[i].x+rects[i].w;
              var top = rects[i].y, bottom = rects[i].y+rects[i].h;
              if (right >= x
                  && left <= x
                  && bottom >= y
                  && top <= y) {
                  isCollision = rects[i];
              }
          }
          
          return isCollision;
      }
      
      
        //if(JSON.stringify(trial.choices) != JSON.stringify(["none"])) {
       // elem.addEventListener('click', checkCol);

        // function that do things if collision occured.
        function checkCol(e) {
            console.log('click: ' + e.offsetX + '/' + e.offsetY);
            var canvas = $('#myCanvas');
            console.log('click: ' + (e.offsetX - canvas.offset().left) + '/' + (e.offsetY - canvas.offset().top));
            var rect = collides(rects, e.offsetX, e.offsetY);
            if (rect) {
                change_c(rect);
                responseSet.push(rect);
                respCount=respCount+1;
                // setting timer if pressed one time and waited
                if (respCount>=1) {
                  if (trial.timing_response > 0) {
                    var t2 = setTimeout(function() {
                      end_trial();
                    }, trial.timing_response);
                    setTimeoutHandlers.push(t2);
                  }
                }
                if (responseSet.length >= trial.stimulus.length) {
                    end_trial();
                } else {
                    responseSet = responseSet;
                    console.log('collision: ' + rect.x + '/' + rect.y);
                }
            } else {
                console.log('no collision');
                //response.push(rect);
            }
        }
     
      function runBlock() {
        
        respCount=[]; // counter for responses
        responseSet=[]; //check what was pressed
        rectstr = runTrial();
        
              
        
    }
      
      

      var response = {rt: -1, key: -1};

     
      var end_trial = function() {

        // kill any remaining setTimeout handlers
        for (var i = 0; i < setTimeoutHandlers.length; i++) {
          clearTimeout(setTimeoutHandlers[i]);
        }
        // check if the sequence that was pressed is identical to the one that was presented
        
        rectCompare=[]
        // should put here an if statement if direction is backward the loop should be reversed
        
        if (trial.direction == "forward") {
            for (i=0;i<responseSet.length;i++) {
              rectCompare.push(rects[trial.stimulus[i]]);
            } 
        } else if (trial.direction == "backward") {
            for (var i=(responseSet.length-1); i>=0; i--) {
                rectCompare.push(rects[trial.stimulus[i]]);
            }
        } else {
          console.log("Not valid");
        }
        
        
         
        
        if (JSON.stringify(responseSet) === JSON.stringify(rectCompare)) {
          var correctAns = 1;
          console.log("Ok");

        } else {
          correctAns = 0;
          console.log("mistake");
        }
        document.getElementById("myCanvas").removeEventListener('click',checkCol,false);

        // save data
        var trial_data = {
          "rt": response.rt,
          "stimulus": trial.stimulus,
          "direction": trial.direction,
          "correctAns": correctAns,
        };

        setTimeout(
            function () {
                display_element.html('');
                jsPsych.finishTrial(trial_data);
            },
            1000);
      }
      
      runBlock();
      
      console.log(trial.stimulus);
      
    }

    return plugin;

  })();
 