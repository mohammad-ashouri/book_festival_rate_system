<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\DefencePlace;
use Illuminate\Http\Request;

class DefencePlaceController extends Controller
{
    public function index()
    {
        $defencePlaces = DefencePlace::orderBy('name', 'asc')->paginate(20);
        return view('Catalogs.DefencePlaces.index', compact('defencePlaces'));
    }

    public function create()
    {
        return view('Catalogs.DefencePlaces.create');
    }

    public function store(Request $request)
    {
        $defencePlaceExists = DefencePlace::where('name', $request->name)->exists();

        if ($defencePlaceExists) {
            return back()->withErrors(['name' => 'نام محل دفاع تکراری وارد شده است']);
        }

        $newDefencePlace = new DefencePlace();
        $newDefencePlace->name = $request->name;
        $newDefencePlace->save();

        return redirect()->route('DefencePlaces.index')
            ->with('success', 'محل دفاع با موفقیت اضافه شد');
    }

    public function edit($id)
    {
        $defencePlace = DefencePlace::find($id);
        if (empty($defencePlace)) {
            abort(403);
        }
        return view('Catalogs.DefencePlaces.edit', compact('defencePlace'));
    }

    public function update(Request $request)
    {
        $defencePlace = DefencePlace::find($request->id);
        if (empty($defencePlace)) {
            abort(403);
        }
        $defencePlace->name = $request->input('name');
        $defencePlace->status = $request->input('status');
        $defencePlace->save();

        return redirect()->route('DefencePlaces.index')
            ->with('success', 'محل دفاع با موفقیت ویرایش شد');
    }
}
