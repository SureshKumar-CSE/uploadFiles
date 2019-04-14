<?php
if(count($_FILES['upload']['name']) > 0){
	date_default_timezone_set('Asia/Kolkata');
	$files = array();
    // Loop through each file.
    for($i=0; $i<count($_FILES['upload']['name']); $i++){
		// Get the temp file path.
		$tmpFilePath = $_FILES['upload']['tmp_name'][$i];
        // Make sure file have a filepath.
        if($tmpFilePath != ''){
			// Save the filename.
            $filename = $_FILES['upload']['name'][$i];
			// Save the url and the file.
            $filePath = 'media/' . date('d-m-Y-H-i-s').'-'.$_FILES['upload']['name'][$i];
			// Valid extensions for audio files.
			$valid_extensions = array("jfif", "php", "exe", "jpeg", "jpg", "doc", "docx", "xml", "dotx", "wps", "wpd", "wp", "wp4", "wp5", "wp6", "wp7", "qxd", "pdf", "ps", "pub", "txt", "rtf", "odt", "xls", "xlsx", "wks", "xlr", "csv", "ppt", "pps", "ppsx", "vsd", "bmp","pjpeg", "gif", "	", "wav", "mp3", "mp4", "html", "json");
			//$valid_extensions = array("3ga", "aif", "aifc", "aiff", "caf", "caff", "mp3", "mid", "wav");
			// Extract the file extension from its name.
			$temporary = explode('.', $filename);
			$file_extension = end($temporary);
			// Make sure file have a valid extension.
			if(in_array($file_extension, $valid_extensions)){
				$sourcePath = $tmpFilePath;
				$targetPath = $filePath;
				// Upload the file at target path.
				if(move_uploaded_file($sourcePath, $targetPath)){
					$files[] = $filename;
					// Insert into DB
					// Use $filename for the file's name and $filePath for the relative url to the file
					//$conn = mysqli_connect("localhost", "root", "password", "dbname");
					//$sql = "INSERT INTO tablename(FILE_NAME, URL) VALUES('$filename', '$filePath');";
					//$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
				}else {
					echo "Unable to upload files.";
				}
            }else {
				echo "File have invalid extension.";
			}
        }else {
			echo "Unable to upload files because file don't have a filepath.";
		}
    }
	// Show success message	
	echo "<h1>Uploaded:</h1>";    
	if(is_array($files)){
		echo "<ul>";
		foreach($files as $file){
			echo "<li>".$file."</li>";
		}
		echo "</ul> <br/>";
	}
}else {
	echo "You have not selected any file.";
}
?>