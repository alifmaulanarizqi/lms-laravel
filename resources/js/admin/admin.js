import $ from 'jquery';

window.$ = window.jQuery = $;

$(document).ready(function() {
    $('.delete-item').on('click', function(e) {
      e.preventDefault();
        $('#modal-danger').modal('show');
    });
});
