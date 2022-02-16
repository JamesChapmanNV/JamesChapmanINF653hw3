<?php require('database.php')?>

<?php
$newToDoTitle = filter_input(INPUT_POST, "newToDoTitle", FILTER_SANITIZE_STRING);
$Description = filter_input(INPUT_POST, "Description", FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My ToDo List</title>
    <link rel="stylesheet" href="css/main.css" />
</head>

<body>
<main>
    <header><h1>ToDo List</h1></header>
    <?php 
    if($newToDoTitle) { 
        $query = 'INSERT INTO todoitems (Title, Description)
                    VALUES (:newToDoTitle, :Description)';
        $statement = $db->prepare($query);
        $statement->bindValue(':newToDoTitle', $newToDoTitle);
        $statement->bindValue(':Description', $Description);
        $statement->execute();
        $statement->closeCursor();
    } 
    ?>
    <?php
        $query = 'SELECT * FROM todoitems';
        $statement = $db->prepare($query);
        $statement->execute();
        $todos = $statement->fetchAll();
        $statement->closeCursor(); 
    ?>
    <?php 
    if(empty($todos)) { ?>

        <p> No to do list items exist yet.<BR>Add some below!</p>
        
    <?php } else { ?>
    <section>
        <?php foreach ($todos as $todo) : ?>
            <div style="border-bottom: 1px solid #000;">
            <?php echo "<p class='bold'> {$todo['Title']} </p>"; ?>
            <?php echo $todo['Description']; ?>
            <form style="float: right;" class='button' 
                action="delete_todo.php" method="POST">
                <input type="hidden" name="item_num"
                    value="<?php echo $todo['ItemNum']; ?>"> 
                <input type="submit" value="Delete">
            </form>
            </div>
        <?php endforeach; ?>

    </section>
    <?php } ?>
    
    <section>
    <h2>Add Item</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']?>"method="POST">
        <label for="newToDoTitle"></label>
        <input type="text" id="newToDoTitle" name="newToDoTitle" placeholder="Title" required>
        <br>
        <label for="Description"></label>
        <input type="text" id="Description" name="Description" placeholder="Description" required>
        <button>Add Item</button>
    </form>
    </section>

    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> My ToDo List, Inc.</p>
    </footer>
</body>
</html>