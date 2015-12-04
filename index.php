<?php
// require configuration file
require ("conf.php");

if ($viewErrors == 1) {
	// activate full error reporting
	error_reporting(E_ALL & E_STRICT);
}

if ($forceSSL == 1) {
	// Detect if this is an SSL connection, switch to SSL if not
	if ( !isset($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS']) != 'on' ) {
		//SSL is OFF
	   header ('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	   exit();
	}
}

// set counter
$submitted = 0;

// when URL link is accessed, record data from $_GET string
if (isset($_GET['submit'])&&!isset($_SESSION['submitted'])&&isset($_GET[$reqResponse])) {
	// set counter, mark item as submitted
	$submitted = 1;
	$_SESSION['submitted'] = 1;

	if (empty($errors)) {
		$date1 = date("Y-m-d_H-i-s");
		$date2 = date("l F j, Y");
		$randstring = getRandomString();
		$filename = $folderpath.$formname."_".$date1."_".$randstring.$filetype;
		$dbfilename = $folderpath.$formname.$filetype; //"database" file, the file with combined content of all files
		$dbbackuptemp = $folderpath.$formname."_backup_".$date1."_".$randstring.$filetype; //temp "database" backup file
		$dbbackup = $folderpath.$formname."_backup".$filetype; //"database" backup file
		$temp_filename = $folderpath.$formname."_".$date1."_".$randstring."_temp".$filetype;
		touch($filename) or die('<div class="alert alert-error">'.$failMsg.'</div>');

		if (is_writable($filename)) {

			if ($fp = fopen($filename, 'w')) {
			$ip_addr = $_SERVER['REMOTE_ADDR'];
				
				if ($filetype==".csv") { //for generating a .csv spreadsheet
					foreach($_GET as $name => $value) { //first line of .csv, with column headings
						if ($name!='submit'&&$value!='submit') {
						$name = '"'.str_replace('_',' ',$name).'",';
						fputs($fp, "$name");
						}
					}
				fputs($fp, "\r\n"); //first line break
					foreach($_GET as $name => $value) { //second line of .csv, with user data
						if ($name!='submit'&&$value!='submit') {
						$value = '"'.stripslashes(str_replace('_',' ',$value)).'",';
						fputs($fp, "$value");
						}
					}
				fputs($fp, "\r\n"); //second line break
				} //end .csv if statement

			fclose($fp);
			
			// logic for "database"
			if (file_exists($dbfilename)) {
				stream_copy($dbfilename, $dbbackuptemp); //make backup of "database" file if it exists

				if ($fp = fopen($dbfilename, 'a')) { //open "database" for writing

						foreach($_GET as $name => $value) { //add new line to "database" with new submission data
							if ($name!='submit'&&$value!='submit') {
							$value = '"'.stripslashes(str_replace('_',' ',$value)).'",';
							fputs($fp, "$value");
							}
						}
						
					fputs($fp, "\r\n"); //insert line break
					fclose($fp);
				}
				else {
				die('<div class="alert alert-error">'.$failMsg.'</div>');
				}

			unlink($filename); //del file for original submission
			}
 
			else { //if "database" file doesn't exist, make one with the latest submission
				if (file_exists($filename)) { stream_copy($filename, $dbfilename); stream_copy($dbfilename, $dbbackuptemp); unlink($filename); } }

			//clean up backups and temp files
			unlink($dbbackup);
			stream_copy($dbbackuptemp, $dbbackup);
			unlink($dbbackuptemp);
			
			//remove last form submission from memory
			unset($_GET);
			
			if ($successMsg == 1) {
				// success message, with optional redirect
				echo('<div id="formSuccess" style="">'.$successMsg.'</div>');
			}
			if ($successRedir == 1) {
				header("refresh: 0; url=".$redirURL);
			}
		        }
       		 	else {
			die('<div class="alert alert-error">'.$failMsg.'</div>');
			}

			}
		else {
		die('<div class="alert alert-error">'.$failMsg.'</div>');
		}

	}

	// clear $_GET
	unset($_GET);
}

else { } // do nothing

// Generate random string of a specific length
function getRandomString($length = 6) {
	$validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ0123456789";
	$validCharNumber = strlen($validCharacters);
	$result = "";
	for ($i = 0; $i < $length; $i++) {
		$index = mt_rand(0, $validCharNumber - 1);
		$result .= $validCharacters[$index];
		}
	return $result;
	}

// optimized copy function
    function stream_copy($src, $dest)
    {
        $fsrc = fopen($src,'r');
        $fdest = fopen($dest,'w+');
        $len = stream_copy_to_stream($fsrc,$fdest);
        fclose($fsrc);
        fclose($fdest);
        return $len;
    } 

