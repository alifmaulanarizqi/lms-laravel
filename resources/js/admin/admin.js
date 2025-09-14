import $ from 'jquery';

window.$ = window.jQuery = $;

const csrf_token = $('meta[name="csrf-token"]').attr('content');
let delete_url = null;

$('.delete-item').on('click', function (e) {
  e.preventDefault();
  delete_url = $(this).attr('href');
  $('#modal-danger').modal('show');
});

$('.delete-confirm-btn').on('click', function (e) {
  e.preventDefault();

  $.ajax({
    method: 'DELETE',
    url: delete_url,
    data: {
      _token: csrf_token,
    },
    beforeSend: function () {
      $('.delete-confirm-btn').text('Deleting...');
    },
    success: function (response) {
      // store success message in localStorage
      console.log("waduhsuccess");
      localStorage.setItem('delete_toast_message', response.message);
      localStorage.setItem('is_delete_toast_success', 'true');

      // reload page
      window.location.reload();
    },
    error: function (xhr, status, error) {
      // store success message in localStorage
      console.log("waduherror");
      const response = xhr.responseJSON;
      localStorage.setItem('delete_toast_message', response.message);
      localStorage.setItem('is_delete_toast_success', 'false');

      // Reset button text
      $('.delete-confirm-btn').text('Delete');

      // reload page
      window.location.reload();
    }
  });
});
