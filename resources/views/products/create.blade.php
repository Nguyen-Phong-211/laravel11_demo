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
                    <a href="{{ route('products.index') }}" class="btn btn-dark text-white">Black</a>
                </div>
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg">
                      <div class="card-header bg-dark">
                          <h3 class="text-white">
                            Create Product
                          </h3>
                      </div>
                      <form enctype="multipart/form-data" action="{{route('products.store')}}" method="POST">
                          @csrf
                          <div class="card-body">
                              <div class="md-3">
                                  <label for="" class="form-label">Name</label>
                                  <input value="{{ old('name') }}" type="text" name="name" id="" class=" @error('name') is-invalid @enderror  form-control" placeholder="Name">
                                  @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                  @enderror
                              </div>
                            <div class="md-3">
                                <label for="" class="form-label">Sku</label>
                                <input value="{{ old('sku') }}" type="text" name="sku" id="" class="@error('sku') is-invalid @enderror form-control" placeholder="Sku">
                                @error('sku')
                                  <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md-3">
                                <label for="" class="form-label">Price</label>
                                <input value="{{ old('price') }}" type="number" name="price" id="" class="@error('price') is-invalid @enderror form-control" placeholder="Price">
                                @error('price')
                                  <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md-3">
                                <label for="" class="form-label">Description</label>
                                <textarea {{ old('description') }} placeholder="Enter Description" name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="md-3">
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="image" id="" class="form-control form-control-lg">
                              </div>
              
                            <div class="card-footer">
                                <div class="d-grid">
                                  <button class="btn btn-lg btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>