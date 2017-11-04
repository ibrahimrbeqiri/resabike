<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
?>



<div class="container">
	<div class="row">
	<div class="col l12 center">
		<h3><?php echo $lang['SUCCESS_HEADING']; ?> <i class="material-icons reservation-success">check_circle</i></h3>
		<h5><?php echo $lang['SUCCESS_REDIRECT']; ?><span id="countdown">5</span><?php echo $lang['SUCCESS_SECONDS']; ?></h5>
	</div>
	</div>
</div>


<script type="text/javascript">

    // Total seconds to wait
    var seconds = 5;

    function countdown() {
        seconds = seconds - 1;
        if (seconds < 0) {
            // Chnage your redirection link here
            window.location = "<?php echo URL_DIR; ?>";
        } else {
            // Update remaining seconds
            document.getElementById("countdown").innerHTML = seconds;
            // Count down using javascript
            window.setTimeout("countdown()", 1000);
        }
    }

    // Run countdown function
    countdown();

</script>




<?php

unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
