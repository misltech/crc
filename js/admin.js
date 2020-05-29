/***
 * This sends data about the workflow order to the api. We couldnt get the order from php so we used javscript.
 * 
 */


$(document).ready(function () {

    var newworkflow = [];
    $("#submit-workflow").click(function() {
      $("#sortableright > div").each(function(){
        newworkflow.push($(this).text().toLowerCase());
        
      });
      console.log(newworkflow);
      $.ajax({
        headers: {
            'token': $('meta[name="token"]').attr('content'),
            'setWorkflow': newworkflow.toString(),
            'department': new URL(window.location.href).searchParams.get("department")
        },
        url: "../api/setworkflow_api"
    }).done(function (result) {
        if(result.status == 'success'){
          window.location.href = window.location.href + "&success=true&workflow=true";
          //location.reload();
        }
    });

      });

    $("#submit-assign").click(function(){
        
    })
   


});