<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newp_admin = \App\RegisteredUser::where('email','=','admin@admin.com')->first();
        if(!$newp_admin) {
            $newp_admin = [
                'username' => 'NewAdmin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'date_registered' => '1480621558',
                'member_group_id' => '1',
                'default_lang' => 'English',
                'reseller_dns' => '',
                'google_2fa_sec' => '',
                'status' => '1',
            ];
            \App\RegisteredUser::insert($newp_admin);
        }
    }
}
