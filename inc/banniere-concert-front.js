(function($){
    
    $(document).ready(function() {
        // console.log(settings);
        
        $('#banniere-concert').css('display', ((settings.isDisplayed == 'oui')?'block':'none'));
        $('#banniere-concert').css('background-color', settings.bannerColor);

   });


})(jQuery)