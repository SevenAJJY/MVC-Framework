<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/fawsome.css">
    <title>Document</title>
</head>
<body>
<div class="home-content">
    <h1 class="main-title text-center">ALL USERS</h1>
    <div class="main-button">
        <a href="/user/create">
            <span><i class="fa-solid fa-plus me-2 ms-2"></i>ADD NEW USER</span>
            <span><i class="fa-solid fa-plus me-2 ms-2"></i>ADD NEW USER</span>
        </a>
    </div>
    <div class="errors">
            <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-success  mt-3">
                            <i class="fas fa-check me-3"></i> '.$_SESSION['message'].'
                        </div>';
                        unset($_SESSION['message']) ;
                }
            ?>
    </div>
    <div class="table-responsive tables">
        <table class="table__content">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Tax (%)</th>
                    <th>Control</th>
                </tr>
            </thead>
        <tbody>
            <?php 
                if (false !== $users) {
                foreach ($users as $user) {
                    echo '<tr>' ;
                        echo '<td>' . $user->name . '</td>' ;
                        echo '<td>' . $user->age . '</td>' ;
                        echo '<td>' . $user->address . '</td>' ;
                        echo '<td>' . $user->salary  . ' DH</td>' ;
                        echo '<td>' . $user->tax . '</td>' ;?>
                            <td>
                                <a href="/user/edit/<?= $user->id ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Edit</a>
                                <a href="/user/delete/<?= $user->id ?>" class="btn btn-sm btn-danger" onclick="if(!confirm('Are You Sure ?')) return false;"><i class="fas fa-times"></i> Delete</a>
                            </td>
                        <?php
                        echo '</tr>' ;
                }
            }
            else {
                    echo '<tr><td rowspan="6" class="alert alert-success text-center mb-2 mt-2">
                                <i class="fas fa-exclamation-triangle me-3 "></i> '.$text_no_data.
                        '</td></tr>';
            }
        ?>
        </tbody>
    </table>
    </div>

</div>

</body>
</html>
