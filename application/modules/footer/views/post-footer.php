<script>
        $(function() {

            autoRefresh();

        });

        function autoRefresh()
        {

            setTimeout("autoRefresh()",10000);

            $.get("mailbox/messages_count", function(data) {
                $("#result").html(data);
            });
            $.get("mailbox/new_message", function(data) {
                $("#inbox_count").html(data);
            });
            $.get("mailbox/mail_dropdown/3", function(data) {
                $(".dropdown-messages").html(data);
            });

         }
 </script>



    <?php

$this->load->module('analytics');
$this->analytics->google_analytics('','');

?>
</body>
</html>