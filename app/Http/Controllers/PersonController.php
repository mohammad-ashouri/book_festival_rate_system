<?php

namespace App\Http\Controllers;

use App\Models\Catalogs\Publisher;
use App\Models\GeneralInformation;
use App\Models\User;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $personList = User::with('generalInformationInfo')->where('type', 6)->orderBy('id')->paginate(20);
        return view('Persons.index', ['personList' => $personList]);
    }

    public function create()
    {
        return view('Persons.create');
    }

    public function store(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $national_code = $request->input('national_code');
        $howzah_code = $request->input('howzah_code');
        $mobile = $request->input('mobile');
        $gender = $request->input('gender');
        if (!$first_name) {
            return back()->withErrors(['نام وارد نشده است!']);
        }
        if (!$last_name) {
            return back()->withErrors(['نام خانوادگی وارد نشده است!']);
        }
        if (!$national_code) {
            return back()->withErrors(['کد ملی وارد نشده است!']);
        }
        if (!$mobile) {
            return back()->withErrors(['شماره همراه وارد نشده است!']);
        }
        if (!$gender) {
            return back()->withErrors(['جنسیت انتخاب نشده است!']);
        }
        if (!$howzah_code) {
            return back()->withErrors(['شماره پرونده حوزوی وارد نشده است!']);
        }

        $check = GeneralInformation::where('national_code', $national_code)->exists();
        if ($check) {
            return back()->withErrors(['کد ملی تکراری وارد شده است!']);
        }

        $user = User::firstOrCreate([
            'username' => $national_code,
            'password' => bcrypt(12345678),
            'type' => 6,
            'subject' => 'نویسنده',
            'NTCP' => 1,
        ]);

        $generalInformation = new GeneralInformation();
        $generalInformation->user_id = $user->id;
        $generalInformation->first_name = $first_name;
        $generalInformation->last_name = $last_name;
        $generalInformation->national_code = $national_code;
        $generalInformation->howzah_code = $howzah_code;
        $generalInformation->mobile = $mobile;
        $generalInformation->gender = $gender;
        $generalInformation->save();

        $this->logActivity('Person Added =>' . $generalInformation->id, \request()->ip(), \request()->userAgent(), \session('id'));
        return redirect()->route('Person.index')
            ->with('success', 'صاحب اثر با موفقیت اضافه شد');
    }

    public function edit($id)
    {
        $person = User::with('generalInformationInfo')->find($id);
        if (empty($person)) {
            abort(403);
        }
        return view('Persons.edit', compact('person'));
    }

    public function update(Request $request)
    {
        $user_id = $request->input('id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $national_code = $request->input('national_code');
        $howzah_code = $request->input('howzah_code');
        $mobile = $request->input('mobile');
        $gender = $request->input('gender');
        if (!$first_name) {
            return back()->withErrors(['نام وارد نشده است!']);
        }
        if (!$last_name) {
            return back()->withErrors(['نام خانوادگی وارد نشده است!']);
        }
        if (!$national_code) {
            return back()->withErrors(['کد ملی وارد نشده است!']);
        }
        if (!$mobile) {
            return back()->withErrors(['شماره همراه وارد نشده است!']);
        }
        if (!$gender) {
            return back()->withErrors(['جنسیت انتخاب نشده است!']);
        }
        if (!$howzah_code) {
            return back()->withErrors(['شماره پرونده حوزوی وارد نشده است!']);
        }

        $check = GeneralInformation::where('national_code', $national_code)->where('user_id', '!=', $user_id)->exists();
        if ($check) {
            return back()->withErrors(['کد ملی تکراری وارد شده است!']);
        }

        $user = User::find($user_id)->update([
            'username' => $national_code,
        ]);
        if ($user) {
            $this->logActivity('User Edited =>' . $user_id, \request()->ip(), \request()->userAgent(), \session('id'));
        }
        $Person = GeneralInformation::where('user_id', $user_id)->first();
        $Person->fill([
            'user_id' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'mobile' => $mobile,
            'national_code' => $national_code,
            'howzah_code' => $howzah_code,
            'gender' => $gender,
        ]);
        $Person->save();

        $this->logActivity('Person Edited =>' . $user_id, \request()->ip(), \request()->userAgent(), \session('id'));
        return redirect()->route('Person.index')
            ->with('success', 'صاحب اثر با موفقیت ویرایش شد');
    }

}
