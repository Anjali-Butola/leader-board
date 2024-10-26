<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserPoint::factory(50)->create();

        $users = User::get();
        foreach($users as $user){
            $points = UserPoint::where('user_id',$user->id)->pluck('points')->toArray();
            $user->update(['total_score' => array_sum($points)]);
        }

        $users = User::orderBy('total_score','DESC')->get();
        foreach($users as $key=>$user){
            $user->update(['rank'=> $key + 1]);
        }

    }
}
