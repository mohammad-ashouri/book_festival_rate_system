<?php

namespace Database\Seeders;

use App\Models\GeneralInformation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create(
            [
                'username' => 'ashouri',
                'password' => bcrypt(12345678),
                'type' => 1,
                'subject' => 'ادمین کل',
            ]
        );
        GeneralInformation::create([
            'user_id' => $user->id,
            'first_name' => 'محمد',
            'last_name' => 'عاشوری',
            'gender' => 'مرد',
            'mobile' => '09398888226',
        ]);

        $user = User::create(
            [
                'username' => 'vahedi',
                'password' => bcrypt(12345678),
                'type' => 1,
                'subject' => 'ادمین کل',
            ]
        );
        GeneralInformation::create([
            'user_id' => $user->id,
            'first_name' => 'سید سجاد',
            'last_name' => 'واحدی',
            'gender' => 'مرد',
            'mobile' => '09191964151',
        ]);

        $user = User::create(
            [
                'username' => 'zarei',
                'password' => bcrypt(12345678),
                'type' => 1,
                'subject' => 'ادمین کل',
            ]
        );
        GeneralInformation::create([
            'user_id' => $user->id,
            'first_name' => 'حسین',
            'last_name' => 'زارعی',
            'gender' => 'مرد',
            'mobile' => '09192735336',
        ]);

        $user = User::create(
            [
                'username' => 'akbarpour',
                'password' => bcrypt(12345678),
                'type' => 1,
                'subject' => 'ادمین کل',
            ]
        );
        GeneralInformation::create([
            'user_id' => $user->id,
            'first_name' => 'عباس',
            'last_name' => 'اکبرپور',
            'gender' => 'مرد',
            'mobile' => '09191488088',
        ]);

        $user = User::create(
            [
                'username' => 'test1',
                'password' => bcrypt(12345678),
                'type' => 4,
                'subject' => 'ارزیاب',
                'scientific_group' => 3,
            ]
        );
        GeneralInformation::create([
            'user_id' => $user->id,
            'first_name' => 'ارزیاب',
            'last_name' => 'اقتصاد 1',
            'gender' => 'مرد',
            'mobile' => '09191234567',
        ]);

        $user = User::create(
            [
                'username' => 'test2',
                'password' => bcrypt(12345678),
                'type' => 1,
                'subject' => 'ارزیاب',
                'scientific_group' => 3,
            ]
        );
        GeneralInformation::create([
            'user_id' => $user->id,
            'first_name' => 'ارزیاب',
            'last_name' => 'اقتصاد 2',
            'gender' => 'مرد',
            'mobile' => '09191234561',
        ]);

        $user = User::create(
            [
                'username' => 'test3',
                'password' => bcrypt(12345678),
                'type' => 1,
                'subject' => 'ارزیاب',
                'scientific_group' => 3,
            ]
        );
        GeneralInformation::create([
            'user_id' => $user->id,
            'first_name' => 'ارزیاب',
            'last_name' => 'اقتصاد 3',
            'gender' => 'مرد',
            'mobile' => '09191234564',
        ]);

        $user = User::create(
            [
                'username' => 'htest',
                'password' => bcrypt(12345678),
                'type' => 1,
                'subject' => 'مدیر گروه',
                'scientific_group' => 3,
            ]
        );
        GeneralInformation::create([
            'user_id' => $user->id,
            'first_name' => 'مدیر گروه',
            'last_name' => 'اقتصاد',
            'gender' => 'مرد',
            'mobile' => '09191234567',
        ]);

        $user = User::create(
            [
                'username' => 'moradi',
                'password' => bcrypt(12345678),
                'type' => 5,
                'subject' => 'کارشناس گونه بندی',
            ]
        );
        GeneralInformation::create([
            'user_id' => $user->id,
            'first_name' => 'علی',
            'last_name' => 'مرادی',
            'gender' => 'مرد',
            'mobile' => '09191234537',
        ]);
    }
}
