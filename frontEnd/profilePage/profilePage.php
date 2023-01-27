<?php

    include_once '../header.php';

?>

<style>
    /* General styles */
    body {
        background-color: #E5F9E0;
        font-family: Arial, sans-serif;
        font-size: 14px;
        color: #333;
    }
    h2 {
        font-size: 24px;
        text-align: center;
        margin-top: 30px;
        margin-bottom: 30px;
    }
    /* Profile Box styles */
    .ProfileBox {
        display: flex;
        align-items: center;
        width: 80%;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px #ccc;
    }
    .profile-picture {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        margin-right: 20px;
    }
    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ccc;
    }
    /* Table header styles */
    th {
    background-color: #f2f2f2;
    font-size: 18px;
    font-weight: bold;
    }
    /* Table data styles */
    td {
        font-size: 16px;
    }
    /* Highlight the table row on hover */
    tr:hover {
        background-color: #f5f5f5;
    }
    /* Edit button styles */
    .edit-btn {
        background-color: #4CAF50;
        color: #fff;
        padding: 8px 12px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }
</style>

<div class="ProfileBox">
    <img src="<?php echo $_SESSION['profile_picture']; ?>" class="profile-picture">
    <table style="width:100%">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>About</th>
            <th></th>
        </tr>
        <tr>
            <td><?php echo $_SESSION['username']; ?></td>
            <td><?php echo $_SESSION['email']; ?></td>
            <td><?php echo $_SESSION['about']; ?></td>
            <td>
            <a href="/frontEnd/profilePage/edit_profile.php" class="edit-btn">Edit</a>
            </td>
        </tr>
    </table>
</div>

<?php 
    include_once '../footer.php';
?>
