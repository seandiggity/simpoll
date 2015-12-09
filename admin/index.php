<?php
// require configuration file
require ("../conf.php");

if ($viewErrors == "1") {
	// activate full error reporting
	error_reporting(E_ALL & E_STRICT);
}

if ($forceSSL == "1") {
	// Detect if this is an SSL connection, switch to SSL if not
	if ( !isset($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS']) != 'on' ) {
		//SSL is OFF
	   header ('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	   exit();
	}
}
?>
<html>
<head><title><?php echo "Responses: ".$title; ?></title></head>
<style type="text/css">
/* Pretty CSS from John Sardine, http://johnsardine.com/freebies/dl-html-css/simple-little-tab/ */
h2 {
	font-family:Arial, Helvetica, sans-serif;
	color:#111;
	font-size:1.4em;
	float: center;
	text-align: center;
	margin:20px;
}
h3 {
	font-family:Arial, Helvetica, sans-serif;
	color:#111;
	font-size:.8em;
	float: center;
	text-align: center;
	margin:2px;
}
a:link {
	color: #666;
	font-weight: bold;
	text-decoration:none;
}
a:visited {
	color: #999999;
	font-weight:bold;
	text-decoration:none;
}
a:active,
a:hover {
	color: #bd5a35;
	text-decoration:underline;
}
table {
	font-family:Arial, Helvetica, sans-serif;
	color:#666;
	font-size:.8em;
	text-shadow: 1px 1px 0px #fff;
	background:#eaebec;
	border:#ccc 1px solid;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;
	float: center;
	margin: 20px auto 20px auto;
}
table th {
	padding:21px 25px 22px 25px;
	border-top:1px solid #fafafa;
	border-bottom:1px solid #e0e0e0;

	background: #ededed;
	background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
	background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child {
	text-align: left;
	padding-left:20px;
}
table tr:first-child th:first-child {
	-moz-border-radius-topleft:3px;
	-webkit-border-top-left-radius:3px;
	border-top-left-radius:3px;
}
table tr:first-child th:last-child {
	-moz-border-radius-topright:3px;
	-webkit-border-top-right-radius:3px;
	border-top-right-radius:3px;
}
table tr {
	text-align: center;
	padding-left:20px;
}
table td:first-child {
	text-align: left;
	padding-left:20px;
	border-left: 0;
}
table td {
	padding:18px;
	border-top: 1px solid #ffffff;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;

	background: #fafafa;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
	background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td {
	background: #f6f6f6;
	background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
	background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
table tr:last-child td {
	border-bottom:0;
}
table tr:last-child td:first-child {
	-moz-border-radius-bottomleft:3px;
	-webkit-border-bottom-left-radius:3px;
	border-bottom-left-radius:3px;
}
table tr:last-child td:last-child {
	-moz-border-radius-bottomright:3px;
	-webkit-border-bottom-right-radius:3px;
	border-bottom-right-radius:3px;
}
table tr:hover td {
	background: #f2f2f2;
	background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
	background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);	
}
</style>
<body>
<h2><?php echo "Responses: ".$title; ?></h2>
<h3><a href="<?php echo $formname.$filetype ?>" target="_blank">Download Responses [CSV]</a></h3>
<?php
// display contents of CSV in HTML table
prettyReadCSV($formname.$filetype);

function prettyReadCSV($filename, $header=false) {
	$handle = fopen($filename, "r");
	echo '<table>';
	//display header row if true
	if ($header) {
	    $csvcontents = fgetcsv($handle);
	    echo '<tr>';
	    foreach ($csvcontents as $headercolumn) {
		echo "<th>$headercolumn</th>";
	    }
	    echo '</tr>';
	}
	// displaying contents
	$counter = 0;
	while ($csvcontents = fgetcsv($handle)) {
	    $counter++;
	    if ($counter % 2 == 0) { echo '<tr class="even">'; } 
	    else { echo '<tr>'; }
	    foreach ($csvcontents as $column) {
		echo "<td>$counter</td><td>$column</td>";
	    }
	    echo '</tr>';
	}
	echo '</table>';
	fclose($handle);
}
?>
<h3><a href="<?php echo $formname.$filetype ?>" target="_blank">Download Responses [CSV]</a></h3>
</body></html>
