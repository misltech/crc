 <!-- /#wrapper -->

 <!-- Bootstrap core JavaScript -->
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
 <script src="../js/raphael.js"></script>
 <script src="../js/progressStep.js"></script>
 
 
   <script>

            $(document).ready(function () {


                var $progressDiv = $("#progressBar");
                var $progressBar = $progressDiv.progressStep();
                $progressBar.addStep("Student");
                $progressBar.addStep("Instructor");
                $progressBar.addStep("Employer");
                $progressBar.addStep("Chair");
                $progressBar.addStep("Dean");
                $progressBar.addStep("RecReg");
                $progressBar.setCurrentStep(2);
                $progressBar.refreshLayout();

                var $progressDiv2 = $("#progressBar2");
                var $progressBar2 = $progressDiv2.progressStep({ activeColor: "red" });
                $progressBar2.addStep("Student");
                $progressBar2.addStep("Instructor");
                $progressBar2.addStep("Employer");
                $progressBar2.addStep("Chair");
                $progressBar2.addStep("Dean");
                $progressBar2.addStep("RecReg");
                $progressBar2.setCurrentStep(4);
                $progressBar2.refreshLayout();
            });
        </script>
 
 <!-- Menu Toggle Script -->
 <script>
   $("#menu-toggle").click(function(e) {
     e.preventDefault();
     $("#wrapper").toggleClass("toggled");
   });
 </script>

 </body>

 </html>