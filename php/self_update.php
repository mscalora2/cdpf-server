<?php
	$dataDir = $_ENV['OPENSHIFT_DATA_DIR'];
	$repoDir = $_ENV['OPENSHIFT_REPO_DIR'];
	
	$updateScript = "${repoDir}misc/self_update";
	
	echo `$updateScript`;
	