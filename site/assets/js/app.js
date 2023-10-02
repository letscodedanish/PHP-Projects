(function () {
  var quantity = document.querySelectorAll(".quantity");
  if (quantity != null) {
    var add = document.querySelectorAll(".add");
    var sub = document.querySelectorAll(".subtract");
    add.forEach((element) => {
      element.addEventListener("click", function () {
        var item = element.getAttribute("data-item");
        var number = document.querySelector(`#number-${item}`);
        var input = document.querySelector(`#item-${item}`);
        number.innerHTML++;
        input.value++;
      });
    });

    sub.forEach((element) => {
      element.addEventListener("click", function () {
        var item = element.getAttribute("data-item");
        var number = document.querySelector(`#number-${item}`);
        var input = document.querySelector(`#item-${item}`);

        if (number.innerHTML > 1 && input.value > 1) {
          number.innerHTML--;
          input.value--;
        }
      });
    });
  }
})();
