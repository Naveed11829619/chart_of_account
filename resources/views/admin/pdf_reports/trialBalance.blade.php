<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trial Balance Report</title>
    <style>
        body{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 10px;
        }
       th {
            padding: 2px 5px;
        }
        td {
            padding: 2px 5px;
            white-space: nowrap;
        }
        .trail_tr{
        background-color: #7571f9 !important;
        }
        .trail_tr th{
            font-size:12px !important;
            color: #f1f1f1 !important;
        }
        .trail_tr th:nth-child(1) , .trailTotal th:nth-child(1){
            width: 70% !important;
        }
        .trail_tr th:nth-child(2) , .trailTotal th:nth-child(2){
            width: 30% !important;
        }
        .blackBorder td, .blackBorder th {
            border: 1px solid #938f8f !important;
        }
    </style>

</head>

<body>
    <div>

        <div style="text-align: center; font-size:20px;margin-bottom:20px;font-weight:bolder;">Trial Balance</div>

        <table style="width: 100%">
            <thead>
                <tr>
                    <th style="width: 50%;padding: 10px;border: 1px solid rgb(182, 182, 182);border-right: 0;">Debit</th>
                    <th style="width: 50%;padding: 10px;border: 1px solid rgb(182, 182, 182);">Credit</th>
                </tr>
            </thead>

            <tbody style="background-color:#f3f3f3;">
                <tr>
                    <td style="width: 50%;vertical-align: top !important; padding:10px;">
                        {{-- Debit Table code Start --}}
                            <table class="blackBorder" style="width: 100%;border-collapse: collapse;">
                                {{-- <thead> --}}
                                    <tr class="trail_tr">
                                        {{-- <th style="width: 70%">Final Account</th>
                                        <th style="width: 30%">Closing Balance</th> --}}
                                        <th>Final Account</th>
                                        <th>Closing Balance</th>
                                    </tr>
                                {{-- </thead>
                                <tbody> --}}
                                    @php
                                        $totalDebit = 0;
                                        $totalCredit = 0;
                                        $recordCountDebit = 0;
                                    @endphp
                                    @foreach($subAccounts as $key=>$subAccount)
                                        @php
                                            $getOpeningBalanceResponse = getOpeningBalance($subAccount->id, $startDate, $endDate,  false , 0);
                                            $openingBalance = $getOpeningBalanceResponse["opening_balance"];
                                            $entryType = $getOpeningBalanceResponse["opening_balance_type"];
                                        @endphp

                                        @if ($entryType == 'debit')
                                            @php
                                                $totalDebit += round($openingBalance);
                                                ++$recordCountDebit;
                                                $checkMultiple = 1;
                                             @endphp
                                            <tr
                                                @if ($recordCountDebit == 52 * $checkMultiple)
                                                    style="page-break-after: always;"
                                                    ++$checkMultiple;
                                                @endif
                                            >
                                                <td>{{$subAccount->title  }}</td>
                                                <td>{{ number_format($openingBalance) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                {{-- </tbody> --}}
                            </table>
                         {{-- Debit Table code end --}}
                    </td>
                    <td style="width: 50%;vertical-align: top !important; padding:10px;">
                        {{-- Credit Table code Start --}}
                            <table class="blackBorder" style="width: 100%;border-collapse: collapse;">
                                {{-- <thead> --}}
                                    <tr class="trail_tr">
                                        <th>Final Account</th>
                                        <th>Closing Balance</th>
                                    </tr>
                                {{-- </thead>
                                <tbody> --}}
                                    @php
                                        $recordCountCredit = 0;
                                    @endphp
                                    @foreach($subAccounts as $key=>$subAccount)
                                        @php
                                            $getOpeningBalanceResponse = getOpeningBalance($subAccount->id, $startDate, $endDate,  false , 0);
                                            $openingBalance = $getOpeningBalanceResponse["opening_balance"];
                                            $entryType = $getOpeningBalanceResponse["opening_balance_type"];

                                            ++$recordCountCredit;
                                            @endphp

                                        @if ($entryType == 'credit')
                                            @php
                                                $totalCredit += round($openingBalance);
                                                $checkMultiple = 1;
                                            @endphp
                                            <tr
                                                @if ($recordCountCredit == 52 * $checkMultiple)
                                                    style="page-break-after: always;"
                                                    ++$checkMultiple;
                                                @endif
                                            >
                                                <td>{{$subAccount->title}}</td>
                                                <td>{{ number_format($openingBalance )}}</td>
                                            </tr>
                                        @endif
                                @endforeach
                                {{-- </tbody> --}}
                            </table>
                        {{-- Credit Table code end --}}
                    </td>
                </tr>
            </tbody>

            <tfoot>
                <tr>
                    <td  style="background-color: rgba(0, 0, 0, 0.05);">
                        <table style="width:96%;border-collapse: collapse;">
                            {{-- <tbody> --}}
                                <tr class="trailTotal">
                                    <th class="text-center h5" style="width: 70%">Total</th>
                                    <th class="h5" style="width: 30%">{{ number_format($totalDebit) }}</th>
                                </tr>
                            {{-- </tbody> --}}
                        </table>
                    </td>
                    <td  style="background-color: rgba(0, 0, 0, 0.05);">
                        <table style="width:100%;border-collapse: collapse;">
                            {{-- <tbody> --}}
                                <tr class="trailTotal">
                                    <th class="text-center h5" style="width: 70%">Total</th>
                                    <th class="h5" style="width: 30%">{{ number_format($totalCredit) }}</th>
                                </tr>
                            {{-- </tbody> --}}
                        </table>
                    </td>
                </tr>
            </tfoot>


        </table>


    </div>

</body>

</html>
