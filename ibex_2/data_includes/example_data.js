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

    ["practice", "DashedSentence", {s: "This is another practice sentence with a practice question following it."},
                 "Question", {hasCorrect: false, randomOrder: false,
                              q: "How would you like to answer this question?",
                              as: ["Press 1 or click here for this answer.",
                                   "Press 2 or click here for this answer.",
                                   "Press 3 or click here for this answer."]}],
    ["practice", "DashedSentence", {s: "This is the last practice sentence before the experiment begins."}],
    
//List A
["Exp1_ListA_secondPair", "DashedSentence", {s: "My professor pointed out the mythological terms that the journalist consistently used incorrectly."}],
["Exp1_ListA_firstPair", "DashedSentence", {s: "A lot of attention was given to the national debate across all sources of media."}],

    
//List B
["Exp1_ListB_secondPair", "DashedSentence", {s: "Ms. Archilego searched for the mythological terms in the new fictional novel."}],
["Exp1_ListB_firstPair", "DashedSentence", {s: "Daniel wasn't very interested in the national debate although everyone was talking about it."}]
];
