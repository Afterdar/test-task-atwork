<?php

declare(strict_types=1);

namespace App\Services\User\Database\Repository;

use App\Http\Requests\User\AddUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\Database\Models\User;
use Carbon\Carbon;
use Gerfey\Repository\Repository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    protected $entity = User::class;

    public function addUser(AddUserRequest $addUserRequest, string $filePath): bool
    {
        return $this->createQueryBuilder()
            ->insert([
                'name' => $addUserRequest['name'],
                'surname' => $addUserRequest['surname'],
                'password' => Hash::make($addUserRequest['password']),
                'phone' => $addUserRequest['phone'],
                'avatar' => $filePath,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }

    public function updateUser(UpdateUserRequest $updateUserRequest, string $filePath, int $id): bool
    {
        $user = $this->createQueryBuilder()
            ->where('id', '=', $id)
            ->first();

        if ($user === null)
        {
            return false;
        }

        $result = $user->fill([
            'name' => $updateUserRequest['name'],
            'surname' => $updateUserRequest['surname'],
            'password' => Hash::make($updateUserRequest['password']),
            'phone' => $updateUserRequest['phone'],
            'avatar' => $filePath,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return $result->save();
    }

}
