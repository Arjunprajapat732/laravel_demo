<?php
	function pre($str) {
		echo '<pre>';
		print_r($str);
		echo '</pre>';
	}
	function pred($str) {
		echo '<pre>';
		print_r($str);
		echo '</pre>';
		die;
	}
	function formatFileSize($bytes) {
		$sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
		$factor = floor((strlen($bytes) - 1) / 3);
		return sprintf("%.2f", $bytes / pow(1024, $factor)) . @$sizes[$factor];
	}
?>