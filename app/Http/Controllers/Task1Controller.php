<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResult;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Task1Controller extends Controller
{
    use JsonResult;

    const PER_PAGE = 3;
    const AUTH_LOGIN = 'admin';
    const AUTH_PASSWORD = 'admin';

    public function index (Request $request) {

        try {
            $request->validate([
                'order' => 'required|string|in:id,name,admin_check,email',
                'desc' => 'required|int|in:1,0',
                'page' => 'required|int',
            ]);
        } catch (ValidationException $e) {
            return $this->error($this->errorValidationHelper($e));
        }

        $data = Task::index([
            'order' => $request->get('order'),
            'desc' => $request->get('desc'),
            'pagination' => env('PAGINATION_PER_PAGE', self::PER_PAGE),
        ]);


        return $this->json($data);
    }

    public function store (Request $request) {
        try {
            $data = $request->validate([
                'id' => 'int',
                'name' => 'required|string|filled',
                'email' => 'required|string|filled',
                'description' => 'required|string|filled',
                'admin_check' => 'int',
            ]);
        } catch (ValidationException $e) {
            return $this->error($this->errorValidationHelper($e));
        }

        // Только создание
        if (!$request->session()->exists('admin')) {
            unset ($data['id'], $data['admin_check']);
        }

        $data = Task::store($data);

        return $this->json($data);
    }

    public function login (Request $request) {
        try {
            $data = $request->validate([
                'login' => 'required|string|filled',
                'password' => 'required|string|filled'
            ]);
        } catch (ValidationException $e) {
            return $this->error($this->errorValidationHelper($e));
        }

        if (env('AUTH_LOGIN', self::AUTH_LOGIN) === $data['login'] && env('AUTH_PASSWORD', self::AUTH_PASSWORD) === $data['login']) {
            $request->session()->put('admin', true);
            return $this->success();
        }
        else {
            return $this->error('User is not found', 404);
        }
    }

    public function logout (Request $request) {
        $request->session()->forget('admin');
        return $this->success();
    }
}
