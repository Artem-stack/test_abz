<?php
namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserService
{
   public function getUserById($userId)
{
    $validator = Validator::make(['id' => $userId], [
        'id' => 'required|integer|min:1|max:999999',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'fails' => $validator->errors(),
        ], 400);
    }

    $user = User::find($userId);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'The user with the requested identifier does not exist',
            'fails' => [
                'user_id' => [
                    'User not found',
                ],
            ],
        ], 404);
    }

    return response()->json([
        'success' => true,
        'user' => new UserResource($user),
    ])->original;
}




    public function getToken(User $user)
    {
        return [
            'success' => true,
            'token' => $user->token,
        ];
    }
}