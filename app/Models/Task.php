<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table = 'task_index';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function index ($data) {

        $query = self::select();

        if (isset($data['limit']))
            $query->take($data['limit']);

        if (isset($data['offset']))
            $query->skip($data['offset']);

        if (isset($data['order'])) {
            $query->orderBy($data['order'], isset($data['desc']) && $data['desc'] ? 'desc' : 'asc');
        }

        $paginator = $query->paginate($data['pagination'] ?? 3);

        return [
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'items' => $paginator->items()
        ];
    }

    public static function get ($data) {
        $query = self::select();
        $query->where('id', $data['id'] ?? null);
        $result = $query->first();
        return $result;
    }

    public static function store ($data) {

        if (isset($data['id'])) {
            $item = self::findOrFail($data['id']);
            $item->update($data);
        }
        else {
            $item = new self();
            $item = $item->create($data);
        }

        return self::get(['id' => $item->id]);
    }

    public static function remove ($data) {
        $query = self::select();
        $query->where('id', $data['id'] ?? null);
        return $query->delete();
    }
}
