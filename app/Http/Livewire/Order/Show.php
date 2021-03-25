<?php

namespace App\Http\Livewire\Order;

use Livewire\Component;

use App\Models\Order;
use App\Models\Product;

use Illuminate\Support\Facades\Log;

class Show extends Component
{
    public Order $order;

    public function render()
    {
        return view('livewire.order.show');
    }

    public function submit()
    {
        $gateway_data = $this->gatewayPrepare($this->order->basket_content);
        $this->gatewaySend($gateway_data);

        $this->order->update([
            'submitted_to_gateway' => 1,
        ]);
        
        session()->flash('flash.banner', 'Order submitted to Gateway!');
        session()->flash('flash.bannerStyle', 'success');

        $this->order = $this->order->refresh();
    }

    private function gatewayPrepare($basket)
    {
        $gateway_order_id = env('GATEWAY_ORDER_PREFIX') . '-' . $this->order->id;

        $gatewayArray = [
            'external_ref' => $gateway_order_id,
            'company_ref_id' => env('GATEWAY_RETAILER'),
            'sale_datetime' => date('Y-m-d H:i:s'),
            
            'customer_name' => $this->order->name,
            'customer_email' => '',
			
			'shipping_address_1' =>	$this->order->address_line_1,
			'shipping_address_2' =>	$this->order->address_line_2,
			'shipping_address_3' =>	$this->order->town,
			'shipping_address_4' =>	$this->order->county,
			'shipping_address_5' =>	'',
			'shipping_postcode' =>	$this->order->postcode,
			'shipping_country' =>	'',
			'shipping_country_code' => 'GB',
			
			'shipping_method' =>	'',
			'shipping_carrier' =>	'',
			'shipping_tracking' =>	'',
			
			'billing_address_1' =>	'',
			'billing_address_2' =>	'',
			'billing_address_3' =>	'',
			'billing_address_4' =>	'',
			'billing_address_5' =>	'',
			'billing_postcode' =>	'',
			'billing_country' =>	'',
			
			'payment_trans_id' =>	'',
			
			'items' =>				[],
        ];

        $i = 1;
        $items = [];
        foreach($basket as $row){
            if($row->options->ref){
                $product = Product::where('sku', $row->id)->first();
                
                $productArray = [
                    'sku' => $product->sku,
                    'external_ref' => $gateway_order_id . '-' . $i,
                    'description' => $row->name,
                    'quantity' => $row->qty,
                    'type' => 2, // 2 = Print Job (http://developers.gateway3d.com/Print-iT_Integration#Item_Type_Codes)
                    'print_job_ref' => $row->options->ref,
                    'unit_sale_price' => $row->price,
                    'aspects' => [$row->options->aspects],
                ];
				
				$items[] = $productArray;
				$i++;
            }
        }
        
        // put the items in the array
		$gatewayArray['items'] = array_merge($gatewayArray['items'], $items);
        
        // gateway wants it in json format
		return json_encode($gatewayArray);
    }

    private function gatewaySend($gateway_data)
    {
        $gatewayUrl = env('GATEWAY_API_URL');
        $gatewayRetailerId = env('GATEWAY_RETAILER');
        $gatewayApiKey = env('GATEWAY_API_KEY');
        
		$curl = curl_init($gatewayUrl);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, true);

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: Basic ' . $gatewayRetailerId . ':' . $gatewayApiKey;

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $gateway_data);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);

		$gatewayResponse = curl_exec($curl);

		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		if($status != 200) {
			die("Error: call to URL $gatewayUrl failed with status $status, response $gatewayResponse, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
		}

		curl_close($curl);
    }
}
