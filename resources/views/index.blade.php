@extends('layouts.modelTemplate')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product list</h1>

             @if (Session::has('success'))
                <div class="alert alert-primary mt-8">{{ Session::get('success') }} 
                </div>
            @endif
        </div>

        <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <a href="{{ route('productNew') }} ">
                <button class="btn btn-primary">Retour</button>
            </a>
        </h6>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Product name</th>
                <th>Price Ht</th>
                <th>Date création</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            @if(isset($products))
            @foreach($products as $prod)
            <tr>
                <td>{{ $prod->name }}</td>
                <td>{{ $prod->priceHt }}</td>
                <td>{{ Carbon\Carbon::parse($prod->creationDate)->format('d/m/Y à H:i') }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $prod->id }}">
                      Edit
                    </button>

                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete{{ $prod->id }}">
                      Delete
                    </button>
                </td>
            </tr>


            <div class="modal fade" id="staticBackdrop{{ $prod->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Updating</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    
                    <form class="user" method="post" action="{{ route('edit') }}">
                                @csrf

                        <input type="hidden" name="id" class="form-control form-control-user" id="exampleFirstName" value="{{ $prod->id }}">

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>Product name</label>
                                <input type="text" name="productName" class="form-control form-control-user" id="exampleFirstName" value="{{ $prod->name }}" 
                                    placeholder="Product name" >
                            </div>
                            <div class="col-sm-6">
                                <label>Price Ht</label>
                                <input type="number" min="1" name="priceHt" class="form-control form-control-user" id="exampleLastName" value="{{ $prod->priceHt }}"
                                    placeholder="Price Ht" >
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                      </div>
                      </form>
                </div>
                </div>
                </div>



                <!--DELETE MODALE -->
                <div class="modal fade" id="delete{{ $prod->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Deleting</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    
                    <form class="user" method="post" action="{{ route('delete') }}">
                                @csrf

                        <input type="hidden" name="delete_id" class="form-control form-control-user" id="exampleFirstName" value="{{ $prod->id }}">

                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                      </div>
                      </form>
                </div>
                </div>
                </div>
            @endforeach
            @endif
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>        
</div>
</div>
@endsection