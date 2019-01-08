<?php

namespace Tests\Feature;
use App\User;
use App\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ViewTransactionTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function prikazi_samo_autentifikovane_usere(){
        //Ne dozvoljava pristup neautentifikovanim userima
        $this->signOut()
            //Zbog negativnog testa
            ->withExceptionHandling()
            //Poziva index rutu i index controller
            ->get('transactions1')
            //Potvrdjuje da se redirektovao na login stranicu
            ->assertRedirect('/login');
    }



    /**
     * @test
     */
    public function prikazuje_samo_transakcije_koje_su_za_trenutno_ulogovanog_usera(){
        // !!! U nadredjenoj klasi TestCase je kroz setUp() (konstruktor) pozvan metod signIn koji trenutnog usera smatra autentifikovanim userom
        //Kreira drugog usera - koji nije autentifikovan
        $otherUser=createFactory(User::class);
        //Pravi transakciju i pridruzuje id koji je definisan u setUp metodi Base Test cklase
        $transaction=createFactory(Transaction::class,['user_id'=>$this->user->id]);
        //dd($transaction);
        //Druga transakcija za neautentifikovanog usera
        $otherTransaction=createFactory(Transaction::class,['user_id'=>$otherUser->id]);
        $this->get('/transactions1')
            //Vidi transakciju ulogovanog usera
            ->assertSee($transaction->description)
            //Ne vidi transakciju ulogovanog usera
            ->assertDontSee($otherTransaction->description);
        //Odlazak na stranu transakcija

    }

    /**
     * @test
     */
    public function prikazuje_sve_transakcije()
    {
        //Da napravi transakcije
        //Poziva metod nadredjene klase, za pravljenje transakcija za logovanog usera
        $transaction=$this->createTestFactory(Transaction::class);
        //dd($transaction,$transaction->category->name);
        //Da li vidi transakcije
        $this->get('/transactions')
            ->assertSee($transaction->description)
            ->assertSee($transaction->category->name);

    }

    /**
     * @test
     */
    public function razdvaja_transakcije_po_kategoriji(){
        //Pravi kategoriju
        $category=createFactory('App\Category');

        //Sada pravi transakciju za odredjenu kategoriju
        $transaction=$this->createTestFactory('App\Transaction',['category_id'=>$category->id]);
        //dd($transaction);
        //Transakcija koju ne zelimo da vidimo
        $otherTransaction=$this->createTestFactory('App\Transaction');
        //Trazi odredjenu transakciju sa slugom
        $this->get('/transactions1/'.$category->slug.'/'.$this->user->id)
            ->assertSee($transaction->description)
            ->assertDontSee($otherTransaction->description);
    }


}
