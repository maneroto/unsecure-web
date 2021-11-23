<?php include get_file('templates/components/navbar.php'); ?>
<main id="dashboard">
    <div class="container-wide">
        <div class="tasks-list">
            <?php 
                require get_file("templates/components/TaskItem.php"); 
            ?>
        </div>
    </div>
</main>
<?php include get_file('templates/components/footer.php'); ?>