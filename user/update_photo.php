<?php
	include('session.php');
	
	$fileInfo = PATHINFO($_FILES["image"]["name"]);
	
	if (empty($_FILES["image"]["name"])){
		$location=$srow['Foto'];
		?>
			<script>
				window.alert('La foto subida está vacia!');
				window.history.back();
			</script>
		<?php
	}
	else{
		if ($fileInfo['extension'] == "jpg" OR $fileInfo['extension'] == "png") {
			$newFilename = $fileInfo['filename'] . "_" . time() . "." . $fileInfo['extension'];
			move_uploaded_file($_FILES["image"]["tmp_name"], "../upload/" . $newFilename);
			$location = "upload/" . $newFilename;
			
			mysqli_query($conn,"update `user` set photo='$location' where userid='".$_SESSION['id']."'");
	
			?>
				<script>
					window.alert('Foto subida correctamente!');
					window.history.back();
				</script>
			<?php
		}
		else{
			?>
				<script>
					window.alert('No se actualizo la foto! Por favor usar formato JPG o PNG');
					window.history.back();
				</script>
			<?php
		}
	}
	
	

?>