<?php
class Route {
	protected function route($url, $explode) {
		$ultimoExplode = array_pop($explode);
		$type = explode(".", $ultimoExplode);	
		$type[1] = isset($type[1]) ? $type[1] : $type;
		
		$type = ($url == 'index' ? 'html' : $type[1]);
		
		$url = ($url == 'index' ? 'index.html' : $url);
		
		if(file_exists(PUBLIC_HTML.$url)) {
			
			switch ($type) {
				case 'css': 
					header("Content-Type: text/css");
					break;
			}	
			require_once(PUBLIC_HTML.$url);
		} else {
			require_once(PUBLIC_HTML.'404.html');
		}
	}
}