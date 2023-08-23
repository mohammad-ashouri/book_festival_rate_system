<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function getLanguageInfo(Request $request)
    {
        $id=$request->input('id');
        if ($id){
            return Language::find($id)->value('name');
        }
    }
}
