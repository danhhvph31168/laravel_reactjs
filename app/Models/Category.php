<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
    ];

    // public $attributes = [
    //     'slug' => 'ahuhu'
    // ];                              // mặc định add

    // public $timestamp = false;   // ngắt timestamps

    public static function boot() // event
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = \Str::slug($model->name);
        });

        static::created(function ($model) {
            \Log::info('Add data', $model->toArray());
        });

        static::retrieved(function ($model) {
            $model->name = strtoupper($model->name);
            $model->hehe = 'Tạo mới dữ liệu ko có trong data';
        });
    }
}
