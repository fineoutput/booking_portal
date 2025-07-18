<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Invoice</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 30px; font-size: 14px; color: #000; }
    .header, .footer { text-align: center; }
    .invoice-box { border: 1px solid #000; padding: 20px; }
    .company-logo { float: right; width: 100px; }
    .clearfix::after { content: ""; display: table; clear: both; }
    .bold { font-weight: bold; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: center; }
    .no-border td { border: none; }
    .text-left { text-align: left; }
    .text-right { text-align: right; }
  </style>
</head>
<body>

<div class="invoice-box">
  <div class="clearfix">
    <div style="float: left;">
      <p><strong>Original-for Recipient</strong><br/>
      <strong>{{$user->business_name ?? ''}}</strong><br/>
      {{-- Registered Office: KN 22/2, MANSAROVAR, Jaipur, Rajasthan, 302020 --}}
        {{$user->cities->city_name ?? ''}}, {{$user->state->state_name ?? ''}}
      <br/>
      GSTIN: {{$user->GST_number ?? ''}}<br/>
      {{-- PAN: AACKC0624R<br/> --}}
      E-mail: <a href="mailto:{{$user->email  ?? ''}}">{{$user->email  ?? ''}}</a>
      </p>
    </div>
    <img src="{{public_path($user->logo)}}" class="company-logo" alt="Colors of India Logo"/>
  </div>

  <hr/>

  <div class="clearfix">
    {{-- <div style="float: left;">
      <strong>Guest Name:</strong> 5TH APR PURI - INTIMATE CARES
    </div> --}}
    <div style="float: right;">
      <strong>Date:</strong> {{ $booking->created_at->format('d/m/Y') }}
    </div>
  </div>
{{-- 
  <p><strong>Agency Name:</strong> INTIMATE CARES<br/>
  <strong>Address:</strong> SAKET VIHAR, MITRA MANDAL COLONY, ANISABAD, PATNA, BIHAR-800002<br/>
  <strong>GSTIN:</strong> 10AAKFI4972K1ZT</p> --}}

  <table>
    <thead>
      <tr>
        <th>Sr.</th>
        <th>Package Name</th>
        <th>Description</th>
        <th>PER PAX COST</th>
        <th>PAX</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>{{ $booking->package->package_name ?? ''}}</td>
        <td class="text-left">
          {{-- <strong>HSN CODE 998596<br/>PURI PACKAGE</strong><br/> --}}
          CHECK IN - {{ optional($booking->packagetemp)->start_date ? \Carbon\Carbon::parse($booking->packagetemp->start_date)->format('d-F-Y') : '' }}<br/>
          CHECK OUT - {{ optional($booking->packagetemp)->end_date ? \Carbon\Carbon::parse($booking->packagetemp->end_date)->format('d-F-Y') : '' }}<br/>
          PAX - {{ $booking->packagetemp->adults_count ?? ''}} Adults
        </td>
        <td>{{ $booking->fetched_price ?? '' }}</td>
        <td>18%</td>
        <td>
            @php  
                $tax_amount = $booking->fetched_price * 0.18;
                $total_price = round($booking->fetched_price + $tax_amount, 2);
            @endphp
            {{ $total_price }}
        </td>
      </tr>
    </tbody>
  </table>

  <table class="no-border">
    <tr>
      <td class="text-right bold" colspan="4">Gross Total</td>
      <td>{{$booking->fetched_price ?? ''}}</td>
    </tr>
    <tr>
      <td class="text-right bold" colspan="4">Service Charge</td>
      <td>{{$booking->agent_margin ?? ''}}</td>
    </tr>
    <tr>
      <td class="text-right bold" colspan="4">18% IGST (ON SERVICE)</td>
      @php  
                $tax_amount = $booking->fetched_price * 0.18;
                 $margin = $booking->agent_margin;
                $total_price = round($booking->fetched_price + $margin + $tax_amount, 2);
          @endphp
      <td> {{$tax_amount}}</td>
    </tr>
    <tr>
      <td class="text-right bold" colspan="4">TOTAL AMOUNT</td>
      <td><strong>{{$total_price ?? '0'}}</strong></td>
    </tr>
    <tr>
      <td class="text-right bold" colspan="4">RECEIVED</td>
      <td>0</td>
    </tr>
    <tr>
      <td class="text-right bold" colspan="4">BALANCE AMOUNT</td>
      <td><strong>{{$total_price ?? ''}}</strong></td>
    </tr>
  </table>

  <br/>
  <p><strong>E. & O. E.</strong><br/>
  CASH: Payment to be made to the cashier & printed Official Receipt must be obtained.<br/>
  Cheque / DD: All Cheques and drafts in payment of bills must be crossed ‘A/c Payee Only’ and drawn in favour of ‘Colors of India Hospitality’.<br/>
  Late Payment: Interest @18% p.a. from the bill amount will be charged on all outstanding bills after the due date.<br/>
  For GST INPUT: Kindly mention all details carefully to avoid unnecessary complications.<br/>
  This is computer generated invoice signature not required.</p>
</div>

</body>
</html>
