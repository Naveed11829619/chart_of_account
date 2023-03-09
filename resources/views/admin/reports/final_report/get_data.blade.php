<style>
    .trail_tr {
        background-color: #7571f9 !important;
    }

    .trail_tr th {
        font-size: 20px !important;
        color: #f1f1f1 !important;
    }

    .trail_tr th:nth-child(1),
    .trailTotal th:nth-child(1) {
        width: 70% !important;
    }

    .trail_tr th:nth-child(2),
    .trailTotal th:nth-child(2) {
        width: 30% !important;
    }

    .blackBorder td,
    .blackBorder th {
        border: 1px solid #938f8f !important;
    }
</style>


<div>
    <div class="d-flex justify-content-end mt-4">
        <a class="btn btn-success text-white" href="{{ route('finalAccountAccountReport', [$startDate, $endDate]) }}">Export to PDF</a>
    </div>


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
                                        <td>{{ $detail->finalAccount->title }}</td>
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
                    <table class="w-100">
                        <tbody>
                            <tr class="trailTotal">
                                <th class="text-center h5">Total</th>
                                <th class="h5">{{ number_format($sumOfDebit) }}</th>
                            </tr>
                        </tbody>
                    </table>
                </td>

                <td>
                    <table class="w-100">
                        <tbody>
                            <tr class="trailTotal">
                                <th class="text-center h5">Total</th>
                                <th class="h5">{{ number_format($sumOfCredit) }}</th>
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
</div>

<script>
    // $(document).ready(function() {
    //     $(".table").DataTable({
    //             dom: "Bfrtip",
    //             buttons: ["copy", "csv", "excel", "pdf", "print"]
    //     })
    // });
</script>
