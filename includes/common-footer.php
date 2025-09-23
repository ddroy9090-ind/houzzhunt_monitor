<!-- top to bottom start  -->
<div class="prgoress_indicator">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
            style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 28.2787;">
        </path>
    </svg>
</div>
<!-- top to bottom end  -->

<script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendors/jquery/jquery-3.7.1.min.js"></script>
<script src="assets/vendors/slick/slick.min.js"></script>
<script src="assets/vendors/wow/wow.js"></script>
<script src="assets/vendors/youtube-popup/youtube-popup.jquery.js"></script>
<script src="assets/js/custom.js"></script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/js/countrySelect.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const megaToggle = document.getElementById('megaMenu');
        const megaMenu = document.querySelector('.mega-menu');

        if (megaToggle && megaMenu) {
            megaToggle.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = this.closest('.dropdown');
                parent.classList.toggle('show');
                megaMenu.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (!megaToggle.contains(e.target) && !megaMenu.contains(e.target)) {
                    megaMenu.classList.remove('show');
                    megaToggle.closest('.dropdown').classList.remove('show');
                }
            });
        }
    });
</script>


<script>
    function openPopup() {
        document.getElementById("popupForm").classList.add("show");
        document.body.classList.add("no-scroll");
    }

    function closePopup() {
        document.getElementById("popupForm").classList.remove("show");
        document.body.classList.remove("no-scroll");
    }

    // Optional: Auto open after delay
    // window.addEventListener("load", function () {
    //   setTimeout(function () {
    //     openPopup();
    //   }, 3000);
    // });
</script>



<script>
    function openPopup1() {
        document.getElementById("popupFormCareer").classList.add("show");
        document.body.classList.add("no-scroll");
    }

    function closePopup1() {
        document.getElementById("popupFormCareer").classList.remove("show");
        document.body.classList.remove("no-scroll");
    }

    // Optional: Auto open after delay
    // window.addEventListener("load", function () {
    //   setTimeout(function () {
    //     openPopup();
    //   }, 3000);
    // });
</script>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        const counters = document.querySelectorAll(".counter-number");

        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute("data-count");
                const count = +counter.innerText;
                const speed = 30;

                const inc = Math.ceil(target / speed);

                if (count < target) {
                    counter.innerText = count + inc;
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target + (counter.dataset.count.endsWith('%') ? '%' : '+');
                }
            };

            updateCount();
        });
    });
</script>


<script>
    const tabBtns = document.querySelectorAll(".tab-btn");
    const tabContents = document.querySelectorAll(".tab-content");

    tabBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const target = btn.getAttribute("data-tab");

            tabBtns.forEach(b => b.classList.remove("active"));
            tabContents.forEach(tc => tc.classList.remove("active"));

            btn.classList.add("active");
            document.getElementById(target).classList.add("active");
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#callBtn').on('click', function() {
            const $popup = $('#callPopup');
            if ($popup.hasClass('show')) {
                $popup.removeClass('show');
                setTimeout(function() {
                    $popup.hide();
                }, 300);
            } else {
                $popup.show();
                setTimeout(function() {
                    $popup.addClass('show');
                }, 10);
            }
        });

        $('#closePopup').on('click', function() {
            $('#callPopup').removeClass('show');
            setTimeout(function() {
                $('#callPopup').hide();
            }, 300);
        });
    });



    $(document).ready(function() {
        function checkFormFields() {
            const name = $('#callPopup input[type="text"]').eq(0).val().trim();
            const phone = $('#callPopup input[type="text"]').eq(1).val().trim();

            if (name !== '' && phone !== '') {
                $('#callPopup button:contains("Call me!")').removeAttr('disabled');
            } else {
                $('#callPopup button:contains("Call me!")').attr('disabled', 'disabled');
            }
        }

        $('#callPopup input[type="text"]').on('input', checkFormFields);
    });



    // Show popup after 3 seconds

    // setTimeout(function () {
    //     const $popup = $('#callPopup');
    //     $popup.show();
    //     setTimeout(function () {
    //         $popup.addClass('show');
    //     }, 10);
    // }, 3000);
</script>




<!-- ------ Mobile Menu DropDowns ------ -->
<script>
    let navbar = document.querySelector(".navbar");
    let navLinks = document.querySelector(".nav-links");
    let menuOpenBtn = document.querySelector(".navbar .bx-menu");
    let menuCloseBtn = document.querySelector(".nav-links .bx-x");

    menuOpenBtn.onclick = function() {
        navLinks.style.left = "0";
    }

    menuCloseBtn.onclick = function() {
        navLinks.style.left = "-100%";
    }

    // Handle dropdown toggle (mobile only)
    const arrows = document.querySelectorAll(".arrow");

    arrows.forEach(arrow => {
        arrow.addEventListener("click", function() {
            const targetId = this.getAttribute("data-target");
            const targetMenu = document.getElementById(targetId);

            // Close all dropdowns
            document.querySelectorAll(".sub-menu").forEach(menu => {
                if (menu !== targetMenu) {
                    menu.style.display = "none";
                }
            });

            // Toggle clicked dropdown
            if (targetMenu.style.display === "block") {
                targetMenu.style.display = "none";
            } else {
                targetMenu.style.display = "block";
            }

            // Reset arrow rotations
            arrows.forEach(a => a.style.transform = "rotate(0deg)");
            // Rotate current arrow
            if (targetMenu.style.display === "block") {
                this.style.transform = "rotate(180deg)";
            }
        });
    });
</script>


<script>
    const swiper = new Swiper('.noctisSwiper', {
        slidesPerView: 4,
        spaceBetween: 20,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            0: {
                slidesPerView: 1.2,
                spaceBetween: 15,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 20,
            }
        }
    });
</script>

<script>
  var swiper1 = new Swiper(".hh-review-slider", {
    slidesPerView: 3,
    spaceBetween: 30,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 30,
      }
    }
  });
</script>



<script>
    $(document).ready(function() {
        $("#country1").countrySelect({
            defaultCountry: "ae"
        });
    });
</script>


<script>
    $(document).ready(function() {
        $("#country").countrySelect({
            defaultCountry: "ae"
        });
    });
</script>


<script>
    document.body.classList.add('loading');

    window.addEventListener('load', function() {
        setTimeout(function() {
            var preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            preloader.style.transition = 'opacity 0.5s ease';

            setTimeout(function() {
                preloader.style.display = 'none';
                document.body.classList.remove('loading');
            }, 500);
        }, 2000);
    });
</script>



<script>
    $(document).ready(function() {
        $('.team-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: false,
            arrows: true,
            prevArrow: $('.custom-prev'),
            nextArrow: $('.custom-next'),
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 1.3,
                    slidesToScroll: 1
                }
            }]
        });
    });
</script>

<script>
    $(document).ready(function() {
        const $slider = $('.video-slider');
        $slider.slick({
            slidesToShow: 2.5,
            slidesToScroll: 2,
            arrows: false,
            infinite: false,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1.3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1.3, // Show 1.5 slides on mobile
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('#prevBtn').click(function() {
            $slider.slick('slickPrev');
        });
        $('#nextBtn').click(function() {
            $slider.slick('slickNext');
        });

        $('.play-button').click(function() {
            let videoURL = $(this).data('video');
            $('#videoFrame').attr('src', videoURL + '?autoplay=1');
            $('#videoModal').modal('show');
        });

        $('#videoModal').on('hidden.bs.modal', function() {
            $('#videoFrame').attr('src', '');
        });
    });
</script>


<script>
    const megamenu = document.querySelector('.megamenu');
    const navbar1 = document.querySelector('.navbar-custom');

    megamenu.addEventListener('mouseenter', () => {
        navbar1.style.backgroundColor = '#004a44';
    });

    megamenu.addEventListener('mouseleave', () => {
        navbar1.style.backgroundColor = '';
    });
</script>


<script>
    const megamenu1 = document.querySelector('.megamenu1');
    const navbar2 = document.querySelector('.navbar-custom');

    megamenu1.addEventListener('mouseenter', () => {
        navbar2.style.backgroundColor = '#004a44';
    });

    megamenu1.addEventListener('mouseleave', () => {
        navbar2.style.backgroundColor = '';
    });
</script>

<!-- ----------AJAX FORM CRM DATA------- -->

<script>
    $(document).ready(function() {
        $(".appointment-form").on("submit", function(e) {
            e.preventDefault();

            // Form data collect
            const name = $('#name').val().trim();
            const phone = $('#phone').val().trim();
            const email = $('#email').val().trim();
            const country = $('#country').val().trim();

            // TeleCRM API payload
            const data = {
                fields: {
                    name: name,
                    phone: phone,
                    email: email,
                    country: country
                },
                actions: [{
                    type: "SYSTEM_NOTE",
                    text: "Lead Source: Popup Form"
                }]
            };

            $.ajax({
                url: "https://api.telecrm.in/enterprise/685c0a8b9846bf4716e3dc4f/autoupdatelead", // <-- yahan tumhari API endpoint hogi
                type: "POST",
                headers: {
                    "Authorization": "Bearer 6fd6c60c-fb6b-44e1-9159-c4e5537eafb91752571733690:3f3226a7-0e87-4f93-a196-c92450fd3436", // <-- apna API key yahan dalna
                    "Content-Type": "application/json"
                },
                data: JSON.stringify(data),
                success: function(response) {
                    console.log("TeleCRM Response:", response);
                    
                    // Show success alert first
                    alert("Your data has been submitted successfully!");

                    // Form reset
                    $(".appointment-form")[0].reset();

                    // Redirect to thankyou.php
                    window.location.href = "thankyou.php";
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    console.error("Raw Response:", xhr.responseText);
                    alert("Something went wrong while submitting the form. Please try again.");
                }
            });
        });
    });
</script>



<!-- -----Career Form------ -->

<script>
    $(document).ready(function() {
        $('#leadFormone').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "career-submit.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log("Server Response:", response);
                    alert("Form submitted successfully!");
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

</body>

</html>