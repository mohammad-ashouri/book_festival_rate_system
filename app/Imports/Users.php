<?php

namespace App\Imports;

use App\Models\Catalogs\DocumentType;
use App\Models\Document;
use App\Models\GeneralInformation;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class Users implements ToModel
{
    public function model(array $row)
    {
        // Define how each row in the Excel file should be mapped to your database model
        $user = User::where('username', $row[1])->exists();
        if (!$user) {
            $user = User::create([
                'id' => $row[0],
                'username' => $row[1],
                'password' => bcrypt(12345678),
                'type' => 6,
                'subject' => 'نویسنده',
            ]);
            GeneralInformation::firstOrCreate([
                'user_id' => $user->id
            ]);
        }
    }
}
