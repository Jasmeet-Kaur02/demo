<?php

namespace App\Http\Controllers;

use App\Exports\DemoFieldExport;
use App\Models\DemoField;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class DemoFieldController extends Controller
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            "firstName" => "required|string",
            "lastName" => "required|string"
        ]);

        if($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validatedData = $validator->valid();

        $demoField = DemoField::create($validatedData);
        $data = new stdClass;
        $data->demoField = $demoField;

        return response()->json([
            "data" => $data,
            "message" => "Data has been added",
            "status" => true
        ], 201);
    }


    public function get() 
    {
       return Excel::download(new DemoFieldExport(), "demo-fields.xlsx");
    }
}
