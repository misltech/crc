$(document).ready(function () {


    $.ajax({
        headers: {
            'token': $('meta[name="token"]').attr('content'),
            'request': 'all'
        },
        url: "student_api"
    }).done(function (result) {
        console.log(result);
        console.log(result.length);
        filter(result);
    });



    function filter(res) {
        if (res.length == 0) {
            $('.jumbotron').append("<div class='alert alert-dark text-center'>No applications assigned for you.</div>");
        }
        if (res.length > 0) {

            for (let index = 0; index < res.length; index++) {
                const element = res[index];

                htmlElement = getRejectElement(checkReject(element[1].rejected));
                htmlElement += '<div class="card-header">Internship</div>'
                htmlElement += '<div class="card-body text-secondary">';
                htmlElement += '<h6 class="card-text text-align-center"><span class="float-left">' + element[1].dept + " " + element[1].classnumber + '</span><span class="float-right">'+ element[1].semester + ' ' + element[1].year + '</span></h6>';
                htmlElement += '<div id="progress' + index + '"' + ' class="progressB mx-auto img-fluid"></div>';
                htmlElement += '<div class="text-center"><a href="' + buildApplicationRedirect(element[1].rejected, element[1].fwid) +'" class="mt-2 btn btn-primary text-center">' + applicationModifier(checkReject(element[1].rejected))+'</a></div>';
                htmlElement += '</div>';
                htmlElement += '</div>';
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

            }

        }

        // $('.jumbotron').append('<div class="card border-danger mb-3"><div class="card-header">Internship</div><div class="card-body text-secondary"><h5 class="card-title">CSB 221</h5><p class="card-text">Set to red when application is rejected</p><div id="progressBar2" class="progressB mx-auto"></div><a href="#" class="offset-4 btn btn-primary">See application</a></div></div>');

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
            return '<div class="hvr-underline-from-center card border-light mb-3">';
        }
        else {
            return '<div class="hvr-underline-from-center card border-light mb-3">';
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
    
    // $(window).resize(function() {  //neeeds to refresh the svg image

    //     setTimeout(rel(), 1000);
    //    function rel(){
    //     window.location.reload();
    //    }
        
    //     alert("changed");
    //     });

});