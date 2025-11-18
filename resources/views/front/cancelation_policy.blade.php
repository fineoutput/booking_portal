@extends('front.common.app')
@section('title','home')
@section('content')
<style>
       .terms-conditions {
  font-family: 'Segoe UI', sans-serif;
  line-height: 1.8;
  color: #333;
  padding: 1.5rem;
  background: #fafafa;
  border-radius: 8px;
}

.terms-conditions h2 {
  color: #0073aa;
  margin-bottom: 1rem;
}

.terms-conditions h4 {
  margin-top: 1.5rem;
  color: #444;
  font-weight: 600;
}

.terms-conditions ul {
  padding-left: 1.5rem;
  margin-top: 0.5rem;
}

.terms-conditions ul li {
  margin-bottom: 0.5rem;
}

.terms-conditions a {
  color: #0073aa;
  text-decoration: none;
}

</style>
  <div class="container">
    <article class="card" role="article" aria-labelledby="policy-title">
      <header>
        <h1 id="policy-title">Cancellation &amp; Refund Policy</h1>
        <div class="subtitle">Clear rules for cancellations, refunds and important terms &amp; conditions.</div>
      </header>

      <!-- Refund rules -->
      <section aria-labelledby="refund-title">
        <h2 id="refund-title">Refund / Cancellation Slab</h2>
        <table class="refund" role="table" aria-describedby="refund-desc">
          <thead>
            <tr>
              <th>Notice period before travel</th>
              <th>Refund / Charge</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>30 days or more</td>
              <td>Full refund (after deducting any non-refundable charges from suppliers)</td>
            </tr>
            <tr>
              <td>15 to 29 days</td>
              <td>50% of the total package cost will be charged</td>
            </tr>
            <tr>
              <td>7 to 14 days</td>
              <td>75% of the total package cost will be charged</td>
            </tr>
            <tr>
              <td>Less than 7 days</td>
              <td>No refund will be applicable</td>
            </tr>
          </tbody>
        </table>
        <p id="refund-desc" class="muted">Note: The above slabs are applied to the total package cost unless suppliers' policies dictate otherwise.</p>
      </section>

      <!-- Terms & Conditions -->
      <section aria-labelledby="terms-title">
        <h2 id="terms-title">Important Terms &amp; Conditions</h2>

        <ol>
          <li>
            <strong>Supplier / Vendor Policies</strong>
            <p class="muted">We coordinate with multiple hotels, transport providers and local partners. All cancellations are subject to the respective vendor / supplier policies. Any amount that is non-refundable per their policy will be deducted from the refund amount.</p>
          </li>

          <li>
            <strong>Peak Season, Festive Periods &amp; Long Weekends</strong>
            <p class="muted">During peak seasons, festivals, special events and long weekends, <span class="highlight">100% cancellation charges may apply irrespective of the booking date</span>. This is due to stricter cancellation rules from hotels and transport providers during such periods.</p>
          </li>

          <li>
            <strong>Refund Processing Timeline</strong>
            <p class="muted">If a refund is applicable, it will be processed within <strong>10–15 working days</strong> after receiving confirmation from all suppliers/vendors. Refunds will be issued to the same payment method used during booking.</p>
          </li>

          <li>
            <strong>Unused / Partially Used Services</strong>
            <p class="muted">No refund will be provided for:</p>
            <ul>
              <li>Unused services</li>
              <li>Missed transfers / sightseeing</li>
              <li>Early check-out</li>
              <li>No-show at hotels</li>
              <li>Last-minute changes requested by the traveler</li>
            </ul>
          </li>

          <li>
            <strong>Booking Amendments</strong>
            <p class="muted">Any amendments (date change, hotel change, upgrade, etc.) requested after the booking is confirmed will be processed as per availability and may attract additional charges from suppliers.</p>
          </li>

          <li>
            <strong>Force Majeure / Unforeseen Situations</strong>
            <p class="muted">In situations beyond our control such as natural calamities, roadblocks, strikes, political disturbances, weather conditions, or operational restrictions, refunds and cancellations will be processed strictly as per supplier/vendor policy. Our company will not be liable for delays or losses caused due to such situations.</p>
          </li>

          <li>
            <strong>Special Non-Refundable Bookings</strong>
            <p class="muted">Some hotels, flights and activities are categorised as “non-refundable” or “non-changeable”. In such cases, <span class="highlight">100% cancellation charges will apply irrespective of the notice period</span>.</p>
          </li>

          <li>
            <strong>Acceptance of Policy</strong>
            <p class="muted">By confirming the booking and making the payment, the traveler agrees to all terms mentioned in this Cancellation &amp; Refund Policy.</p>
          </li>
        </ol>
      </section>

      
    </article>
  </div>
@endsection