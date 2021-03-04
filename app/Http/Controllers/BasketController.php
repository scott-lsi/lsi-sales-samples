<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Basket;

use App\Models\Product;

class BasketController extends Controller
{
    /**
     * Add a product to the basket
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, Product $product, $rowId = null)
    {
        // get the custom gateway request
        $custom_gateway_data = $request->data;

        // sort out the options for the basket row
        $options = [];

        // add the product model so we can allow a link to edit the personalisation
        $options['product'] = $product;

        // aspects
        $aspects = [];
        if(isset($custom_gateway_data['extra']['state']['aspects'][0]['aspect_id'])){
        	$aspects = [
        		'aspect_id' => $custom_gateway_data['extra']['state']['aspects'][0]['aspect_id'],
        		'option_id' => $custom_gateway_data['extra']['state']['aspects'][0]['option_id'],
        	];
        }
        $options['aspects'] = $aspects;

        // get the print job
        $options['ref'] = $custom_gateway_data['ref'];

        // get the image url
        $options['imageurl'] = $custom_gateway_data['thumbnails'][0]['url'];

        // get the personalisation text
        if(isset($custom_gateway_data['extra']['state']['text_areas'])){
            $textInputs = [];
            foreach($custom_gateway_data['extra']['state']['text_areas'] as $textarea){
                if(isset($textarea['text'])){
                    $textInputs[] = $textarea['text'];
                }
            }
            $options['textinputs'] = $textInputs;
        }

        // gather the stuff to add to the basket
        $product_to_add = [
            'id' =>     $product->sku,
            'name' =>   $product->name,
            'qty' =>    (int)$custom_gateway_data['quantity'],
            'price' =>  0,
            'options' => $options
        ];
        
        // check if it's an update to an existing row or it's a new submission
        // if there's a rowId in the request (it's a url parameter), it's an update to an existing row
        if($rowId){
            // update the row
            Basket::update($rowId, $product_to_add);
            
            // send the user a message
            session()->flash('flash.banner', 'Basket updated!');
            session()->flash('flash.bannerStyle', 'success');

            // just return the url, not a redirect, as the window href is changed by the js in personaliser.blade.php
            return route('basket.show');
        } else {
            // add the product
            Basket::add($product_to_add);

            // send the user a message
            session()->flash('flash.banner', $custom_gateway_data['quantity'] . ' x ' . $product->name . ' added to your basket');
            session()->flash('flash.bannerStyle', 'success');

            // just return the url, not a redirect, as the window href is changed by the js in personaliser.blade.php
            return route('product.show', $product);
        }
    }
}
