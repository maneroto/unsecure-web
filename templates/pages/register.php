<?php 
require(get_file("templates/components/SignForm.php"));
$form = new SignForm("", "Register");
?>
<main id="sign">
    <div class="container-slim">
        <h1 class="h1">
            Register
        </h1>
        <?php $form->render(); ?>
        <p>
            Already have an account?
            <a href="<?php page_link("login")?>" class="link">
                Sign in
            </a>
        </p>
    </div>
</main>