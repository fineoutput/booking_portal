<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #dc3545; /* Bootstrap red */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .card {
            padding: 30px;
            border-radius: 8px;
            background-color: white;
            color: #212529;
            min-width: 350px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            margin-bottom: 15px;
        }

        /* Success Checkmark Animation */
        .checkmark {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #28a745;
            color: white;
            font-size: 18px;
            line-height: 30px;
            text-align: center;
            margin-bottom: 20px;
            opacity: 0;
            transform: scale(0);
            animation: checkmark-animation 1s forwards;
        }

        @keyframes checkmark-animation {
            0% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 1;
                transform: scale(1.2);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        #message {
            margin-top: 15px;
            font-weight: bold;
            color: green;
        }

        #resetForm {
            display: block;
        }
    </style>
</head>
<body>

    <div class="card text-center">
        <h3 class="mb-4">Reset Password</h3>
        
        <!-- Form -->
        <form id="resetForm">
            <input type="hidden" name="token" value="{{ request('token') }}">
            <input type="hidden" name="email" value="{{ request('email') }}">

            <input type="password" class="form-control" name="password" placeholder="New Password" required>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>

            <button type="submit" class="btn btn-danger w-100">Reset Password</button>
        </form>

        <!-- Success Message with Checkmark -->
        <div id="successMessage" style="display: none;">
            <div class="checkmark">✔</div>
            <div id="message">Password has been reset.</div>
        </div>
    </div>

    <!-- Bootstrap JS (optional for components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('resetForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            const response = await fetch('/booking_portal/public/api/password/reset', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();
            
            const successMessage = document.getElementById('successMessage');
            const resetForm = document.getElementById('resetForm');

            if (result.status) {
                // Hide form and show success message
                resetForm.style.display = 'none';  // Hide form
                successMessage.style.display = 'block';  // Show success message
            } else {
                alert(result.message);  // Show error message in alert (you can replace with Toast or modal)
            }
        });
    </script>

</body>
</html>
