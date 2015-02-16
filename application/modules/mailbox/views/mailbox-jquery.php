<script type="text/javascript">

    $(function() {

            autoRefreshInbox();

        });
        
        
        function autoRefreshInbox()
        {
            
            setTimeout("autoRefreshInbox()",10000);            
            
            $.get("mailbox/new_message_all", function(data) {
                $("#inbox_all_message").html(data);    
            });
            $.get("mailbox/new_message_market", function(data) {
                $("#inbox_market").html(data);    
            });
            $.get("mailbox/new_message_member", function(data) {
                $("#inbox_member").html(data);    
            });
            $.get("mailbox/new_message_support", function(data) {
                $("#inbox_support").html(data);    
            });
         }
    $(document).ready(function() {
        
    $('#select_all').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.i-checks').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.i-checks').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
    
        
   
});

</script>
