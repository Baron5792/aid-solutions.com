<?php
    include __DIR__ . "/./partials/header.php";
?>

<div class="title">
    <p>Comments</p>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-8">
            <table>
                <?php
                    $query = mysqli_query($connection, "SELECT * FROM comment");
                    if (mysqli_num_rows($query) > 0) {
                ?>  
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Featured</th>
                            <th>Star</th>
                            <th>Country</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                <?php
                        foreach ($query as $data) {
                            $firstname = $data['firstname'];
                            $lastname = $data['lastname'];
                            $star = $data['star'];
                            $country = $data['country'];
                            $date = $data['date'];
                            $avatar = $data['avatar'];
                            $id = $data['id'];
                            $status = $data['featured'];
                            if ($status == 0) {
                                $featured = "normal";
                            }
                            else {
                                $featured = "featured";
                            }
                ?>  
                            <tr>
                                <td><?= $firstname ?></td>
                                <td><?= $lastname ?></td>
                                <td><?= $featured ?></td>
                                <td><?= $star ?></td>
                                <td><?= $country ?></td>
                                <td><?= $date ?></td>
                                <td>
                                    <a href="<?= URL ?>admin/delete-comment.php?id=<?= $id ?>"><button type="button" class="btn btn-basic"><i class="text-danger fa fa-trash"></i></button></a>
                                </td>

                            </tr>
                <?php
                        }
                    }
                    else {
                        echo "No record(s) found";
                    }
                ?>
                    
            </table>
        </div>
        <div class="col-md-4">
            <div class="title">
                <p>Add Comment</p>
            </div>
            <form action="<?= URL ?>admin/comment-logic.php" method="POST" enctype="multipart/form-data">
                <div class="row">


                    <!-- alert -->
                    <?php if (isset($_SESSION['reset-error'])): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?=
                                $_SESSION['reset-error'];
                                unset($_SESSION['reset-error']);
                            ?>
                        </div>
                    <?php elseif (isset(($_SESSION['reset-success']))): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?=
                                $_SESSION['reset-success'];
                                unset($_SESSION['reset-success']);
                            ?>
                        </div>
                    <?php endif ?>
                    <!-- end of comment -->


                    <input type="text" name="firstname" required class="form-control col-md-12" placeholder="Enter firstname" id="">
                    <input type="text" name="lastname" required class="form-control col-md-12 mt-1" placeholder="Enter lastname" id="">
                    <input type="text" name="message" required class="form-control col-md-12 mt-1" placeholder="Message" id="">
                    <input type="number" name="star" required class="form-control col-md-6 mt-1" placeholder="Enter no. of star" id="">
                    <input type="text" name="country" required class="form-control col-md-6 mt-1" placeholder="Enter country name" id="">
                    <input type="file" id="avatar" name="avatar" required class="form-control col-md-12 mt-1" id="" style="display: none;">
                    <select name="status" id="" class="form-control col-md-6 mt-1">
                        <option value="0" selected>Normal</option>
                        <option value="1">Featured</option>
                    </select>
                    <label for="avatar" class="mt-1" style="border: 2px dotted blue; width: 100%; padding: 20px 0px; text-align: center;">click to select an image</label>
                    <button type="submit" class="btn btn-primary btn-sm" name="comment">Add comment</button>
                </div>
            </form>

        </div>
    </div>
</div>