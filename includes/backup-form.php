<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Handle file upload
    $uploadDir = __DIR__ . "/uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES['cv']['name']);
    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['cv']['tmp_name'], $targetFile)) {
        $cvUrl = "https://www.houzzhunt.com/uploads/" . $fileName; // public URL to download later
    } else {
        die(json_encode(["status" => "error", "message" => "File upload failed."]));
    }

    // 2. Prepare data for TeleCRM
    $apiUrl = "https://api.telecrm.in/enterprise/685c0a8b9846bf4716e3dc4f/autoupdatelead";

    $postData = [
        "fields" => [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "country" => $_POST['city'],
            "phone" => $_POST['phone'],
            "cv_link" => $cvUrl // send file link to TeleCRM
        ],
        "actions" => [
            [
                "type" => "SYSTEM_NOTE",
                "text" => "Lead Source: Career Form"
            ]
        ]
    ];

    // 3. Send to TeleCRM
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo json_encode([
        "status" => $httpcode,
        "response" => json_decode($response, true),
        "cv_download" => $cvUrl
    ]);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <!-- AJAX Script -->
    <!-- <script>
    $('#lead-form').on('submit', function (e) {
        e.preventDefault();

        const data = {
            fields: {
                name: $('#name').val(),
                phone: $('#phone').val(),
                email: $('#email').val(),
                location: $('#location').val()
            },
            actions: [{
                type: "SYSTEM_NOTE",
                text: "Lead Source: Mortgage Form"
            }]
        };

        $.ajax({
            url: 'https://api.telecrm.in/enterprise/685c0a8b9846bf4716e3dc4f/autoupdatelead',
            type: 'POST',
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer 6fd6c60c-fb6b-44e1-9159-c4e5537eafb91752571733690:3f3226a7-0e87-4f93-a196-c92450fd3436'
            },
            data: JSON.stringify(data),
            success: function (response) {
                alert('Form submitted successfully!');
                // Redirect to thank you page after successful submission
                window.location.href = 'thankyou.php';
                // $('#lead-form')[0].reset();
            },
            error: function (xhr, status, error) {
                console.error("Status:", status);
                console.error("Error:", error);
                console.error("Response:", xhr.responseText);
                alert('Submission failed. Check console for error.');
            }
        });
    });
</script> -->


    <!-- AJAX Script -->
    <!-- <script>
    $('#lead-form-footer').on('submit', function (e) {
        e.preventDefault();

        const data = {
            fields: {
                name: $('#nameone').val(),
                phone: $('#phoneone').val(),
                email: $('#emailone').val(),
                location: $('#locationone').val()
            },
            actions: [{
                type: "SYSTEM_NOTE",
                text: "Lead Source: Mortgage Form"
            }]
        };

        $.ajax({
            url: 'https://api.telecrm.in/enterprise/685c0a8b9846bf4716e3dc4f/autoupdatelead',
            type: 'POST',
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer 6fd6c60c-fb6b-44e1-9159-c4e5537eafb91752571733690:3f3226a7-0e87-4f93-a196-c92450fd3436'
            },
            data: JSON.stringify(data),
            success: function (response) {
                alert('Form submitted successfully!');
                window.location.href = 'thankyou.php';
                // $('#lead-form-footer')[0].reset();
            },
            error: function (xhr, status, error) {
                console.error("Status:", status);
                console.error("Error:", error);
                console.error("Response:", xhr.responseText);
                alert('Submission failed. Check console for error.');
            }
        });
    });
</script> -->


    <!-- --- houzzhunt Form Lead Using AJAX -- -->

    <script>
        $('#leadForm').on('submit', function(e) {
            e.preventDefault();

            const formData = {
                fields: {
                    name: $('input[name="name"]').val(),
                    mobile: $('input[name="phone"]').val(),
                    email: $('input[name="email"]').val(),
                    custom_country: $('input[name="country"]').val()
                },

                actions: [{
                    type: "SYSTEM_NOTE",
                    text: "Lead Source: houzzhunt Form"
                }]


            };

            $.ajax({
                url: 'https://api.telecrm.in/enterprise/685c0a8b9846bf4716e3dc4f/autoupdatelead',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(formData),
                headers: {
                    'Authorization': 'Bearer 6fd6c60c-fb6b-44e1-9159-c4e5537eafb91752571733690:3f3226a7-0e87-4f93-a196-c92450fd3436'
                },
                success: function(response) {
                    alert("Your data has been submitted successfully!");
                    $('#leadForm')[0].reset();
                    window.location.href = "thankyou.php";
                },
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText || error);
                    alert("There was an error submitting your data. Please check input fields and try again.");
                }
            });
        });
    </script>

    <!-- --- houzzhunt Popup Form Lead Using AJAX -- -->

    <script>
        $('#leadFormone').on('submit', function(e) {
            e.preventDefault();

            const formData = {
                fields: {
                    name: $('#nameone').val(),
                    phone: $('#phoneone').val(),
                    email: $('#emailone').val(),
                    location: $('#Popupcountry').val()
                },
                actions: [{
                    type: "SYSTEM_NOTE",
                    text: "Lead Source: Mortgage Form"
                }]
            };

            $.ajax({
                url: 'https://api.telecrm.in/enterprise/685c0a8b9846bf4716e3dc4f/autoupdatelead',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(formData),
                headers: {
                    'Authorization': 'Bearer 6fd6c60c-fb6b-44e1-9159-c4e5537eafb91752571733690:3f3226a7-0e87-4f93-a196-c92450fd3436'
                },
                success: function(response) {
                    alert("Your data has been submitted successfully!");
                    $('#leadFormone')[0].reset();
                    window.location.href = "thankyou.php";
                },
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText || error);
                    alert("There was an error submitting your data. Please check input fields and try again.");
                }
            });
        });
    </script>

    <script src="assets/vendors/jquery/jquery-3.7.1.min.js"></script>

    <script>
        $(function() {
            // Dummy payload just for testing
            let payload = {
                name: "Test User",
                email: "test@example.com",
                country: "India",
                phone: "9999999999"
            };

            $.ajax({
                url: "https://api.telecrm.in/enterprise/685c0a8b9846bf4716e3dc4f/autoupdatelead",
                method: "POST",
                headers: {
                    "Authorization": "Bearer 6fd6c60c-fb6b-44e1-9159-c4e5537eafb91752571733690:3f3226a7-0e87-4f93-a196-c92450fd3436",
                    "Content-Type": "application/json"
                },
                data: JSON.stringify(payload),
                success: function(res) {
                    console.log("✅ API Connected! Response:", res);
                    alert("API call successful! Check console for details.");
                },
                error: function(xhr) {
                    console.error("❌ API Error:", xhr.responseText);
                    alert("API call failed! Check console for details.");
                }
            });
        });
    </script>




    <script>
        $(document).ready(function() {
            $('#leadFormone').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "career-submit",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log("Server Response:", response);
                        alert("Form submitted successfully! CV uploaded.");
                        window.location.href = "thankyou.php";
                    },
                    error: function(xhr) {
                        console.error("Error:", xhr.responseText);
                        alert("Submission failed!");
                    }
                });
            });
        });
    </script>

    <!-- Career Form -->
    <div class="popup-overlay" id="popupFormCareer">
        <div class="popup-content">
            <div class="popup-image popup-image1"></div>
            <div class="popup-form">
                <div class="popup-close" onclick="closePopup1()">×</div>
                <h4 class="heading-title"><span>Submit your CV</span></h4>

                <form method="POST" id="leadFormone" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Enter Name</label>
                        <input type="text" name="name" id="nameone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" id="mobile" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input type="email" name="email" id="emailone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" id="city" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Attach CV</label>
                        <input type="file" name="cv" id="cv" class="form-control" accept=".pdf,.doc,.docx" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="gradient-btn btn-green-glossy w-100 mt-3 text-center">
                            Submit Enquiry
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>











</body>

</html>