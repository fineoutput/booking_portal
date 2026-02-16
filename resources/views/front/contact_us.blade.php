@extends('front.common.app')
@section('title','home')
@section('content')
  <style>
    


    .card {
    background: var(--card);
    padding: 32px;
    border-radius: 14px;
    border: 1px solid var(--border);
    box-shadow: 0 6px 18px rgb(0 0 0 / 24%);
  }

    h1{
      margin:0;
      font-size:24px;
      font-weight:600;
    }

    .subtitle{
      color:var(--muted);
      font-size:14px;
      margin-top:4px;
      margin-bottom:18px;
    }

    .grid{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:28px;
    }

    .info-box{
      padding:20px;
      border-radius:12px;
      border:1px solid var(--border);
      background:#fbfdff;
    }

    .info-box h3{
      margin:0 0 10px 0;
      font-size:18px;
      color:#111827;
    }

    .info-item{
      margin-bottom:10px;
    }

    .muted{color:var(--muted);}

    label{
      display:block;
      margin-bottom:6px;
      font-size:14px;
      font-weight:500;
    }

    input, textarea{
      width:100%;
      padding:12px 14px;
      border-radius:8px;
      border:1px solid var(--border);
      background:#ffffff;
      font-size:15px;
      outline:none;
      transition:0.2s;
    }

    input:focus, textarea:focus{
      border-color:var(--accent);
      box-shadow:0 0 0 3px rgba(15,98,254,0.12);
    }

    textarea{
      height:120px;
      resize:none;
    }

    button{
      background:var(--accent);
      color:#fff;
      padding:12px 20px;
      border:0;
      border-radius:8px;
      font-size:15px;
      cursor:pointer;
      transition:0.2s;
      width:100%;
      font-weight:500;
    }

    button:hover{
      background:#0049e6;
    }

    @media(max-width:700px){
      .grid{
        grid-template-columns:1fr;
      }
      .card{
        padding:22px;
      }
    }
  </style>
 <div class="container">
    <div class="card">

      <h1>Contact Us</h1>
      <div class="subtitle">Feel free to reach out to us for bookings, support, or partnership inquiries.</div>

      <div class="grid">

        <!-- Contact Information -->
        <div class="info-box">
          <h3>Contact Details</h3>

          <div class="info-item">
            <strong>Email:</strong>
            <div class="muted">coih.praveensharma@gmail.com</div>
          </div>

          <div class="info-item">
            <strong>Phone:</strong>
            <div class="muted">+91 9782324798</div>
          </div>

          <div class="info-item">
            <strong>Office Address:</strong>
            <div class="muted">
             T7, 3rd Floor, Jagdamba Tower,
Amrapali Circle, Vaishali Nagar,
Jaipur, Rajasthan 302021
            </div>
          </div>

          

        </div>

        <!-- Contact Form -->
        <div>
          <form action="#" method="post">
            <div style="margin-bottom:14px;">
              <label>Your Name</label>
              <input type="text" required>
            </div>

            <div style="margin-bottom:14px;">
              <label>Your Email</label>
              <input type="email" required>
            </div>

            <div style="margin-bottom:14px;">
              <label>Mobile Number</label>
              <input type="text" required>
            </div>

            <div style="margin-bottom:14px;">
              <label>Message</label>
              <textarea required></textarea>
            </div>

            <button style="background: #0049e6; color: #fff;" type="submit">Send Message</button>
          </form>
        </div>

      </div>
    </div>
  </div>

@endsection