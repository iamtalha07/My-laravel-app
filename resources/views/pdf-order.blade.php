<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Invoice</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .text-right {
            text-align: right;
        }
    </style>

</head>

<body class="login-page" style="background: white">

    <div>
        <div class="row">
            <div class="col-xs-7">
                <h4>From:</h4>
                <strong>{{ $order->user->name }}</strong><br>
                {{ $order->user->email }} <br>
                <br>
            </div>

            <div class="col-xs-4">
                <img src="https://res.cloudinary.com/dqzxpn5db/image/upload/v1537151698/website/logo.png"
                    alt="logo">
            </div>
        </div>

        <div style="margin-bottom: 0px">&nbsp;</div>

        <div class="row">
            <div class="col-xs-6">
                <h4>To:</h4>
                <address>
                    <strong>{{ $order->customer_name }}</strong><br>
                    <span>{{ $order->address }}</span><br>
                    <span>{{ $order->contact }}</span>
                </address>
            </div>

            <div class="col-xs-5">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <th>Invoice Num:</th>
                            <td class="text-right">{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th> Invoice Date: </th>
                            <td class="text-right">{{ $order->created_at->format('Y-m-d') }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <table class="table">
            <thead style="background: #F5F5F5;">
                <tr>
                    <th>Item</th>
                    <th></th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div><strong>{{ $order->product->name }}</strong></div>
                        <td></td>
                        <td class="text-right">${{ number_format($order->product->price) }}</td>
                </tr>
            </tbody>
        </table>

    </div>

</body>

</html>
