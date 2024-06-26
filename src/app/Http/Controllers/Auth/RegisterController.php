<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\Auth\RegisterService;
use OpenApi\Attributes as OA;

#[
    OA\Post(
        path: "/api/auth/register",
        operationId: "signUp",
        summary: "Registration",
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                ref: "#/components/schemas/AuthRegisterRequest"
            )
        ),
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 201,
                description: "The user has successfully registered",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/UserResource"
                )
            ),
            new OA\Response(
                response: 409,
                description: "The user with the provided username is already registered"
            ),
            new OA\Response(response: 422, description: "Validation error"),
        ]
    )
]
class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterService $service)
    {
        $data = $request->validated();
        $user = $service($data);

        return $user instanceof User ? new UserResource($user) : $user;
    }
}
