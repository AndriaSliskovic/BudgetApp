<?php

namespace Tests;

use App\User;
use Exception;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    //user koji se pravi zbog autentifikacije
    protected $user;

    protected function setUp ()
    {
        parent::setUp();
        //Setuje usera koji ce biti ulogovan !!!
        $this->user=createFactory(User::class);
        //Ukljucuje signIn metod
        $this->signIn($this->user)->disableExceptionHandling();
    }

    protected function disableExceptionHandling ()
    {
        $this->oldExceptionHandler = app()->make(ExceptionHandler::class);
        app()->instance(ExceptionHandler::class, new PassThroughHandler);
    }

    protected function withExceptionHandling ()
    {
        app()->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }
    //Dodato - dozvoljava chaining metod posle pozivanja sigIn
    protected function signIn($user){
        //The actingAs helper method provides a simple way to authenticate a given user as the current user
        $this->actingAs($user);
        return $this;
    }
    //Sprecava gustu da pristupi stranici transakcija
    protected function signOut(){
        $this->post('/logout');
        return $this;
    }

    //Overajdovani metodi za pozivanje factorija za logovanog usera - poziva createFactory helper
    function createTestFactory($class, $attributes=[], $times=null){
        return createFactory($class,array_merge(['user_id'=>$this->user->id],$attributes),$times);
    }

    function makeTestFactory($class, $attributes=[], $times=null){
        return makeFactory($class,array_merge(['user_id'=>$this->user->id],$attributes),$times);
    }
}

class PassThroughHandler extends Handler
{
    public function __construct () {}

    public function report (Exception $e) {}

    public function render ($request, Exception $e)
    {
        throw $e;
    }


}
