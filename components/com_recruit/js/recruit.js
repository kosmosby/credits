jQuery( document ).ready(function() {

    jQuery( "#estimate" ).on( "click", function() {

        var type_id = jQuery('#requesthr-form').find('#jform_type_id').val();
        var jform_employee_id = jQuery('#requesthr-form').find('#jform_employee_id').val();
        var jform_typeemployee_id = jQuery('#requesthr-form').find('#jform_typeemployee_id').val();
        var jform_count = jQuery('#requesthr-form').find('#jform_count').val();

        jQuery.post( "index.php?option=com_recruit&task=requesthr.estimate&type="+type_id+"&jform_employee_id="+jform_employee_id+"&jform_typeemployee_id="+jform_typeemployee_id+"&jform_count="+jform_count , function(response) {
            jQuery('#estimate_div').html(response);
            return false;
        });
        return false;
    });
});