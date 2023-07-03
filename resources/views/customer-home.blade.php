@extends('layouts.master_layout.master_layout')
@section('title', 'Home')
@section('content')
@push('style')
<style>
    .img-fluid {
    max-width: 100%;
    height: 200px;
}
</style>
@endpush
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

    <section style="background-color: #eee;">
        {{-- @if($products->count() > 0) --}}
        <div class="container py-5">
            <div class="row justify-content-center">
                {{-- @foreach ($products as $product) --}}
                    <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body pb-0">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p><a href="#!" class="text-dark"></a></p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body pb-0">
                                <div class="d-flex justify-content-between">
                                    <p class="text-dark">Price</p>
                                    <p><a href="#!" class="text-dark"></a></p>
                                </div>
                            </div>
                            <hr class="my-0" />
                            {{-- <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center pb-2 mb-1">
                                    <button type="button" id="{{ $product->id }}" class="btn btn-primary butBtn"
                                        data-toggle="modal" data-target="#shippingModal" data-prod_id="{{$product->id}}">Buy now</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                {{-- @endforeach --}}
            </div>
        </div>

    </section>

    <!-- Shipping Detail Modal Start-->
    <div class="modal fade" id="shippingModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Shipping Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" id="order_form">
                    @csrf
                    <div class="modal-body">
                    <input type="hidden" name="product_id" id="productId" class="form-control">
                        <div class="form-group">
                            <label for="customer_name">Customer Name:</label>
                            <input type="text" class="form-control" name="customer_name"
                                placeholder="Enter Customer Name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number:</label>
                            <input type="number" class="form-control" name="contact" placeholder="Enter Contact Number"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="address">Enter Shipping Address:</label>
                            <textarea class="form-control" rows="3" name="address" placeholder="Enter Shipping Address" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="add_order_btn" class="btn btn-primary">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Shipping Detail Modal End-->

    <script>
    $(document).ready(function(){
        $("#order_form").on('submit', function(e) {
            e.preventDefault();
            $('#add_order_btn').text('Placing Order...')
            $.ajax({
                url: '',
                type: 'POST',
                data: $('#order_form').serialize(),
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Order Created Successfully!',
                            'Congratulations you have earned 100 points!',
                            'success'
                        )
                    }
                    var points = parseInt($('#points').text());
                    var newPoint = points + 100;
                    $('#points').text(newPoint);
                    $('#add_order_btn').text('Place Order')
                    $('#order_form')[0].reset()
                    $('#shippingModal').modal('hide')
                }
            })
        })

        $('#shippingModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var prodId = button.data('prod_id')
            var modal = $(this)
            modal.find('.modal-body #productId').val(prodId)
        });
    })
    </script>
@endsection
