<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parcels List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        td,
        th {
            border: 1px solid #ddd;
        }

        .bb-none {
            border-bottom: 2px solid transparent;
        }

        .br-none {
            border-right: 2px solid #fff;
        }

        .bt-none {
            border-top: 2px solid #fff;
        }

        .bl-none {
            border-left: 2px solid #fff;
        }

        .tc {
            text-align: center;
        }

        .tr {
            text-align: right;
        }

        body {
            font-family: bangla;
            font-size: 13px;
            background-color: red;
        }

        .fs {
            font-size: 12px;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        .gtc {
            text-align: center;
            border-radius: 15px;
        }

        .sgtc {
            background-color: green;
            color: white;
            font-size: 20px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <htmlpageheader name="page-header">
        <table style="border: 2px solid #fff;">
            <tr>
                <td class="tc bb-none">
                    <p style="font-size: 15px;">Parcelsheba Limited</p>
                </td>
            </tr>
        </table>
    </htmlpageheader>
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="tc" style="font-size: 10px;">
                <p class="card-text mb-25"><b>Address :</b> House#181/182,Block C, Section 6,Mirpur Dhaka, Bangladesh</p>
                <p style="font-size: 12px;"><b>Emergency Contact:</b> +880198-997711</p>
            </td>
        </tr>
    </table>
    <table style="border: 2px solid #fff;">
        <tr>
            <td class="bb-none bl-none" style=" text-align: center;"><b>Name:</b> {{$merchant->name}} <b> Mobile:</b> {{$merchant->mobile}}
        </tr>
    </table>
    <br>
    <table style="border: 2px solid #ddd;">
        <tr>
            <th style="width: 20;">#</th>
            <th style="width: 180;">Merchant</th>
            <th style="width: 100;">Date</th>
            <th style="width: 80;">Tracking ID</th>
            <th style="width: 80;">Invoice ID</th>
            <th style="width: 100;">Parcel Price (TK)</th>
            <th style="width: 100;">Delivery (TK)</th>
            <th style="width: 50;">Cod (TK)</th>

            <th style="width: 100;">Merchant Pay (TK)</th>
            <th style="width: 50;">Status</th>
            <th>Merchant Payment Status</th>
        </tr>

        @foreach($parcels as $parcel)
        <tr>
            <td class="tc">{{$loop->iteration}}</td>
            <td>
                <p>{{$parcel->merchant->name}}</p>
            </td>
            <td class="tc">
                {{ Carbon\Carbon::parse($parcel->added_date)->format('d-m-Y') }}
            </td>
            <td class="tc">
                {{$parcel->tracking_id}}
            </td>
            <td class="tc">
                {{$parcel->invoice_id}}
            </td>

            <td class="tr">{{number_format($parcel->collection_amount)}}</td>
            <td class="tr">{{number_format($parcel->delivery_charge)}}</td>
            <td class="tr">{{number_format($parcel->cod)}}</td>
            <td class="tr">{{number_format($parcel->payable)}}</td>
            <td class="tc">
                {{$parcel->status}}
            </td>
            <td>
                @if(isset($parcel->collection))
                <p>{{$parcel->collection->merchant_paid??'' }} </p>
                @else
                <p>No Collection </p>
                @endif

            </td>
        </tr>
        @endforeach
    </table>

</body>

</html>