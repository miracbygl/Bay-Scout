<?php
session_start();

// Giriş yapılmışsa doğrudan dashboard'a yönlendir
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
    <title>Bay Scout - Hoş Geldiniz</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
        body {
         margin: 0;
         padding: 0;
         height: 100vh;
            background: url('assets/bg2.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
        justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            color: white;
        }
.overlay {
            background-color: rgba(0, 0, 0, 0.6);
         position: absolute;
            inset: 0;
            z-index: 0;
        }
    .welcome-box {
            position: relative;
            z-index: 1;
         text-align: center;     background: rgba(255, 255, 255, 0.05);
            padding: 60px;
            border-radius: 20px;
       box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(10px);
        }
        .welcome-box h1 {
         font-size: 3rem;
            margin-bottom: 10px;
        }
        .welcome-box p {
            font-size: 1.2rem;
        }
        .loading-dots::after {
            content: '';
          display: inline-block;
         animation: dots 1.5s steps(3, end) infinite;
        }
        @keyframes dots {
         0% { content: ''; }
         33% { content: '.'; }
            66% { content: '..'; }
            100% { content: '...'; }
        }
        .ball-icon {
            margin: 30px auto 0;
            width: 80px;
            height: 80px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .ball-icon:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
 <div class="overlay"></div>

    <div class="welcome-box">
        <h1> Bay Scout</h1>
        <p>Futbolun Geleceğini Bugünden Keşfet</p>

        
    <a href="login.php" title="Giriş Yap">
            <svg class="ball-icon" viewBox="0 0 512 512" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M256,8C119.03,8,8,119.03,8,256s111.03,248,248,248s248-111.03,248-248S392.97,8,256,8z M378,392l-90-18l-42,38 l-42-38l-90,18l18-90l-38-42l38-42l-18-90l90,18l42-38l42,38l90-18l-18,90l38,42l-38,42L378,392z"/>
            </svg>
        </a>

        <p class="mt-4 loading-dots">Giriş sayfasına girmek için üsteeki ikona basınız</p>
    </div>

    
</body>
</html>
