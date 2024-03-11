<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\ScientificGroup;
use Illuminate\Http\Request;

class ScientificGroupController extends Controller
{
    public function getScientificGroupInfo(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            return ScientificGroup::find($id);
        }
        abort(403);
    }

    public function getAllGroups()
    {
        return ScientificGroup::all();
    }
}
