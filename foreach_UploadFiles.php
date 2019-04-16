<?php
date_default_timezone_set('Asia/Kolkata');
$valid_extensions = array("3ga", "aif", "aifc", "aiff", "caf", "caff", "mp3", "mid", "wav");
if(count($_FILES["upload"]["name"]) > 0){
    // Loop through each file
	foreach($_FILES["upload"]["tmp_name"] as $key => $tmp_name){
		$file_tmp_path=$_FILES["upload"]["tmp_name"][$key];
		if(!empty($_FILES["upload"]["type"][$key])){
			if($file_tmp_path != ""){
				$file_name=$_FILES["upload"]["name"][$key];
				$filePath = "media/" . date('d-m-Y-H-i-s').'-'.$file_name;
				$temporary = explode(".", $file_name);
				$file_extension = end($temporary);
				if(in_array($file_extension, $valid_extensions)){
					$sourcePath = $file_tmp_path;
					$targetPath = $filePath;
					if(move_uploaded_file($sourcePath, $targetPath)){
						echo "<li>".$file_name."</li>";
						// Insert into DB
						// Use $file_name for the file's name and $filePath for the relative url to the file
						//$conn = mysqli_connect("localhost", "root", "password", "dbname");
						//$sql = "INSERT INTO tablename(FILE_NAME, URL) VALUES('$file_name', '$targetPath');";
						//$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					}else {
						echo "Something is wrong when uploading the ".$file_name;
					}
				}else {
					echo "File ".$file_name."contains invalid extension.";
				}
			}else {
				echo "Error: Temporary path is empty for ".$key;
			}
		}else {
			echo $key."File have not a valid type.";
		}
	 }
}else {
	echo "You have not selected any file.\n";
}
?>
