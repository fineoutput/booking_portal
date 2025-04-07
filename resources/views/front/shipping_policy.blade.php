@extends('front.common.app')
@section('title','home')
@section('content')
<style>
    .shipping-policy {
  font-family: 'Segoe UI', sans-serif;
  color: #333;
  line-height: 1.7;
}

.shipping-policy h2 {
  color: #0066cc;
  margin-bottom: 1rem;
}

.shipping-policy h4 {
  margin-top: 1.5rem;
  color: #444;
}

.shipping-policy ul {
  padding-left: 1.2rem;
}

.shipping-policy ul li {
  margin-bottom: 0.5rem;
}

</style>
<div class="container">
    <div class="shipping-policy">
        <h2>Shipping Policy for B2B Travel Service Company</h2>
        <p>Thank you for choosing <strong>Trip Dekho</strong> as your trusted travel service partner. This shipping policy outlines the details regarding the delivery of travel documents, promotional materials, and any related physical products to our business clients.</p>
      
        <h4>1. Travel Documents & Packages Delivery</h4>
        <p>At Trip Dekho, we aim to make the booking and travel experience as smooth and efficient as possible. Depending on the nature of the travel service provided, we offer the following delivery options:</p>
        <ul>
          <li><strong>Travel Documents (Itineraries, Vouchers, Tickets, etc.):</strong> Delivered electronically via email or our secure portal within business days after finalizing the booking. Physical copies can be shipped upon request using your preferred method.</li>
          <li><strong>Physical Materials (Brochures, Promotional Items, etc.):</strong> Shipped to your designated business address. Delivery time depends on your location and chosen shipping method.</li>
        </ul>
      
        <h4>2. Shipping Methods & Costs</h4>
        <ul>
          <li><strong>Digital Deliveries:</strong> All documents (e.g., tickets, itineraries) are sent digitally at no extra cost via email or secure portal.</li>
          <li><strong>Physical Deliveries:</strong> Charged based on:
            <ul>
              <li>Destination (domestic or international)</li>
              <li>Shipping Method (Standard, Expedited, Priority)</li>
              <li>Weight and Size of the shipment</li>
            </ul>
            Shipping fees are calculated at checkout with an option to select your preferred shipping method.
          </li>
        </ul>
      
        <h4>3. Delivery Timeframe</h4>
        <ul>
          <li><strong>Travel Documents:</strong>
            <ul>
              <li>Digital: Sent within 1-2 business days from booking confirmation.</li>
              <li>Physical: Typically arrive within 1-2 business days for domestic and 1-2 weeks for international, depending on the shipping method.</li>
            </ul>
          </li>
          <li><strong>Marketing Materials and Brochures:</strong>
            <ul>
              <li>Standard: 1-2 business days for domestic, up to 3 weeks for international deliveries.</li>
              <li>Expedited: Faster delivery based on location.</li>
            </ul>
          </li>
        </ul>
      
        <h4>4. International Shipping</h4>
        <p>We offer international shipping for physical items such as marketing materials and promotional products. Please note:</p>
        <ul>
          <li><strong>Shipping Time:</strong> May vary due to customs, local regulations, or restrictions.</li>
          <li><strong>Import Duties & Taxes:</strong> The receiving business is responsible for applicable duties, taxes, or fees.</li>
          <li>Customs clearance may cause delays beyond our control.</li>
        </ul>
      
        <h4>5. Service and Shipping Delays</h4>
        <p>We strive for timely deliveries, but unforeseen issues can cause delays. If delays occur, we will notify you and provide an updated delivery estimate.</p>
        <p>If you face any issues, our support team is available to assist and ensure quick resolution.</p>
      
        <h4>6. Returns & Exchanges</h4>
        <p>Due to the nature of travel services, refunds or exchanges are not available for issued travel documents. For physical items like brochures or promotional materials, returns/exchanges can be requested within <strong>[X]</strong> days of receipt if items are unused and in resalable condition.</p>
      
        <h4>7. Contact Us</h4>
        <p>If you have any questions or need help with deliveries, please reach out:</p>
        <ul>
          <li><strong>Email:</strong> <a href="mailto:praveen.sharma@coih.in">praveen.sharma@coih.in</a></li>
          <li><strong>Phone:</strong> 9784869191</li>
          <li><strong>Business Hours:</strong> 24/7</li>
        </ul>
      
        <p>Thank you for partnering with <strong>Trip Dekho</strong>. We look forward to supporting your travel service needs!</p>
      </div>
</div>
  
@endsection