<div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_V2_SITE_KEY') }}"></div>
@if ($errors->has('g-recaptcha-response'))
    <span class="text-red-600 text-sm">Please verify yourself as human</span>
@endif

<span class="text-red-600 text-sm" id="recaptcha-error-block" ></span>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
<script>
    $('document').ready(function(){
        $('#recaptcha-form').submit(function(e){
            if(grecaptcha.getResponse() == "") {
                e.preventDefault();
                $('#recaptcha-error-block').text('Please verify yourself as human');
            }
        });
    });
</script>