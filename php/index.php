<?php

	$dataDir = isset($_ENV['OPENSHIFT_DATA_DIR']) ? $_ENV['OPENSHIFT_DATA_DIR'] : ('/var/www/data/');
	$upload = !isset($_REQUEST['list']);
  
	function isImageName($name) {
		return preg_match('/^[^.\/][^\/]*\.(jpe?g|png|gif)$/i',$name)>0;
	}

		/* handle image delivery */
	if (isset($_REQUEST['phpinfo'])) {
		phpinfo();
		exit;
	}
	
	/* handle image delivery */
	if (isset($_REQUEST['f'])) {
		if (isImageName($_REQUEST['f']) && is_file($dataDir . $_REQUEST['f'])) {
	
			$file = $dataDir . $_REQUEST['f'];
			if (preg_match('/\.gif/i',$file)) {
				header('Content-Type: image/gif');
			} else if (preg_match('/\.jpe?g/i',$file)) {
				header('Content-Type: image/jpeg');
			} else if (preg_match('/\.png/i',$file)) {
				header('Content-Type: image/png');
			} else {
				header ("HTTP/1.0 404 Not Found");
				exit;
			}
			$seconds_to_cache = 60*60*24*365*5;
			$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
			header("Expires: $ts");
			header("Pragma: cache");
			header("Cache-Control: max-age=$seconds_to_cache");
			header('Pragma: public');
			ob_clean();
			flush();
			readfile($file);
			exit;
			
		}
		header ("HTTP/1.0 404 Not Found");
		exit;
	}

	require_once 'twig/lib/Twig/Autoloader.php';
	Twig_Autoloader::register();
	$twig = new Twig_Environment(new Twig_Loader_Filesystem('.'));
	
	$message = "Upload Photos To CDPF";
	
	if (isset($_REQUEST['submit']) && isset($_FILES["the-file"])) {
	
		$file = $_FILES["the-file"];
		$message = "Missing or illegal file name!";
		
		if (isset($file["name"]) && isImageName($file["name"])) {
		
			$name = preg_replace('/^[.]|[^\w.]/i','-', $file['name']);
			
			$result = move_uploaded_file($file["tmp_name"],$dataDir.$name);
			
			$message = $result ? "The photo $name has been uploaded" :
				"Error receiving the file: $name";
		}
	}

	$images = array_filter(scandir($dataDir),'isImageName');
	
	echo $twig->render('index.twig', array(
		'message' => $message,
		'images' => $images,
		'upload' => $upload
	));

?>
