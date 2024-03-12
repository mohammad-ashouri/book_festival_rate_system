<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Festival;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

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
        $festivals = Festival::orderByDesc('id')->paginate(20);
        return view('Catalogs.Festivals.index', compact('festivals'));
    }

    public function create()
    {
        $lastFestival = Festival::orderByDesc('id')->first();
        return view('Catalogs.Festivals.create', compact('lastFestival'));
    }

    public function store(Request $request)
    {
        $activeFestival = Festival::where('active', 1)->first();

        if ($activeFestival) {
            $activeFestival->active = 0;
            $activeFestival->save();
        }

        $newFestival = new Festival();
        $newFestival->name = $request->name;
        $newFestival->starter = session('id');
        $newFestival->start_date = Jalalian::fromFormat('Y/n/j', $request->start_year . '/' . $request->start_month . '/' . $request->start_day)->toCarbon();
        $newFestival->save();

        return redirect()->route('Festivals.index')
            ->with('success', 'دوره با موفقیت تعریف شد.');
    }

    public function edit($id)
    {
        $festival = Festival::find($id);
        if (empty($festival)) {
            abort(403);
        }
        return view('Catalogs.Festivals.edit', compact('festival'));
    }

    public function update(Request $request)
    {
        $festival = Festival::find($request->id);

        if (empty($festival)) {
            abort(403);
        }

        if ($request->status == 0 and (!$request->filled('finish_year') || !$request->filled('finish_month') || !$request->filled('finish_day'))) {
            return back()->withErrors(['date' => 'در صورت غیرفعال شدن همایش، باید تاریخ پایان مشخص باشد']);
        }

        $festival->name = $request->name;
        $festival->starter = session('id');
        $festival->start_date = Jalalian::fromFormat('Y/n/j', $request->start_year . '/' . $request->start_month . '/' . $request->start_day)->toCarbon();
        if ($request->finish_year) {
            $festival->finish_date = Jalalian::fromFormat('Y/n/j', $request->finish_year . '/' . $request->finish_month . '/' . $request->finish_day)->toCarbon();
        }
        $festival->active = $request->status;
        $festival->save();

        return redirect()->route('Festivals.index')
            ->with('success', 'دوره با موفقیت ویرایش شد.');
    }
}
