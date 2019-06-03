<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{   
    const TYPE_NORMAL = 'normal';
    const TYPE_CROWDFUNDING = 'crowdfunding';

    public static $typeMap=[
        self::TYPE_NORMAL => '普通商品',
        self::TYPE_CROWDFUNDING => '众筹商品',
    ];
    protected $fillable = [
        'title', 'long_title', 'description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'price','type'
    ];
    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];
    // 与商品SKU关联
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    public function getImageUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return \Storage::disk('public')->url($this->attributes['image']);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function crowdfunding()
    {
        return $this->hasOne(CrowdfundingProduct::class);
    }

    public function properties()
    {
        return $this->hasMany(ProductProperty::class);
    }

    public function getGroupedPropertiesAttribute()
    {
        return $this->properties
            ->groupBy('name')
            // 使用 map 方法将属性集合变为属性值集合
            ->map(function($properties){
                //pluck('value') 方法，这个方法会返回该集合中所有的 value 字段值所组成的新集合。
                return $properties->pluck('value')->all(); 
            });
    }

    public function toESArray()
    {
        // 只取出需要的字段
        $arr = array_only($this->toArray(), [
            'id',
            'type',
            'title',
            'category_id',
            'long_title',
            'on_sale',
            'rating',
            'sold_count',
            'review_count',
            'price',
        ]);

        // 如果商品有类目，则 category 字段为类目名数组，否则为空字符串
        $arr['category'] = $this->category ? explode(' - ', $this->category->full_name) : '';
        // 类目的 path 字段
        $arr['category_path'] = $this->category ? $this->category->path : '';
        // strip_tags 函数可以将 html 标签去除
        $arr['description'] = strip_tags($this->description);
        // 只取出需要的 SKU 字段
        $arr['skus'] = $this->skus->map(function (ProductSku $sku) {
            return array_only($sku->toArray(), ['title', 'description', 'price']);
        });
        // 只取出需要的商品属性字段
        // $arr['properties'] = $this->properties->map(function (ProductProperty $property) {
        //     return array_only($property->toArray(), ['name', 'value']);
        // });
        // 添加search_value字段
        $arr['properties'] = $this->properties->map(function (ProductProperty $property) {
            // 对应地增加一个 search_value 字段，用符号 : 将属性名和属性值拼接起来
            return array_merge(array_only($property->toArray(), ['name', 'value']), [
                'search_value' => $property->name.':'.$property->value,
            ]);
        });

        return $arr;
    }

    public function scopeByIds($query, $ids)
    {
        return $query->whereIn('id', $ids)->orderByRaw(sprintf("FIND_IN_SET(id, '%s')", join(',', $ids)));
    }
}
