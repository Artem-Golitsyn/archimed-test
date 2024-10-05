<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResult;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Task2Controller extends Controller
{
    use JsonResult;

    public function index (Request $request) {

        try {
            $data = $request->validate([
                'name'          => 'string',
                'price_from'    => 'int',
                'price_to'      => 'int',
                'bedrooms'      => 'int',
                'bathrooms'     => 'int',
                'storeys'       => 'int',
                'garages'       => 'int'
            ]);
        } catch (ValidationException $e) {
            return $this->error($this->errorValidationHelper($e));
        }

        $data = House::index($data);

        return $this->json($data);
    }
}
