<?php

namespace App\Imports;

use App\Models\Catalogs\DefencePlace;
use App\Models\Catalogs\DocumentType;
use App\Models\Catalogs\Publisher;
use App\Models\Catalogs\ScientificGroup;
use App\Models\Document;
use App\Models\GeneralInformation;
use App\Models\Post;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class Posts implements ToModel
{
    public function model(array $row)
    {
        // Define how each row in the Excel file should be mapped to your database model
//        $user = User::where('username', $row[0])->exists();
//        if ($user) {
        $publisher = $thesisDefencePlace = $sg2 = null;
        if ($row[18] == 'کتاب') {
            $publisher = Publisher::firstOrCreate(['name' => $row[1]]);
            $publisher = $publisher->id;
        }
        if (isset ($row[13]) and $row[18] == 'پایان نامه') {
            $thesisDefencePlace = DefencePlace::firstOrCreate(['name' => $row[13]]);
            $thesisDefencePlace = $thesisDefencePlace->id;
        }
        $sg1 = ScientificGroup::where('name', $row[19])->first();
        if (empty($sg1)) {
            $sg1 = ScientificGroup::create(['name' => $row[19]]);
        }
        if ($row[20] != null) {
            $sg2 = ScientificGroup::where('name', $row[20])->value('id');
        }
        Post::insert([
            'id' => $row[21],
            'user_id' => $row[0],
            'title' => $row[1],
            'publisher' => $publisher,
            'post_type' => $row[3],
            'festival_id' => $row[4],
            'language' => $row[5],
            'circulation' => $row[6],
            'book_size' => $row[7],
            'number_of_covers' => $row[8],
            'pages_number' => $row[9],
            'ISSN' => $row[10],
            'publish_date' => $row[11],
            'thesis_defence_date' => $row[12],
            'thesis_defence_place' => $thesisDefencePlace,
            'thesis_supervisor' => $row[14],
            'thesis_advisor' => $row[15],
            'thesis_referee' => $row[16],
            'thesis_grade' => $row[17],
            'post_format' => $row[18],
            'research_type' => 'individual',
            'scientific_group_v1' => $sg1->id,
            'scientific_group_v2' => $sg2,
            'post_delivery_method' => 'physical',
            'created_at' => now(),
        ]);
    }
//    }
}
