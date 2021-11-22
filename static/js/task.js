const getFormData = (form) => {
    form = new FormData(form);
    return {
        title: form.get('title'),
        urgency: form.get('urgency'),
        description: form.get('description'),
        due_date: form.get('due_date'),
    };
};

const getTask = async (data) => {
    const response = await server.get('Task.php', { params: data });

    return response.data;
};

const createTask = async (data) => {
    const response = await server.post('Task.php', data);

    return response.data;
};

const updateTask = async (data) => {
    const response = await server.put('Task.php', data);

    return response.data;
};

const setTaskForm = () => {
    const form = document.querySelector('#task-form');

    form.onsubmit = function (e) {
        e.preventDefault();
        const taskId = form.dataset.taskId;
        const data = getFormData(form);
        if (taskId) {
            updateTask({ ...data, id: taskId.replace('/', '') }).then((res) => {
                if (res) {
                    window.location.reload();
                }
            });
        } else {
            createTask(data).then((res) => {
                if (res) {
                    window.location.replace('/unsecure-web');
                }
            });
        }
    };
};

const initializeFormData = () => {
    const form = document.querySelector('#task-form');
    const taskId = form.dataset.taskId;

    if (taskId) {
        getTask({ id: taskId.replace('/', '') })
            .then((tasks) => {
                const taskInfo = tasks[0];
                const { title, urgency, description, due_date } = taskInfo;
                form.querySelector('#title').value = title;
                form.querySelector('#urgency').value = urgency;
                form.querySelector('#description').value = description;
                form.querySelector('#due-date').value = due_date;
            })
            .catch((err) => console.log(err));
    }
};

document.addEventListener('DOMContentLoaded', function () {
    initializeFormData();
    setTaskForm();
});
