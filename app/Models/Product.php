<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Product extends Model implements Sitemapable
{
    use HasApiTokens;
    protected $fillable = ['name','url','data','removed','path','is_local','product_type','Product_Name','Product_Description','Name_Seo','Description_Seo','Price','Mode'];


    public function toSitemapTag(): Url | string | array
    {
        return Url::create(route('product_page',[
            'product' => $this->Product_Type,
            'id'      => $this->name,
        ]))
            ->setLastModificationDate(Carbon::yesterday())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.7);
    }


}
