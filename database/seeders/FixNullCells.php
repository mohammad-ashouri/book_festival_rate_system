<?php

namespace Database\Seeders;

use App\Models\GeneralInformation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixNullCells extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::with('generalInformationInfo')->whereHas('generalInformationInfo', function ($query) {
            $query->whereNull('first_name');
        })->delete();
//        GeneralInformation::where('first_name','=',null)->delete();
//        GeneralInformation::where('last_name','=',null)->update(['last_name'=>'-']);
//        GeneralInformation::where('national_code','=',null)->update(['national_code'=>'-']);
//        GeneralInformation::where('howzah_code','=',null)->update(['howzah_code'=>'-']);
//        GeneralInformation::where('mobile','=',null)->update(['mobile'=>'-']);
//        GeneralInformation::where('gender','=',null)->update(['gender'=>'-']);
//        GeneralInformation::where('email','=',null)->update(['email'=>'-']);
    }
}
