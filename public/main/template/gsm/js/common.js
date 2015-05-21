function ValidatePaymentInformation()
{
    var ValidationResults = true;
    var PaymentInformation = $('#payment_info').val();
    var FileExtension = $('#proforma_file').val().split(".").pop().toLowerCase();

    if (PaymentInformation == '' || PaymentInformation.trim() == "")
    {
        $("#payment_info").addClass('errorClass');
        ValidationResults = false;
    }
    else
    {
        $("#payment_info").removeClass('errorClass');
        ValidationResults = true;

    }
    console.log(FileExtension);
    return false;
    if (FileExtension != '' || FileExtension.trim() != "")
    {
        if ($.inArray(ext, ["jpg", "pdf", 'jpeg']) == -1) {
            $("#proforma_file").addClass('errorClass');
            ValidationResults = false;
        } else {
            $("#proforma_file").removeClass('errorClass');
            ValidationResults = true;
        }
    }

    return ValidationResults;

}