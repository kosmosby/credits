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


     var isSuperUser = jQuery('#isSuperUser').html();

     if(!isSuperUser) {
        jQuery('.superuser').parents('.control-group').hide();
     }

    jQuery(".interpreter_type").on('change', function(ret) {
        var int_type = ret.target.value;

        showAdditionForm(int_type);
    });

    var interpreter_type_val = jQuery("#jform_interpreter_type").val();

    //alert(interpreter_type_val);

    showAdditionForm(interpreter_type_val);





});

function showAdditionForm(int_type) {

    jQuery(".container1").html('');

    var id = jQuery("#jform_id").val();

    switch (int_type) {
        case '0':
            jQuery.post( "index.php?option=com_recruit&task=requestvr.loadform&form=translatorwritten&id="+id, function(response) {
                jQuery(".container1").html(response);

            });
            break;
        case '1':
            jQuery.post( "index.php?option=com_recruit&task=requestvr.loadform&form=translatorspoken&id="+id, function(response) {
                jQuery(".container1").html(response);

            });
            break;
        case '2':
            jQuery.post( "index.php?option=com_recruit&task=requestvr.loadform&form=translatorslice&id="+id, function(response) {
                jQuery(".container1").html(response);

            });
            break;
        default:
    }
}