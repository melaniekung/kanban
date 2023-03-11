function showModal(event) {
  event.preventDefault();

  const id = event.target.getAttribute('data-id');
  const editModal = document.querySelector('#edit-modal-' + id);

  if (event.target.id === "edit-btn") {
    editModal.hidden = false;

    fetch(`/task/edit/${id}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        document.querySelector('#edit-title-' + id).value = data[0]['title'];
        document.querySelector('#edit-tags-' + id).value = data[0]['tags'];
        document.querySelector('#edit-duedate-' + id).value = data[0]['duedate'];
        document.querySelector('#edit-notes-' + id).value = data[0]['notes'];
        document.querySelector('#edit-status-' + id).value = data[0]['status'];
      });
  } else if (event.target.id === "save-btn") {
    // check for status delete
    if (document.querySelector('#edit-status-' + id).value != "delete") {
      // submit form to save/update
      document.getElementById(event.target.parentNode.id).submit();
    } else {
      // redirect to task_delete
      fetch("/task/delete/" + id)
        .then(response=>response.json())
        .then(window.location.reload(true))
    }
  } else if (event.target.id === "") {
    // clicking anywhere other than buttons
    const url = "/task/" + id;
    const status = event.target.getAttribute('data-status');
    const csel = "card-" + status + "-" + id;
    const tsel = "task-" + status + "-" + id;
    const modalContent = document.getElementById(csel);
    const modalTask = document.getElementById(tsel);

    if (modalContent.hidden === true) {
      // expand task card
      modalContent.hidden = false;
      modalTask.hidden = true;

      fetch(url)
        .then(response => response.text())
        .then(data => {
          modalContent.innerHTML = data;
        });
    } else {
      // close task card
      modalContent.hidden = true;
      modalTask.hidden = false;
      editModal.hidden = true;
    }
  }
}

// set event listener for each task on kanban
const tasks = document.querySelectorAll('#task-btn');
tasks.forEach(t => {
  const taskBtn = t.getAttribute('class');
  document.querySelector('.' + taskBtn).addEventListener('click', showModal);
});