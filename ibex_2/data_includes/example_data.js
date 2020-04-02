//Transfer time used to beb 1500

// var sequence = getCookieValue("ibex_2_group");
//
// if (sequence == ""){
// 	sequence = "E"
// }
//
// switch (sequence){
//         case "E":
//             var shuffleSequence = seq("intro3", sepWith("sep", seq("practice", "intro4", randomize("Exp1_ListA_firstPair"), randomize("Exp1_ListA_secondPair"), "exitpoll", "sendResults", "end")));
//             break;
//         default:
//             var shuffleSequence = seq("end");
//                 }


shuffleSequence = seq("intro_ibex2", sepWith("sep", seq("practice", "intro2_ibex2", randomize("Exp2_ListA_firstPair"), randomize("Exp2_ListA_secondPair"), "exitpoll", "sendResults", "end")));

//var sequence = document.cookie.match('(^|[^;]+)\\s*group\\s*=\\s*([^;]+)');
//if (sequence=='AAA'){var shuffleSequence = seq("intro", sepWith("sep", seq("practice", randomize("ListA_secondPair"), randomize("firstPair"))));
//             } else if (sequence=='BBB'){var shuffleSequence = seq("intro", sepWith("sep", seq("practice", randomize("firstPair"), randomize("secondPair"))));}

var practiceItemTypes = ["practice"];

var defaults = [
    "Separator", {
        transfer: 1000,
        normalMessage: "Please wait for the next sentence.",
        errorMessage: "Wrong. Please wait for the next sentence."
    },
    "DashedSentence", {
        mode: "self-paced reading"
    },
    "AcceptabilityJudgment", {
        as: ["1", "2", "3", "4", "5", "6", "7"],
        presentAsScale: true,
        instructions: "Use number keys or click boxes to answer.",
        leftComment: "(Bad)", rightComment: "(Good)"
    },
    "Question", {
        hasCorrect: true
    },
    "Message", {
        hideProgressBar: true
    },
    "Form", {
        hideProgressBar: true,
        continueOnReturn: true,
        saveReactionTime: true
    }
];

var items = [

    ["sep", "Separator", { }],

    ["intro_ibex2", "Form", {
        html: { include: "intro_ibex2.html" },} ],

    ["intro2_ibex2", "Form", {
        html: { include: "intro2_ibex2.html" },} ],

		["exitpoll_pilot", "Form", {
				html: { include: "exitpoll_pilot.html" },} ],

    ["exitpoll", "Form", {
        html: { include: "exitpoll.html" },} ],

    ["end", "Form", {
        html: { include: "end.html" }, continueMessage: false} ],

	["sendResults", "__SendResults__", { }],

  ["practice",
  "PictureDisplay", {transfer: "keypress",
            normalMessage: "Memorize this image, then press any key to continue.",
            url: "https://www.psycholinguistics.ml/ibex_2/img/practice_1A.png"},
  "DashedSentence", {s: "This is a practice task to get you used to remembering images like this."},
  "PictureQuestion", {
        q: "Is this the image you saw?",
        url: "https://www.psycholinguistics.ml/ibex_2/img/practice_1B.png",
        as:["yes", "no"]}
          ],

    ["practice",
    "PictureDisplay", {transfer: "keypress",
              normalMessage: "Memorize this image, then press any key to continue.",
              url: "https://www.psycholinguistics.ml/ibex_2/img/practice_2A.png"},
    "DashedSentence", {s: "Sometimes sentences will be followed by a question so make sure you read carefully."},
    "Question", {q: "Was the sentence about reading carefully?",
          as:["yes", "no"]}
            ],

["practice",
  "AudioDisplay", {transfer: "keypress",
            normalMessage: "Memorize these words, then press any key to continue.",
            url: "https://www.psycholinguistics.ml/ibex_2/audio/practice_1F.mp3"},
  "DashedSentence", {s: "This is a practice task to get you used to listening to audio like this."},
  "AudioQuestion", {
        q: "Are these the words you heard?",
        url: "https://www.psycholinguistics.ml/ibex_2/audio/practice_1M.mp3",
        as:["yes", "no"]}
            ],

["practice",
  "AudioDisplay", {transfer: "keypress",
            normalMessage: "Memorize these words, then press any key to continue.",
            url: "https://www.psycholinguistics.ml/ibex_2/audio/practice_2M.mp3"},
  "DashedSentence", {s: "Sentences may also be followed by questions checking how carefully you read."},
  "Question", {
        q: "Was the sentence about how to write a sentence?",
        as:["no", "yes"]}
            ],

//Practice List (20)
["Exp2_ListA_secondPair", "AudioDisplay", {transfer: "keypress", normalMessage: "Memorize these words, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/audio/6M_s.mp3"}, "DashedSentence", {s: "When Chester and his partners became aware of their conflicting inferences, they began to argue about who was right."}, "Question", {q: "Did Chester and his partners disagree?", as:["yes", "no"]}],
["Exp2_ListA_firstPair", "PictureDisplay", {transfer: "keypress", normalMessage: "Memorize this image, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/img/2A_d.png"}, "DashedSentence", {s: "Mr. Wells told us that a critical component of the artistic process is finding inspiration."}, "Question", {q: "Did Mr. Well suggested finding inspiration in order to do mathematics?", as:["no", "yes"]}],
["Exp2_ListA_secondPair", "PictureDisplay", {transfer: "keypress", normalMessage: "Memorize this image, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/img/1A_d.png"}, "DashedSentence", {s: "The team wrote down the critical element of the plan that the manager came up with."}, "PictureQuestion", {q: "Is this the image you saw?", url: "https://www.psycholinguistics.ml/ibex_2/img/1B_d.png", as:["no", "yes"]}],
["Exp2_ListA_firstPair", "AudioDisplay", {transfer: "keypress", normalMessage: "Memorize these words, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/audio/1F_s.mp3"}, "DashedSentence", {s: "Keagan didn't mean for the crunchy bits to end up in the dish."}, "AudioQuestion", {q: "Are these the words that you heard?", url: "https://www.psycholinguistics.ml/ibex_2/audio/1M_s.mp3", as:["yes", "no"]}],
["Exp2_ListA_secondPair", "AudioDisplay", {transfer: "keypress", normalMessage: "Memorize these words, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/audio/7F_d.mp3"}, "DashedSentence", {s: "Nora didn't like the crunchy corn in the quirky gourmet meal."}, "Question", {q: "Did Nora like everything about her meal?", as:["no", "yes"]}],
["Exp2_ListA_firstPair", "AudioDisplay", {transfer: "keypress", normalMessage: "Memorize these words, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/audio/8M_d.mp3"}, "DashedSentence", {s: "Morgan admired the curly mane of the horse walking in the arena."}, "AudioQuestion", {q: "Are these the words that you heard?", url: "https://www.psycholinguistics.ml/ibex_2/audio/8F_d.mp3", as:["no", "yes"]}],
["Exp2_ListA_secondPair", "PictureDisplay", {transfer: "keypress", normalMessage: "Memorize this image, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/img/3A_d.png"}, "DashedSentence", {s: "The toy had a curly wig and a plastic brush."}, "PictureQuestion", {q: "Is this the image you saw?", url: "https://www.psycholinguistics.ml/ibex_2/img/3B_d.png", as:["no", "yes"]}],
["Exp2_ListA_firstPair", "PictureDisplay", {transfer: "keypress", normalMessage: "Memorize this image, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/img/6A_d.png"}, "DashedSentence", {s: "It was due to a deliberate act that the corporation went bankrupt."}, "Question", {q: "Was it a family that went bankrupt?", as:["no", "yes"]}],
["Exp2_ListA_secondPair", "AudioDisplay", {transfer: "keypress", normalMessage: "Memorize these words, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/audio/2M_s.mp3"}, "DashedSentence", {s: "As a result of the deliberate policy, all employees had to have their bags searched when entering the building."}, "AudioQuestion", {q: "Are these the words that you heard?", url: "https://www.psycholinguistics.ml/ibex_2/audio/2F_s.mp3", as:["yes", "no"]}],
["Exp2_ListA_firstPair", "AudioDisplay", {transfer: "keypress", normalMessage: "Memorize these words, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/audio/4F_d.mp3"}, "DashedSentence", {s: "Because of the dense fog, Addy could barely see where she was going."}, "Question", {q: "Was it foggy weather that made it difficult to Addy to see where she was going?", as:["yes", "no"]}],
["Exp2_ListA_secondPair", "PictureDisplay", {transfer: "keypress", normalMessage: "Memorize this image, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/img/4_s.png"}, "DashedSentence", {s: "Through the dense woods, the porch light lit the way."}, "Question", {q: "Was it a flashlight that was lighting the way?", as:["no", "yes"]}],
["Exp2_ListA_firstPair", "PictureDisplay", {transfer: "keypress", normalMessage: "Memorize this image, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/img/5_s.png"}, "DashedSentence", {s: "After the disciplinary measures, Mr. Jackson lost his job."}, "Question", {q: "Was it Mr. Zayne who lost his job?", as:["no", "yes"]}],
["Exp2_ListA_secondPair", "AudioDisplay", {transfer: "keypress", normalMessage: "Memorize these words, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/audio/9F_s.mp3"}, "DashedSentence", {s: "Though the disciplinary proceedings went well, the student had already decided to leave school."}, "Question", {q: "Did the proceedings go well?", as:["yes", "no"]}],
["Exp2_ListA_firstPair", "AudioDisplay", {transfer: "keypress", normalMessage: "Memorize these words, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/audio/5M_d.mp3"}, "DashedSentence", {s: "The show focused on the distinct cultures that are found around the world."}, "Question", {q: "Was the show about recent medical discoveries?", as:["no", "yes"]}],
["Exp2_ListA_secondPair", "PictureDisplay", {transfer: "keypress", normalMessage: "Memorize this image, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/img/7_s.png"}, "DashedSentence", {s: "Learning about the distinct identity was very interesting to Leah."}, "PictureQuestion", {q: "Is this the image you saw?", url: "https://www.psycholinguistics.ml/ibex_2/img/7_s.png", as:["yes", "no"]}],
["Exp2_ListA_firstPair", "PictureDisplay", {transfer: "keypress", normalMessage: "Memorize this image, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/img/10_s.png"}, "DashedSentence", {s: "It was certainly an eerie absence when Maddison didn't show up for practice."}, "PictureQuestion", {q: "Is this the image you saw?", url: "https://www.psycholinguistics.ml/ibex_2/img/10_s.png", as:["yes", "no"]}],
["Exp2_ListA_secondPair", "AudioDisplay", {transfer: "keypress", normalMessage: "Memorize these words, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/audio/3F_s.mp3"}, "DashedSentence", {s: "Issac didn't want to think about the eerie coincidence that he had experienced earlier that day."}, "AudioQuestion", {q: "Are these the words that you heard?", url: "https://www.psycholinguistics.ml/ibex_2/audio/3M_s.mp3", as:["yes", "no"]}],
["Exp2_ListA_firstPair", "AudioDisplay", {transfer: "keypress", normalMessage: "Memorize these words, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/audio/10M_s.mp3"}, "DashedSentence", {s: "Mrs. Saunders noticed the enormous difference between the two students."}, "AudioQuestion", {q: "Are these the words that you heard?", url: "https://www.psycholinguistics.ml/ibex_2/audio/10F_s.mp3", as:["yes", "no"]}],
["Exp2_ListA_secondPair", "PictureDisplay", {transfer: "keypress", normalMessage: "Memorize this image, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/img/8A_d.png"}, "DashedSentence", {s: "On account of the enormous potential of the new proposal, we will definitely accept it."}, "Question", {q: "Will the proposal be accepted?", as:["yes", "no"]}],
["Exp2_ListA_firstPair", "PictureDisplay", {transfer: "keypress", normalMessage: "Memorize this image, then press any key to continue.", url: "https://www.psycholinguistics.ml/ibex_2/img/9A_d.png"}, "DashedSentence", {s: "Mr. Kent's explicit intention was to change the way we think about the topic."}, "PictureQuestion", {q: "Is this the image you saw?", url: "https://www.psycholinguistics.ml/ibex_2/img/9B_d.png", as:["no", "yes"]}]
];
