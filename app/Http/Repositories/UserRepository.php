<?php 
namespace App\Http\Repositories;

use App\Models\User;
use Carbon\Carbon;

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

    public function show (int $id) {
        $user =  User::select('users.name', 'users.email', 'users.active', 'users.scheduled_resignation', 'jobs.id as id_job', 'jobs.name as job_name','users.created_at')
            ->join('jobs', 'jobs.id', 'users.id_job')
            ->where('users.id', $id)
            ->where('users.active', 1)
            ->first();
            
        $userFormatted = [
            'name' => $user->name,
            'email' => $user->email,
            'active' => $user->active,
            'scheduled_resignation' => $user->scheduled_resignation,
            'job' => [
                'id' => $user->id_job,
                'name' => $user->job_name
            ],
        ];

        return $userFormatted;
    }

    public function scheduledResignation (array $data) {
        $user = User::find($data['id_user']); 
        $user->scheduled_resignation = $data['date'];
         
        $user->save();

        return [
            'id' => $user->id,
            'name' => $user->name,
            'scheduled_resignation' => $user->scheduled_resignation
        ];
    }

    public function listScheduledResignation () {
        $today = Carbon::now()->format('Y-m-d');

        $users = User::select('users.id', 'users.name', 'users.email', 'users.active', 'users.scheduled_resignation', 'jobs.id as id_job', 'jobs.name as job_name')
                ->join('jobs', 'users.id_job', 'jobs.id')
                ->where('active', 1)
                ->where('scheduled_resignation', '>=', $today)
                ->get();
       
        return $users;
    }
}