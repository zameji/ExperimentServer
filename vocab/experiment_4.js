//source: Shipley & Burlingame 1941

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
    ["SOLDIER: He is a soldier.", "person in the army", "person in a business", "student", "person who uses metal"],
    ["JUG: He was holding a jug.", "A container for pouring liquids", "an informal discussion", "A soft cap", "A weapon that explodes"],
    ["DINOSAUR: The children were pretending to be dinosaurs.", "animals that lived a long time ago", "robbers who work at sea", "very small creatures with human form but with wings", "large creatures with wings that breathe fire"],
    ["PAVE: It was paved.", "covered with a hard surface", "prevented from going through", "divided", "given gold edges"],
    ["ROVE: He couldn't stop roving.", "travelling around", "getting drunk", "making a musical sound through closed lips", "working hard"],
    ["COMPOUND: They made a new compound.", "thing made of two or more parts", "agreement", "group of people forming a business", "guess based on past experience"],
    ["CANDID: Please be candid.", "say what you really think", "be careful", "show sympathy", "show fairness to both sides"],
    ["QUIZ: We made a quiz.", "set of questions", "thing to hold arrows", "serious mistake", "box for birds to make nests in"],
    ["CRAB: Do you like crabs?", "sea creatures that walk sideways", "very thin small cakes", "tight, hard collars", "large black insects that sing at night"],
    ["REMEDY: We found a good remedy.", "way to fix a problem", "place to eat in public", "way to prepare food", "rule about numbers"],
    ["DEFICIT: The company had a large deficit.", "spent a lot more money than it earned", "went down a lot in value", "had a plan for its spending that used a lot of money", "had a lot of money in the bank"],
    ["NUN: We saw a nun.", "woman following a strict religious life", "long thin creature that lives in the earth", "terrible accident", "unexplained bright light in the sky"],
    ["COMPOST: We need some compost.", "rotted plant material", "strong support", "help to feel better", "hard stuff made of stones and sand stuck together"],
    ["MINIATURE: It is a miniature.", "a very small thing of its kind", "an instrument to look at small objects", "a very small living creature", "a small line to join letters in handwriting"],
    ["FRACTURE: They found a fracture.", "break", "small piece", "short coat", "rare jewel"],
    ["DEVIOUS: Your plans are devious.", "tricky", "well-developed", "not well thought out", "more expensive than necessary"],
    ["BUTLER: They have a butler.", "man servant", "machine for cutting up trees", "private teacher", "cool dark room under the house"],
    ["THRESHOLD: They raised the threshold.", "point or line where something changes", "flag", "roof inside a building", "cost of borrowing money"],
    ["STRANGLE: He strangled her.", "killed her by pressing her throat", "gave her all the things she wanted", "took her away by force", "admired her greatly"],
    ["MALIGN: His malign influence is still felt.", "evil", "good", "very important", "secret"],
    ["OLIVE: We bought olives.", "oily fruit", "scented pink or red flowers", "men's clothes for swimming", "tools for digging up weeds"],
    ["STEALTH: They did it by stealth.", "moving secretly with extreme care and quietness", "spending a large amount of money", "hurting someone so much that they agreed to their demands", "taking no notice of problems they met"],
    ["BRISTLE: The bristles are too hard.", "short stiff hairs", "questions", "folding beds", "bottoms of the shoes"],
    ["DEMOGRAPHY: This book is about demography.", "the study of population", "the study of patterns of land use", "the study of the use of pictures to show facts about numbers", "the study of the movement of water"],
    ["AZALEA: This azalea is very pretty.", "small tree with many flowers growing in groups", "light material made from natural threads", "long piece of material worn by women in India", "sea shell shaped like a fan"],
    ["ERRATIC: He was erratic.", "unsteady", "without fault", "very bad", "very polite"],
    ["NULL: His influence was null.", "had no effect", "had good results", "was unhelpful", "was long-lasting"],
    ["ECLIPSE: There was an eclipse.", "The sun hidden by a planet", "a strong wind", "a loud noise of something hitting the water", "The killing of a large number of people"],
    ["LOCUST: There were hundreds of locusts.", "insects with wings", "unpaid helpers", "people who do not eat meat", "brightly coloured wild flowers"],
    ["CABARET: We saw the cabaret.", "song and dance performance", "painting covering a whole wall", "small crawling insect", "person who is half fish, half woman"],
    ["HALLMARK: Does it have a hallmark?", "stamp to show the quality", "stamp to show when to use it by", "mark to show it is approved by the royal family", "mark or stain to prevent copying"],
    ["MONOLOGUE: Now he has a monologue.", "long turn at talking without being interrupted", "single piece of glass to hold over his eye to help him to see better", "position with all the power", "picture made by joining letters together in interesting ways"],
    ["WHIM: He had lots of whims.", "strange ideas with no motive", "old gold coins", "female horses", "sore red lumps"],
    ["REGENT: They chose a regent.", "a ruler acting in place of the king", "an irresponsible person", "a person to run a meeting for a time", "a person to represent them"],
    ["FEN: The story is set in the fens.", "low land partly covered by water", "a piece of high land with few trees", "a block of poor-quality houses in a city", "a time long ago"],
    ["AWE: They looked at the mountain with awe.", "wonder", "worry", "interest", "respect"],
    ["EGALITARIAN: This organization is egalitarian.", "treats everyone who works for it as if they are equal", "does not provide much information about itself to the public", "dislikes change", "frequently asks a court of law for a judgement"],
    ["UPBEAT: I'm feeling really upbeat about it.", "good", "upset", "hurt", "confused"],
    ["PIGTAIL: Does she have a pigtail?", "a rope of hair made by twisting bits together", "a lot of cloth hanging behind a dress", "a plant with pale pink flowers that hang down in short bunches", "a lover"],
    ["RUCK: He got hurt in the ruck.",  "group of players gathered round the ball in some ball games", "hollow between the stomach and the top of the leg", "pushing and shoving", "race across a field of snow"],
    ["EXCRETE: This was excreted recently.", "pushed or sent out", "made clear", "discovered by a science experiment", "put on a list of illegal things"],
    ["YOGA: She has started yoga.", "a form of exercise for body and mind", "handwork done by knotting thread", "a game where a cork stuck with feathers is hit between two players", "a type of dance from eastern countries"],
    ["PUMA: They saw a puma.", "large wild cat", "small house made of mud bricks", "tree from hot, dry countries", "very strong wind that sucks up anything in its path"],
    ["APERITIF: She had an aperitif.", "a drink taken before a meal", "a long chair for lying on with just one place to rest an arm", "a private singing teacher", "a large hat with tall feathers"],
    ["EMIR: We saw the emir.", "Middle Eastern chief with power in his land", "bird with long curved tail feathers", "woman who cares for other people's children in Eastern countries", "house made from blocks of ice"],
    ["HAZE: We looked through the haze.", "unclear air", "small round window in a ship", "strips of wood or plastic to cover a window", "list of names"],
    ["SOLILOQUY: That was an excellent soliloquy!", "speech in the theatre by a character who is alone", "song for six people", "short clever saying with a deep meaning", "entertainment using lights and music"],
    ["ALUM: This contains alum.", "a chemical compound usually involving aluminium", "a poisonous substance from a common plant", "a soft material made of artificial threads", "a tobacco powder once put in the nose"],
    ["CAFFEINE: This contains a lot of caffeine.", "a substance that makes you excited", "a substance that makes you sleepy", "threads from very tough leaves", "ideas that are not correct"],
    ["COVEN: She is the leader of a coven.", "a secret society", "a small singing group", "a business that is owned by the workers", "a group of church women who follow a strict religious life"],
    ["UBIQUITOUS: Many weeds are ubiquitous.", "are found in most countries", "are difficult to get rid of", "have long, strong roots", "die away in the winter"],
    ["ROUBLE: He had a lot of roubles.", "Russian money", "very precious red stones", "distant members of his family", "moral or other difficulties in the mind"],
    ["COMMUNIQUE: I saw their communiqué.", "official announcement", "critical report about an organization", "garden owned by many members of a community", "printed material used for advertising"],
    ["SKYLARK: We watched a skylark.", "small bird that flies high as it sings", "show with aeroplanes flying in patterns", "man-made object going round the earth", "person who does funny tricks"],
    ["ATOLL: The atoll was beautiful.", "low island made of coral round a sea-water lake", "work of art created by weaving pictures from fine thread", "mall crown with many precious jewels worn in the evening by women", "place where a river flows through a narrow place full of large rocks"],
    ["CANONICAL: These are canonical examples.", "regular and widely accepted examples", "examples which break the usual rules", "examples taken from a religious book", "examples discovered very recently"],
    ["MARSUPIAL: It is a marsupial.", "an animal with a pocket for babies", "an animal with hard feet", "a plant that grows for several years", "a plant with flowers that turn to face the sun"],
    ["BAWDY: It was very bawdy.", "rude", "unpredictable", "enjoyable", "rushed"],
    ["THESAURUS: She used a thesaurus.", "a kind of dictionary", "a chemical compound", "a special way of speaking", "an injection just under the skin"],
    ["CORDILLERA: They were stopped by the cordillera.", "a line of mountains", "a special law", "an armed ship", "the eldest son of the king"]
]


var blocks_list = jsPsych.randomization.repeat(trials, 1);

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
    '<div class = centerbox><p class = block-text>In this task, you will be shown a CAPITALIZED WORD, together with an example of how it is used.</p>'+
	'<p class = block-text>Your task is to find the meaning of the word among the options below the word and press the letter corresponding to the meaning.</p>'+
  '<p class = block-text>Important! Please be sure to keep all other browser windows closed while doing this task.</p>'+
  '<p class = block-text>Our algorithm is very sensitive and may flag your responses as being suspicious if other tabs, windows, or programs are open.</p>'+
  '<p class = block-text><b>You will have a set amount of time to answer each question.</b>'+
  " If you do not answer in time, don't worry, just continue to the next question. </p></div>"
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
var vocab_task = {
  type: 'poldrack-categorize',
  is_html: true,
  choices: [possible_responses[0][1], possible_responses[1][1], possible_responses[2][1], possible_responses[3][1]],
  data: {
    trial_id: "task",
    exp_stage: "test"
  },
  timing_stim: null,
  response_ends_trial: true,
  timing_response: 15 * 1000,
  timing_feedback_duration: 1000,
  show_stim_with_feedback: false,
  timing_post_trial: 1,
  timeout_message: '<div class = centerbox><div class = center-text>Out of time</div></div>',
  correct_text: '<p class = AX_text style="color:white;"> </p>',
  incorrect_text: '<p class = AX_text style="color:white;"> </p>'
};


/* ************************************ */
/* Set up experiment */
/* ************************************ */

var vocab_timed_experiment4 = []
vocab_timed_experiment4.push(instruction_node);

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
    vocab_timed_experiment4.push(task)
}
vocab_timed_experiment4.push(end_block)
