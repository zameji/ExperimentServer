// Serialize the data
// {
// var promise = new Promise(function(resolve, reject) {
//     var data = jsPsych.data.dataAsJSON();
//     resolve(data);
// })
//
// promise.then(function(data) {
//
//
//     $.ajax({
//         type: "POST",
//         url: '/save',
//         data: { "data": data },
//         success: function(){ document.location = "/next" },
//         dataType: "application/json",

        // Endpoint not running, local save
        // error: function(err) {
        //
        //     if (err.status == 200){
        //         document.location = "/next";
        //     } else {
        //         // If error, assue local save
        //         jsPsych.data.localSave('local-global-shape_results.csv', 'csv');
        //     }
        // }
    // });
//                  })
//              }
//
//       });
// });

// <script>
//
// var user_id = "kyla";
// //var user_id = getID();
//
// $( document ).ready(function() {
//
//     jsPsych.init({
//              timeline: flanker_experiment,
//              display_element: "getDisplayElement",
//              fullscreen: true,
//              on_trial_finish: function(data){
//                addID('flanker')
//              },
//
//              on_finish:  function() {
// 		saveData(user_id, jsPsych.data.dataAsCSV());
//       }
//
//       });
// });
// </script>
