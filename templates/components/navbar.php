<nav class="navbar">
    <div class="container-wide">
        <a href="<?php page_link("") ?>" class="nav-brand">
            <h1 class="h2">
                MyTasks
            </h1>
        </a>
        <div class="nav-menu">
            <form method="GET" class="nav-search">
                <input type="search" class="input primary" placeholder="Search task name" name="search" id="search" />
                <button type="submit" class="btn primary">
                    Search
                </button>
            </form>
            <a href="<?php page_link("login") ?>" class="btn accent">new task</a>
        </div>
    </div>
</nav>