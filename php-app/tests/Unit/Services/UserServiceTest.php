<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\UserService;
use App\Interfaces\Users\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Exception;

class UserServiceTest extends TestCase
{
    protected $userRepositoryMock;
    protected UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
        $this->userService = new UserService($this->userRepositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testShouldReturnErrorWhenListAllFails()
    {
        $this->userRepositoryMock
            ->shouldReceive('all')
            ->once()
            ->andThrow(new Exception('DB error'));

        $result = $this->userService->listAll();

        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Erro ao listar usuários.', $result['message']);
    }

    public function testShouldReturnMessageWhenListAllSucceeds()
    {
        $fakeUsers = [
            ['id' => 1, 'name' => 'User 1'],
            ['id' => 2, 'name' => 'User 2'],
        ];

        $this->userRepositoryMock
            ->shouldReceive('all')
            ->once()
            ->andReturn(new Collection($fakeUsers));

        $result = $this->userService->listAll();

        $this->assertArrayNotHasKey('error', $result);
        $this->assertEquals($fakeUsers, $result['message']->toArray());
    }

    public function testShouldReturnErrorWhenFindOneFails()
    {
        $id = 1;

        $this->userRepositoryMock
            ->shouldReceive('findById')
            ->once()
            ->with($id)
            ->andThrow(new Exception('DB error'));

        $result = $this->userService->findOne($id);

        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Erro ao buscar usuário.', $result['message']);
    }

    public function testShouldReturnMessageWhenFindOneSucceeds()
    {
        $id = 1;
        $fakeUser = ['id' => $id, 'name' => 'Maria'];

        $this->userRepositoryMock
            ->shouldReceive('findById')
            ->once()
            ->with($id)
            ->andReturn($fakeUser);

        $result = $this->userService->findOne($id);

        $this->assertArrayNotHasKey('error', $result);
        $this->assertEquals($fakeUser, $result['message']);
    }

    public function testShouldReturnErrorWhenCreateFails()
    {
        $data = ['name' => 'Teste', 'email' => 'teste@test.com', 'password' => '123456'];

        $this->userRepositoryMock
            ->shouldReceive('store')
            ->once()
            ->with($data)
            ->andThrow(new Exception('DB error'));

        $result = $this->userService->create($data);

        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Erro ao criar usuário', $result['message']);
    }

    public function testShouldReturnMessageWhenCreateSucceeds()
    {
        $id = 1;
        $data = ['id' => $id, 'name' => 'Teste', 'email' => 'teste@test.com'];
        $fakeUser = (object) $data;

        $this->userRepositoryMock
            ->shouldReceive('store')
            ->once()
            ->with($data)
            ->andReturn($fakeUser);

        $result = $this->userService->create($data);

        $this->assertArrayNotHasKey('error', $result);
        $this->assertEquals($fakeUser, $result['message']);
    }

    public function testShouldReturnErrorWhenUpdateFails()
    {
        $id = 1;
        $data = ['name' => 'João'];

        $this->userRepositoryMock
            ->shouldReceive('update')
            ->once()
            ->with($id, $data)
            ->andThrow(new Exception('DB error'));

        $result = $this->userService->update($id, $data);

        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Erro ao atualizar usuário.', $result['message']);
    }

    public function testShouldReturnErrorWhenUpdateUserNotFound()
    {
        $id = 999;
        $data = ['name' => 'João'];

        $this->userRepositoryMock
            ->shouldReceive('update')
            ->once()
            ->with($id, $data)
            ->andReturn(null);

        $result = $this->userService->update($id, $data);

        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Usuário não encontrado ou não atualizado.', $result['message']);
    }

    public function testShouldReturnMessageWhenUpdateSucceeds()
    {
        $id = 1;
        $data = ['name' => 'João'];
        $fakeUser = ['id' => $id, 'name' => 'João Lima'];

        $this->userRepositoryMock
            ->shouldReceive('update')
            ->once()
            ->with($id, $data)
            ->andReturn($fakeUser);

        $result = $this->userService->update($id, $data);

        $this->assertArrayNotHasKey('error', $result);
        $this->assertEquals($fakeUser, $result['message']);
    }

    public function testShouldReturnErrorWhenDeleteFails()
    {
        $id = 1;

        $this->userRepositoryMock
            ->shouldReceive('delete')
            ->once()
            ->with($id)
            ->andThrow(new Exception('DB error'));

        $result = $this->userService->delete($id);

        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Erro ao deletar usuário.', $result['message']);
    }

    public function testShouldReturnErrorWhenDeleteUserNotFound()
    {
        $id = 999;

        $this->userRepositoryMock
            ->shouldReceive('delete')
            ->once()
            ->with($id)
            ->andReturn(false);

        $result = $this->userService->delete($id);

        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Usuário não encontrado ou não deletado.', $result['message']);
    }

    public function testShouldReturnMessageWhenDeleteSucceeds()
    {
        $id = 1;

        $this->userRepositoryMock
            ->shouldReceive('delete')
            ->once()
            ->with($id)
            ->andReturn(true);

        $result = $this->userService->delete($id);

        $this->assertArrayNotHasKey('error', $result);
        $this->assertEquals('Usuário deletado com sucesso.', $result['message']);
    }
}
