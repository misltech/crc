$(document).ready(function () {


    $.ajax({
        headers: {
            'token': $('meta[name="csrf-token"]').attr('content'),
            'request': 'all'
        },
        url: "../api/student_appplication_api"
    }).done(function (result) {
        console.log(result);
        console.log(result.length);
        filter(result);
    });



    function filter(res) {
        if (res.length == 0) {
            $('.jumbotron').append("<div class='alert alert-dark text-center'>No applications currently assigned to you. Try again later.</div>");
        }
        if (res.length > 0) {

            for (let index = 0; index < res.length; index++) {
                const element = res[index];

                if(element[1].progress == -1){
                    htmlElement = '<div class="hvr-underline-reveal card border-light mb-3 w-100">';
                    htmlElement += '<div class="card-header">Internship</div><div class="card-body text-secondary">'
                    htmlElement += '<h6 class="card-text text-align-center"><span class="float-left">' + element[1].dept + " " + element[1].classnumber + '</span><span class="float-right">' + element[1].semester + ' ' + element[1].year + '</span></h6>';
                    htmlElement += '<div class="text-center"><a href="stu.php?fwid=' + element[1].fwid + '"';
                    htmlElement += 'class="mt-2 btn btn-primary text-center">Start Application</a></div></div></div>';
                    $('.apps').append(htmlElement);
                }
                else{

                
                htmlElement = getRejectElement(checkReject(element[1].rejected)); //If you want to change the layout if there is a reject do this at getReject element
                htmlElement += '<div class="card-header">Internship' + buildReviseNotice(checkReject(element[1].rejected))+'</div>' //Shows a revise on screen if application status is rejected
                htmlElement += '<div class="card-body text-secondary">';
                htmlElement += '<h6 class="card-text text-align-center"><span class="float-left">' + element[1].dept + " " + element[1].classnumber + '</span><span class="float-right">'+ element[1].semester + ' ' + element[1].year + '</span></h6>';
                htmlElement += '<div id="progress' + index + '"' + ' class="progressB mx-auto img-fluid"></div>';
                htmlElement += '<div class="text-center"><a href="' + buildApplicationRedirect(element[1].rejected, element[1].fwid) +'" class="mt-2 btn btn-primary text-center">' + applicationModifier(checkReject(element[1].rejected))+'</a></div>';
                htmlElement += '</div></div>';
                console.log(element[0]);
                console.log(element[1]);

                $('.apps').append(htmlElement);

                if (!(checkReject(element[1].rejected))){
                    var $progressDiv = $("#progress" + index);
                    var $progressBar = $progressDiv.progressStep();
                }
                else {
                    var $progressDiv = $("#progress" + index);
                    var $progressBar = $progressDiv.progressStep({ activeColor: "red"});
                }


                for (let e = 0; e < element[0].length; e++) {
                    const order = element[0][e];
                    $progressBar.addStep(element[0][e]);
                    console.log(element[0][e]);
                }

                if (element[1].progress == null) {
                    $progressBar.setCurrentStep(0);
                    $progressBar.refreshLayout();
            
                }
                else {
                    $progressBar.setCurrentStep(element[1].progress);
                    $progressBar.refreshLayout();
                  
                }
                
                $('#progress'+index).attr({
                    'data-toggle': "tooltip", 
                    'data-placement': "top", 
                    'title': "Your application is being reviewed by your " + element[0][element[1].progress]
                });
                
            }
        }

        }

    }
    
    function buildReviseNotice(r){
        if (r){
            return "<b>(Please revise your application)</b>";
        }
        else{
            return "";
        }
    }
    function buildApplicationRedirect(rej, id){
        var newURL;
        if(checkReject(rej)){
            newURL = "review.php?rej=1&fwid="+id;
        }
        else{
            newURL = "review.php?rej=0&fwid="+id;
        }
        return newURL;
    }
    // function get                
    function applicationModifier(reject){
        if(reject){
            return 'Edit Application';
        }
        else{
            return 'View Application';
        }
    }

    function getRejectElement(reject) { 
        if (reject == 0) {
            return '<div class="hvr-underline-reveal card border-light mb-3 w-100">';
        }
        else {
            return '<div class="hvr-underline-reveal card border-light mb-3 w-100">';
        }

    }
    function checkReject(rej) { //promise not needed
        if (rej == 0) {
            return false;
        }
        else if (rej == 1){
            return true;
        }


    }

});