<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::orderBy('name', 'asc')->paginate(20);
        return view('Catalogs.Publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('Catalogs.Publishers.create');
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
