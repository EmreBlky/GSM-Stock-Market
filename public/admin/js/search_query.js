$(document).ready(function(){
        	$("#email").autocomplete({
				source: "search.php",
				minLength: 2,
				select: function (event, ui) {	
					var item = ui.item;
                                        $("#title").val(item.title);
					$("#first_name").val(item.first_name);
					$("#last_name").val(item.last_name);
                                        $("#company_name").val(item.company_name);
                                        $("#phone_number").val(item.phone_number);
                                        $("#mobile_number").val(item.mobile_number);
                                        $("#address_line_1").val(item.address_line_1);
                                        $("#address_line_2").val(item.address_line_2);
                                        $("#town_city").val(item.town_city);
                                        $("#county").val(item.county);
                                        $("#country").val(item.country);
                                        $("#post_code").val(item.post_code);
                                        $("#website").val(item.website);
                                        $("#business_sectors").val(item.business_sectors);
                                        $("#other_sectors").val(item.other_sectors);
                                        $("#vat_tax").val(item.vat_tax);
                                        $("#company_number").val(item.company_number);
                                        $("#language").val(item.language);
                                        $("#facebook").val(item.facebook);
                                        $("#twitter").val(item.twitter);
                                        $("#gplus").val(item.gplus);
                                        $("#linkedin").val(item.linkedin);
                                        $("#skype").val(item.skype);
				}
			});
});