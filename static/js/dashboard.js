const getTasks = async () => {
    const response = await server.get('Task.php');

    return response.data;
};

const getTaskByTitle = async (data) => {
    const response = await server.get('Task.php', { params: data });

    return response.data;
};

const deleteTask = async (data) => {
    const response = await server.delete('Task.php', { data });

    return response.data;
};

const createBadge = (urgencyLevel) => {
    const badge = newTag({
        tagName: 'div',
        className: 'badge',
    });
    switch (parseInt(urgencyLevel)) {
        case 3:
            badge.classList.add('warning');
            badge.textContent = 'High';
            break;
        case 2:
            badge.classList.add('secondary');
            badge.textContent = 'Mid';
            break;
        case 1:
        default:
            badge.classList.add('accent');
            badge.textContent = 'Low';
            break;
    }
    return badge;
};

const createTaskItem = (taskData) => {
    const { id, title, urgency, description, due_date } = taskData;
    const taskContainer = newTag({
        tagName: 'article',
        className: 'task-item',
    });
    const taskHeader = newTag({
        tagName: 'header',
        target: taskContainer,
        className: 'task-item__header',
    });
    newTag({
        tagName: 'h3',
        target: taskHeader,
        textContent: title,
    });
    taskHeader.appendChild(createBadge(urgency));
    const taskBody = newTag({
        tagName: 'div',
        target: taskContainer,
        className: 'task-item__body',
    });
    newTag({
        tagName: 'p',
        target: taskBody,
        textContent: description,
    });
    const taskFooter = newTag({
        tagName: 'footer',
        target: taskContainer,
        className: 'task-item__footer',
    });
    const taskDelete = newTag({
        tagName: 'button',
        target: taskFooter,
        textContent: 'done',
        className: 'btn warning',
    });
    newTag({
        tagName: 'p',
        target: taskFooter,
        textContent: `Due: ${new Date(due_date).toLocaleDateString()}`,
        className: 'task-item__date',
    });
    taskDelete.onclick = function () {
        deleteTask({ id: parseInt(id) }).then((res) => {
            if (res) {
                window.location.reload();
            }
        });
    };
    return taskContainer;
};

const showTasks = (tasksData) => {
    const tasksList = document.querySelector('.tasks-list');
    tasksList.innerHTML = '';
    if (Array.isArray(tasksData) && tasksData.length > 0) {
        tasksData.forEach((item) =>
            tasksList.appendChild(createTaskItem(item))
        );
    } else {
        tasksList.innerHTML = 'No tasks found';
    }
};

const searchTasks = (title) => {
    if (title) {
        getTaskByTitle({ title: title }).then((res) => {
            showTasks(res);
        });
    } else {
        getTasks().then((res) => {
            showTasks(res);
        });
    }
};

const setSearchForm = () => {
    const searchForm = document.querySelector('.nav-search');

    searchForm.onsubmit = function (e) {
        e.preventDefault();
        const searchInput = document.querySelector('[name=search]');
        searchTasks(searchInput.value);
    };
};

document.addEventListener('DOMContentLoaded', function () {
    getTasks().then((res) => {
        showTasks(res);
    });
    setSearchForm();
});
