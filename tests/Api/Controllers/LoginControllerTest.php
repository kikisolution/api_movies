<?php

namespace Tests\Api\Controllers;

use GuzzleHttp\Client;
use Source\Api\Controllers\LoginController;
use Source\Api\Models\User;
use Source\Api\Controllers\UserController;
use PHPUnit\Framework\TestCase;

class LoginControllerTest extends TestCase
{
    /** @var Client $clientHttp */
    protected $clientHttp;

    /** @var array $dataRight */
    protected $dataRight;

    /** @var array $dataWrong */
    protected $dataWrong;

    /** @var array $dataFakeUser */
    protected $dataFakeUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->clientHttp = new Client();
        $this->dataRight = ['email' => 'usuario@sistema.com', 'password' => '123'];
        $this->dataWrong = ['email' => 'xxxxxx@xxxx.xxxx', 'password' => 'xxx'];
        $this->dataFakeUser = ['first_name' => 'Usuário', 'email' => 'usuario@sistema.com'];
    }

    /**
     * @test
     * @dataProvider valueProvider()
     * @param int $value
     * @param bool $expecteResult
     */
    public function loginBehavior(int $value, bool $expecteResult): void
    {
        // Create Stuntmen.
        $userControl = $this->createMock(UserController::class);

        // Stubs - Return State.
        $userControl->method('checkEmail')->willReturn($expecteResult);
        $userControl->method('checkPassword')->willReturn($expecteResult);
        $userControl->method('getUser')->willReturn((object) $this->dataFakeUser);

        // Mock - Expect Behavior.
        $userControl->expects(self::exactly($value))->method('getUser');

        $login = new LoginController(null, $userControl);
        $login->loginInit($this->dataRight);
    }

    /**
     * @return array[]
     */
    public function valueProvider(): array
    {
        return [
            'isHasToBeLoginSuccess' => ['value' => 1, 'expecteResult' => true],
            'itHasToBeLoginFail' => ['value' => 0, 'expecteResult' => false]
        ];
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }


    /**
     * @test
     */
    public function itHasToLoginSuccessRequestPost(): void
    {
        $request = $this->clientHttp->post(API_URL . '/auth/login', [ 'form_params' => $this->dataRight ] );
        $responseJson = $request->getBody();
        $responseArray = json_decode($responseJson, true);

        $this->assertJson($responseJson);
        $this->assertArrayHasKey('status', $responseArray, "Check if status is available");
        $this->assertEquals("success", $responseArray['status'], "Test if status is success");
    }

    /**
     * @test
     */
    public function itHasToLoginFailRequestPost(): void
    {
        $request = $this->clientHttp->post(API_URL . '/auth/login', [ 'form_params' => $this->dataWrong ] );
        $responseJson = $request->getBody();
        $responseArray = json_decode($responseJson, true);

        $this->assertJson($responseJson);
        $this->assertArrayHasKey('status', $responseArray, "Check if status is available");
        $this->assertEquals("error", $responseArray['status'], "Test if status is error");
    }

}