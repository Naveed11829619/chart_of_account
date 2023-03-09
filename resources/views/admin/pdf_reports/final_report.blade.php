<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Final Account Report</title>
    <style>
        body{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 10px;
        }
        .trail_tr{
        background-color: #7571f9 !important;
        }
        .trail_tr th{
            font-size:12px !important;
            color: #f1f1f1 !important;
        }
        .trail_tr th:nth-child(1) , {
            width: 70% !important;
        }
        .trail_tr th:nth-child(2){
            width: 30% !important;
        }
        .blackBorder td, .blackBorder th {
            border: 1px solid #938f8f !important;
        }
        .trailTotal th{
            justify-content: space-between;
        }
        


    </style>
</head>
<body>
    <div>
        <div style="text-align: center; font-size:20px;margin-bottom:10px;font-weight:bolder;">Final Detailed Report</div>
        <table style="width:35%; padding: 10px 0px;">
            <tr>
                <th>Start date : <span>{{ Carbon\Carbon::createFromFormat('y-m-d', $startDate)->format('d / m / y') }}</span></th>
                <th style="padding-left: 15px;">End date : <span>{{ Carbon\Carbon::createFromFormat('y-m-d', $endDate)->format('d / m / y') }}</span></th>
            </tr>
        </table>
        @if (isset($vouchers) && $vouchers->count() > 0)
        <table class="table table-striped table-bordered zero-configuration">
            <thead>
                <tr>
                    <th class="text-center h4">Debit</th>
                    <th class="text-center h4">Credit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    {{-- Debit Table code Start --}}
                    <td style="vertical-align: top !important;">
                        <table class="w-100 blackBorder">
                            <thead>
                                <tr class="trail_tr">
                                    <th>Final Account</th>
                                    <th>Debit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalDebit = 0;
                                    $totalCredit = 0;
                                @endphp
                                 @foreach ($vouchers as $key => $detail)
                                    
                                    @if ($detail->entry_type == 'debit')
                                        @php
                                            $totalDebit += round($totalDebit);
                                        @endphp
                                        <tr>
                                            <td>{{$detail->finalAccount->title}}</td>
                                            <td data-last-balance="{{ $totalDebit }}">{{ number_format($detail->debit_amount) }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                    {{-- Debit Table code end --}}
    
                    {{-- Credit Table code Start --}}
                    <td style="vertical-align: top !important;">
                        <table class="w-100 blackBorder">
                            <thead>
                                <tr class="trail_tr">
                                    <th>Final Account</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vouchers as $key => $detail)
                                   
                                    @if ($detail->entry_type == 'credit')
                                       
                                        <tr>
                                            <td>{{$detail->finalAccount->title}}</td>
                                            <td>{{number_format($detail->credit_amount)}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                    {{-- Credit Table code end --}}
                </tr>
    
    
                <tr style="background-color: rgba(0, 0, 0, 0.05) !important;">
                    <td>
                        <table style="width: 100%">
                            <tbody>
                                <tr class="trailTotal">
                                    <td class="">Total <span style="opacity: 0">sjgfchdsgfhsadgfsjadfsdjfj</span></td>
                                    <td class="total">{{ number_format($sumOfDebit) }}</th>
                                </tr>
                                
                            </tbody>
                        </table>
                    </td>
    
                    <td>
                        <table style="width: 100%">
                            <tbody>
                                <tr class="trailTotal">
                                    <td class="">Total <span style="opacity: 0">sjgfchdsgfhsadgfsja</span></td>

                                    <td class="total">  {{ number_format($sumOfCredit) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
    
            </tbody>
    
            {{-- Total Debit and Credit code Start --}}
            <tfoot>
    
            </tfoot>
            {{-- Total Debit and Credit code Start --}}
        </table>
        <h4>Account Profit: {{$sumOfDebit - $sumOfCredit}} </h4>
        @else
            <h4>Record Not Found</h4>
        @endif
        
    </div>

</body>

</html>
