<?php

declare(strict_types=1);

namespace App\Services\User\Http\Controller;

use App\Http\Requests\User\AddUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\Database\Repository\UserRepository;
use Exception;
use Gerfey\ResponseBuilder\ResponseBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class UserController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function addUser(AddUserRequest $addUserRequest): JsonResponse
    {
        $nameUser = $addUserRequest['name'];
        $filePath = Storage::disk('public')->put("/avatars/$nameUser", $addUserRequest['avatar']);

        $addUser = $this->userRepository->addUser($addUserRequest, (string)$filePath);

        if ($addUser === false) {
            Storage::deleteDirectory("public/avatars/$nameUser");

            throw new Exception('Ошибка создания пользователя');
        }

        return ResponseBuilder::success(['Пользователь создан']);
    }

    public function updateUser(UpdateUserRequest $updateUserRequest, int $id): JsonResponse
    {
        $nameUser = $updateUserRequest['name'];
        $filePath = Storage::disk('public')->put("/avatars/$nameUser", $updateUserRequest['avatar']);

        $updateUser = $this->userRepository->updateUser($updateUserRequest, (string)$filePath, $id);

        if ($updateUser === false) {
            Storage::deleteDirectory("public/avatars/$nameUser");

            throw new Exception('Ошибка обновления пользователя, неверный id');
        }

        return ResponseBuilder::success(['Пользователь обновлен']);
    }

    public function deleteUser(int $id): JsonResponse
    {
        $user = $this->userRepository->find($id);

        if ($user === null) {
            throw new Exception('По указанному id нет пользователя');
        }

        $userName = $user['name'];

        $result = $user->delete();

        if ($result === true) {
            Storage::deleteDirectory("public/avatars/$userName");
        } else {
            throw new Exception('Произошла ошибка удаления пользователя');
        }

        return ResponseBuilder::success(['Пользователь удален']);
    }
}
