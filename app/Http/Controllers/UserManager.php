<?php

namespace App\Http\Controllers;

use App\Models\GeneralInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManager extends Controller
{
    public function index()
    {
        $userList = User::orderByDesc('id')->paginate(20);
        return view('Users.index', compact('userList'));
    }

    public function edit($id)
    {
        $user = User::with('generalInformationInfo')->find($id);
        return view('Users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $userID = $request->input('id');
        $username = $request->input('username');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $type = $request->input('type');
        $scientific_group = $request->input('scientific_group');
        $status = $request->status;
        $ntcp = $request->ntcp;
        switch ($type) {
            case 1:
                $subject = 'ادمین کل';
                break;
            case 2:
                $subject = 'کارشناس سامانه';
                break;
            case 3:
                $subject = 'مدیر گروه';
                break;
            case 4:
                $subject = 'ارزیاب';
                break;
            case 5:
                $subject = 'کارشناس گونه بندی';
                break;
            case 6:
                $subject = 'نویسنده';
                break;
        }

        $user = User::find($userID);
        if ($user) {
            GeneralInformation::find($userID)->update([
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);
            $user->type = $type;
            $user->username = $username;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->scientific_group = $scientific_group;
            $user->subject = $subject;
            $user->active = $status;
            $user->NTCP = $ntcp;
            $user->save();
        }
        $this->logActivity('Edited User With ID => ' . $userID, request()->ip(), request()->userAgent(), session('id'));
        return redirect()->route('Users.index')
            ->with('success', 'کاربر با موفقیت ویرایش شد');
    }

    public function newUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
        ]);
        if ($validator->fails()) {
            return $this->alerts(false, 'userFounded', 'نام کاربری تکراری وارد شده است.');
        }
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $username = $request->input('username');
        $password = $request->input('password');
        $type = $request->input('type');
        $scientific_group = $request->input('scientific_group');
        switch ($type) {
            case 1:
                $subject = 'ادمین کل';
                break;
            case 2:
                $subject = 'کارشناس سامانه';
                break;
            case 3:
                $subject = 'مدیر گروه';
                break;
            case 4:
                $subject = 'ارزیاب';
                break;
            case 5:
                $subject = 'کارشناس گونه بندی';
                break;
            case 6:
                $subject = 'نویسنده';
                break;
        }
        $user = new User();
        $user->username = $username;
        $user->password = bcrypt($password);
        $user->scientific_group = $scientific_group;
        $user->type = $type;
        $user->subject = $subject;
        $user->save();

        $generalInformation = new GeneralInformation();
        $generalInformation->user_id = $user->id;
        $generalInformation->first_name = $first_name;
        $generalInformation->last_name = $last_name;
        $generalInformation->save();

        $this->logActivity('Added User With Name => ' . $username, request()->ip(), request()->userAgent(), session('id'));
        return $this->success(true, 'userAdded', 'کاربر با موفقیت تعریف شد. برای نمایش اطلاعات جدید، لطفا صفحه را رفرش نمایید.');
    }

    public function getUserInfo(Request $request)
    {
        $user = User::find($request->userID);
        $this->logActivity('Getting User Information With ID => ' . $request->userID, request()->ip(), request()->userAgent(), session('id'));
        return $user;
    }


}
