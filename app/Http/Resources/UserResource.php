<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        $data = [];

        foreach ($this->resource as $user) {
            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'scheduled_resignation' => $user->scheduled_resignation,
                'job' => [
                    'id' => $user->id_job,
                    'name' => $user->job_name,
                ]
            ];
        }

        return $data;
    }
}
