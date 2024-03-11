<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function getFestivalInfo(Request $request)
    {
        if ($request->id) {
            return Festival::find($request->input('id'));
        }
        abort(403);
    }
    public function index()
    {
        $festivals = Festival::orderBy('name', 'asc')->paginate(20);
        return view('Catalogs.Festivals.index', compact('festivals'));
    }

    public function create()
    {
        $lastFestival = Festival::orderByDesc('id')->first();
        return view('Catalogs.Festivals.create',compact('lastFestival'));
    }

    public function store(Request $request)
    {
        $publisherExists = Publisher::where('name', $request->name)->exists();

        if ($publisherExists) {
            return back()->withErrors(['name' => 'نام ناشر تکراری وارد شده است']);
        }

        $newPublisher = new Publisher();
        $newPublisher->name = $request->name;
        $newPublisher->save();

        return redirect()->route('Publishers.index')
            ->with('success', 'ناشر با موفقیت اضافه شد');
    }

    public function edit($id)
    {
        $publisher = Publisher::find($id);
        if (empty($publisher)) {
            abort(403);
        }
        return view('Catalogs.Publishers.edit', compact('publisher'));
    }

    public function update(Request $request)
    {
        $publisher = Publisher::find($request->id);
        if (empty($publisher)) {
            abort(403);
        }
        $publisher->name = $request->input('name');
        $publisher->status = $request->input('status');
        $publisher->save();

        return redirect()->route('Publishers.index')
            ->with('success', 'ناشر با موفقیت ویرایش شد');
    }
}
