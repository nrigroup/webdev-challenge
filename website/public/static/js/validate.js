$(document).ready(function () {
  $('.brand-select').change(function () {
    var brand = $(this).val();
    $(this).replaceWith('<input class="form-control" type="text" name="brand" id="inputBrand" value="">');

    if (brand == '') {
      $('input[name=brand]').after('<p class="help-block">请输入品牌名称</p>');
    }
    else {
      $('input[name=brand]').val(brand);

      if (brand == '苹果') {
        $('#inputModel').replaceWith('<select class="brand-select form-control" name="model" id="inputModel"></select>');
        $('#inputModel').append('<option value="">请选择型号</option>');
        $('#inputModel').append('<option value="iPhone 6 Plus">iPhone 6 Plus</option>');
        $('#inputModel').append('<option value="iPhone 6">iPhone 6</option>');
        $('#inputModel').append('<option value="iPhone 5s">iPhone 5s</option>');
        $('#inputModel').append('<option value="iPhone 5c">iPhone 5c</option>');
        $('#inputModel').append('<option value="iPhone 5">iPhone 5</option>');
        $('#inputModel').append('<option value="iPhone 4S">iPhone 4S</option>');
        $('#inputModel').append('<option value="iPhone 4">iPhone 4</option>');
        $('#inputModel').append('<option value="">其他</option>');
        $('#inputModel').change(function () {
          var model = $(this).val();
          if (model == '') {
            $('#inputModel').replaceWith('<input type="text" name="model" id="inputModel" class="form-control" value=""/>');
          }
        });
        $('#inputBrand').change(function () {
          $('#inputModel').replaceWith('<input type="text" name="model" id="inputModel" class="form-control" value=""/>');
        });
      }
    }
  });
  /* 表单验证 */
  $.validator.addMethod("imei",
    function (input, element) {
//      input = input.replace(/\s+/g, "");
      return this.optional(element) || input.length >= 14 &&
        input.match(/^[0-9]{14,15}$/);
    }, "Please specify a valid imei number"
  );
  $('.form-validation').validate(
    {
      rules: {
        imei: {
          required: true,
          imei: true
        }
      },
      highlight: function (element) {
        $(element).closest('.form-group').addClass('has-error');
      },
      unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
      },
      errorElement: 'span',
      errorClass: 'help-block',
      errorPlacement: function (error, element) {
//        if (element.parent('.input-group').length) {
//          error.insertAfter(element.parent());
//        }
//        else {
//          error.insertAfter(element);
//        }
      }
    }
  );
});
