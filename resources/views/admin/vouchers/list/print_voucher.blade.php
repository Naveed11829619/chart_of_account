<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Journal Voucher</title>
</head>
<style>
    .footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   text-align: center;
}
</style>
<body style="font-size:13px; color:gray;">
  <div style="width:700px; margin:auto;">
    <header style="margin-top: 30px; display:flex;padding-bottom: 2rem; border-bottom: .5rem solid;position: relative;">
      <div style="font-size:1rem; position:absolute; top: -40px;">
        <img src="{{ public_path('assets/img/logo.png') }}" alt="" height="100px" width="100px">
    </div>
      <table style="border-collapse: collapse; margin-left: 30%; width:70%;" >
        <tr>
          {{-- <td colspan="2" style="font-weight: bold;"><u>{{ucwords(str_replace('_',' ',$voucher->voucher_type))}}</u></td> --}}
          <td style="border:1px solid;">Dated:</td>
          <td style="border:1px solid;">{{date('d M Y')}}</td>
        </tr>
        <tr>
          <td style="border:1px solid;padding-right:1rem;font-weight: bold;">Project:</td>
          <td style="border:1px solid;border-right: none; text-align:center; padding-left:30px;">Symargo Digital Marketing Office</td>
          <td style="border-bottom: 1px solid;"></td>
          <td style="border: 1px solid; border-left: none;"></td>
        </tr>
      </table>
    </header>
<section>
    <table border="1" style="margin-top: 30px; border-collapse:collapse; width:100%;">
        <thead>
            <tr>
                <th>A/C Name</th>
                <th>A/C Narration</th>
                <th>Debit</th>
                <th>Credit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($voucher->voucherDetails as $detail )
                <tr>
                    <td style="padding: 5px; text-align:center">{{ucwords(strtolower($detail->finalAccount->title))}}</td>
                    <td style="padding: 5px; text-align:center">{{ucwords(strtolower($detail->product_narration))}}</td>
                    @if ($detail->debit_amount == 0)
                    <td style="text-align:center">---</td>
                    @else
                    <td style="padding: 5px; text-align:center">{{number_format(round($detail->debit_amount))}}</td>
                    @endif
                    @if ($detail->credit_amount==0)
                    <td style="text-align:center">---</td>
                    @else
                    <td style="padding: 5px; text-align:center;">{{number_format(round($detail->credit_amount))}}</td>
                    @endif
                </tr>
            @endforeach
        <tr>
            <td colspan="2" style="text-align: center;"> <b>Total</b></td>
            <td style="padding: 5px; text-align:center">{{number_format($sum_of_debit)}}</td>
            <td style="padding: 5px; text-align:center">{{number_format($sum_of_credit)}}</td>
        </tr>
        </tbody>
    </table>
</section>
<div style="margin-top: 15rem; text-align: center;" class="footer">
    <div style="display: inline-block; margin-right: 6%;">
      <p style="border-top: 2px solid; width: 200px;"></p>
      {{-- <p style="text-align: center;">SHOAIB SHAFIQ</p> --}}
      <p style="text-align: center;">PAID BY</p>
    </div>
    <div style="display: inline-block; margin-bottom:4% ">
      <p style="border-top: 2px solid; width: 200px;"></p>
    </div>
    <div style="display: inline-block; margin-left: 6%;">
      <p style="border-top: 2px solid; width: 180px;"></p>
      {{-- <p style="text-align: center;">SALMAN AHMAD BUTT</p> --}}
      <p style="text-align: center;">RECIEVED BY</p>
    </div>
  </div>
  </div>
</body>
</html>