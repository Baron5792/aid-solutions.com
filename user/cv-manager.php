<?php
    include "./partials/header.php";
?>

<script>
    document.getElementById("title_title").innerHTML = "CV Manager | aid-solutions";
</script>

<style>
    .cvNotify {
        background-color: silver;
    }
</style>

<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">CV Manager</p>
    </div>

    <?php if (isset($_SESSION['cv'])): ?>
        <p class="alert alert-danger">
            <?=
                $_SESSION['cv'];
                unset($_SESSION['cv']);
            ?>
        </p>
    <?php endif ?>

    <?php if (isset($_SESSION['cv-success'])): ?>
        <p class="alert alert-success">
            <?=
                $_SESSION['cv-success'];
                unset($_SESSION['cv-success']);
            ?>
        </p>
    <?php endif ?>

    <?php if (isset($_SESSION['delete'])): ?>
        <p class="alert alert-success">
            <?=
                $_SESSION['delete'];
                unset($_SESSION['delete']);
            ?>
        </p>
    <?php endif ?>


    
</div>

<!-- check for CV -->
<?php
    $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$id'");
    $details = mysqli_fetch_assoc($query);
    $resume = $details['resume'];

    if (strlen($resume) < 1) {
?>
        <form action="cv-manager_logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= $id ?>">
            <div class="container-fluid">
                <label for="CV" class="cv-container mt-5">
                    <div class="cv-content">
                        <p>Click here to upload file</p>
                        <small>To upload file size is <b>(MAX 300kB) and</b> allowed file type are <b>(.doc, .docx, .pdf)</b></small>
                    </div>
                </label>
                <input type="file" name="cv" id="CV" style="display: none;" onchange="showIcon()">
                <div id="file-icon" style="display: none;">
                    <i class="fas fa-check text-success"></i> File Selected
                </div>
                <button type="submit" name="upload" class="btn btn-primary mt-3">Upload File</button>
            </div>
        </form>
<?php
    }

    else {
?>
        <div class="container mt-5">
            <div class="row pt-4 pb-2" style="border: 1px dotted darkcyan;">
                <p class="col-11 col-sm-11 col-md-11" style="font-weight: bold;"><?= $resume ?></p>
                <form action="<?= URL ?>user/delete-cv.php" method="POST" class="" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?= $id ?>">
                    <button type="submit" name="delete" onclick="deleteCV();" class="btn btn-outline-light text-danger col-1"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
<?php
    }
?>



<script>
    function showIcon() {
        var fileInput = document.getElementById('CV');
        var fileIcon = document.getElementById('file-icon');
        if (fileInput.files.length > 0) {
            fileIcon.style.display = 'block';
        } else {
            fileIcon.style.display = 'none';
        }
    }


    function deleteCV() {
        if (confirm("Are you sure?")) {
                true;
            }

        else {
            event.preventDefault();
            event.stopPropagation();
        }
    }
    
</script>

<?php
    include "./partials/footer.php";
?>