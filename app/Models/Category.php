<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'is_directory', 'level', 'path'];
    protected $casts = ['is_directory' => 'boolean'];

    protected static function boot()
    {
    	parent::boot();
    	static::creating(function (Category $category){
    		if(is_null($category->parent_id)){
    			$category->level = 0;
    			$category->path = '-';
    		}else{
    			$category->level = $category->parent->level + 1;
    			$category->path = $category->parent->path . $category->parent_id . '-';
    		}
    	});
    }

    public function parent()
    {
    	return $this->belongsTo(Category::class);
    }

    public function children()
    {
    	return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
    	return $this->hasMany(product::class);
    }

    //获取所有祖先类目的 ID 值
    public function getPathIdsAttribute()
    {
    	return array_filter(explode('-', trim($this->path, '-')));
    }

    public function getAncestorsAttribute()
    {
    	return Category::query()
    			->whereIn('id', $this->path_ids)
    			->orderBy('level')
    			->get();
    }

    public function getFullNameAttribute()
    {
    	return $this->ancestors // 获取所有祖先类目
    				->pluck('name') // 取出所有祖先类目的 name 字段作为一个数组
    				->push($this->name) // 将当前类目的 name 字段值加到数组的末尾
    				->implode('-'); // 用 - 符号将数组的值组装成一个字符串
    }
}
