@extends('layouts.master_layout.master_layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Add Product Modal Start-->
    <div class="modal fade" id="productModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="add_product_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Product Name:</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Product Name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="price">Product Price:</label>
                            <input type="number" class="form-control" name="price" placeholder="Enter Product Price"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="add_product_btn" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Add Product Modal End-->

    <!-- Edit Product Modal Start-->
    <div class="modal fade" id="editProductModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="POST" id="edit_product_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">
                    <input type="hidden" name="product_image" id="product_image">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Product Name:</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter Product Name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Product Price:</label>
                            <input type="number" class="form-control" name="price" id="price"
                                placeholder="Enter Product Price" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="edit_product_btn" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Edit Product Modal End-->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="row">
                                    <button title="Add New Booker" type="button" class="btn btn-primary"
                                        data-toggle="modal" data-target="#productModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="table_data">
                            <div class="card-body" id="show_all_products">
                                <h1 class="text-center text-secondary my-5">Loading...</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            fetchAllProducts();
            //Fetch all product records
            function fetchAllProducts() {
                $.ajax({
                    url: '{{ route('fetchProducts') }}',
                    method: 'get',
                    success: function(response) {
                        console.log(response)
                        $("#show_all_products").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }
        </script>
    @endpush
    <script>
        //Add new product ajax request
        $("#add_product_form").on('submit', function(e) {
            e.preventDefault();
            const fd = new FormData(this)
            $('#add_product_btn').text('Adding...')
            $.ajax({
                url: '{{ route('store') }}',
                type: 'POST',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Added!',
                            'Product Added Successfully!',
                            'success'
                        )
                        fetchAllProducts();
                    }
                    $('#add_product_btn').text('Add Product')
                    $('#add_product_form')[0].reset()
                    $('#productModal').modal('hide')
                }
            })
        })

        //Edit product ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('edit') }}',
                type: 'GET',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#name").val(response.name);
                    $("#price").val(response.price);
                    $("#product_id").val(response.id);
                    $("#product_image").val(response.image);
                }
            })
        })

        // update product ajax request
        $("#edit_product_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#edit_product_btn").text('Updating...');
            $.ajax({
                url: '{{ route('update') }}',
                method: 'POST',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Updated!',
                            'Product Updated Successfully!',
                            'success'
                        )
                        fetchAllProducts();
                    }
                    $("#edit_product_btn").text('Update Product');
                    $("#edit_product_form")[0].reset();
                    $("#editProductModal").modal('hide');
                }
            });
        });

    // delete product ajax request
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('delete') }}',
              type: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchAllProducts();
              }
            });
          }
        })
      });
    </script>
@endsection
