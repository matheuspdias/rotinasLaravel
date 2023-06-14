<?php 
namespace App\Http\Repositories;

use App\Models\User;

class userRepository {

    public function index () {
        $users = User::select('users.id', 'users.name', 'users.email', 'users.active', 'users.scheduled_resignation', 'jobs.id as id_job', 'jobs.name as job_name')
            ->join('jobs', 'users.id_job', 'jobs.id')
            ->where('users.deleted_at', null)
            ->get();
        
        // $usersFormatted = [];

        // foreach ($users as $user) {
        //     $usersFormatted[] = [
        //         'id' => $user->id,
        //         'name' => $user->name,
        //         'email' => $user->email,
        //         'scheduled_resignation' => $user->scheduled_resignation,
        //         'job' => [
        //             'id' => $user->id_job,
        //             'name' => $user->job_name
        //         ]
        //     ];
        // }

        return $users;
    }

    public function create (array $data) {
        $user = User::create($data);
        return $user;
    }
}