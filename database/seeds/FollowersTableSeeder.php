<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //获取所有用户
        $users = User::all();
        //获取id为1的用户
        $user = $users->first();
        $user_id = $user->id;

        //剔除id为1的用户
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        //id为1的用户关注除除1以外的用户
        $user->follow($follower_ids);

        //用户关注ID为1的用户
        foreach ($followers as $follower){
            $follower->follow($user_id);
        }
    }
}
