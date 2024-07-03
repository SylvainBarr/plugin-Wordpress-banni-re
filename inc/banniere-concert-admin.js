(function($){
    
    $(document).ready(function() {

        $('.bc-color-picker').wpColorPicker();
        
        const picker = datepicker('.date-picker-input', {
            dateSelected: new Date(settings.concertDate),
            startDay: 1,
            customDays: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
            customMonths: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        })

   });





})(jQuery)