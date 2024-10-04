<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

trait JsonResult {

	public function json($data, int $status = null) {

        $status = $status ?? 200;

        return Response::json([
            'status' => $status,
            'data' => $data
        ], $status);
	}

    public function raw_json($data) {
        if (!isset($data['status'])) {
            $data['status'] = 200;
        }

        $status = $data['status'];

        return Response::json($data, $status);
    }

    public function success() {
        return Response::json([
            'status' => 200
        ]);
    }

    public function error($error, int $status = null, array $data = []) {

        $status = $status ?? 400;

        $errorArray = [
            'status' => $status,
            'error' => $error
        ];

        if (!empty($data)) {
            $errorArray['data'] = $data;
        }

        return Response::json($errorArray, $status);
    }

    public function errorValidationHelper(ValidationException $e)
    {
       return implode(', ', $e->validator->errors()->all());
    }

}
