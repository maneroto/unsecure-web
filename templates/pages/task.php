<?php include get_file('templates/components/navbar.php'); ?>
<main id="task">
    <div class="container-slim">
        <div class="task-form-card">
            <form method="POST" action="">
                <input type="text" class="input secondary" placeholder="Enter the task name" id="name" name="name"
                    required />
                <select class="input secondary" name="urgency" id="urgency" required>
                    <option value="" selected disabled>Select the urgency level</option>
                    <option value="1">Low</option>
                    <option value="2">Mid</option>
                    <option value="3">High</option>
                </select>
                <textarea class="textarea secondary" name="description" id="description" cols="30" rows="5"
                    placeholder="Enter the task description" required></textarea>
                <input type="date" class="input secondary" placeholder="Due date" id="due-date" name="due-date"
                    requried />
                <button type="submit" class="btn accent">
                    Create task
                </button>
            </form>
        </div>
    </div>
</main>
<?php include get_file('templates/components/footer.php'); ?>