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

var sequence = getCookieValue("group");
var progress = getCookieValue("progress");

sequence = sequence[progress];

switch (sequence){
        case "E":
            var shuffleSequence = seq("intro3", sepWith("sep", seq("practice", "intro4", randomize("Exp1_ListA_firstPair"), randomize("Exp1_ListA_secondPair"), "exitpoll", "sendResults", "end")));
            break;
        default:
            var shuffleSequence = seq("end");
                }

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

    ["intro3", "Form", {
        html: { include: "intro3.html" },} ],

    ["intro4", "Form", {
        html: { include: "intro4.html" },} ],

    ["exitpoll", "Form", {
        html: { include: "exitpoll.html" },} ],

    ["end", "Form", {
        html: { include: "end.html" }, continueMessage: false} ],

	["sendResults", "__SendResults__", { }],

  "practice",
  "PictureDisplay", {transfer: 1500,
            normalMessage: "Please recall this image",
            url: "/img/1A.png"},
  "DashedSentence", {s: "This is a practice task to get you used to remembering images like this."},
  "PictureQuestion", {
        q: "Is this the image you saw?",
        url: "/img/1B.png",
        as:["yes", "no"]}
          ],

    ["practice",
    "PictureDisplay", {transfer: 1500,
              normalMessage: "Please recall this image",
              url: "/img/2A.png"},
    "DashedSentence", {s: "Sometimes sentences will be followed by questions so make sure you read carefully."},
    "Question", {q: "Was the sentence about reading carefully?",
          as:["yes", "no"]}
            ],

["practice",
  "AudioDisplay", {transfer: "keypress",
            normalMessage: "Please remember this word, then press any key to continue.",
            url: "/audio/1A.m4a"},
  "DashedSentence", {s: "This is a practice task to get you used to listening to audio like this."},
  "AudioQuestion", {
        q: "Is this the sound you heard?",
        url: "/audio/1B.m4a",
        as:["yes", "no""]}
            ],

["practice",
  "AudioDisplay", {transfer: "keypress",
            normalMessage: "Please remember this word, then press any key to continue.",
            url: "/audio/2A.m4a"},
  "DashedSentence", {s: "Sentences may also be followed by questions checking how carefully you read."},
  "Question", {
        q: "Was the sentence about reading quickly?",
        as:["no", "yes"]}
            ],

//List A
["Exp1_ListA_secondPair", "DashedSentence", {s: "My professor pointed out the mythological terms that the journalist consistently used incorrectly."}],
["Exp1_ListA_firstPair", "DashedSentence", {s: "A lot of attention was given to the national debate across all sources of media."}],


//List B
["Exp1_ListB_secondPair", "DashedSentence", {s: "Ms. Archilego searched for the mythological terms in the new fictional novel."}],
["Exp1_ListB_firstPair", "DashedSentence", {s: "Daniel wasn't very interested in the national debate although everyone was talking about it."}]
];
