/*
 * Custom javascript file contains all necessary client side code
 */
var DOMAINURL = "http://localhost/youship/frontend/web";
$(".new-offer-price").keypress(function(e){
    console.log("key press"+$(this).attr("data-id")+e.keyCode);
    if(e.keyCode == 13){
        console.log("enter pressed");
        //make ajax request with id and offer price
    $.post(DOMAINURL+"/site/update-customer-quote",
    {
        id: $(this).attr("data-id"),
        offerprice: $(this).val()
    },
    function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
        window.location.href = DOMAINURL+"/site/view-order";
    });
    }
});

$(".refresh-btn").click(function(){
   window.location.reload(); 
});

