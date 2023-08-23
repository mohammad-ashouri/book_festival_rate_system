<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function getFestivalInfo(Request $request)
    {
        return Festival::find($request->input('id'));
    }
}
