<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Custom Gateway personaliser
     * 
     * @param  App\Models\Product $product
     * @param  string $print_job_ref
     * @return \Illuminate\Http\Response
     */
    public function personaliser(Product $product, $ref = null, $rowId = null)
    {
        return view('product.personaliser', compact('product', 'ref', 'rowId'));
    }

    /**
     * Custom Gateway External Pricing API
     * 
     * @param  int $id
     * @return string
     */
    public function getExternalPricingAPI($id){
		$callback = $_GET['callback'];
		$callback = preg_replace("/[^0-9a-zA-Z\$_]/", "", $callback); // XSS prevention
		
		$product = Product::find($id);
		
		$epaArray = [
			'price' => 0,
			'name' => $product->name,
			'description' => $product->description,
		];
		$epaJson = json_encode($epaArray);
		
		header('Content-type: application/javascript'); // this was text/plain as per the docs, but on poshop digitalocean server it requires application/javascript in chrome
		echo "{$callback}({$epaJson})";
		exit;
    }
}
