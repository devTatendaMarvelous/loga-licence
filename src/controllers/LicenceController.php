<?php

namespace App\Http\Controllers\LogaLicence;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Marvelous\Licence\Models\Licence;

class LicenceController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->filled('model_id')) {

            $licence = \Marvelous\Licence\Licence::createLicence($request->model_id);

            return response()->json(['message' => 'success', 'data' => $licence], 201);
        }else{
            return response()->json(['message' => 'Error', 'errors' => "model_id Is required"], 400);
        }
    }


}
