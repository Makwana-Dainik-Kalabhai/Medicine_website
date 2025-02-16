if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
  
  $(document).ready(function () {
    var last_index = $(".add-benefits").val();
  
    $(".add-benefits").click(function () {
      $(".benefits-form").append(
        `<div class="row">
              <div class="col-md-1 border p-3">
                  <p>${last_index})</p>
              </div>
              <div class="col-md-3 border p-3">
                  <input type="text" name='add-key' class="form-control" />
              </div>
              <div class="col-md-6 border p-3">
                  <textarea class="border w-100 text-secondary py-1 px-2" name='add-value' rows="5" required></textarea>
              </div>
              <div class="col-md-2 border p-3">
                  <button class="btn btn-danger" name="add-benefits" value="${last_index}">Add</button>
              </div>
          </div>`
      );
      last_index++;
    });
  });
  