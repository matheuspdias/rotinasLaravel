<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = new UserRepository;
    }

    public function index () {
        $users = $this->userRepository->index();

        return new UserResource($users);
    }
}
