$('.modal-task').click(function(event) {
    event.preventDefault();

    var modalUrl = $(this).attr('href');
    $.get(modalUrl, function(data) {
        $(data).appendTo('body').modal('show');
    });
});

var modal = document.getElementById('task-card');
var closeModalBtn = document.getElementById('exit-modal-btn');

closeModalBtn.addEventListener('click', function() {
  modal.style.display = 'none';
});