<?php

namespace App\Http\Controllers;

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
        $user = User::find($id);
        return view('Users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $userID = $request->input('id');
        $name = $request->input('name');
        $family = $request->input('family');
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
            $user->name = $name;
            $user->family = $family;
            $user->type = $type;
            if ($request->password){
                $user->password=Hash::make($request->password);
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
        $name = $request->input('name');
        $family = $request->input('family');
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
        $lastUserId = User::first()->orderBy('id', 'desc')->value('id');
        $user = new User();
        $user->name = $name;
        $user->family = $family;
        $user->username = $username;
        $user->password = bcrypt($password);
        $user->scientific_group = $scientific_group;
        $user->type = $type;
        $user->subject = $subject;
        $user->save();
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
