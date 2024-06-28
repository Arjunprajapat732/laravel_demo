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
?>