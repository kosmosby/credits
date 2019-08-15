jQuery( document ).ready(function() {

    jQuery( "#estimate" ).on( "click", function() {

        var id = jQuery('#requesthr-form').find('#jform_id').val();
        var type_id = jQuery('#requesthr-form').find('#jform_type_id').val();
        var jform_employee_id = jQuery('#requesthr-form').find('#jform_employee_id').val();

        var jform_typeemployee_id = jQuery('#requesthr-form').find('#jform_typeemployee_id').val();
        var jform_level_id = jQuery('#requesthr-form').find('#jform_level_id').val();

        var jform_count = jQuery('#requesthr-form').find('#jform_count').val();
        var start_date = jQuery('#requesthr-form').find('#jform_start_date').val();

        jQuery.post( "index.php?option=com_recruit&task=requesthr.estimate&type="+type_id+"&jform_employee_id="+jform_employee_id+"&jform_typeemployee_id="+jform_typeemployee_id+"&jform_count="+jform_count+"&jform_start_date="+start_date+"&jform_id="+id+"&jform_level_id="+jform_level_id , function(response) {

            console.log('responce: ', response);

            var response = JSON.parse(response)

            console.log(response.public_date);
            console.log(response.estimate_date);
            jQuery('#estimate_div').html("дата открытия: "+response.public_date+"<br />дата закрытия: "+response.estimate_date);
            return false;
        });
        return false;
    });


     var view = jQuery('#view').html();

     switch (view) {
         case 'requesthr':
            jQuery('#jform_type_id').val(1);
            //jQuery('#jform_type_id').prop( "disabled", true );
         break;
         case 'requestvr':
             jQuery('#jform_type_id').val(2);
             //jQuery('#jform_type_id').prop( "disabled", true );
         break;
         default:
     }
});