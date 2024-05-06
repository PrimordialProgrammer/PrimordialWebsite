<?php
include_once 'db_connection.php';

// Add video
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $title = $_POST["add_title"];
    $url = $_POST["add_url"];
    $description = $_POST["add_description"];

    $sql = "INSERT INTO videos (title, url, description) VALUES (:title, :url, :description)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':url', $url, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->execute();
}

// Edit video
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $id = $_POST["edit_id"];
    $title = $_POST["edit_title"];
    $description = $_POST["edit_description"];

    $sql = "UPDATE videos SET title = :title, description = :description WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

// Delete video
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id = $_POST["delete_id"];

    $sql = "DELETE FROM videos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

// Fetch videos
$sql = "SELECT * FROM videos";
$result = $conn->query($sql);
$videos = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos - BloomTech</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            overflow-y: auto; /* Add a vertical scrollbar to the body */
        }

        .videos-page {
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        .video-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-height: 300px; /* Set a maximum height for the container */
            overflow-y: auto; /* Add a vertical scrollbar when needed */
        }

        .video-item {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: left;
        }

        iframe {
            width: 100%;
            height: 180px;
            border: 0;
        }

        h3, p {
            margin: 10px 0;
        }

        form {
            margin-top: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #008CBA;
        }

        .delete-btn {
            background-color: #f44336;
        }
    </style>
</head>
<body class="videos-page">
    <center>
        <h2>Videos</h2>
        <div class="video-container">
            <?php foreach ($videos as $video): ?>
                <div class="video-item">
                    <iframe width="560" height="315" src="<?= $video['url'] ?>" frameborder="0" allowfullscreen></iframe>
                    <h3><?= $video['title'] ?></h3>
                    <p><?= $video['description'] ?></p>

                    <!-- Edit Video Form -->
                    <form method="post">
                        <input type="hidden" name="edit_id" value="<?= $video['id'] ?>">
                        <input type="text" name="edit_title" value="<?= $video['title'] ?>" required>
                        <textarea name="edit_description" required><?= $video['description'] ?></textarea>
                        <button type="submit" name="edit" class="edit-btn">Edit</button>
                    </form>

                    <!-- Delete Video Form -->
                    <form method="post">
                        <input type="hidden" name="delete_id" value="<?= $video['id'] ?>">
                        <button type="submit" name="delete" class="delete-btn">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </center>

    </form>
</body>
</html>
