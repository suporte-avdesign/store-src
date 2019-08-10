<?php

use AVD\Interfaces\Web\ConfigKeywordInterface as Keyword;




/**
 * returns the location (ipinfo\ipinfo\IPinfo)
 */
if ( !function_exists('ipLocation'))
{
    function ipLocation()
    {
        (env('IP_PRODUCTION') == true ? $ip = $_SERVER['REMOTE_ADDR'] : $ip = null);
        ($ip == '127.0.0.1' ? $details = constLang('access_local') : $details = '');
        if ($ip != '127.0.0.1') {
            $client   =  new \ipinfo\ipinfo\IPinfo(env('TOKEN_IPINFO'));
            $location =  $client->getDetails($ip);
            foreach ($location->all as $key => $value) {
                $details .= "{$key}:{$value}, ";
            }
            $details = substr($details, 0, -2);
        }
        return $details;
    }
}


/**
 * Return config language
 */
if ( !function_exists('constLang'))
{
    function constLang($key)
    {
        return config('lang_pt-BR.'. $key);
    }
}


/**
 * Route Section
 *
 * @param  string $title
 */
if (! function_exists('setRoute')) {
    function setRoute($route){

        $keyword = app(Keyword::class);

        switch ($route) {
            case 'section':
                return $keyword->routeSection();
                break;
            case 'category':
                return $keyword->routeCategory();
                break;
            case 'product':
                return $keyword->routeProduct();
                break;
            case 'color':
                return $keyword->routeColor();
                break;
        }
    }
}

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
 * Porcentagem: Retorna o valor da porcentagem entre dois valores
 *
 * @param  string $numero
 */
if (! function_exists('getPercent')) {
    function getPercent($max, $min){
        $percent = (($min / $max) * 100);
        return number_format((float)$percent,2,'.','.');
    }
}

/**
 * Porcentagem: Retorna as duas casas decimais
 *
 * @param  string $numero
 */
if (! function_exists('numFormat')) {
    function numFormat($v, $d){
        return number_format((float)$v,$d,'.','.');
    }
}

/**
 * Limitar o texto de uma string
 *
 * @param  string $numero
 */
if (! function_exists('limitText')) {
    function limitText($str, $limit=100, $clear=true, $point=false){
        if($clear = true){
            $str = strip_tags($str);
        }
        if(strlen($str) <= $limit){
            return $str;
        }
        $limit_str = substr($str, 0, $limit);
        $last = strrpos($limit_str, ' ');
        return substr($limit_str, 0, $last).'...';
    }
}


if (! function_exists('percent')) {
    function percent($p, $t)
    {
        return ($p / 100) * $t;
    }
}


/**
 * Só números
 */
if (! function_exists('onlyNumber')) {
    function onlyNumber($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }
}



if (! function_exists('random_string')) {
    function random_string($type = 'alnum', $len = 10)
    {
        switch ($type) {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                switch ($type) {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'sha1':
                return sha1(uniqid(mt_rand(), TRUE));
        }
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
 * Define path images
 *
 * @var string str
 * @return  void
 */
if (! function_exists('urf')) {
    function urf($str){

        return env('APP_URF').'/'.$str;

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

if (! function_exists('ary_diff')) {
    function ary_diff( $ary_1, $ary_2 ) {
        // compare the value of 2 array
        // get differences that in ary_1 but not in ary_2
        // get difference that in ary_2 but not in ary_1
        // return the unique difference between value of 2 array
        $diff = array();

        // get differences that in ary_1 but not in ary_2
        foreach ( $ary_1 as $v1 ) {
            $flag = 0;
            foreach ( $ary_2 as $v2 ) {
                $flag |= ( $v1 == $v2 );
                if ( $flag ) break;
            }
            if ( !$flag ) array_push( $diff, $v1 );
        }

        // get difference that in ary_2 but not in ary_1
        foreach ( $ary_2 as $v2 ) {
            $flag = 0;
            foreach ( $ary_1 as $v1 ) {
                $flag |= ( $v1 == $v2 );
                if ( $flag ) break;
            }
            if ( !$flag && !in_array( $v2, $diff ) ) array_push( $diff, $v2 );
        }

        return $diff;
    }

}


if (! function_exists('ary_unique')) {
    function ary_unique($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}


/**
 * Return Json
 */
if ( !function_exists('typeJson'))
{
    function typeJson($array)
    {
       return json_decode(json_encode($array, FALSE));
    }
}

if ( !function_exists('formatCubic'))
{
    function formatCubic($value)
    {
        $n = number_format($value, 0, '.', '');
        $d = substr($n, (strlen($n) - 3), strlen($n));
        $i = substr($n, 0, -3);
        return floatval("{$i}.{$d}");
    }
}







