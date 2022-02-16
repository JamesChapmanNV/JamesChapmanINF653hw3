<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My ToDo List</title>
    <link rel="stylesheet" href="/css/main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>ToDo List</h1></header>

    <main>
        <h1>Database Error</h1>
        <p>There was an error connecting to the database.</p>
        <p>The database must be installed as described in the appendix.</p>
        <p>MySQL must be running as described in chapter 1.</p>
        <p>Error message: <?php echo $error_message; ?></p>
        <p>&nbsp;</p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?>My ToDo List, Inc.</p>
    </footer>
</body>
</html>