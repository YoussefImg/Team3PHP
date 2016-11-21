/**
 * Created by Ludovic on 18-11-16.
 */
window.$ = window.jQuery = require('jquery');

$(document).ready(function() {
    var lastentry = "";


    $(".search-form input[name='Time']").keyup(function (e) {
        $this = $(this);

        if ($this.val() != lastentry) {

            var dateRegex = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
            if (!$this.val().match(dateRegex)) {
                $this.css('border-color', 'red');
                $(".search-form input[type='submit']").prop('disabled', true);
            } else {
                $this.css('border-color', '');
                $(".search-form input[type='submit']").prop('disabled', false);
            }
            console.log($this.css('border'));


        }
        lastentry = $this.val()
    });

});