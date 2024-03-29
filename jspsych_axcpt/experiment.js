//To do Feb 5: recheck timing
/* ************************************ */
/* Define helper functions */
/* ************************************ */
function evalAttentionChecks() {
  var check_percent = 1
  if (run_attention_checks) {
    var attention_check_trials = jsPsych.data.getTrialsOfType('attention-check')
    var checks_passed = 0
    for (var i = 0; i < attention_check_trials.length; i++) {
      if (attention_check_trials[i].correct === true) {
        checks_passed += 1
      }
    }
    check_percent = checks_passed / attention_check_trials.length
  }
  return check_percent
}

var getChar = function() {
  return '<div class = centerbox><div class = AX_text>' + chars[Math.floor(Math.random() * 22)] +
    '</div></div>'
}

var getChar_red = function() {
  return '<div class = centerbox><div class = AX_text style="color:red;">' + chars[Math.floor(Math.random() * 22)] +
    '</div></div>'
}

var getInstructFeedback = function() {
    return '<div class = centerbox><p class = center-block-text>' + feedback_instruct_text +
      '</p></div>'
  }
  /* ************************************ */
  /* Define experimental variables */
  /* ************************************ */
  // generic task variables
var sumInstructTime = 0 //ms
var instructTimeThresh = 0 ///in seconds

// task specific variables
var possible_responses = [
  ["F key", 70],
  ["J key", 74]
]
var chars = 'BCDEFGHIJLMNOPQRSTUVWZ'
var practice_proportions = ["AX"]
var practice_blocks = jsPsych.randomization.repeat(practice_proportions, 1)
//directly below is the current version
var trial_proportions = ["AX", "AX", "AX", "AX", "AX", "AX", "AX", "AX","AX", "AX","AX", "AX","AX", "AX","AX", "AX","AX", "BX","BX","BX","BX","AY", "AY","AY","AY","BY","BY", "BY"] //60-15-15-10 % like Lopez-Garcia (reduced to 28 trials from 34)
// OLD // var trial_proportions = ["AX", "AX", "AX", "AX", "AX", "AX", "AX", "AX","AX", "AX","AX", "AX","AX", "AX","AX", "AX","AX", "AX","AX", "AX","AX", "AX","AX", "AX", "BX","BX","BX","BX","AY", "AY","AY","AY","BY","BY"]
var block1_list = jsPsych.randomization.repeat(trial_proportions, 1)
var block2_list = jsPsych.randomization.repeat(trial_proportions, 1)
var blocks = [block1_list] //removed block2_list

//Original Setup:
// var chars = 'BCDEFGHIJLMNOPQRSTUVWZ'
// var trial_proportions = ["AX", "AX", "AX", "AX", "AX", "AX", "AX", "BX", "AY", "BY"]
// var block1_list = jsPsych.randomization.repeat(trial_proportions, 1)
// var block2_list = jsPsych.randomization.repeat(trial_proportions, 1)
// var block3_list = jsPsych.randomization.repeat(trial_proportions, 1)
// var blocks = [block1_list, block2_list, block3_list]

/* ************************************ */
/* Set up jsPsych blocks */
/* ************************************ */
// Set up attention check node
var attention_check_block = {
  type: 'attention-check',
  data: {
    trial_id: "attention_check"
  },
  timing_response: 180000,
  response_ends_trial: true,
  timing_post_trial: 200
}

var attention_node = {
  timeline: [attention_check_block],
  conditional_function: function() {
    return run_attention_checks
  }
}

//Set up post task questionnaire
var post_task_block = {
   type: 'survey-text',
   data: {
       trial_id: "post task questions"
   },
   questions: ['<p class = center-block-text style = "font-size: 20px">Please summarize what you were asked to do in this task.</p>',
              '<p class = center-block-text style = "font-size: 20px">Do you have any comments about this task?</p>'],
   rows: [15, 15],
   columns: [60,60]
};

// generic task variables
var run_attention_checks = false
var attention_check_thresh = 0.65

// task specific variables
/* define static blocks */
var end_block = {
  type: 'poldrack-text',
  timing_response: 180000,
  data: {
    exp_id: "ax_cpt",
    trial_id: "end"
  },
  text: '<div class = centerbox><p class = center-block-text>Thanks for completing this task! Press enter to continue.</p></div>',
  cont_key: [13],
  timing_post_trial: 0
};

var feedback_instruct_text =
  'Welcome to the next task. Press <strong>enter</strong> to begin.'
var feedback_instruct_block = {
  type: 'poldrack-text',
  cont_key: [13],
  text: getInstructFeedback,
  data: {
    trial_id: 'instruction'
  },
  timing_post_trial: 0,
  timing_response: 180000
};
/// This ensures that the subject does not read through the instructions too quickly.  If they do it too quickly, then we will go over the loop again.
var instructions_block = {
  type: 'poldrack-instructions',
  pages: [
    '<div class = centerbox><p class = block-text>In this task, you will see a red letter, followed by multiple black letters, and finally, another red letter. That forms one set. Then, a new set will start. </p><p class = block-text>Your job is to respond by pressing the "J" key after ALL letters EXCEPT if the first red letter in the set was an "A" and the current letter is a RED "X".<b> If the first red letter was an "A" <strong>AND</strong> the current letter is a red "X", press the ' +
    possible_responses[0][0] + '. Otherwise press the ' + possible_responses[1][0] +
    ' after every letter.</b> </p><p class = block-text>Important: Do not press any keys before you see a letter. If you press a key before the letter is shown, you will lose a point for this section.</div>',
    '<div class = centerbox><p class = block-text>You will now see a practice set. Press J after every letter, except the second red letter. At the second red letter, press F if the first red letter was an A and the current (red) letter is an X. Otherwise, press J again.</p></div>'
  ],
  allow_keys: false,
  data: {
    exp_id: "ax_cpt",
    trial_id: 'instruction'
  },
  show_clickable_nav: true,
  timing_post_trial: 01000
};

var instruction_node = {
  timeline: [feedback_instruct_block, instructions_block],
  /* This function defines stopping criteria */
  loop_function: function(data) {
    for (i = 0; i < data.length; i++) {
      if ((data[i].trial_type == 'poldrack-instructions') && (data[i].rt != -1)) {
        rt = data[i].rt
        sumInstructTime = sumInstructTime + rt
      }
    }
    if (sumInstructTime <= instructTimeThresh * 1000) {
      feedback_instruct_text =
        'Read through instructions too quickly.  Please take your time and make sure you understand the instructions.  Press <strong>enter</strong> to continue.'
      return true
    } else if (sumInstructTime > instructTimeThresh * 1000) {
      feedback_instruct_text =
        'Done with instructions. Press <strong>enter</strong> to continue.'
      return false
    }
  }
}


var start_test_block = {
  type: 'poldrack-text',
  timing_response: 180000,
  data: {
    trial_id: "test_intro"
  },
  text: '<div class = centerbox><p class = center-block-text>We will now start the test. Remember, press J after every letter unless the first red letter was an A and the current letter is a red X.</p><p class = center-block-text> This task will take 5-7min.</p>, <p class = center-block-text> Press enter to continue.</p></div>',
  cont_key: [13],
  timing_post_trial: 1000,
  on_finish: function() {
  	current_trial = 0
  }
};

var rest_block = {
  type: 'poldrack-text',
  timing_response: 180000,
  data: {
    trial_id: "rest"
  },
  text: '<div class = centerbox><p class = block-text>Take a break! Press enter to continue.</p></div>',
  timing_post_trial: 1000
};

var wait_block = {
  type: 'poldrack-single-stim',
  // stimulus: '<div class = centerbox><div class = AX_text>+</div></div>',
  stimulus: '<div class = centerbox><div class = AX_feedback>Press any key to continue to the next set of letters.</div></div>',
  is_html: true,
  data: {
    trial_id: "wait"
  },
  response_ends_trial: true
  //choices: 'none',
	//timing_stim: 1000,
	//timing_response: 1000,
	//timing_post_trial: 0
}

/* define test block cues and probes*/
var A_cue = {
  type: 'poldrack-categorize',
  stimulus: '<div class = centerbox><div style="color:red"; class = AX_text>A</div></div>',
  is_html: true,
  response_ends_trial: true,
  choices: [possible_responses[0][1], possible_responses[1][1]],
  data: {
    trial_id: "cue",
    exp_stage: "test"
  },
  key_answer: 74,
  timing_stim: -1, //was 500
  timing_feedback_duration: 750,
  //timing_response: 2000,
  correct_text: '<div class = centerbox><div style="color:green"; class = center-text>Correct!</div></div>',
  incorrect_text: '<div class = centerbox><div style="color:red"; class = center-text>Incorrect</div></div>',
  show_stim_with_feedback: false,
  timeout_message: '<div class = centerbox><div style="color:black; font-size: 40px;"; class = center-text-varsize>Respond faster</div></div>'
};

var other_cue = {
  type: 'poldrack-categorize',
  stimulus: getChar_red,
  is_html: true,
  response_ends_trial: true,
  choices: [possible_responses[0][1], possible_responses[1][1]],
  data: {
    trial_id: "cue",
    exp_stage: "test"
  },
  key_answer: 74,
  timing_stim: -1,
  timing_feedback_duration: 750,
  //timing_response: 2000,
  correct_text: '<div class = centerbox><div style="color:green"; class = center-text>Correct!</div></div>',
  incorrect_text: '<div class = centerbox><div style="color:red"; class = center-text>Incorrect</div></div>',
  show_stim_with_feedback: false,
  timeout_message: '<div class = centerbox><div style="color:black; font-size: 40px;"; class = center-text-varsize>Respond faster</div></div>'
};

var distractor = {
  type: 'poldrack-categorize',
  stimulus: getChar,
  is_html: true,
  response_ends_trial: true,
  choices: [possible_responses[0][1], possible_responses[1][1]],
  data: {
    trial_id: "distractor",
    exp_stage: "test"
  },
  key_answer: 74,
  timing_stim: -1,
  timing_feedback_duration: 750,
  //timing_response: 2000,
  correct_text: '<div class = centerbox><div style="color:green"; class = center-text>Correct!</div></div>',
  incorrect_text: '<div class = centerbox><div style="color:red"; class = center-text>Incorrect</div></div>',
  show_stim_with_feedback: false,
  timeout_message: '<div class = centerbox><div style="color:black; font-size: 40px;"; class = center-text-varsize>Respond faster</div></div>'
};

var X_probe = {
  type: 'poldrack-categorize',
  stimulus: '<div class = centerbox><div style="color:red"; class = AX_text>X</div></div>',
  is_html: true,
  choices: [possible_responses[0][1], possible_responses[1][1]],
  data: {
    trial_id: "probe",
    exp_stage: "test"
  },
  timing_stim: -1,
  response_ends_trial: true,
  timing_feedback_duration: 750,
  //timing_response: 2000,
  correct_text: '<div class = centerbox><div style="color:green"; class = center-text>Correct!</div></div>',
  incorrect_text: '<div class = centerbox><div style="color:red"; class = center-text>Incorrect</div></div>',
  show_stim_with_feedback: false,
  timeout_message: '<div class = centerbox><div style="color:black; font-size: 40px;"; class = center-text-varsize>Respond faster</div></div>'
};

var other_probe = {
  type: 'poldrack-categorize',
  stimulus: getChar_red,
  is_html: true,
  choices: [possible_responses[0][1], possible_responses[1][1]],
  data: {
    trial_id: "probe",
    exp_stage: "test"
  },
  timing_stim: -1,
  response_ends_trial: true,
  timing_feedback_duration: 750,
  //timing_response: 2000,
  correct_text: '<div class = centerbox><div style="color:green"; class = center-text>Correct!</div></div>',
	incorrect_text: '<div class = centerbox><div style="color:red"; class = center-text>Incorrect</div></div>',
  show_stim_with_feedback: false,
  timeout_message: '<div class = centerbox><div style="color:black; font-size: 40px;"; class = center-text-varsize>Respond faster</div></div>'
};

var X_probe_practice = {
  type: 'poldrack-categorize',
  stimulus: '<div class = centerbox><div style="color:red"; class = AX_text>X</div></div>',
  is_html: true,
  choices: [possible_responses[0][1], possible_responses[1][1]],
  data: {
    trial_id: "probe",
    exp_stage: "test"
  },
  timing_stim: -1,
  key_answer: 70,
  response_ends_trial: true,
  timing_feedback_duration: 750,
  //timing_response: 2000,
  correct_text: '<div class = centerbox><div style="color:green"; class = center-text>Correct!</div></div>',
  incorrect_text: '<div class = centerbox><div style="color:red"; class = center-text>Incorrect</div></div>',
  show_stim_with_feedback: false,
  timeout_message: '<div class = centerbox><div style="color:black; font-size: 40px;"; class = center-text-varsize>Respond faster</div></div>'
};

/* ************************************ */
/* Set up experiment */
/* ************************************ */

var ax_cpt_experiment = []
ax_cpt_experiment.push(instruction_node);


ax_cpt_experiment.push(A_cue);
ax_cpt_experiment.push(distractor);
ax_cpt_experiment.push(distractor);
ax_cpt_experiment.push(distractor);
ax_cpt_experiment.push(X_probe_practice);
ax_cpt_experiment.push(wait_block);

ax_cpt_experiment.push(start_test_block);


for (b = 0; b < blocks.length; b++) {
  var block = blocks[b]
  for (i = 0; i < block.length; i++) {
    switch (block[i]) {
      case "AX":
        cue = jQuery.extend(true, {}, A_cue)
        probe = jQuery.extend(true, {}, X_probe)
        cue.data.condition = "AX"
        probe.data.condition = "AX"
		probe.key_answer = 70
        break;
      case "BX":
        cue = jQuery.extend(true, {}, other_cue)
        probe = jQuery.extend(true, {}, X_probe)
        cue.data.condition = "BX"
        probe.data.condition = "BX"
		probe.key_answer = 74
        break;
      case "AY":
        cue = jQuery.extend(true, {}, A_cue)
        probe = jQuery.extend(true, {}, other_probe)
        cue.data.condition = "AY"
        probe.data.condition = "AY"
		probe.key_answer = 74
        break;
      case "BY":
        cue = jQuery.extend(true, {}, other_cue)
        probe = jQuery.extend(true, {}, other_probe)
        cue.data.condition = "BY"
        probe.data.condition = "BY"
		probe.key_answer = 74
        break;
    }

	distractor_1 = jQuery.extend(true, {}, distractor)
	distractor_2 = jQuery.extend(true, {}, distractor)
	distractor_3 = jQuery.extend(true, {}, distractor)

    ax_cpt_experiment.push(cue)
	ax_cpt_experiment.push(distractor_1)
	ax_cpt_experiment.push(distractor_2)
	ax_cpt_experiment.push(distractor_3)
    ax_cpt_experiment.push(probe)
    ax_cpt_experiment.push(wait_block)
  }
  ax_cpt_experiment.push(attention_node)
}
ax_cpt_experiment.push(post_task_block)
ax_cpt_experiment.push(end_block)
