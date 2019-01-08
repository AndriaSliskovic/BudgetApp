<?php

namespace Tests\Feature;


use App\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTransactinsTest extends TestCase
{
    private $polje;
    private $ruta;
    use DatabaseMigrations;



    /**
     * @test
     */
    public function it_can_create_transactions(){
        //Pravi transakciju
        $transaction=$this->makeTestFactory(Transaction::class);
        //Koristi se metod post zato sto se upisuju transakcije
        $this->post('/transactions',$transaction->toArray())
        //Treba da vrati na pocetnu rutu (da relouduje stranicu)
        ->assertRedirect('/transactions');
        //Treba da vidi description za upisanu transakciju
        $this->get('/transactions')
            ->assertSee($transaction->description);
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_description(){
//        //Pravi transakciju koja je null
//        $transaction=makeFactory(Transaction::class,['description'=>null]);
//        //Negativan test mora da ukljuci exeption
//        $this->withExceptionHandling()->post('/transactions',$transaction->toArray())
//            //Trazi gresku u sesiji za description polje
//            ->assertSessionHasErrors('description');
        $this->polje=['description'=>null];
        $this->ruta='/transactions';
        $this->postTransaction($this->polje,$this->ruta);
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_category(){
        //Salje key=>value zeljenog parametra
        $this->polje=['category_id'=>null];
        $this->ruta='/transactions';
        //Ponavlja se kod iz prethodnog
        $this->postTransaction($this->polje,$this->ruta);
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_without_an_amount(){
         //Ponavlja se kod iz prethodnog
        $this->polje=['amount'=>null];
        $this->ruta='/transactions';
        $this->postTransaction($this->polje,$this->ruta);
    }

    /**
     * @test
     */
    public function it_cannot_create_transactions_with_invalid_amount()
    {
        $this->polje=['amount'=>'abc'];
        $this->ruta='/transactions';
        $this->postTransaction($this->polje,$this->ruta);
    }

        //DRY metod za prethodne metode
    public function postTransaction($polje,$ruta){
        //Pravi transakciju koja je null
        $transaction=$this->makeTestFactory(Transaction::class,$polje);
        //Negativan test mora da ukljuci exeption
        $this->withExceptionHandling()->post($ruta,$transaction->toArray())
            //Trazi gresku u sesiji za index polja
            ->assertSessionHasErrors(key($polje));
    }


}