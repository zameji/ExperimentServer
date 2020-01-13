// Author recognition task
// source: Acheson et al. 2008, Hintz & Brysbaert 2019, Mar et al 2006 (updated version with different genres, what we use here)


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
  ["J key", 74]
]

var trials = [
    ["Sidney Sheldon", 70],
    ["Danielle Steele", 70],
    ["Jackie Collins", 70],
    ["Judith Krantz", 70],
    ["Nora Roberts", 70],
    ["Iris Johansen", 70],
    ["Diana Palmer", 70],
    ["Catherine Anderson", 70],
    ["Joy Fielding", 70],
    ["Nicholas Sparks", 70],
    ["Stephen Hawking", 70],
    ["Stephen J. Gould", 70],
    ["Richard Dawkins", 70],
    ["Thomas Kuhn", 70],
    ["Ernst Mayr", 70],
    ["Douglas Rushkoff", 70],
    ["Amir D. Aczel", 70],
    ["Robert Jordan", 70],
    ["Douglas Adams", 70],
    ["Anne McCaVrey", 70],
    ["William Gibson", 70],
    ["Terry Brooks", 70],
    ["Terry Goodkind", 70],
    ["Piers Anthony", 70],
    ["Arthur C. Clarke", 70],
    ["Ray Bradbury", 70],
    ["Ursula K. Le Guin", 70],
    ["Roland Barthes", 70],
    ["John Searle", 70],
    ["Jean Baudrillard", 70],
    ["Michel Foucault", 70],
    ["Bertrand Russell", 70],
    ["Antonio Damasio", 70],
    ["Daniel Goleman", 70],
    ["Dean Koontz", 70],
    ["John LeCarré", 70],
    ["Robert Ludlum", 70],
    ["Clive Cussler", 70],
    ["Sue Grafton", 70],
    ["Ian Rankin", 70],
    ["P. D. James", 70],
    ["John Saul", 70],
    ["Patricia Cornwell", 70],
    ["Ken Follett", 70],
    ["Noam Chomsky", 70],
    ["Norman Mailer", 70],
    ["Michael Moore", 70],
    ["Eric Schlosser", 70],
    ["Bob Woodward", 70],
    ["Pierre Berton", 70],
    ["Naomi Klein", 70],
    ["John Updike", 70],
    ["W. O. Mitchell", 70],
    ["Alice Munro", 70],
    ["Maeve Binchy", 70],
    ["Carol Shields", 70],
    ["John Irving", 70],
    ["Toni Morrison", 70],
    ["Amy Tan", 70],
    ["Rohinton Mistry", 70],
    ["Sinclair Ross", 70],
    ["Jack Canfield", 70],
    ["Philip C. McGraw", 70],
    ["M. Scott Peck", 70],
    ["Robert Fulghum", 70],
    ["Erma Bombeck", 70],
    ["Jean Vanier", 70],
    ["Stephen R. Covey", 70],
    ["José Saramago", 70],
    ["Yukio Mishima", 70],
    ["Gabriel Garcia Marquez", 70],
    ["Albert Camus", 70],
    ["Umberto Eco", 70],
    ["Milan Kundera", 70],
    ["Paulo Coelho", 70],
    ["W. G. Sebald", 70],
    ["Italo Calvino", 70],
    ["Thomas Mann", 70],
    ["Faith Popcorn", 70],
    ["Jim Collins", 70],
    ["Napoleon Hill", 70],
    ["Robert T. Kiyosaki", 70],
    ["Stephen C. Lundin", 70],
    ["Peter S. Pande", 70],
    ["Kenneth H. Blanchard", 70],
    ["Matt Ridley", 70],
    ["John Maynard Smith", 70],
    ["Diane Ackerman", 70],
    ["Jeffrey Gray", 70],
    ["Joseph LeDoux", 70],
    ["Oliver Sacks", 70],
    ["Naomi Wolf", 70],
    ["Robert D. Kaplan", 70],
    ["Susan Sontag", 70],
    ["Melody Beattie", 70],
    ["Deepak Chopra", 70],
    ["Marianne Williamson", 70],
    ["Peter F. Drucker", 70],
    ["Barry Z. Posner", 70],
    ["M. D. Johnson Spencer", 70],
    ["Lauren Adamson", 74],
    ["Eric Amsel", 74],
    ["Margaritia Azmitia", 74],
    ["Oscar Barbarin", 74],
    ["Reuben Baron", 74],
    ["Gary Beauchamp", 74],
    ["Thomas Bever", 74],
    ["Elliot Blass", 74],
    ["Dale Blyth", 74],
    ["Hilda Borko", 74],
    ["John Condry", 74],
    ["Edward Cornell", 74],
    ["Carl Corter", 74],
    ["Diane Cuneo", 74],
    ["Denise Daniels", 74],
    ["Geraldine Dawson", 74],
    ["Aimee Dorr", 74],
    ["W Patrick Dickson", 74],
    ["Robert Emery", 74],
    ["Frances Fincham", 74],
    ["Martin Ford", 74],
    ["Harold Gardin", 74],
    ["Frank Gresham", 74],
    ["Robert Inness", 74],
    ["Frank Keil", 74],
    ["Reed Larson", 74],
    ["Lynn Liben", 74],
    ["Hugh Lytton", 74],
    ["Franklin Manis", 74],
    ["Morton Mendelson", 74],
    ["James Morgan", 74],
    ["Scott Paris", 74],
    ["Richard Passman", 74],
    ["David Perry", 74],
    ["Miriam Sexton", 74],
    ["K Warner Schaie", 74],
    ["Robert Siegler", 74],
    ["Mark Strauss", 74],
    ["Alister Younger", 74],
    ["Steve Yussen", 74]
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
  'Welcome to the experiment. Press <strong>enter</strong> to begin.'
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
    '<div class = centerbox><p class = block-text>In this task, you will be shown several names. Some of them are authors (that is, anyone who has written at least one book), some non-authors.</p>'+
	"<p class = block-text>Press F if you know an author with the name shown. Press J otherwise.</p>"+
	'<p class = block-text>Do not guess. You will lose a point for every name you select who is not an author.</p></div>'
  ],
  allow_keys: false,
  data: {
    exp_id: "vocab_timed4",
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
var art_task = {
  type: 'poldrack-categorize',
  is_html: true,
  choices: [possible_responses[0][1], possible_responses[1][1]],
  data: {
    trial_id: "task",
    exp_stage: "test"
  },
  // timing_stim: null,
  // response_ends_trial: true,
  // timing_response: 5 * 1000,
  // timing_feedback_duration: 0,
  timing_stim: null,
  response_ends_trial: true,
  timing_response: 5 * 1000,
  timing_feedback_duration: 1,
  show_stim_with_feedback: false,
  timing_post_trial: 1000,
  timeout_message: '<div class = centerbox><div class = center-text>Respond faster</div></div>',
  // show_stim_with_feedback: false,
  // timing_post_trial: 1,
  correct_text: '<p class = AX_text style="color:white;"> </p>',
  incorrect_text: '<p class = AX_text style="color:white;"> </p>',
  timeout_message: '<div class = centerbox><div class = center-text>Respond faster</div></div>',

};


/* ************************************ */
/* Set up experiment */
/* ************************************ */

var vocab_timed_experiment2 = []
vocab_timed_experiment2.push(instruction_node);

for (b = 0; b < blocks_list.length; b++) {

	cue = blocks_list[b][0]

	task = jQuery.extend(true, {}, art_task)
	task.stimulus = '<div class = centerbox><div class =  center-text>' + cue + '</div></div>'

	task.key_answer =  blocks_list[b][1];
    vocab_timed_experiment2.push(task)
}
vocab_timed_experiment2.push(end_block)
