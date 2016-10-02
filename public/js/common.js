$('.deleteEntry').on('click', function () {

  var result = confirm('Вы действительно хотите удалить?');
  if (result === false) {
    return false;
  }

  $(this).prop('disabled', true);

  var inputData = $('#formDeleteEntry').serialize();
  var action = $(this).data('action');
  var parent = $(this).parent();

  $.ajax({
    url: action,
    type: 'POST',
    data: inputData,
    success: function (msg) {
      if (msg.status === 'success') {
        parent.slideUp(300, function () {
          parent.closest("tr").remove();
        });
        toastr.success(msg.msg);
      }
    },
    error: function (data) {
      if (data.status === 422) {
        toastr.error('Во время удаления возникла ошибка');
      }
    }
  });

  return false;
});