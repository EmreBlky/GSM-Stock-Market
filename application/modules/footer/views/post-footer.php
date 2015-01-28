

    <!-- Mainly scripts -->
    <script src="/public/main/js/jquery-2.1.1.js"></script>
    <script src="/public/main/js/bootstrap.min.js"></script>
    
    <!-- Toastr script -->
    <script src="/public/main/js/plugins/toastr/toastr.min.js"></script>
    <script>
	$(document).ready(function() {

    // show when page load
    toastr.info('Page Loaded!');

    $('#linkButton').click(function() {
       // show when the button is clicked
       toastr.success('Click Button');

    });

});
</script>

    <?php 

$this->load->module('analytics');
$this->analytics->google_analytics('','');

?>
</body>
</html>