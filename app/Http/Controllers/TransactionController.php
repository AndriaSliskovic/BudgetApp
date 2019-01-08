<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
    private $data;

    public function __construct()
    {
        //Ukljucivanje middlewarea
        $this->middleware('auth');
    }

    public function index(Category $category, User $user){
        //Prikazuje sve transakcije
        $transactions=Transaction::all();
        return view('transactions.index',compact('transactions'));
    }

    public function showByCategoryForAuthUser(Category $category, User $user){
        //Prikazuje samo transakcije ulogovanog usera sa kategorijama, koristi scope fje iz modela
        $transactions=Transaction::byUser($user)->byCategory($category)->get();
        return view('transactions.index',compact('transactions'));
    }

    public function showByCategory(Category $category){
        if ($category->exists){
            $transactions=Transaction::where('category_id',$category->id)->get();
        }
        else{
            $transactions=Transaction::all();
        }
            return view('transactions.index',compact('transactions'));
    }

    public function showByCategory2(Category $category){
        //Drugi nacin prethodnog metoda, koristi se local scope iz modela scopeByCategory()
        $transactions=Transaction::byCategory($category)->get();
        return view('transactions.index',compact('transactions'));
    }

    public function store(Request $request){
        //Validacija podataka koji su dosli sa requestom
        $this->validate($request,[
           'description'=>'required',
            'category_id'=>'required',
            'amount'=>'required|numeric'
        ]);
        Transaction::create($request->all());
        return redirect('/transactions');
    }

    public function create(){
        $this->data['categories']=Category::all();
        $this->data['user_id']=auth()->id();
        return view('transactions.create',$this->data);
    }
}
