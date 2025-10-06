<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $result = $this->userService->listAll();

        if (isset($result['error'])) {
            return response()->json(['error' => $result['message']], 500);
        }

        return response()->json($result['message'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $result = $this->userService->create($request->validated());

        if (isset($result['error'])) {
            return response()->json(['error' => $result['message']], 500);
        }

        return response()->json($result['message'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->userService->findOne($id);

        if (!$result) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        if (isset($result['error'])) {
            return response()->json(['error' => $result['message']], 500);
        }

        return response()->json($result['message'], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $result = $this->userService->update($id, $request->validated());

        if (isset($result['error'])) {
            return response()->json(['error' => $result['message']], 500);
        }

        return response()->json($result['message'], 200);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->userService->delete($id);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['message']], 500);
        }

        return response()->json(['message' => $result['message']], 200);
    }
}
