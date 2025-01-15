<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=test", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}

$query = $db->prepare("SELECT * FROM smartphone");
$query->execute();

$smartphones = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ReviewYourExperience</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container-fluid">
    <div class="card-wrapper">
        <?php
        foreach ($smartphones as $smartphone) {
            ?>
            <div class="card" style="width: 13rem;">
                <img src="<?php
                echo $smartphone["image"]
                ?>
" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <?php
                        echo $smartphone["name"]
                        ?>
                    </h5>
                    <div class="d-flex justify-content-center">
                        <a href="update.php" class="btn btn-warning">Update</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="delete.php" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="read.php?id=<?= $smartphone["id"] ?>" class="btn btn-primary">Insert</a>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>