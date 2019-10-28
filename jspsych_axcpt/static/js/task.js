    var test_stimuli = [
      ["A"," ", "X"], 
      ["A"," ", "Y"],
      ["B"," ", "X"],
      ["B"," ", "Y"]
    ];

    var responses = [
    	[70,74]
    ];

    var all_trials = jsPsych.randomization.repeat(test_stimuli, 10, true);

    var post_trial_gap = function() {
      return Math.floor( Math.random() * 1500 ) + 750;
    }

    var test_block = {
      type: "multi-stim-single-response",
      stimuli: test_stimuli,
      is_html: true,
      choices: responses,
      data: all_trials.data,
      timing_stim: [500, 2000, -1],
      timing_response: 5000,
      timing_post_trial: post_trial_gap,
      on_finish: function() { 
    	console.log(jsPsych.data.getLastTrialData());
  	}
    };

    var debrief_block = {
      type: "text",
      text: function() {
        return "debriefing!"
      }
    };

    /* create experiment definition array */
    var experiment = [];
    experiment.push(test_block);
    experiment.push(debrief_block);

    /* start the experiment */
    jsPsych.init({
      experiment_structure: experiment,
      on_finish: function() {
        jsPsych.data.displayData();
      }
    });