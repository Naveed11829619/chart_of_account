<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Journal Voucher Report</title>

    <style>
        body{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 10px;
        }
        
        table,tr,th,td {
         border:1px solid black;
         border-collapse: collapse;
         text-align: center;
      }
        h5{
            text-align: center;
        }
    </style>

</head>

<body>
    <div>
        <div style="text-align: center; font-size:20px;margin-bottom:20px;font-weight:bolder;">All Vouchers</div>
        @php
            $date = Session::get('key');;
           
        @endphp
        <h5>from:: {{$date['start_date']}} to: {{$date['end_date']}} </h5>
        <table class="table1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Voucher Type</th>
                    <th>final account</th>
                    <th>Naration</th>
                    <th>Debit</th>
                    <th>Credit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $num = 0;
                @endphp
                @foreach ($vouchers as $key=> $voucherDetail)
                    <tr>
                        <td style="width: 5%">{{++$num}}</td>
                        <td>{{date('d/m/y',strtotime($voucherDetail->date))}}</td>
                        <th>{{ ucwords(str_replace('_',' ',$voucherDetail->voucher->voucher_type))}}</th>
                        <td>{{$voucherDetail->finalAccount->title}}</td>
                        <td style="width: 30%"> {{$voucherDetail->product_narration}}</td>
                        {{-- Code for Debit start --}}
                        @if ($voucherDetail->entry_type =='debit')
                            <td>{{ number_format($voucherDetail->debit_amount) }}</td>
                        @else
                            <td>0</td>
                        @endif
                        {{-- Code for Debit start --}}

                        {{-- Code for Credit start --}}
                        @if ($voucherDetail->entry_type == 'credit')
                            <td>{{ number_format($voucherDetail->credit_amount) }}</td>
                        @else
                            <td>0</td>
                        @endif
                        {{-- Code for Credit start --}}
                    </tr>
                    
                @endforeach

            </tbody>
        </table>

    </div>

</body>

</html>
