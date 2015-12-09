<?php
/* Configuration for SimPoll polling system by Sean "Diggity" O'Brien, sean@webio.me sean.obrien@yale.edu
 * Grabs a $_GET string from a URL and adds it to a text file.
 * This script is useful if you need to ask one question (e.g. via a link in an e-mail) and record the response.
 * Example usage: https://some-web-server.domain/simpoll/index.php?submit=1&bacon=1
 * See README.md and LICENSE for more details.
 * For something more complex and pretty, try Pollovoto https://github.com/seandiggity/pollovoto */

$title = "Simple Poll"; // title for poll or vote

$failMsg = "<h4>There has been an error with your response submission.</h4>"; // text for error message
$showSuccess = 1; // display success message?
$successMsg = "<h4>Success!</h4><p>Your response has been submitted.  Thank you.</p>"; // text for success message
$successRedir = 0; // redirect if successful submission?
$redirURL = ""; // URL to redirect to

$formname = "poll"; // short name of voting form
$filetype = ".csv"; // Comma Separated Values (for spreadsheet program)
$folderpath = "./admin/"; // admin location to store and view results

$reqResponse = "bacon"; // required poll response. $_GET['submit'] is also required to record a response
$maxFilesize = 500000000; // maximum filesize, in bytes

$viewErrors = 1; // enable strict error reporting?
$forceSSL = 1; // force SSL?
?>
