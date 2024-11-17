function validateForm() {
  //! Phone
  $("input[name='phone']").keyup(function () {
    if ($(this).val() == "") {
      $(this).css("border", "2px solid red");
      $(this).siblings("b").text("Please! Enter the Phone no.");
    } //
    else if ($(this).val().length != 10) {
      $(this).css("border", "2px solid red");
      $(this).siblings("b").text("Enter 10 digit number");
    } //
    else {
      $(this).css("border", "none");
      $(this).siblings("b").text("");
      phoneErr = false;
    }
  });
  //! Email
  $("input[name='email']").keyup(function () {
    if ($(this).val() == "") {
      $(this).css("border", "2px solid red");
      $(this).siblings("b").text("Please! Enter the Email");
    } //
    // else if ($(this).val() != /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/) {
    //   $(this).css("border", "2px solid red");
    //   $(this).siblings("b").text("Enter valid Email");
    // } //
    else {
      $(this).css("border", "none");
      $(this).siblings("b").text("");
      emailErr = false;
    }
  });
  //! House no.
  $("input[name='house_no']").keydown(function () {
    if ($(this).val() == "") {
      $(this).css("border", "2px solid red");
      $(this).siblings("b").text("Please! Enter the House no.");
    } //
    else {
      $(this).css("border", "none");
      $(this).siblings("b").text("");
      hnoErr = false;
    }
  });
  //! Street
  $("input[name='street']").keydown(function () {
    if ($(this).val() == "") {
      $(this).css("border", "2px solid red");
      $(this).siblings("b").text("Please! Enter the Street.");
    } //
    else {
      $(this).css("border", "none");
      $(this).siblings("b").text("");
      streetErr = false;
    }
  });
  //! Suite
  $("input[name='suite']").keydown(function () {
    if ($(this).val() == "") {
      $(this).css("border", "2px solid red");
      $(this).siblings("b").text("Please! Enter the Apartment(Suite)");
    } //
    else {
      $(this).css("border", "none");
      $(this).siblings("b").text("");
      suiteErr = false;
    }
  });
  //! City
  $("input[name='city']").keydown(function () {
    if ($(this).val() == "") {
      $(this).css("border", "2px solid red");
      $(this).siblings("b").text("Please! Enter the City");
    } //
    else {
      $(this).css("border", "none");
      $(this).siblings("b").text("");
      cityErr = false;
    }
  });
  //! State
  $("input[name='state']").keydown(function () {
    if ($(this).val() == "") {
      $(this).css("border", "none");
      $(this).css("border", "2px solid red");
      $(this).siblings("b").text("Please! Enter the State");
    } //
    else {
      $(this).siblings("b").text("");
      stateErr = false;
    }
  });
  //! Pincode
  $("input[name='pincode']").keydown(function () {
    if ($(this).val() == "") {
      $(this).css("border", "2px solid red");
      $(this).siblings("b").text("Please! Enter the Pincode");
    } //
    else if ($(this).val().length != 6) {
      $(this).css("border", "2px solid red");
      $(this).siblings("b").text("Please! Enter the 6 digit Pincode");
    } else {
      $(this).siblings("b").text("");
      pinErr = false;
    }
  });
}

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

  //! Validate Form
  var emailErr = false,
    phoneErr = false;
  var hnoErr = false,
    streetErr = false,
    suiteErr = false,
    cityErr = false,
    stateErr = false,
    pinErr = false;

  validateForm(
    emailErr,
    phoneErr,
    hnoErr,
    streetErr,
    suiteErr,
    cityErr,
    stateErr,
    pinErr
  );

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

    if (
      name != "" &&
      !(emailErr && email == "") &&
      !(phoneErr && phone == "") &&
      !(hnoErr && hno == "") &&
      !(streetErr && street == "") &&
      !(suiteErr && suite == "") &&
      !(cityErr && city == "") &&
      !(stateErr && state == "") &&
      !(pinErr && pin == "")
    ) {
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
    }
  });
});
