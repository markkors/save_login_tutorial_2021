
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--My custom Javascript functions-->
<script src="<?=core::$home_url?>js/functions.js"></script>
<script>
    // init script after page content fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // functies gemaakt in function.js
        clearMainContent();
        setMainContent('<div>main content hier</div>');
    });
</script>
