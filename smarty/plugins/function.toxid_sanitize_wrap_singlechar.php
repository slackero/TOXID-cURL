<?php

/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File: function.toxid_sanitize_wrap_singlechar.php
 * Type: string, html
 * Name: toxid_sanitize_wrap_singlechar
 * Purpose: Do not wrap short char at end of text
 * "ending little a" > ending <prepend>little a</append>
 * -------------------------------------------------------------
 *
 * @param array  $params  title[, length[, append[, prepend]]]
 * @param Smarty &$smarty clever simulation of a method
 *
 * @return string
 */
function smarty_function_toxid_sanitize_wrap_singlechar($params, &$smarty)
{
	if(!isset($params['text'])) {
		return '';
	}
	if(empty($params['length'])) {
		return $params['text'];
	}

	$params['text'] = trim($params['text']);
	$params['length'] = intval($params['length']);

	if(!isset($params['prepend']) || !isset($params['append'])) {
		$params['prepend'] = '<span class="nowrap">';
		$params['append'] = '</span>';
	}

	$params['text'] = preg_replace('/\s+/', ' ', $params['text']);

	if(preg_match('/^(.+)\s(.+)\s(.{1,'.$params['length'].'})$/s', $params['text'], $match)) {
		$params['text'] = $match[1].' '.$params['prepend'].$match[2].' '.$match[3].$params['append'];
	}
	return $params['text'];
}

