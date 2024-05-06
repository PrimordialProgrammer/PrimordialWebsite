<?php
include_once 'classes/class.user.php';

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        $firstname = $_POST["add_firstname"];
        $lastname = $_POST["add_lastname"];
        $grade = $_POST["add_grade"];
        $user->add_class_member($firstname, $lastname, $grade);
    } elseif (isset($_POST["edit"])) {
        $id = $_POST["edit_id"];
        $firstname = $_POST["edit_firstname"];
        $lastname = $_POST["edit_lastname"];
        $grade = $_POST["edit_grade"];
        $user->edit_class_member($id, $firstname, $lastname, $grade);
    } elseif (isset($_POST["delete"])) {
        $id = $_POST["delete_id"];
        $user->delete_class_member($id);
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

$result = $user->list_class_members();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Class List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .scroll-container {
            max-height: 300px;
            overflow-y: auto;
        }

        .actions {
            display: flex;
            gap: 5px;
        }

        input[type="text"] {
            padding: 5px;
            width: 150px;
            margin-right: 5px;
        }

        button {
            padding: 8px;
            cursor: pointer;
        }

        .add-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .edit-btn {
            background-color: #008CBA;
            color: white;
            border: none;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <form method="post">
        <label>Add Member:</label>
        <input type="text" name="add_firstname" placeholder="First Name" required>
        <input type="text" name="add_lastname" placeholder="Last Name" required>
        <input type="text" name="add_grade" placeholder="Grade" required>
        <button type="submit" name="add" class="add-btn">Add</button>
    </form>

    <div class="scroll-container">
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>

            <?php
            if ($result) {
                foreach ($result as $row) {
                    echo "<tr>
                            <td>{$row['firstname']}</td>
                            <td>{$row['lastname']}</td>
                            <td>{$row['grade']}</td>
                            <td class='actions'>
                                <form method='post'>
                                    <input type='hidden' name='edit_id' value='{$row['ID']}'>
                                    <input type='text' name='edit_firstname' value='{$row['firstname']}'>
                                    <input type='text' name='edit_lastname' value='{$row['lastname']}'>
                                    <input type='text' name='edit_grade' value='{$row['grade']}'>
                                    <button type='submit' name='edit' class='edit-btn'>Edit</button>
                                </form>
                                <form method='post'>
                                    <input type='hidden' name='delete_id' value='{$row['ID']}'>
                                    <button type='submit' name='delete' class='delete-btn'>Delete</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No records found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
