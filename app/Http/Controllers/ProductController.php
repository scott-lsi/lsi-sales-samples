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
}
