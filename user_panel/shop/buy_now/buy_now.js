$(document).ready(function () {
  var items = [];
  var off_price = [];
  var price = [];
  var quantity = [];
  let total = 0;

  $("input[name='item_arr[]']").map(function () {
    items.push($(this).val());
  });
  $("input[name='off_price_arr[]']").map(function () {
    off_price.push($(this).val());
  });
  $("input[name='price_arr[]']").map(function () {
    price.push($(this).val());
  });
  $("input[name='quantity_arr[]']").map(function () {
    quantity.push($(this).val());
  });
  
  for (let i = 0; i < off_price.length; i++) {
    total += off_price[i] * quantity[i];
  }
  if(total < 1000)
    total += 50;
  $("#rzp-button1").html(`Pay Now<br />₹${total}`);

  for(let i=0; i<items.length; i++) {
    $(`#form_items${i}`).val(items[i]);
    $(`#form_off_price${i}`).val(off_price[i]);
    $(`#form_price${i}`).val(price[i]);
    $(`#form_quantity${i}`).val(quantity[i]);
  }
  $("input[name='form_total']").val(total);
  
  // ! Display Different btns when payment_type is changed
  $("#payment_type").change(function () {
    if ($("#payment_type").val() == "Razorpay") {
      $("#rzp-button1").css("display", "block");
      $(".buy_now_main .purchase").css("display", "none");
      $("input[name='form_pay_status']").val("Paid");
    }
    
    if ($("#payment_type").val() == "Cash On Delivery") {
      $(".buy_now_main .purchase").css("display", "block");
      $("#rzp-button1").css("display", "none");
      $("input[name='form_pay_status']").val("Pending");
    }

    if ($("#payment_type").val() == "select") {
      $("#rzp-button1").css("display", "none");
      $(".buy_now_main .purchase").css("display", "none");
    }
  });

  //! Update Quantity onchange quantity input
  $("input[name='quantity_arr[]']").change(function () {
    let total = 0;

    quantity[$(this).attr("id")] = $(this).val();

    for (let i = 0; i < off_price.length; i++) {
      total += off_price[i] * quantity[i];
    }
    for(let i=0; i<items.length; i++) {
      $(`#form_quantity${i}`).val(quantity[i]);
    }

    if(total < 1000)
      total += 50;

    $("input[name='form_total']").val(total);

    $("#rzp-button1").html(`Pay Now<br />₹${total}`);
  });

  //! Remove Product
  $(".card .remove_btn").click(function () {
    let product_id = $(this).val();
    
    $.ajax({
      type: "POST",
      url: "buy_now.php",
      data: {
        product_id: product_id,
      },
      success: function () {
        location.reload();
      },
    });
  });
});
