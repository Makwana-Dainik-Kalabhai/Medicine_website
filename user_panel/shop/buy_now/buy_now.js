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
  $("#rzp-button1").html(`Pay Now<br />₹${total}`);

  // ! Display Different btns when payment_type is changed
  $("#payment_type").change(function () {
    if ($("#payment_type").val() == "Razorpay") {
      $("#rzp-button1").css("display", "block");
      $(".buy_now_main .purchase").css("display", "none");
    }

    if ($("#payment_type").val() == "Cash On Delivery") {
      $(".buy_now_main .purchase").css("display", "block");
      $("#rzp-button1").css("display", "none");
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

    $("#rzp-button1").html(`Pay Now<br />₹${total}`);
  });

  //! Remove Product
  $(".card .remove_btn").click(function () {
    let item_code = $(this).val();
    $.ajax({
      type: "POST",
      url: "buy_now.php",
      data: {
        item_code: item_code,
      },
      success: function () {
        location.reload();
      },
    });
  });

  $(".buy_now_main .purchase").click(function () {
    let order_id = $("input[name='order_id']").val();

    let name = $("input[name='name']").val();
    let email = $("input[name='email']").val();
    let phone = $("input[name='phone']").val();

    let total = 0;

    for (let i = 0; i < items.length; i++) {
      total += off_price[i] * quantity[i];
    }

    let hno = $("input[name='house_no']").val();
    let street = $("input[name='street']").val();
    let suite = $("input[name='suite']").val();
    let city = $("input[name='city']").val();
    let state = $("input[name='state']").val();
    let pin = $("input[name='pincode']").val();

    let address = [hno, street, suite, city, state, pin];
    let delivery_date = $("input[name='delivery_date']").val();

    if(!(validateForm(name,email,phone,hno,street,suite,city,state,pin))) {
      return;
    }

    $.ajax({
      type: "POST",
      url: "success.php",
      data: {
        order_id: order_id,
        name: name,
        email: email,
        phone: phone,
        items: items,
        offer_price: off_price,
        price: price,
        quantity: quantity,
        payment_type: "Cash On Delivery",
        payment_status: "Pending",
        total: total,
        delivery_address: address,
        delivery_date: delivery_date,
      },
      success: function (data) {
        alert("Order Placed Successfully");
      },
    });
  });
});

function validateForm(name,email,phone,hno,street,suite,city,state,pin) {
  if(name == null) {
    alert("Null");
    return false;
  }
}