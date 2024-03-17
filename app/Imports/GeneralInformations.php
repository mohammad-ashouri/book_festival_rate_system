<?php

namespace App\Imports;

use App\Models\Catalogs\DocumentType;
use App\Models\Document;
use App\Models\GeneralInformation;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class GeneralInformations implements ToModel
{
    public function model(array $row)
    {
        // Define how each row in the Excel file should be mapped to your database model
        $user = User::find($row[0]);
        if ($user) {
            if ($row[7] == 'TRUE') {
                $gender = 'مرد';
            } else {
                $gender = 'زن';
            }
            if ($row[8] == 'TRUE') {
                $nationality = 'ایرانی';
            } else {
                $nationality = 'غیر ایرانی';
            }
            GeneralInformation::create([
                'user_id' => $user->id,
                'address' => $row[1],
                'mobile' => $row[2],
                'phone' => $row[3],
                'national_code' => $user->username,
                'email' => $row[4],
                'first_name' => $row[5],
                'last_name' => $row[6],
                'gender' => $gender,
                'nationality' => $nationality,
            ]);
        }
    }
}
