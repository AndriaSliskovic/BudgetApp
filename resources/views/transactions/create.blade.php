@extends('layouts.app')

@section('content')
   <div class="container">
       <div class="row">
           <div class="col-md-6">
               <div class="card">
                   <div class="card-header">
                       Napravi transakciju
                   </div>
                   <div class="card-body">
                       <form action="/transactions" method="POST">
                           {{csrf_field()}}
                           <div class="form-group">
                               <label for="description">Description</label>
                               <input type="text" name="description" class="form-input" value="{{old('description')}}">
                           </div>
                           <div class="form-group">
                               <label for="amoun">Amount</label>
                               <input type="number" name="amount" class="form-input" value="{{old('amount')}}">
                           </div>
                           <div class="form-group">
                               <label for="amoun">Category</label>
                               <select name="category_id" class="form-control" id="categorySelect">
                               <option value=""></option>
                               @foreach($categories as $c)
                                   <option value="{{$c->id}}">{{$c->name}}</option>
                                   @endforeach
                               </select>
                           </div>
                           <input type="hidden" name="user_id" value="{{$user_id}}">
                           <button class="btn btn-success" type="submit">Upisi transakciju</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>

   </div>



    @endsection