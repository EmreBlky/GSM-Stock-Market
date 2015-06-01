<?php

$advSearch = isset( $_GET['advancedSearch'] );
$advSearchInClass = $advSearch ? 'class="collapse in" aria-expanded="true' : 'class="collapse"';

?>

<script>
    $(document).ready(function () {

        $("#search").submit(function () {
            var $form = $(this),
                $advSearch = $form.find("#AdvanceSearch");

            if( $advSearch.hasClass("in") ){
                $form.append("<input type='hidden' name='advancedSearch' value='true' >");
            }
        });

    });
</script>
