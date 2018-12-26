<?php

namespace Tests\Feature;
use App\User;
use App\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTransactionTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_display_all_transactions()
    {
        //Da napravi transakcije
        $transaction=factory(Transaction::class)->create();


        //Da li vidi transakcije
        $this->get('/transactions')
            ->assertSee($transaction->description);

    }
}
