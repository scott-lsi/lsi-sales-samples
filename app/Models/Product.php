<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $guarded = [];

    public function product_images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function getMainProductImageAttribute()
    {
        if(!$this->product_images->isEmpty()){
            return $this->main_product_image = $this->product_images->first()->filename;
        }
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the origin and URL for a Custom Gateway personaliser
     * 
     * @return array
     */
    public function personaliser($ref = null)
    {
        $iframeOrigin = 'https://g3d-app.com';
        $iframeUrl = $iframeOrigin;
        $iframeUrl .= '/s/app/acp3_2/en_GB/';
        if($this->gateway_config){
            $iframeUrl .= $this->gateway_config . '.html';
        } else {
            $iframeUrl .= env('GATEWAY_CONFIG') . '.html';
        }
        $iframeUrl .= '#p=' . $this->gateway_id;
        if($this->gateway_dropship){
            $iframeUrl .= '&d=' . $this->gateway_dropship;
        } else {
            $iframeUrl .= '&d=' . env('GATEWAY_DROPSHIP');
        }
        if($ref){
            $iframeUrl .= '&pj=' . $ref;
        }
        $iframeUrl .= '&r=2d-canvas';
        $iframeUrl .= '&a2c=postMessage';
        $iframeUrl .= '&epa=' . rawurlencode(route('product.personaliser.epa', $this->id));
        $iframeUrl .= '&_usePs=1&_pav=3';

        return [
            'iframeOrigin' => $iframeOrigin,
            'iframeUrl' => $iframeUrl
        ];
    }

    public function getProductIdAttribute()
    {
        return $this->id;
    }
}
