<?php
	/*if ($_FILES["file"]["error"] > 0){
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	}
	else{
		$uploads_dir = '/var/www/sistemas/archivos/images';
		foreach ($_FILES["file"]["error"] as $key => $error) {
			echo "key: " . $key . " error: " . $error . "<br>";
		    if ($error == UPLOAD_ERR_OK) {
		        $tmp_name = $_FILES["file"]["tmp_name"][$key];
		        $name = $_FILES["file"]["name"][$key];
		        move_uploaded_file($tmp_name, "$uploads_dir/$name");
		    }
		}
		$tmp_name = $_FILES["file"]["tmp_name"];
		$name = $_FILES["file"]["name"];
		move_uploaded_file($tmp_name, "$uploads_dir/$name");
		echo "string: " . $_FILES["file"]["error"]."<br>";
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "Stored in: " . $_FILES["file"]["tmp_name"];
	}*/

	if(count($_FILES['file']['size'])>0) {
		foreach ($_FILES['file']['error'] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				if ($_FILES["file"]["size"][$key] <= 1900000) {
					$file = str_replace(" ", "",$_FILES["file"]["name"][$key]);
					echo $_FILES["file"]["size"][$key]."<br>";
					if (!file_exists("/var/www/sistemas/archivos/images/$file")) {
						$tmp_name = $_FILES["file"]["tmp_name"][$key];
					    move_uploaded_file($tmp_name, "/var/www/sistemas/archivos/images/$file");
						echo $file."<br>";
					}else{
						echo 'El archivo "'.$file.'" ya existe<br>';
					}
				}else{
					echo 'El archivo "'.$file.'" es muy grande<br>';
				}
			}else{
				echo 'El archivo "'.$_FILES['file']['name'].'" no se subió correctamente'
			}			
		}
	}
	echo count($_FILES['file']['tmp_name']);
?>