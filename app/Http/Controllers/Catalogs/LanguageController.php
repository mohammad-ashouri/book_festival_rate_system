<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Language;
use App\Models\Catalogs\Publisher;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class LanguageController extends Controller
{
    public function getLanguageInfo(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            return Language::find($id)->value('name');
        }
        abort(403);
    }

    public function index()
    {
        $languages = Language::orderBy('name')->paginate(20);
        return view('Catalogs.Languages.index', compact('languages'));
    }

    public function create()
    {
        return view('Catalogs.Languages.create');
    }

    public function store(Request $request)
    {
        $languageExists = Language::where('name', $request->name)->exists();

        if ($languageExists) {
            return back()->withErrors(['name' => 'نام زبان تکراری وارد شده است']);
        }

        $newLanguage = new Language();
        $newLanguage->name = $request->name;
        $newLanguage->save();

        return redirect()->route('Languages.index')
            ->with('success', 'زبان با موفقیت تعریف شد.');
    }

    public function edit($id)
    {
        $language = Language::find($id);
        if (empty($language)) {
            abort(403);
        }
        return view('Catalogs.Languages.edit', compact('language'));
    }

    public function update(Request $request)
    {
        $language = Language::find($request->id);
        if (empty($language)) {
            abort(403);
        }
        $language->name = $request->input('name');
        $language->status = $request->input('status');
        $language->save();

        return redirect()->route('Languages.index')
            ->with('success', 'زبان با موفقیت ویرایش شد');
    }
}
