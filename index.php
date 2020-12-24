<?php 
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Wear a Mask</title>
</head>
<body>

<div class="main-section">
<div class="add-section">
<form action="">
<input type="text" name="first_name" placeholder="First Name" required />
<input type="text" name="last_name" placeholder="Last Name" required />
<input type="text" name="email" placeholder="Email" required />
<input type="text" name="store" placeholder="Store" required />
<button type="submit">Add &nbsp; <span>&#43;</span></button>

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
    
</body>
</html>