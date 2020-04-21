<?php include('skeleton.head.php') ?>
<h1>Review Form</h1>
<p>Student and company information here to be reviewed...</p>

<form method="post" action="backend/submit-professor.php">

    <label>
        <p>Student ID for Candidate:</p><input type="text" name="studentID" value="">
    </label>
    <br>

    <fieldset>


        <legend>Learning Objectives:</legend>
        <span class="insert-group-addon">
            <div id="slo">
                <input type="checkbox" id="slo1" name="slo1" value="true" />
                <label for="slo1">Transfer knowledge and skills learned from the classrooms to events and situations
                    outside of the classroom.</label>
                <br>

                <input type="checkbox" id="slo2" name="slo2" value="true" />
                <label for="slo2">Communicate orally with other professionals.</label>
                <br>

                <input type="checkbox" id="slo3" name="slo3" value="true" />
                <label for="slo3">Describe and report events, procedures and results in professional writing.</label>
                <br>

                <input type="checkbox" id="slo4" name="slo4" value="true" />
                <label for="slo4">Reflect and evaluate experiences throughout the process.</label>
                <br>
            </div>
        </span>

        <div id="alo">
            <button id="btnId">Add</button>
            <script>
            var btn = document.getElementById('btnId');
            btn.addEventListener('click', function(e) {

                e.preventDefault();

                var div = document.createElement('div');
                div.setAttribute('class', 'insert-group-addon');
                btn.parentNode.insertBefore(div, btn);

                var chk = document.createElement("input");
                chk.setAttribute('type', 'checkbox');
                btn.parentNode.insertBefore(chk, div);

                var txt = document.createElement("input");
                txt.setAttribute('type', 'text');
                txt.setAttribute('size', '115');
                btn.parentNode.insertBefore(txt, div);

            });
            </script>
        </div>


    </fieldset>

    <label>
        <p>Additional Learning Objectives:[TEMP]</p>
        <textarea id="alo" name="alo" rows="5" cols="100"></textarea>
    </label>

    <?php include('components/accept_reject.php'); includeARComponent(); ?>

    <input id="button" type="submit" name="button" />
</form>

<?php include('skeleton.foot.php') ?>
