 <!-- /#wrapper -->

 <!-- Bootstrap core JavaScript -->
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
 <script src="../js/raphael.js"></script>
 <script src="../js/progressStep.js"></script>
 
   <script>
            function onClick() {
                console.log("Clicked: " + this.index);
                return true;
            }
            
            function beforeEntry() {
                console.log("Before entry: " + this.index);
                return true;
            }

            function afterEntry() {
                console.log("After entry: " + this.index);
            }
        
            function beforeExit() {
                console.log("Before exit: " + this.index);
                return true;
            }

            function afterExit() {
                console.log("After exit: " + this.index);
            }

            $(document).ready(function () {
                var $progressDiv = $("#progressBar");
                var $progressBar = $progressDiv.progressStep();
                $progressBar.addStep("Name");
                $progressBar.addStep("Source");
                $progressBar.addStep("Fields");
                $progressBar.addStep("Filter");
                $progressBar.addStep("Schedule");
                
                for (var stepCounter = 0; stepCounter < 5; stepCounter++) {
                    var currentStep = $progressBar.getStep(stepCounter);
                    currentStep.onClick = onClick;
                    currentStep.beforeEntry = beforeEntry;
                    currentStep.afterEntry = afterEntry;
                    currentStep.beforeExit = beforeExit;
                    currentStep.afterExit = afterExit;
                }
                
                $progressBar.setCurrentStep(0);
                $progressBar.refreshLayout();
                
                function resetVisited() {
                    for (var counter = 0; counter < 5; counter++) {
                        var currentStep = $progressBar.getStep(counter);
                        currentStep.setVisited(false);
                    }
                }
                
                var counter = 1;
                var intervalId = null;
                function startLoop() {
                    if (intervalId) {
                        // continue
                    }
                    else {
                        intervalId = setInterval(function () {
                            if (counter == 0) {
                                resetVisited();
                            }
                            $progressBar.setCurrentStep(counter);
                            counter++;
                            if (counter > 4) {
                                counter = 0;
                            }
                        }, 1000);
                    }
                }
                
                function stopLoop() {
                    if (intervalId) {
                        clearInterval(intervalId);
                        intervalId = null;
                    }
                }
                
                $("#startLoop").click(startLoop);
                $("#stopLoop").click(stopLoop);
                $("#resetVisited").click(resetVisited);
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