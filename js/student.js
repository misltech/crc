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
            $('.jumbotron').append('<div>No applications assigned for you.</div>');
        }
        if (res.length > 0) {

            for (let index = 0; index < res.length; index++) {
                const element = res[index];

                htmlElement = getRejectElement(checkReject(element[1].rejected));
                htmlElement += '<div class="card-header">Internship</div>'
                htmlElement += '<div class="card-body text-secondary">';
                htmlElement += '<h5 class="card-text text-align-center"><span class="float-left">' + element[1].dept + '</span><span class="float-right">'+ element[1].semester + ' ' + element[1].year + '</span></h5>';
                htmlElement += '<div id="progress' + index + '"' + ' class="progressB mx-auto img-fluid"></div>';
                htmlElement += '<div class="text-center"><a href="' + buildApplicationRedirect() +'" class="mt-2 btn btn-primary text-center">' + applicationModifier(checkReject(element[1].rejected))+'</a></div>';
                htmlElement += '</div>';
                htmlElement += '</div>';
                console.log(element[0]);
                console.log(element[1]);

                $('.jumbotron').append(htmlElement);

                if (!checkReject(checkReject(element[1].rejected))){
                    var $progressDiv = $("#progress" + index);
                    var $progressBar = $progressDiv.progressStep();
                }
                else {
                    var $progressDiv = $("#progress" + index);
                    var $progressBar = $progressDiv.progressStep({ activeColor: "red" });
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

    function buildApplicationRedirect(){
        // var newURL = window.location.protocol + "/" + window.location.host + "/" + window.location.pathname + 'review.php?rej=1?fwid=something';
        var newURL = "review.php?rej=1?fwid=something";
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
            return '<div class="card border-light mb-3">';
        }
        else {
            return '<div class="card border-danger mb-3">';
        }

    }
    function checkReject(rej) { //promise not needed


        if (rej == 0) {
            return false;
        }
        else {
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