<?php

/**
 * Svg Icons
 * @ global variables
 */
global $svgIcon;

/**
 * Display Svg icon
 * 
 */

if (!function_exists('useSVG')) {
	function useSVG($filename = 'long-arrow-right')
	{
		$icon = get_stylesheet_directory() . '/dist/images/icons/' . $filename . '.svg';

		$svg_icon_content = @file_get_contents($icon);

		return $svg_icon_content;
	}
}