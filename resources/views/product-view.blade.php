@if ($products->count() > 0)
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ number_format($product->price) }}</td>
                    <td>
                        <a href="#" id="{{ $product->id }}" class="editIcon" data-toggle="modal"
                            data-target="#editProductModal"><i class="fa fa-edit"></i></a>

                        <a href="#" id="{{ $product->id }}" class="deleteIcon"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="card-body">
        <div class="alert alert-info">
            <p>No records found</p>
        </div>
    </div>
@endif
