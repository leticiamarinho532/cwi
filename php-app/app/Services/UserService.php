<?php

namespace App\Services;

use App\Interfaces\Users\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;


class UserService
{
    protected UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return array
     */
    public function listAll()
    {
        try {
            return [
                'message' => $this->userRepository->all()
            ];
        } catch (Exception $e) {
            Log::error('Erro ao listar usuários: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'error' => true,
                'message' => 'Erro ao listar usuários.'
            ];
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function findOne(int $id)
    {
        try {
            return [
                'message' => $this->userRepository->findById($id)
            ];
        } catch (Exception $e) {
            Log::error("Erro ao buscar usuário -{$id}: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'error' => true,
                'message' => 'Erro ao buscar usuário.'
            ];
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        try {
            return [
                'message' => $this->userRepository->store($data)
            ];
        } catch (Exception $e) {
            Log::error('Erro ao criar usuário: ' . $e->getMessage(), [
                'dados' => $data,
            ]);

            return [
                'error' => true,
                'message' => 'Erro ao criar usuário'
            ];
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data)
    {
        try {
            $updated = $this->userRepository->update($id, $data);

            if (!$updated) {
                return [
                    'error' => true,
                    'message' => 'Usuário não encontrado ou não atualizado.'
                ];
            }

            return [
                'message' => $updated
            ];
        } catch (Exception $e) {
            Log::error("Erro ao atualizar usuário -{$id}: " . $e->getMessage(), [
                'dados' => $data,
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'error' => true,
                'message' => 'Erro ao atualizar usuário.'
            ];
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function delete(int $id)
    {
        try {
            $deleted = $this->userRepository->delete($id);

            if (!$deleted) {
                return [
                    'error' => true,
                    'message' => 'Usuário não encontrado ou não deletado.'
                ];
            }

            return [
                'message' => 'Usuário deletado com sucesso.'
            ];
        } catch (Exception $e) {
            Log::error("Erro ao deletar usuário -{$id}: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'error' => true,
                'message' => 'Erro ao deletar usuário.'
            ];
        }
    }
}
