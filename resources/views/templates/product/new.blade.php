@extends('layouts.modelTemplate')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ajouter product</h1>
        
    </div>

     @if ($errors->any())
        <ul class="alert alert-warning">
            @foreach ($errors->all() as $error)
            <li> {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form class="user" method="post" action="{{ route('store') }}">
        @csrf

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label>Product name</label>
                <input type="text" name="productName" class="form-control form-control-user" id="exampleFirstName"
                    placeholder="Product name" >
            </div>
            <div class="col-sm-6">
                <label>Price Ht</label>
                <input type="number" min="1" name="priceHt" class="form-control form-control-user" id="exampleLastName"
                    placeholder="Price Ht" >
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary btn-user btn-block" >     Ajouter
        </button> 
        
    </form>
</div>
@endsection


