<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class House extends Model
{

    protected $table = 'house_index';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $guarded = [
        'id'
    ];

    public static function index ($data) {

        $query = self::select();

        if (isset($data['name'])) {
            $search = '%'.$data['name'].'%';
            $query->where('name', 'like', $search);
        }

        /*
        if (isset($data['price'], $data['price']['from'], $data['price']['to']) ){
            $query->whereBetween('price', [$data['price']['from'], $data['price']['to']));
        }
        */

        if (isset($data['price_from'])){
            $query->where('price', '>=', $data['price_from']);
        }
        if (isset($data['price_to'])){
            $query->where('price', '<=', $data['price_to']);
        }

        if (isset($data['bedrooms'])){
            $query->where('bedrooms', $data['bedrooms']);
        }

        if (isset($data['bathrooms'])){
            $query->where('bathrooms', $data['bathrooms']);
        }

        if (isset($data['storeys'])){
            $query->where('storeys', $data['storeys']);
        }

        if (isset($data['garages'])){
            $query->where('garages', $data['garages']);
        }

        $result = $query->get()->toArray();

        return $result;
    }
}
