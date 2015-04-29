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
<script>
    (function(f,b){
        var c;
        f.hj=f.hj||function(){(f.hj.q=f.hj.q||[]).push(arguments)};
        f._hjSettings={hjid:24813, hjsv:3};
        c=b.createElement("script");c.async=1;
        c.src="//static.hotjar.com/c/hotjar-24813.js?sv=3";
        b.getElementsByTagName("head")[0].appendChild(c); 
    })(window,document);
</script>
</body>
</html>