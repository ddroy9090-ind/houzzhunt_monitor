<!-- Footer Section -->
<footer id="site-footer">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left: Copyright -->
            <div class="col-md-6">
                <p class="footer-copy">© 2025 houzzhunt. All rights reserved.</p>
            </div>

            <!-- Right: Social Icons -->
            <div class="col-md-6">
                <div class="footer-social">
                    <a href="https://www.facebook.com/people/Houzz-Hunt/61574436629351/" target="_blank" rel="noopener">
                        <img src="assets/icons/facebook.png" alt="Facebook" />
                    </a>
                    <a href="https://www.instagram.com/houzzhunt/?hl=en" target="_blank" rel="noopener">
                        <img src="assets/icons/instagram.png" alt="Instagram" />
                    </a>
                    <a href="https://www.linkedin.com/company/houzz-hunt/" target="_blank" rel="noopener">
                        <img src="assets/icons/linkedin.png" alt="LinkedIn" />
                    </a>
                    <a href="https://x.com/HouzzHunt" target="_blank" rel="noopener">
                        <img src="assets/icons/twitter.png" alt="X (Twitter)" />
                    </a>
                </div>
            </div>

        </div>
    </div>
</footer>

<!-- Bootstrap JS CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery CDN required for AJAX -->


<!-- SCRIPT -->
<script>
    // Refined algorithm with stable validation and tolerance rounding
    let residencyType = 'resident';
    let selectedRate = 3.99;

    const propertyValueInput = document.getElementById('propertyValue');
    const downPaymentInput = document.getElementById('downPayment');
    const loanDurationInput = document.getElementById('loanDuration');
    const interestInput = document.getElementById('interestRate');
    const durationLabel = document.getElementById('durationLabel');

    const rateOptions = [{
            label: '3 years fixed-rate',
            rate: 3.99
        },
        {
            label: '5 years fixed-rate',
            rate: 3.98
        },
        {
            label: 'Variable rate',
            rate: 5.51
        }
    ];

    const rateContainer = document.createElement('div');
    rateContainer.className = 'mt-4';
    rateContainer.innerHTML = '<label class="form-label">Select Rate Option</label>';

    const rateGroup = document.createElement('div');
    rateGroup.className = 'btn-group w-100';
    rateGroup.setAttribute('role', 'group');

    rateOptions.forEach((opt, i) => {
        const btn = document.createElement('button');
        btn.className = `btn btn-outline-dark${i === 0 ? ' active' : ''}`;
        btn.textContent = `${opt.label} (${opt.rate.toFixed(2)}%)`;
        btn.dataset.rate = opt.rate;
        btn.setAttribute('data-rate', opt.rate);
        btn.addEventListener('click', function() {
            document.querySelectorAll('[data-rate]').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            selectedRate = parseFloat(this.dataset.rate);
            interestInput.value = selectedRate;
            calculate();
        });
        rateGroup.appendChild(btn);
    });

    rateContainer.appendChild(rateGroup);
    document.querySelector('.mb-3:nth-child(6)').after(rateContainer);

    const residencyButtons = document.querySelectorAll('[data-type]');
    residencyButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            residencyButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            residencyType = this.getAttribute('data-type');
            calculate();
        });
    });

    [propertyValueInput, downPaymentInput, loanDurationInput, interestInput].forEach(el => el.addEventListener('input', calculate));

    function calculate() {
        const propertyValue = parseFloat(propertyValueInput.value) || 0;
        const downPayment = parseFloat(downPaymentInput.value) || 0;
        const duration = parseInt(loanDurationInput.value) || 0;
        const rate = parseFloat(interestInput.value) || 0;
        durationLabel.innerText = duration > 0 ? duration : '-';

        if (propertyValue <= 0 || downPayment <= 0 || duration <= 0 || rate <= 0) {
            return displayInvalid('Enter valid numeric inputs');
        }

        let minDP = residencyType === 'nonresident' ? 0.4 : 0.2;
        const requiredDP = propertyValue * minDP;
        if (downPayment + 1 < requiredDP) {
            return displayInvalid('Minimum Down Payment not met');
        }

        const loanAmount = propertyValue - downPayment;
        const monthlyRate = rate / 100 / 12;
        const months = duration * 12;

        if (loanAmount <= 0 || monthlyRate <= 0 || months <= 0) {
            return displayInvalid('Invalid Loan Structure');
        }

        const monthlyPayment = (loanAmount * monthlyRate) / (1 - Math.pow(1 + monthlyRate, -months));
        const totalInterest = (monthlyPayment * months) - loanAmount;

        document.getElementById('loanAmount').innerText = `AED ${loanAmount.toLocaleString()}`;
        document.getElementById('monthlyCost').innerText = `AED ${Math.round(monthlyPayment).toLocaleString()}`;
        document.getElementById('interestPaid').innerText = `AED ${Math.round(totalInterest).toLocaleString()}`;

        const dldFee = propertyValue * 0.04;
        const mrFee = propertyValue * 0.0025;
        const agencyFee = propertyValue * 0.02;
        const totalUpfront = downPayment + dldFee + 3000 + 4000 + mrFee + agencyFee;

        document.getElementById('upfrontDown').innerText = `AED ${downPayment.toLocaleString()}`;
        document.getElementById('upfrontDLD').innerText = `AED ${Math.round(dldFee).toLocaleString()}`;
        document.getElementById('upfrontMR').innerText = `AED ${Math.round(mrFee).toLocaleString()}`;
        document.getElementById('upfrontAgency').innerText = `AED ${Math.round(agencyFee).toLocaleString()}`;
        document.getElementById('totalUpfront').innerText = `AED ${Math.round(totalUpfront).toLocaleString()}`;
    }

    function displayInvalid(message = 'Invalid Input') {
        document.getElementById('loanAmount').innerText = message;
        document.getElementById('monthlyCost').innerText = '-';
        document.getElementById('interestPaid').innerText = '-';
        document.getElementById('upfrontDown').innerText = '-';
        document.getElementById('upfrontDLD').innerText = '-';
        document.getElementById('upfrontMR').innerText = '-';
        document.getElementById('upfrontAgency').innerText = '-';
        document.getElementById('totalUpfront').innerText = '-';
    }

    calculate();
</script>

<!-- AJAX Script -->
<script>
    $('#lead-form').on('submit', function(e) {
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
                'Authorization': 'Bearer f8bed041-8a2f-4b23-b69f-4e6a4bdedf321757412029364:d9f69aac-844a-4c91-abf2-c44d2bb6b50c'
            },
            data: JSON.stringify(data),
            success: function(response) {
                alert('Form submitted successfully!');
                window.location.href = 'thankyou.php';
                // $('#lead-form')[0].reset();
            },
            error: function(xhr, status, error) {
                console.error("Status:", status);
                console.error("Error:", error);
                console.error("Response:", xhr.responseText);
                alert('Submission failed. Check console for error.');
            }
        });
    });
</script>


<!-- AJAX Script -->
<script>
    $('#lead-form-footer').on('submit', function(e) {
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
            success: function(response) {
                alert('Form submitted successfully!');
                window.location.href = 'thankyou.php';
                // $('#lead-form-footer')[0].reset();
            },
            error: function(xhr, status, error) {
                console.error("Status:", status);
                console.error("Error:", error);
                console.error("Response:", xhr.responseText);
                alert('Submission failed. Check console for error.');
            }
        });
    });
</script>





</body>

</html>