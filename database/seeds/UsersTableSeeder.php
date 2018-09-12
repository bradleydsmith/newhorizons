<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = new User;
        $adminUser->name = "admin";
        $adminUser->fname = "Admin";
        $adminUser->lname = "User";
        $adminUser->email = "admin@newhorizonsrmit.tk";
        $adminUser->password = bcrypt("newhorizons");
        $adminUser->type = User::ADMIN_TYPE;
        $adminUser->save();
        
        $normalUser = new User;
        $normalUser->name = "user";
        $normalUser->fname = "Normal";
        $normalUser->lname = "User";
        $normalUser->email = "user@newhorizonsrmit.tk";
        $normalUser->password = bcrypt("newhorizons");
        $normalUser->type = User::USER_TYPE;
        $normalUser->save();
    }
}
