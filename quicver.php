<?php
     if(!isset($_POST['host']) || $_POST['host']=="") {
	die("You did not specify any host.</br><a href=\"index.html\">Back</a>");
     }
     $host = $_POST['host'];
     $port = $_POST['port'];
     if(!is_numeric($port) && !$port == "") {
	die("You've specified an invalid port number.</br><a href=\"index.html\">Back</a>");
     }
     if (strlen($host) > 100) {
	die("You've specified a host that exceeds the allowed length of 100 characters.</br><a href=\"index.html\">Back</a>");
     }
     if(!checkdnsrr(idn_to_ascii($host), 'A')) {
	die("Host: \"$host\" is not resolvable. Maybe you've misspelled it?</br><a href=\"index.html\">Back</a>");
     }
     if($port > 65535 || $port < 0 && !$port == "") {
        die("You've specified an invalid port number.</br><a href=\"index.html\">Back</a>");
     }
     passthru("quicver $host $port | aha --title Results: > quicver.html");
     $htmlpage = file_get_contents('https://henrock.net/quicver/quicver.html');
     echo str_replace("</pre>", "</pre><a href=\"index.html\">Back</a>", $htmlpage);
     echo "<script>window.location = 'quicver.html'</script>";
?>
