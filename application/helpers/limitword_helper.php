<?php
defined('BASEPATH') or exit('No direct script access allowed');

function limit_word($text, $limit)
{
	if (str_word_count($text, 0) > $limit) {
		$words = str_word_count($text, 2);
		$pos = array_keys($words);
		$text = substr($text, 0, $pos[$limit]) . '...';
	}
	return $text;
}

function limit_word_regex($text, $limit)
{
	if (str_word_count($text, 0) > $limit) {
		$words = str_word_count($text, 2);
		$pos = array_keys($words);
		$text = substr(
			htmlspecialchars(
				preg_replace(
					"/&#?[a-z0-9]{2,8};/i",
					"",
					(preg_replace('/<+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>+/i', '', $text))
				)
			),
			0,
			$pos[$limit]
		) . '...';
	}
	return $text;
}
