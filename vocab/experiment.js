//Dabrowska 2018, same "shortened version of the Vocabulary Size Test developed by Nation and Beglar"
//https://www.victoria.ac.nz/lals/about/staff/paul-nation#vocab-tests


/* ************************************ */
/* Define helper functions */
/* ************************************ */

function shuffle(arr) {
  for (let i = arr.length - 1; i > 0; i--) {
    let j = Math.floor(Math.random() * (i + 1)); // random index from 0 to i

    [arr[i], arr[j]] = [arr[j], arr[i]];
  }
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
  ["G key", 71],
  ["H key", 72],
  ["J key", 74]
]

var trials = [
    ["TALK", "speak", "draw", "eat", "sleep"],
    ["PERMIT", "allow", "sew", "cut", "drive"],
    // ["PARDON", "forgive", "pound", "divide", "tell"],
    // ["COUCH", "sofa", "pin", "eraser", "glass"],
    // ["REMEMBER", "recall", "swim", "number", "defy"],
    // ["TUMBLE", "fall", "drink", "dread", "think"],
    // ["HIDEOUS", "dreadful", "silvery", "tilted", "young"],
    // ["CORDIAL", "hearty", "swift", "muddy", "leafy"],
    // ["EVIDENT", "obvious", "green", "afraid", "sceptical"],
    // ["IMPOSTER", "pretender", "conductor", "officer", "book"],
    // ["MERIT", "deserve", "distrust", "fight", "separate"],
    // ["FASCINATE", "enchant", "welcome", "fix", "stir"],
    // ["INDICATE", "signify", "defy", "excite", "bicker"],
    // ["IGNORANT", "uninformed", "red", "sharp", "precise"],
    // ["FORTIFY", "strengthen", "submerge", "vent", "deaden"],
    // ["RENOWN", "fame", "length", "head", "loyalty"],
    // ["NARRATE", "tell", "yield", "buy", "associate"],
    // ["MASSIVE", "large", "bright", "speedy", "low"],
    // ["HILARITY", "laughter", "speed", "grace", "malice"],
    // ["SMIRCHED", "soiled", "stolen", "pointed", "remade"],
    // ["SQUANDER", "waste", "tease", "belittle", "cut"],
    // ["CAPTION", "heading", "drum", "ballet", "ape"],
    // ["FACILITATE", "help", "turn", "strip", "bewilder"],
    // ["JOCOSE", "humorous", "paltry", "fervid", "plain"],
    // ["APPRISE", "inform", "reduce", "strew", "delight"],
    // ["RUE", "lament", "eat", "dominate", "cure"],
    // ["DENIZEN", "inhabitant", "senator", "fish", "atom"],
    // ["DIVEST", "dispossess", "intrude", "rally", "pledge"],
    // ["AMULET", "charm", "orphan", "dingo", "pond"],
    // ["INEXORABLE", "rigid", "involatile", "untidy", "sparse"],
    // ["SERRATED", "notched", "dried", "armed", "blunt"],
    // ["LISSOM", "loose", "moldy", "supple", "convex"],
    // ["MOLLIFY", "mitigate", "direct", "pertain", "abuse"],
    // ["PLAGIARIZE", "appropriate", "intend", "revoke", "maintain"],
    // ["ORIFICE", "hole", "brush", "building", "lute"],
    // ["QUERULOUS", "complaining", "maniacal", "curious", "devout"],
    // ["PARIAH", "outcast", "priest", "lentil", "locker"],
    // ["ABET", "incite", "waken", "ensue", "placate"],
    // ["TEMERITY", "rashness",  "timidity", "desire", "kindness"],
    // ["PRISTINE", "first", "vain", "sound", "level"]
]

var blocks_list = jsPsych.randomization.repeat(trials, 1)

/* ************************************ */
/* Set up jsPsych blocks */
/* ************************************ */

// task specific variables
/* define static blocks */
var end_block = {
  type: 'poldrack-text',
  timing_response: 180000,
  data: {
    exp_id: "timed_vocab",
    trial_id: "end"
  },
  text: '<div class = centerbox><p class = center-block-text>Thanks for completing this task!</p><p class = center-block-text>Press <strong>enter</strong> to continue.</p></div>',
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
    '<div class = centerbox><p class = block-text>In this task, you will be shown a CAPITALIZED WORD, together with an example of how it is used.</p>'+
	'<p class = block-text>Select the option that BEST fits the meaning of the word and press the corresponding letter on the keyboard.</p>'+
  '<p class = block-text>Important! Please be sure to keep all other browser windows closed while doing this task.</p>'+
  '<p class = block-text>Our algorithm is very sensitive and may flag your responses as being suspicious if other tabs, windows, or programs are open.</p>'+
  '<p class = block-text><b>You will have a set amount of time to answer each question.</b>'+
  " If you do not answer in time, don't worry, just continue to the next question. </p></div>"
  ],
  allow_keys: false,
  data: {
    exp_id: "vocab_timed",
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

/* define test block tasks*/
var vocab_task = {
  type: 'poldrack-categorize',
  is_html: true,
  choices: [possible_responses[0][1], possible_responses[1][1], possible_responses[2][1], possible_responses[3][1]],
  data: {
    trial_id: "task",
    exp_stage: "test"
  },
  timing_stim: -1,
  response_ends_trial: true,
  timing_response: 8 * 1000,
  timing_feedback_duration: -1,
  timing_feedback_duration: 1000,
  show_stim_with_feedback: false,
  timing_post_trial: 1,
  timeout_message: '<div class = centerbox><div class = center-text>Out of time</div></div>',
  correct_text: '<div class = centerbox><div class = center-text>+</div>',
  incorrect_text: '<div class = centerbox><div class = center-text>+</div>'

};


/* ************************************ */
/* Set up experiment */
/* ************************************ */

var vocab_timed_experiment = []
vocab_timed_experiment.push(instruction_node);

for (b = 0; b < blocks_list.length; b++) {

	cue = blocks_list[b][0]

	random_order = [1,2,3,4]
	shuffle(random_order)

	f_choice = blocks_list[b][random_order[0]]
	g_choice = blocks_list[b][random_order[1]]
	h_choice = blocks_list[b][random_order[2]]
	j_choice = blocks_list[b][random_order[3]]

	task = jQuery.extend(true, {}, vocab_task)
	task.stimulus = '<div class = centerbox><div class =  center-block-text>' + cue + '</div>' +
						'<table style="margin-left:auto;margin-right:auto;">' +
							'<tr class = block-text> <td><b>F.</b> </td><td>' + f_choice + '</td></tr>' +
							'<tr class = block-text> <td><b>G.</b> </td><td>' + g_choice + '</td></tr>' +
							'<tr class = block-text> <td><b>H.</b> </td><td>' + h_choice + '</td></tr>' +
							'<tr class = block-text> <td><b>J.</b> </td><td>' + j_choice + '</td></tr>' +
						'</table>'+
					'</div>'

	task.key_answer = possible_responses[random_order.indexOf(1)][1];
    vocab_timed_experiment.push(task)
}
vocab_timed_experiment.push(end_block)
