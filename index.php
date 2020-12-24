<?php 
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Wear a Mask</title>
</head>
<body>

<div class="main-section">
<div class="add-section">
<form action="app/add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                error
                <input type="text" name="first_name" style="border-color: #ff6666" placeholder="First Name"  />
<input type="text" name="last_name" placeholder="Last Name"  />
<input type="text" name="email" placeholder="Email"  />
<input type="text" name="store" placeholder="Store"  />
              <button type="submit">Add &nbsp; <span>&#43;</span></button>

             <?php }else{ ?>
                <input type="text" name="first_name" placeholder="what?"  />
<input type="text" name="last_name" placeholder="Last Name"  />
<input type="text" name="email" placeholder="Email"  />
<input type="text" name="store" placeholder="Store"  />
              <button type="submit">Add &nbsp; <span>&#43;</span></button>
             <?php } ?>
          </form>
</div>
<?php 
    $slacker = $conn->query("SELECT * FROM slacker ORDER BY id DESC");
?>
<div class="slacker-section">
<?php if($slacker->rowCount() <= 0){ ?>
<div class="slacker-item">
<div class="empty">
    <img src="" alt="">
</div>
</div>
<?php } ?>

<?php while($slackers = $slacker->fetch(PDO::FETCH_ASSOC)) { ?>

<div class="slacker-item">
    <span id="<?php echo $slackers['id']; ?>"
    class="remove-slacker">x</span>
    <?php if($slackers['checked']){ ?>
        <input type="checkbox"
        class="check-box"
        checked />
<h2 class="checked"><?php echo $slackers['first_name'], $slackers['last_name'], $slackers['email'], $slackers['store']?></h2>

        <?php }else { ?>
            <input type="checkbox"
        class="check-box"/>
<h2><?php echo $slackers['first_name'], $slackers['last_name'], $slackers['email'], $slackers['store']?></h2>
            <?php } ?>
        <br>
        <small>created: <?php echo $slackers['date'] ?> </small>
</div>
<?php } ?>
</div>



</div>
    
<script>
$(document).ready(function() {
    $('.remove-slacker').click(function() {
        const id = $(this).attr('id');

        $.post("app/remove.php",
        {
            id: id
        },
        (data) => {
            if(data) {
                $(this).parent().hide(600);
            }
        }
        );
    })
})
    </script>
</body>
</html>