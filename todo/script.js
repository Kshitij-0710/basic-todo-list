$(document).ready(function() {
    // Load tasks on page load
    loadTasks();

    // Add task form submission
    $('#taskForm').submit(function(event) {
        event.preventDefault();
        var taskDescription = $('#taskInput').val();
        addTask(taskDescription);
    });

    // Handle task deletion
    $('#taskList').on('click', 'button.delete', function() {
        var taskId = $(this).parent().data('id');
        deleteTask(taskId);
    });

    // Function to load tasks from the server
    function loadTasks() {
        $.ajax({
            url: 'tasks.php',
            method: 'GET',
            success: function(response) {
                $('#taskList').html(response);
            }
        });
    }

    // Function to add a new task
    function addTask(description) {
        $.ajax({
            url: 'tasks.php',
            method: 'POST',
            data: { description: description },
            success: function(response) {
                $('#taskInput').val('');
                loadTasks();
            }
        });
    }

    // Function to delete a task
    function deleteTask(id) {
        $.ajax({
            url: 'tasks.php',
            method: 'POST',
            data: { delete_id: id },
            success: function(response) {
                loadTasks();
            }
        });
    }
});
