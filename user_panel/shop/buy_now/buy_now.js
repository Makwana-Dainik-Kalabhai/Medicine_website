$(document).ready(function() {
    $(".card .remove_btn").click(function() {
        let item_code = $(this).val();
        $.ajax({
            type: "POST",
            url: "buy_now.php",
            data: {
                item_code: item_code
            },
            success: function() {
                location.reload();
            }
        });
    });
    
    $(".card #quantity").change(function() {
        let quantity = $(this).val();
        let item_code = $(this).siblings("#item_code").val();
        
        $.ajax({
            type: "POST",
            url: "buy_now.php",
            data: {
                quantity: quantity,
                item_code: item_code
            },
            success: function() {
                location.reload();
            }
        });
    });
});