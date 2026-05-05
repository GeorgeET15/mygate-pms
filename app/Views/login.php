<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Mygate PMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --mygate-black: #1D1E1E;
            --mygate-blue: #AEDFFB;
            --mygate-yellow: #FEDF2B;
            --blue-gradient: linear-gradient(135deg, #D2EFFA, #AEDFFB);
            --yellow-gradient: linear-gradient(135deg, #F3ED9D, #FEDF2B);
        }
        body {
            background-color: var(--mygate-black);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-top: 5px solid var(--mygate-yellow);
        }
        .login-logo {
            font-size: 3.5rem;
            color: var(--mygate-black);
            margin-bottom: 10px;
        }
        .btn-login {
            background: var(--yellow-gradient);
            color: var(--mygate-black);
            border: none;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            font-weight: 700;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(254, 223, 43, 0.4);
        }
        .form-control:focus {
            border-color: var(--mygate-blue);
            box-shadow: 0 0 0 0.25rem rgba(174, 223, 251, 0.25);
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <div class="mb-4">
        <img src="/assets/img/mygate-logo.png" alt="Mygate Logo" class="img-fluid" style="max-height: 80px;">
    </div>
    <div class="p-2">
        <h3 class="fw-bold mb-1">Mygate PMS</h3>
        <p class="text-muted small mb-4">Secure Property Management</p>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger small py-2">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="/login/authenticate" method="POST">
        <?= csrf_field() ?>
        <div class="mb-3 text-start">
            <label class="form-label small fw-bold text-uppercase">Email Address</label>
            <input type="email" name="email" class="form-control form-control-lg" placeholder="admin@mygate.com" required>
        </div>
        <div class="mb-4 text-start">
            <label class="form-label small fw-bold text-uppercase">Password</label>
            <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-login">Sign In</button>
    </form>
    
    <div class="mt-4 small text-muted">
        &copy; <?= date('Y') ?> Mygate PMS. All rights reserved.
    </div>
</div>

</body>
</html>
