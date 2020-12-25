<?php 
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Mask Tracker</title>
</head>
<body>

<div class="main-section">
<h1 class=>Mask Tracker</h1>
<img src="https://growth-management.alachuacounty.us/Content/images/mask.png" alt="Mask for app" srcset="">
<p class=>Insert the person that is not following the rules to mask wearing</p>
<br>
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
                <input type="text" name="first_name" placeholder="First Name"  />
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
    <p>This is the section where all the slackers are recorded. If on the list, doctors are decided whether they want to help these patient or not. If there info is crossed off, it means they are in the process of paying fines or community services to get removed. If you are able to remove the slacker, hit the X button on the right of each slacker. </p>
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
        data-slacker-id="<?php echo $slackers['id']; ?>"
        checked />
<h2 class="checked"><?php echo $slackers['first_name'], ['last_name'], ['email'], ['store']?></h2>


        <?php }else { ?>
            <input type="checkbox"
            data-slacker-id="<?php echo $slackers['id']; ?>"
        class="check-box" />
<h2><?php echo $slackers['first_name']?></h2> 
<h2><?php echo $slackers['last_name']?></h2> 
<h2><?php echo $slackers['email']?></h2> 
<h2><?php echo $slackers['store']?></h2>

            <?php } ?>
        <br>
        <small>Added: <?php echo $slackers['date'] ?> </small>
</div>
<?php } ?>
</div>



</div>
    
<script>
        $(document).ready(function(){
            $('.remove-slacker').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-slacker-id');
                
                $.post('app/check.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                                  
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
        });
    </script>
</body>
</html>