<?php
use Illuminate\Contracts\Filesystem\Factory as fileFactory;

use Barryvdh\DomPDF\Facade as PDF;

/**
 * Abrir PDF no browser
 * @var $order array
 * @return  json
 */
if (! function_exists('printerOrderPdf')) {
    function printerOrderPdf($order) {

        $pdf_url  = 'storage/pdf/order';
        $factory = app(fileFactory::class);
        $diskAccesses = $factory->disk('local');

        $name = md5($order->id) . md5($order->user_id).'.pdf';
        $year = date('Y', strtotime($order->created_at));
        $file = url("{$pdf_url}/{$year}/{$order->user_id}/{$name}");
        $path    = "public/pdf/order/{$year}/{$order->user_id}/{$name}";



        if ($diskAccesses->exists($path)) {
            $success = true;
            $message = 'Imprimir PDF';
            $pdf = $file;

        } else {
            $success = false;
            $message = 'O PDF não foi localizado, atualize o pedido.';
            $pdf = '';
        }
        $out = array(
            "success" => $success,
            "message" => $message,
            "pdf" => $pdf
        );

        if ($diskAccesses->exists($path)) {
            $out['taget'] =  "_blank";

            generateAccessesTxt(
                date('H:i:s').utf8_decode(
                    ' Imprimiu o pedido:'.$order->id)
            );
        }

        return response()->json($out);

    }
}

/**
 * Gerar arquivos pdf dor order.
 *
 * @var string str
 * @return  void
 */
if (! function_exists('generateOrderPdf')) {
    function generateOrderPdf($order, $configImages, $method){


        $photo_url = 'storage/';
        $pdf_url   = 'storage/pdf/order';
        $disk_pdf  = storage_path('app/public/pdf/order');
        $view_pdf  = 'backend.orders.pdf';

        $items = $order->items;
        $notes = $order->notes;
        $year = date('Y', strtotime($order->created_at));
        $shippings = $order->shippings;

        $image = $configImages;

        $name = md5($order->id) . md5($order->user_id).'.pdf';
        $path = "{$disk_pdf}/{$year}/{$order->user_id}";
        $file = "{$path}/{$name}";

        $route = url("{$pdf_url}/{$year}/{$order->user_id}/{$name}");

        if ($method == 'store') {

            if ( !file_exists($path) ) {
                Storage::makeDirectory($path, 0777, true);
            }
        }

        if (file_exists($file)) {
            $delete = unlink($file);
        }

        $pdf = PDF::loadView("{$view_pdf}", compact(
            'order', 'items', 'notes', 'shippings', 'image', 'photo_url'
        ));
        $pdf->save($file);

        return $route;
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
		$admin   = auth()->guard('admin')->user();
		$path    = 'Accesses/'.$admin->id.'/'.date('d-m-Y').'.txt'; 

		$diskAccesses = $factory->disk('local');
		if ($diskAccesses->exists($path)) {
			$diskAccesses->append($path, $str); 
		} else {
			$diskAccesses->put($path, $str);
		}

	}
}