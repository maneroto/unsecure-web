<?php include get_file('templates/components/navbar.php'); ?>
<main id="dashboard">
    <div class="container-wide">
        <div class="tasks-list">
            <?php 
                require get_file("templates/components/TaskItem.php"); 

                

                $item = new TaskItem(
                    "This is the task title",
                    3,
                    "Here we have the description of the task that I need to do",
                    "17/08/2022"
                );
                $item->render();
                $item->render();
                $item->render();
                $item->render();
                $item->render();
            ?>
        </div>
    </div>
</main>
<?php include get_file('templates/components/footer.php'); ?>