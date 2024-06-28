<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Simple Laravell 11 CRUD!</title>
    </head>
    <body>
        <div class="bg-dark">
            <h1 class="text-white text-center">
                Simple Laravel 11 CRUD
            </h1>
            
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                
                <div class="col-md-10 d-flex justify-content-end">
                    <a href="{{ route('products.create') }}" class="btn btn-dark text-white">Create</a>
                </div>

                @if (Session::has('success'))
                    <div class="col-md-10">
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    </div>
                @endif

                <div class="col-md-10">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-dark">
                            <h3 class="text-white">
                                Product
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>ID</td>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Sku</th>
                                    <th>Price</th>
                                    <th>Create at</th>
                                    <th>Action</th>
                                </tr>
                                @if ($products->isNotEmpty())
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                @if ($product->image != "")
                                                    <image width="50" src="{{asset('uploads/products/'.$product->image)}}">
                                                    
                                                @endif
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>${{ number_format($product->price) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                            <td>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark">Edit</a>
                                                <a href="#" onclick="deleteProduct({{ $product->id }});" class="btn btn-danger">Delete</a>

                                                <form id="delete-product-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('delete')
                                                </form>

                                            </td>
                                        </tr>
                                @endforeach
                                @endif
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>


        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>
<script>
    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete this product?")) {
            document.getElementById("delete-product-form-" + id).submit();
        }
    }
</script>
