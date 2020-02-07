//source: Words that Go Together, Dabrowska 2015

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
  ["J key", 74],
  ["K key", 75]
]

var trials = [
    ["blatant lie", "clear lie", "conspicuous lie", "distinct lie", "recognizable lie"],
    ["blank expression", "frightful expression", "plain expression", "sinster expression", "terrible expression"],
    // ["attact publicity", "bring publicity", "make publicity", "win publicity", "attain publicity"],
    // ["fair share", "honest share", "just share", "legitimate share", "reasonable share"],
    // ["arouse suspicions", "incite suspicions", "kindle suspicions", "revive suspicions", "stimulate suspicions"],
    // ["raise prices","elevate prices", "grow prices", "lift prices", "stimulate prices"],
    // ["hazard a guess", "chance a guess", "dare a guess", "gamble a guess", "risk a guess"],
    // ["bend rules", "honour rules", "institute rules", "reject rules", "validate rules"],
    // ["issue a statement", "believe a statement", "change a statement", "offer a statement", "revise a statement"],
    // ["raise standards", "advance standards", "boost standards", "elevate standards", "lift standards"],
    // ["boost production", "double production", "enlarge production", "extend production", "redouble production"],
    // ["join the ranks", "combine the ranks", "conjoin the ranks", "merge the ranks", "unify the ranks"],
    // ["bitter dispute", "cruel dispute", "hard dispute", "harsh dispute", "savage dispute"],
    // ["absolute silence", "pure silence", "sheer silence", "stark silence", "supreme silence"],
    // ["full confession", "complete confession", "exhaustive confession", "extensive confession", "thorough confession"],
    // ["gain popularity", "acquire popularity", "attract popularity", "earn popularity", "get popularity"],
    // ["regular employment",  "constant employment", "normal employment", "ordinary employment", "unbroken employment"],
    // ["witness an incident", "glimpse an incident", "notice an incident", "observe an incident", "see an incident"],
    // ["achieve one's objectives", "complete one's objectives", "finish one's objectives", "follow one's objectives", "tackle one's objectives"],
    // ["general direction", "accurate direction", "appropriate direction", "convenient direction", "specific direction"],
    // ["divert attention", "apply attention", "dedicate attention", "grasp attention", "sidetrack attention"],
    // ["serious problem", "extensive problem", "extreme problem", "significant problem", "vital problem"],
    // ["urgent matters", "compelling matters", "critical matters",  "desperate matters", "major matters"],
    // ["close similarity", "doubtful similarity",  "evident similarity", "evident similarity", "extreme similarity", "near similarity"],
    // ["hear rumours", "contradict rumours", "discover rumours", "know rumours", "tell rumours"],
    // ["memorable phrase", "effective phrase", "helpful phrase", "noteworthy phrase", "significant phrase"],
    // ["divert suspicion", "distract suspicion", "mislead suspicion", "redirect suspicion", "sidetrack suspicion"],
    // ["restore faith", "instil faith", "bring faith", "offer faith", "refresh faith"],
    // ["thorough search", "complete search", "full search", "scrupulous search", "total search"],
    // ["precise details", "abundant details", "complete details",  "definite details", "small details"],
    // ["inflict punishment",  "apply punishment", "deliver punishment", "perform punishment", "provide punishment"],
    // ["attractive proposition", "appealing proposition", "charming proposition", "inviting proposition", "seductive proposition"],
    // ["dim view", "dark view", "murky view",  "shadowy view", "shady view"],
    // ["outspoken critic",  "aggressive critic",  "forthright critic", "frank critic", "open critic"],
    // ["odd remark", "peculiar remark", "queer remark", "unnatural remark", "weird remark"],
    // ["striking example", "distinct example", "gross example", "recognizable example", "shocking example"],
    // ["lodge a complaint", "formulate a complaint", "place a complaint",  "record a complaint", "write a complaint"],
    // ["obvious conclusion", "confident conclusion", "evident conclusion", "solid conclusion", "sure conclusion"],
    // ["overall responsibility", "general responsibility", "large responsibility", "single responsibility", "unique responsibility"],
    // ["refuse an application", "decline an application", "deny an application", "ignore an application", "scrap an application"]
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
    exp_id: "colloc",
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
    '<div class = centerbox><p class = block-text><b>Words that Go Together</b></p>'+
		'<p class = block-text>This questionnaire consists of sets of five phrases. From each set, <b>choose one phrase that sounds the most natural or familiar. If you are not sure, guess. </b>Here are two examples:.</p>'+
		'<p class = block-text>delicate tea <br>feeble tea <br>frail tea <br> powerless tea <br><b> weak tea</b></p>'+
		'<p class = block-text><b>deliver a speech</b> <br>hold a speech <br>perform a speech <br>present a speech <br>utter a speech</p>'+
		'<p class = block-text>The words delicate, feeble, frail, powerless and weak are similar in meaning; but with tea, we would normally use <b>weak</b>. In the second example, <b>deliver</b> a speech sounds more natural than the other choices.</p>'+
	'</div>'
  ],
  allow_keys: false,
  data: {
    exp_id: "colloc",
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
var colloc_task = {
  type: 'poldrack-categorize',
  is_html: true,
  choices: [possible_responses[0][1], possible_responses[1][1], possible_responses[2][1], possible_responses[3][1], possible_responses[4][1]],
  data: {
    trial_id: "task",
    exp_stage: "test"
  },
  timing_stim: -1,
  response_ends_trial: true,
  timing_response: -1,
  timing_feedback_duration: 1,
  timing_post_trial: 1,
  correct_text: "Correct",
  incorrect_text: "False"

};


/* ************************************ */
/* Set up experiment */
/* ************************************ */

var colloc_timed_experiment = []
colloc_timed_experiment.push(instruction_node);

for (b = 0; b < blocks_list.length; b++) {


	random_order = [0,1,2,3,4]
	shuffle(random_order)

	f_choice = blocks_list[b][random_order[0]]
	g_choice = blocks_list[b][random_order[1]]
	h_choice = blocks_list[b][random_order[2]]
	j_choice = blocks_list[b][random_order[3]]
	k_choice = blocks_list[b][random_order[4]]

	task = jQuery.extend(true, {}, colloc_task)
	task.stimulus = '<div class = centerbox>'+
						'<table style="margin-left:auto;margin-right:auto;">' +
						'<tr class = block-text> <td><b>F.</b> </td><td>' + f_choice + '</td></tr>' +
						'<tr class = block-text> <td><b>G.</b> </td><td>' + g_choice + '</td></tr>' +
						'<tr class = block-text> <td><b>H.</b> </td><td>' + h_choice + '</td></tr>' +
						'<tr class = block-text> <td><b>J.</b> </td><td>' + j_choice + '</td></tr>' +
						'<tr class = block-text> <td><b>K.</b> </td><td>' + k_choice + '</td></tr>' +
						'</table>'+
					'</div>'

	task.key_answer = possible_responses[random_order.indexOf(0)][1];
    colloc_timed_experiment.push(task)
}
colloc_timed_experiment.push(end_block)
