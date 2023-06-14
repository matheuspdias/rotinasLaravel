<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = new UserRepository;
    }

    public function index (): UserResource {
        $users = $this->userRepository->index();

        return new UserResource($users);
    }

    public function create (Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'id_job' => 'required|int|exists:jobs,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
       }

       $data = $validator->validated();

       $user = $this->userRepository->create($data);

       return response()->json($user, 201);

    }
}
