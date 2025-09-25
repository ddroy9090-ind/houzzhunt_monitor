<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Digital Business Card</title>
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap');

        @font-face {
            font-family: 'MyCustomFont';
            src: url('assets/font/Aurora.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: "IBM Plex Sans", sans-serif;
            background: #fff;
            overflow-x: hidden;
        }

        body {
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
        }

        a[href^="tel"],
        a[href^="mailto"] {
            text-decoration: none !important;
            color: inherit !important;
        }

        .cbre-card {
            background: #ffffff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            min-height: 100dvh;
        }

        .cbre-banner {
            background: url('assets/business-card/contact-banner.png') no-repeat center center / cover;
            height: 150px;
            position: relative;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid #fff;
            position: absolute;
            bottom: -40px;
            left: 1rem;
            background-color: #fff;
            object-fit: cover;
        }

        .card-body {
            flex-grow: 1;
            padding: 3rem 1rem 2rem;
        }

        .card-body h5 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 0;
            font-family: 'MyCustomFont';
            color: #004a44;
        }

        p.designation-title {
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 30px;
            color: #7a7a7a;
        }

        .contact-info p {
            margin-bottom: 5px;
        }

        .contact-info p a {
            font-size: 18px;
            color: #111;
        }

        .contact-info p a img {
            width: 18px;
            vertical-align: middle;
            margin-right: 6px;
        }

        .whatsapp-icon {
            width: 24px;
            filter: invert(1);
            vertical-align: middle;
            margin-right: 6px;
        }

        .btn-row {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-primary-custom {
            background-color: #fff;
            color: #111;
            border: 1px #9e9e9e solid;
            padding: 10px 0;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            display: inline-block;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary-custom img {
            width: 18px;
            margin-right: 6px;
            vertical-align: middle;
        }

        .btn-primary-custom:hover {
            color: #111;
        }

        ul.social-links {
            display: flex;
            gap: 20px;
            list-style: none;
            margin: 15px 0;
            padding: 0;
        }

        ul.social-links li:first-child {
            margin-left: 0;
            padding-left: 0;
            gap: 0;
        }

        ul.social-links li a {
            display: inline-block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            position: relative;
        }

        ul.social-links li a img {
            width: 30px;
            position: absolute;
            top: 10px;
            left: 0px;
        }

        .link-part h3 {
            margin: 16px 0;
            font-size: 20px;
        }

        .link-part button img {
            width: 18px;
            margin-right: 6px;
            vertical-align: middle;
        }

        .link-part button.btn.btn-light,
        .link-part button.btn.btn-success {
            width: 100%;
            padding: 10px 12px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            margin: 5px 0;
            box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em,
                rgba(90, 125, 188, 0.05) 0px 0.25em 1em;
        }

        .link-part button.btn.btn-light {
            background-color: #fff;
            color: #111;
            border: 1px #9e9e9e solid;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .link-part button.btn.btn-success {
            background-color: #ecbb69;
            color: #111;
            border: none;
        }
    </style>


</head>

<body>

    <?php
    $users = [

        "vivek" => [
            "name" => "Vivek Seth",
            "title" => "Co-Founder",
            "phone" => "+91 7011094329",
            "email" => "vivek@houzzhunt.com",
            "img" => "assets/business-card/vivek.png",
            "phoneIcon" => "assets/flaticons/phone.png",
            "emailIcon" => "assets/flaticons/email.png",
            "vcard" => [
                "N" => "Seth;Vivek;;;",
                "FN" => "Vivek Seth",
                "ORG" => "Houzz Hunt",
                "TITLE" => "Co-Founder",
                "TEL;TYPE=WORK" => "+91 0124 4076182",
                "TEL;TYPE=CELL" => "+971 504013243",
                "EMAIL;TYPE=WORK" => "vivek@houzzhunt.com",
                "URL" => "www.houzzhunt.com"
            ]
        ],

        "abhinav" => [
            "name" => "Abhinav Sharma",
            "title" => "Founder",
            "phone" => "+971 529022965",
            "email" => "abhinav@houzzhunt.com",
            "img" => "assets/business-card/abhinav.png",
            "phoneIcon" => "assets/flaticons/phone.png",
            "emailIcon" => "assets/flaticons/email.png",
            "vcard" => [
                "N" => "Sharma;Abhinav;;;",
                "FN" => "Abhinav Sharma",
                "ORG" => "Houzz Hunt",
                "TITLE" => "Founder",
                "TEL;TYPE=CELL" => "+971 42554683",
                "TEL;TYPE=WORK" => "+971 529022965",
                "EMAIL;TYPE=WORK" => "abhinav@houzzhunt.com",
                "URL" => "www.houzzhunt.com | www.reliantconsultancy.com"
            ]
        ],


        "amrita" => [
            "name" => "Amrita Chandhok",
            "title" => "Chief Executive Officer",
            "phone" => "+971 553399792",
            "email" => "amrita@houzzhunt.com",
            "img" => "assets/business-card/amrita.webp",
            "phoneIcon" => "assets/flaticons/phone.png",
            "emailIcon" => "assets/flaticons/email.png",
            "vcard" => [
                "N" => "Chandhok;Amrita;;;",
                "FN" => "Amrita Chandhok",
                "ORG" => "Houzz Hunt",
                "TITLE" => "Chief Executive Officer",
                "TEL;TYPE=CELL" => "+971 553399792",
                "TEL;TYPE=WORK" => "+971 545050792",
                "EMAIL;TYPE=WORK" => "amrita@houzzhunt.com",
                "URL" => "www.houzzhunt.com"
            ]
        ],
        
         "kapilarora" => [
            "name" => "Kapil Arora",
            "title" => "Property Consultant | Social Media Manager",
            "phone" => "+971 501888765",
            "email" => "kapil.arora@houzzhunt.com",
            "img" => "assets/business-card/HH-logo.png",
            "phoneIcon" => "assets/flaticons/phone.png",
            "emailIcon" => "assets/flaticons/email.png",
            "vcard" => [
                "N" => "Arora;Kapil;;;",
                "FN" => "Kapil Arora",
                "ORG" => "Houzz Hunt",
                "TITLE" => "Property Consultant | Social Media Manager",
                "TEL;TYPE=CELL" => "+971 501888765",
                "TEL;TYPE=WORK" => "+971 42554683",
                "EMAIL;TYPE=WORK" => "kapil.arora@houzzhunt.com",
                "URL" => "www.houzzhunt.com"
            ]
        ],
        
        
        "kapilpuniani" => [
        "name" => "Kapil Puniani",
        "title" => "Director - Investment and Advisory",
        "phone" => "+971 505489831",
        "email" => "kapil.puniani@houzzhunt.com",
        "img" => "assets/business-card/Kapil-Puniani.png",
        "phoneIcon" => "assets/flaticons/phone.png",
        "emailIcon" => "assets/flaticons/email.png",
        "vcard" => [
            "N" => "Puniani;Kapil;;;",
            "FN" => "Kapil Puniani",
            "ORG" => "Houzz Hunt",
            "TITLE" => "Director - Investment and Advisory",
            "TEL;TYPE=WORK,VOICE" => "+971 4 255 4683",
            "TEL;TYPE=CELL;PREF=1" => "+971 505489831",
            "TEL;TYPE=CELL" => "+91 9313613838",
            "EMAIL;TYPE=WORK" => "kapil.puniani@houzzhunt.com",
            "URL" => "www.houzzhunt.com"
        ]
        ],

        // "robin" => [
        //     "name" => "Robin Teh",
        //     "title" => "Managing Director",
        //     "phone" => "+971 501888765",
        //     "email" => "robin@houzzhunt.com",
        //     "img" => "assets/business-card/Robin-Sir.png",
        //     "phoneIcon" => "assets/flaticons/phone.png",
        //     "emailIcon" => "assets/flaticons/email.png",
        //     "vcard" => [
        //         "N" => "Teh;Robin;;;",
        //         "FN" => "Robin Teh",
        //         "ORG" => "Houzz Hunt",
        //         "TITLE" => "Managing Director",
        //         "TEL;TYPE=CELL" => "+971 501888765",
        //         "TEL;TYPE=WORK" => "+971 501888765",
        //         "EMAIL;TYPE=WORK" => "robin@houzzhunt.com",
        //         "URL" => "www.houzzhunt.com"
        //     ]
        // ],


        "janshir" => [
            "name" => "Mohammed Janshir",
            "title" => "Director | Investment & Cansultancy",
            "phone" => "+971 566873097",
            "email" => "janshir@houzzhunt.com",
            "img" => "assets/business-card/jasnier.png",
            "phoneIcon" => "assets/flaticons/phone.png",
            "emailIcon" => "assets/flaticons/email.png",
            "vcard" => [
                "N" => "Janshir;Mohammed;;;",
                "FN" => "Mohammed Janshir",
                "ORG" => "Houzz Hunt",
                "TITLE" => "Director | Investment & Consultancy",
                "TEL;TYPE=WORK" => "+971 42554683",
                "TEL;TYPE=CELL" => "+971 566873097",
                "EMAIL;TYPE=WORK" => "janshir@houzzhunt.com",
                "URL" => "www.houzzhunt.com"
            ]
        ],

        "waqas" => [
            "name" => "Waqas Khadim",
            "title" => "Property Consultant",
            "phone" => "+971 502930358",
            "email" => "waqas@houzzhunt.com",
            "img" => "assets/business-card/waqas.png",
            "phoneIcon" => "assets/flaticons/phone.png",
            "emailIcon" => "assets/flaticons/email.png",
            "vcard" => [
                "N" => "Khadim;Waqas;;;",
                "FN" => "Waqas Khadim",
                "ORG" => "Houzz Hunt",
                "TITLE" => "Property Consultant",
                "TEL;TYPE=WORK" => "+971 42554683",
                "TEL;TYPE=CELL" => "+971 502930358",
                "EMAIL;TYPE=WORK" => "waqas@houzzhunt.com",
                "URL" => "www.houzzhunt.com"
            ]
        ],

        "rishabh" => [
            "name" => "Rishabh Saxena",
            "title" => "Head of Sales",
            "phone" => "+971 503115474",
            "email" => "rishabh@houzzhunt.com",
            "img" => "assets/business-card/HH-logo.png",
            "phoneIcon" => "assets/flaticons/phone.png",
            "emailIcon" => "assets/flaticons/email.png",
            "vcard" => [
                "N" => "Saxena;Rishabh;;;",
                "FN" => "Rishabh Saxena",
                "ORG" => "Houzz Hunt",
                "TITLE" => "Head of Sales Investments & Consulatncy",
                "TEL;TYPE=WORK" => "+971 42554683",
                "TEL;TYPE=CELL" => "+971 503115474",
                "EMAIL;TYPE=WORK" => "rishabh@houzzhunt.com",
                "URL" => "www.houzzhunt.com"
            ]
        ],

        "kaouther" => [
            "name" => "Kaouther Boucherit",
            "title" => "Business Development Executive",
            "phone" => "+971 503703489",
            "email" => "kaouther@houzzhunt.com",
            "img" => "assets/business-card/kaouther.webp",
            "phoneIcon" => "assets/flaticons/phone.png",
            "emailIcon" => "assets/flaticons/email.png",
            "vcard" => [
                "N" => "Boucherit;Kaouther;;;",
                "FN" => "Kaouther Boucherit",
                "ORG" => "Houzz Hunt",
                "TITLE" => "Business Development Executive",
                "TEL;TYPE=WORK" => "+971 42554683",
                "TEL;TYPE=CELL" => "+971 503703489",
                "EMAIL;TYPE=WORK" => "kaouther@houzzhunt.com",
                "URL" => "www.houzzhunt.com"
            ]
        ],




    ];
    $username = $_GET['user'] ?? '';
    $profile = $users[$username] ?? null;
    if (!$profile) {
        echo "<div style='text-align:center;padding:50px;'>Profile not found.</div>";
        exit;
    }
    // Format the phone for WhatsApp (digits only)
    $whatsappPhone = preg_replace('/[^0-9]/', '', $profile['phone']);
    ?>

    <div class="cbre-card">
        <div class="cbre-banner">
            <img src="<?= htmlspecialchars($profile['img']) ?>" class="profile-img"
                alt="<?= htmlspecialchars($profile['name']) ?>">
        </div>
        <div class="card-body text-start">
            <h5><?= htmlspecialchars($profile['name']) ?></h5>
            <p class="designation-title">
                <?= htmlspecialchars($profile['title']) ?>
            </p>
            <div class="contact-info">
                <p>
                    <a href="tel:<?= htmlspecialchars($profile['phone']) ?>"
                        style="text-decoration: none; color: inherit;">
                        <img src="<?= htmlspecialchars($profile['phoneIcon']) ?>" alt="Phone Icon"
                            style="width:16px; vertical-align:middle; margin-right:6px;">
                        <?= htmlspecialchars($profile['phone']) ?>
                    </a>
                </p>
                <p>
                    <a href="mailto:<?= htmlspecialchars($profile['email']) ?>"
                        style="text-decoration: none; color: inherit;">
                        <img src="<?= htmlspecialchars($profile['emailIcon']) ?>" alt="Email Icon"
                            style="width:16px; vertical-align:middle; margin-right:6px;">
                        <?= htmlspecialchars($profile['email']) ?>
                    </a>
                </p>
            </div>


            <ul class="social-links">
                <li><a href="https://www.instagram.com/houzzhunt/?hl=en"> <img src="assets/flaticons/instagram.png" alt="Instagram"></a></li>
                <li><a href="https://www.linkedin.com/company/houzz-hunt/"> <img src="assets/flaticons/linkedin.png" alt="LinkedIn"></a></li>
                <li><a href="https://www.facebook.com/people/Houzz-Hunt/61574436629351/"> <img src="assets/flaticons/facebook.png" alt="Facebook"></a></li>
                <li><a href="https://www.youtube.com/@HouzzHunt"> <img src="assets/flaticons/youtube.png" alt="YouTube"></a></li>
                <li><a href="https://x.com/HouzzHunt"> <img src="assets/flaticons/twitter.png" alt="Twitter"></a></li>
            </ul>

            <div class="btn-row mt-3">
                <a target="_blank" href="https://houzzhunt.com/" class="btn-primary-custom"><img
                        src="assets/business-card/website.png" alt="">Visit Our Website</a>
            </div>
            <div class="link-part">
                <h3>Quick Actions</h3>
                <button class="btn btn-light"
                    onclick="window.open('https://maps.app.goo.gl/9CgsyMa4RBQpJGe96', '_blank')">
                    <img src="assets/business-card/location.png" alt="Location Icon"
                        style="width:16px; vertical-align:middle; margin-right:6px;">
                    Visit our office
                </button>

                <button style="background-color: #014d47; color: #fff;" class="btn btn-success"
                    onclick="window.open('https://wa.me/<?= $whatsappPhone ?>', '_blank')"><img
                        src="assets/business-card/whatsapp.png" alt="" class="whatsapp-icon"> Whatsapp</button>
                <button class="btn btn-success" onclick="downloadVCF()">Add to contacts</button>
            </div>

        </div>
    </div>


    <script>
        function downloadVCF() {
            const v = <?= json_encode($profile['vcard'], JSON_UNESCAPED_SLASHES) ?>;
            const data = [
                "BEGIN:VCARD", "VERSION:3.0",
                "N:" + v.N,
                "FN:" + v.FN,
                "ORG:" + v.ORG,
                "TITLE:" + v.TITLE,
                "TEL;TYPE=CELL:" + v["TEL;TYPE=CELL"],
                "TEL;TYPE=WORK:" + v["TEL;TYPE=WORK"],
                "EMAIL;TYPE=WORK:" + v["EMAIL;TYPE=WORK"],
                "URL:" + v.URL,
                "END:VCARD"
            ].join("\n");
            const blob = new Blob([data], {
                type: 'text/vcard'
            });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = v.FN.replace(/\s+/g, '_') + ".vcf";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>


</body>

</html>