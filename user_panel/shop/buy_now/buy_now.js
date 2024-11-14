$(document).ready(function() {
    $(".card #quantity").change(function() {
        let quantity = $(this).val();
        let item_code = $(".card #item_code").val();

        $.ajax({
            type: "POST",
            url: "up_quantity.php",
            data: {
                quantity: quantity,
                item_code: item_code
            },
            success: function(data) {
                alert(data);
            }
        });
    });
});