<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Invoice</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 30px; font-size: 14px; color: #000; line-height: 1.6; }
    .header, .footer { text-align: center; }
    .invoice-box { border: 1px solid #000; padding: 20px; }
    .company-logo { float: right; width: 100px; max-height: 80px; object-fit: contain; }
    .clearfix::after { content: ""; display: table; clear: both; }
    .bold { font-weight: bold; }
    .section-title { font-size: 16px; margin-top: 20px; font-weight: bold; text-decoration: underline; }
  </style>
</head>
<body>

<div class="invoice-box">
  <!-- Header -->
  <div class="clearfix">
    <div style="float: left;">
      <p><br/>
      <strong>{{ $user->business_name ?? 'N/A' }}</strong><br/>
    {{ optional($user->state)->state_name ? optional($user->state)->state_name : '' }}
<br/>
      GSTIN: {{ $user->GST_number ?? 'N/A' }}<br/>
      E-mail: <a href="mailto:{{ $user->email ?? '' }}">{{ $user->email ?? '' }}</a>
      </p>
    </div>

    @if(!empty($user->logo) && file_exists(public_path($user->logo)))
      <img src="{{ public_path($user->logo) }}" class="company-logo" alt="Company Logo"/>
    @endif
  </div>

  <hr/>

  <!-- Date -->
  <div class="clearfix">
    <div style="float: right;">
      <strong>Date:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
    </div>
  </div>

  <!-- Main Content -->
  <p>Hi Sir/Madam,</p>

  <p>Greetings from <strong>{{ $user->business_name ?? 'Our Company' }}</strong>.</p>

  <p>Thank you for your query with us. As per your requirements, following are the package details.</p>

  <!-- Trip Info -->
  <p><strong>Trip ID:</strong> {{ $booking->id ?? 'N/A' }}</p>
  <p><strong>{{ optional($booking->package)->package_name ?? 'Package Name' }}</strong></p>
  
  <p> CHECK IN - {{ optional($booking->packagetemp)->start_date ? \Carbon\Carbon::parse(optional($booking->packagetemp)->start_date)->format('d-F-Y') : 'N/A' }}<br/>
      CHECK OUT - {{ optional($booking->packagetemp)->end_date ? \Carbon\Carbon::parse(optional($booking->packagetemp)->end_date)->format('d-F-Y') : 'N/A' }}
  </p>

  <p> {{ optional($booking->packagetemp)->adults_count ?? 0 }} Adults,
      {{ optional($booking->packagetemp)->children_5_11 ?? 0 }} Children 
  </p>

  <!-- Price Details -->
  <p class="section-title">
      Price Details: 
      @switch(optional($booking->packagetemp)->hotel_preference)
          @case('standard_cost') Standard Hotel @break
          @case('deluxe_cost') Deluxe Hotel @break
          @case('premium_3_cost') Premium (3 star) @break
          @case('super_deluxe_cost') Super Deluxe Hotel @break
          @case('premium_cost') Premium (4 star) @break
          @case('luxury_cost') Deluxe (4 star) Hotel @break
          @case('premium_5_cost') Premium (5 star) @break
          @case('hostels') Hostels @break
          @default NO DATA
      @endswitch
      , {{ optional($booking->packagetemp)->hotel_category ?? '' }} Room Package
  </p>

  @php
      $basePrice = $booking->fetched_price ?? 0;
      $margin = $booking->agent_margin ?? 0;
      $total_price = round($basePrice + $margin, 2);
  @endphp

  <p><strong>Total Price (INR):</strong> {{ number_format($total_price, 2) }} /- (exc. GST)</p>

  <!-- Hotels List -->
  @if(!empty($hotels) && $hotels->count())
      <p><strong>Hotels Available:</strong></p>
      @foreach($hotels as $hotel)
          <p>{{ $hotel->name ?? 'Unnamed Hotel' }}</p>
      @endforeach
  @else
      <p><strong>No Hotels Available</strong></p>
  @endif

</div>

</body>
</html>
