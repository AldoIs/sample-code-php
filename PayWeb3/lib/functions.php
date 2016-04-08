<?php
	/**
	 * @return string
	 */
	function getCurrentUrl() {

		$url = array();

		// set protocol
		$url['protocol'] = 'http://';
		if (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) === 'on' || $_SERVER['HTTPS'] == 1)) {
			$url['protocol'] = 'https://';
		} elseif (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
			$url['protocol'] = 'https://';
		}

		// set host
		$url['host'] = $_SERVER['HTTP_HOST'];
		// set request uri in a secure way
		$url['request_uri'] = $_SERVER['REQUEST_URI'];

		return join('', $url);
	}

	/**
	 * @param $fullPath
	 * @return string
	 */
	function getFinalDirectory($fullPath){
		$pathArray      = explode('/', $fullPath);
		$numDirectories = count($pathArray);
		$finalDirectory = '';

		for($i=0;$i<($numDirectories-1);$i++){

			$finalDirectory .= $pathArray[$i].'/';
		}

		return $finalDirectory;
	}