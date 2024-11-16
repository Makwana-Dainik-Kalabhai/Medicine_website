$(document).ready(function () {
  $("#payment_type").change(function () {
    if ($("#payment_type").val() == "Razorpay")
      $("#rzp-button1").css("display", "block");

    if ($("#payment_type").val() == "Cash On Delivery")
      $(".buy_now_main .purchase").css("display", "block");
  });

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

  $(".card #quantity").change(function () {
    let quantity = $(this).val();
    let item_code = $(this).siblings("#item_code").val();

    $.ajax({
      type: "POST",
      url: "buy_now.php",
      data: {
        quantity: quantity,
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

    let item_code = $("input[name='item_code']").val();
    let total = $("input[name='total']").val();

    let hno = $("input[name='house_no']").val();
    let street = $("input[name='street']").val();
    let suite = $("input[name='suite']").val();
    let city = $("input[name='city']").val();
    let state = $("input[name='state']").val();
    let pin = $("input[name='pincode']").val();

    let address = [hno, street, suite, city, state, pin];
    let delivery_date = $("input[name='delivery_date']").val();

    $.ajax({
      type: "POST",
      url: "success.php",
      data: {
        order_id: order_id,
        name: name,
        email: email,
        phone: phone,
        item_code: item_code,
        payment_type: "Cash On Delivery",
        payment_status: "pending",
        total: total,
        delivery_address: address,
        delivery_date: delivery_date,
      },
      success: function (data) {
        alert("Order Placed Successfully");
      }
    });
  });
});