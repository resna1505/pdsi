/*
Template Name: PDSI - Admin & Dashboard Template
Author: ICT PDSI
Website: https://ICT PDSI.com/
Contact: ICT PDSI@gmail.comom
File: Coming soon Init Js File
*/
document.addEventListener('DOMContentLoaded', function () {
    var mainArray = Array.from(document.querySelectorAll(".countdownlist"))
    mainArray.forEach(function (item) {
        var countdownVal = item.getAttribute("data-countdown")

        // Set the date we're counting down to
        var countDownDate = new Date(countdownVal).getTime();

        // Update the count down every 1 second
        var countDown = setInterval(function () {
            // Get today's date and time
            var currentTime = new Date().getTime();
            // Find the distance between currentTime and the count down date
            var distance = countDownDate - currentTime;


            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            var countDownBlock = '<div class="countdownlist-item">' +
                '<div class="count-title">Days</div>' + '<div class="count-num">' + days + '</div>' +
                '</div>' +
                '<div class="countdownlist-item">' +
                '<div class="count-title">Hours</div>' + '<div class="count-num">' + hours + '</div>' +
                '</div>' +
                '<div class="countdownlist-item">' +
                '<div class="count-title">Minutes</div>' + '<div class="count-num">' + minutes + '</div>' +
                '</div>' +
                '<div class="countdownlist-item">' +
                '<div class="count-title">Seconds</div>' + '<div class="count-num">' + seconds + '</div>' +
                '</div>';

            // Output the result in an element with id="countDownBlock"
            if (item) {
                item.innerHTML = countDownBlock;
            }
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(countDown);
                item.innerHTML = '<div class="countdown-endtxt">The countdown has ended!</div>';
            }
        }, 1000);
    })
});