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
      <strong>COLORS OF INDIA HOSPITALITY PRIVATE LIMITED</strong><br/>
      Registered Office: KN 22/2, MANSAROVAR, Jaipur, Rajasthan, 302020<br/>
      GSTIN: 08AACKC0624R1Z9<br/>
      PAN: AACKC0624R<br/>
      E-mail: <a href="mailto:praveen.sharma@coih.in">praveen.sharma@coih.in</a>
      </p>
    </div>
    <img src="https://i.ibb.co/mC4hGdv/logo.png" class="company-logo" alt="Colors of India Logo"/>
  </div>

  <hr/>

  <div class="clearfix">
    <div style="float: left;">
      <strong>Guest Name:</strong> 5TH APR PURI - INTIMATE CARES
    </div>
    <div style="float: right;">
      <strong>Date:</strong> 06/04/2025
    </div>
  </div>

  <p><strong>Agency Name:</strong> INTIMATE CARES<br/>
  <strong>Address:</strong> SAKET VIHAR, MITRA MANDAL COLONY, ANISABAD, PATNA, BIHAR-800002<br/>
  <strong>GSTIN:</strong> 10AAKFI4972K1ZT</p>

  <table>
    <thead>
      <tr>
        <th>Sr.</th>
        <th>Description</th>
        <th>PER PAX COST</th>
        <th>PAX</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td class="text-left">
          <strong>HSN CODE 998596<br/>PURI PACKAGE</strong><br/>
          CHECK IN - 05-APRIL-2025<br/>
          CHECK OUT - 06-APRIL-2025<br/>
          PAX - 41 Adults
        </td>
        <td>8496.07</td>
        <td>41</td>
        <td>348338.87</td>
      </tr>
      <tr>
        <td>2</td>
        <td class="text-left">WELCOME KIT</td>
        <td>2000</td>
        <td>41</td>
        <td>82000</td>
      </tr>
      <tr>
        <td>3</td>
        <td class="text-left">+2 SNACKS</td>
        <td>850</td>
        <td>41</td>
        <td>34850</td>
      </tr>
      <tr>
        <td>4</td>
        <td class="text-left">EXTRA LUNCH</td>
        <td>1200</td>
        <td>41</td>
        <td>49200</td>
      </tr>
      <tr>
        <td>5</td>
        <td class="text-left">AV PACKAGE</td>
        <td>30000</td>
        <td>1</td>
        <td>30000</td>
      </tr>
    </tbody>
  </table>

  <table class="no-border">
    <tr>
      <td class="text-right bold" colspan="4">Gross Total</td>
      <td>544388.87</td>
    </tr>
    <tr>
      <td class="text-right bold" colspan="4">Service Charge</td>
      <td>82413</td>
    </tr>
    <tr>
      <td class="text-right bold" colspan="4">18% IGST (ON SERVICE)</td>
      <td>14834.34</td>
    </tr>
    <tr>
      <td class="text-right bold" colspan="4">TOTAL AMOUNT</td>
      <td><strong>641636.21</strong></td>
    </tr>
    <tr>
      <td class="text-right bold" colspan="4">RECEIVED</td>
      <td>0</td>
    </tr>
    <tr>
      <td class="text-right bold" colspan="4">BALANCE AMOUNT</td>
      <td><strong>641636.21</strong></td>
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
