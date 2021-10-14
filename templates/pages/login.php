<?php 
require(get_file("templates/components/SignForm.php"));
$form = new SignForm("", "Login", false);
?>
<main id="sign">
    <div class="container-slim">
        <h1 class="h1">
            Log in
        </h1>
        <?php $form->render(); ?>
        <p>
            Don't you have an account?
            <a href="<?php page_link("register")?>" class="link">
                Sign up
            </a>
        </p>
    </div>
</main>