<?php
defined('BASEPATH') or exit('No direct script access allowed');

function slug($text, $sep = '-', $lowercase = true)
{
	// replace non letter or digits by -
	$text = preg_replace('~[^\\pL\d]+~u', $sep, $text);
	// trim
	$text = trim($text, $sep);
	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	// lowercase
	if ($lowercase == true) {
		$text = strtolower($text);
	}
	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', $sep, $text);
	if (empty($text)) {
		return 'n-a';
	}
	return $text;
}
