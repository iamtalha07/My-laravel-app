<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .page-break {
            page-break-after: always;
        }

        .bg-grey {
            background: #F3F3F3;
        }

        .text-right {
            text-align: right;
        }

        .w-full {
            width: 100%;
        }

        .small-width {
            width: 15%;
        }

        .invoice {
            background: white;
            border: 1px solid #CCC;
            font-size: 14px;
            padding: 48px;
            margin: 20px 0;
        }
    </style>
</head>

<body class="bg-grey">

    <div class="container container-smaller">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1" style="margin-top:20px; text-align: right">
                <div class="btn-group mb-4">
                    <a href="{{ route('orders.download', 1) }}" class="btn btn-success">Save as PDF</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="invoice">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>From:</h4>
                            <address>
                                <strong>{{ $order->user->name }}</strong><br>
                                {{ $order->user->email }} <br>
                            </address>
                        </div>

                        <div class="col-sm-6 text-right">
                            <img src="https://res.cloudinary.com/dqzxpn5db/image/upload/v1537151698/website/logo.png"
                                alt="logo">
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-7">
                            <h4>To:</h4>
                            <address>
                                <strong>{{ $order->customer_name }}</strong><br>
                                <span>{{ $order->address }}</span><br>
                                <span>{{ $order->contact }}</span>
                            </address>
                        </div>

                        <div class="col-sm-5 text-right">
                            <table class="w-full">
                                <tbody>
                                    <tr>
                                        <th>Invoice Num:</th>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Invoice Date: </th>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                </tbody>
                            </table>



                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table invoice-table">
                            <thead style="background: #F5F5F5;">
                                <tr>
                                    <th>Item</th>
                                    <th></th>
                                    <th class="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>{{ $order->product->name }}</strong>
                                    </td>
                                    <td></td>
                                    <td class="text-right">${{ number_format($order->product->price) }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

</body>

</html>
