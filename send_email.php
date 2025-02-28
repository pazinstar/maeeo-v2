<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pazinstar@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'maoanybpqjtsqtwm';   // Replace with your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        // $mail->addAddress('elijah_mutungi@yahoo.com'); // Add recipient
           //$mail->addAddress('maeeo2003@yahoo.com'); 
          //$mail->addAddress('maeeo3002@gmail.com'); // Add recipient
        $mail->addAddress('kelvinmukaria23@gmail.com'); // Add recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    =  "
                             <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f0f8f5; padding: 20px; border: 1px solid #cde4d7; border-radius: 8px;'>
                                <!-- Logo -->
                                <div style='text-align: center; margin-bottom: 20px;'>
                                    <img src='https://maeeo.com/imgs/logo0.png' alt='Company Logo' style='max-width: 100px; height: auto;'>
                                </div>
                                <h3 style='color: #4CAF50; border-bottom: 2px solid #4CAF50; padding-bottom: 8px;'>Message from: {$name}</h3>
                                <p><strong>Email:</strong> <a href='mailto:{$email}' style='color: #007BFF; text-decoration: none;'>{$email}</a></p>
                                <p><strong>Subject:</strong> {$subject}</p>
                                <p style='margin-top: 20px;'><strong>Message:</strong></p>
                                <div style='background-color: #fff; border: 1px solid #ddd; border-radius: 4px; padding: 15px; color: #555;'>
                                    <p>{$message}</p>
                                </div>
                                <br><br>
                                <hr>
                                <div style='display: flex; align-items: center; text-align: center;'>
                                    <i><p style='color: rgb(41, 0, 190);'>This message was sent via the online form on the organization's <span><a href='maeeo.com'>official website</a></span>.</p>
                                    </i>
                                </div>
                            </div>
                        ";

       // Send email
            $mail->send();
            $message = "Message sent successfully!";
            $messageType = 'success';
        } catch (Exception $e) {
            $message = "Message delivery failed. Error: {$mail->ErrorInfo}";
            $messageType = 'error';
        }
} else {
    echo "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 90%;
            position: relative;
        }

        .popup.success {
            border: 2px solid #4CAF50;
        }

        .popup .tick {
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 4px solid #4CAF50;
            position: relative;
            margin: 0 auto 20px;
            animation: scaleTick 0.5s ease-in-out;
        }

        .popup .tick::after {
            content: '';
            position: absolute;
            width: 12px;
            height: 24px;
            border-right: 4px solid #4CAF50;
            border-bottom: 4px solid #4CAF50;
            top: 12px;
            left: 16px;
            transform: rotate(45deg);
            animation: drawCheck 0.4s 0.5s ease-in-out forwards;
            opacity: 0;
        }

        @keyframes scaleTick {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes drawCheck {
            0% {
                opacity: 0;
                transform: scale(0) rotate(45deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotate(45deg);
            }
        }

        .popup button {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'contact.html'; // Include the uneditable HTML form ?>

    <?php if ($message): ?>
        <div class="popup-overlay" id="popup-overlay">
            <div class="popup <?= $messageType ?>">
                <div class="tick"></div>
                <p><?= htmlspecialchars($message) ?></p>
                <button onclick="closePopup()">Close</button>
            </div>
        </div>
        <script>
            function closePopup() {
                const popupOverlay = document.getElementById('popup-overlay');
                if (popupOverlay) {
                    popupOverlay.remove();
                }
            }
        </script>
    <?php endif; ?>
</body>
</html>

