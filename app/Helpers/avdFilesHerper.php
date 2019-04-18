<?php
use Illuminate\Contracts\Filesystem\Factory as fileFactory ;
use Illuminate\Support\Facades\Storage as Storage;

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
 * Criar arquivo txt dos acessos dos usuário administrativos.
 *
 * @var string str
 * @return  void
 */
if (! function_exists('generateAccessesTxt')) {
	function generateAccessesTxt($str){
		$factory = app(fileFactory::class);
		$path    = 'Accesses/'.auth()->user()->id.'/'.date('d-m-Y').'.txt';

		$diskAccesses = $factory->disk('local');
		if ($diskAccesses->exists($path)) {
			$diskAccesses->append($path, $str); 
		} else {
			$diskAccesses->put($path, $str);
		}

	}
}
