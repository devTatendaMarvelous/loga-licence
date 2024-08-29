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
        $licence = new Licence();
        $licence->model_id = $request->model_id ?? null;
        $licence->model = $request->model ?? null;
        $licence->licence_key = $request->licence_key;
        $licence->licence = $request->licence;
        $licence->save();

        return response()->json(['message' => 'success', 'data' => $licence->id], 201);
    }


}
