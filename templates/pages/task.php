<?php include get_file('templates/components/navbar.php'); ?>
<main id="task">
    <div class="container-slim">
        <div class="task-form-card">
            <form method="POST" action="<?php page_link("server/routes/Task/index.php")?>"
                <?php echo isset($_GET['id'])? "data-task-id='".$_GET['id']."'": ""?> id="task-form">
                <input type="text" class="input secondary" placeholder="Enter the task title" id="title" name="title"
                    required />
                <select class="input secondary" name="urgency" id="urgency" required>
                    <option value="" selected disabled>Select the urgency level</option>
                    <option value="1">Low</option>
                    <option value="2">Mid</option>
                    <option value="3">High</option>
                </select>
                <textarea class="textarea secondary" name="description" id="description" cols="30" rows="5"
                    placeholder="Enter the task description" required></textarea>
                <input type="date" class="input secondary" placeholder="Due date" id="due-date" name="due_date"
                    min="<?= date('Y-m-d'); ?>" requried />
                <button type="submit" class="btn accent">
                    Create task
                </button>
            </form>
        </div>
    </div>
</main>
<?php include get_file('templates/components/footer.php'); ?>