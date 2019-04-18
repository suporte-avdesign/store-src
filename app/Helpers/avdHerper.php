<?php


/**
 * Valor em real
 *
 * @param  string $numero
 */
if (! function_exists('setReal')) {
	function setReal($value){
		return number_format((float)$value,2,',','.');
	}
}

/**
 * Trocar números por letras e vice versa.
 *
 * @param  string $str
 */

if (! function_exists('numLetter')) {
	function numLetter($str, $opc='')
	{
		if ($opc == 'letter') {
			$array = array(
				'0' => 'a',
				'1' => 'n', 
				'2' => 's', 
				'3' => 'e', 
				'4' => 'l', 
				'5' => 'm', 
				'6' => 'o', 
				'7' => 'v', 
				'8' => 'i', 
				'9' => 'u' 
			);
		} else {
			$array = array(
				'a' => 0,
				'n' => 1, 
				's' => 2, 
				'e' => 3, 
				'l' => 4, 
				'm' => 5, 
				'o' => 6, 
				'v' => 7, 
				'i' => 8, 
				'u' => 9 
			);
		}
		
		return strtr($str, $array);
	}
}

/**
 * Verifica se existe uma string no array.
 *
 * @var string str
 * @var array
 * @return  true ou false
 */
if (! function_exists('strInArray')) {
	function strInArray($str, $array){
		if (in_array($str, $array)) {
			return true;
		} else {
			return false;
		}
	}
}	
