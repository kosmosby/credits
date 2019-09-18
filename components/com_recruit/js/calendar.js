
jQuery( document ).ready(function() {

    var todays_date = jQuery('#todays_date').html();
    console.log('todays_date =', todays_date);

    var div_for_current_date = jQuery('#'+todays_date);
    var offset = div_for_current_date.offset();

    console.log('offset =', offset.left);

   jQuery('#main_calendar_container').scrollLeft(offset.left - 1120);

    //console.log('todays_date =', offset);

});