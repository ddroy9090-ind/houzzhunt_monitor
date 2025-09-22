<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = "Admindesk@houzzhunt.com";
    $subject = "New Career Form Submission - HouzzHunt";

    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $city = htmlspecialchars($_POST['city']);

    $message = "
    <h2>New Career Form Submission</h2>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Phone:</strong> {$phone}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p><strong>City:</strong> {$city}</p>
    ";

    // File attachment
    $fileTmpPath = $_FILES['cv']['tmp_name'];
    $fileName = $_FILES['cv']['name'];
    $fileSize = $_FILES['cv']['size'];
    $fileType = $_FILES['cv']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Read file content
    $handle = fopen($fileTmpPath, "rb");
    $fileData = fread($handle, filesize($fileTmpPath));
    fclose($handle);

    $encodedFile = chunk_split(base64_encode($fileData));

    // Boundary
    $boundary = md5(time());

    // Headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: HouzzHunt Career Form <no-reply@houzzhunt.com>\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

    // Message Body
    $body = "--{$boundary}\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n";

    // Attachment
    $body .= "--{$boundary}\r\n";
    $body .= "Content-Type: {$fileType}; name=\"{$fileName}\"\r\n";
    $body .= "Content-Disposition: attachment; filename=\"{$fileName}\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= $encodedFile . "\r\n";
    $body .= "--{$boundary}--";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["status" => "success", "message" => "Email sent successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Email sending failed!"]);
    }
}
