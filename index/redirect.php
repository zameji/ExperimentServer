if (!$conn-> query($query)) {
    //echo '<p style="text-align:center; font-family: Lucida, Console, monospace; font-size: medium;">Failed. Have you already done the experiment?</p>';
    echo "Execute failed: (" . $conn->errno . ") " . $conn->error;
} else {
	switch (substr($testgroup, 0, 1)){

		case "1":
			setcookie("ibex_1_group", $ibex_1_group, time()+144000, "/", "psycholinguistics.ml");
			$next = "https://www.psycholinguistics.ml/ibex_1/experiment.html";
			break;

		case "2":
			$next = "https://www.psycholinguistics.ml/ibex_2/experiment.html";
			break;

		case "J":
			setcookie("jspsych_group", $jspsych_group, time()+144000, "/", "psycholinguistics.ml");
			setcookie("jspsych_progress", $jspsych_progress, time()+144000, "/", "psycholinguistics.ml");
			$next = "https://www.psycholinguistics.ml/jspsych.html";
			break;
		default:
			$next = "https://www.psycholinguistics.ml/index/server_error.html";
			break;
	}

    echo "Redirecting...<br /> If nothing happens, <a href='" . $next ."'>click here</a>";
	$conn->commit();
	$conn->close();
	header("Location: ". $next, true, 302);
	exit();

}
