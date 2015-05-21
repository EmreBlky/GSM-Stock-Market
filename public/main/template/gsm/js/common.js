function ValidatePaymentInformation()
{
    var ValidationResults = false;
    var PaymentInformation = $('#payment_info').val();
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
    return false;

}