<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=test",
        "root", "");
    if (isset($_POST['verzenden'])) {
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

        $image = filter_input(INPUT_POST, "image", FILTER_SANITIZE_STRING);

        $query = $db->prepare("UPDATE smartphone SET name=:name, image=:image");
        $query->bindParam("name", $name);
        $query->bindParam("image", $image);
        $query->bindParam("id", $_GET['id']);
        if ($query->execute()) {
            echo "De nieuwe gegevens zijn toegevoegd.";
            header("location: read.php");
        } else {
            echo "Er is een fout opgetreden";
        }
    } else {
        $query = $db->prepare("SELECT * FROM smartphone WHERE id = :id");
        $query->bindParam("id", $_GET['id']);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $data) {
            $name = $data["name"];
            $image = $data["image"];
        }
    }
} catch (PDOException $e) {
    die("Error!; " . $e->getMessage());
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <title>update</title>
</head>
<body>

<div class="container mt-5">
    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="text" class="form-control" id="image" name="image" value="<?php echo $image; ?>">
        </div>

        <button type="submit" class="btn btn-primary" name="verzenden">Update</button>
        <a href="master.php" class="btn btn-secondary">Terug naar Read Page</a>
    </form>
</div>

</body>
</html>