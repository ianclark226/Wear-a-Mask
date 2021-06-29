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
<h1>Mask Tracker</h1>
<h3 style="color:#fff; text-align:center; padding:20px;">Due to Covid19 being at the lowest since the Pandemic has started in the USA, stores and businesses are ending thier mask mandate but be prepared for the next one 100 years from now. Feel free to add any slackers still.</h3>
<img src="https://growth-management.alachuacounty.us/Content/images/mask.png" alt="Mask for app" srcset="">

<!-- TIMER COUNTDOWN -->

<?php 
$date = date('3020-01-01');
$time = date('12:00:00');
$date_today = $date . ' ' . $time;

?>
<script type="text/javascript">
var count_id = "<?php echo $date_today; ?>";
var countDownDate = new Date(count_id).getTime();

var x = setInterval(function() {
    var now = new Date().getTime();

    var distance = countDownDate - now;

    var days = Math.floor(distance/(1000 * 60 * 60 * 24));
    var hours = Math.floor((distance%(1000 * 60 * 60 * 24))/(1000*60*60));
    var minutes = Math.floor((distance%(1000 * 60 * 60))/(1000*60));
    var seconds = Math.floor((distance%(1000 * 60))/1000);

    document.getElementById("timer").innerHTML = days + " Days " + hours + " Hours " + minutes + " Minutes " + seconds + " Seconds Left";

        if(distance<0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML="EXPIRED";
        }      
},1000);
</script>
<?php 
echo '<p id="timer" style="font-size:30px;"></p>'
?>
<p class=>Insert the person that is not following the rules to mask wearing</p>
<br>

<!-- ADD SLACKER SECTION --> 
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

<!-- ADD DATA TO APP AND DATABASE --> 
<?php 
    $slacker = $conn->query("SELECT * FROM slacker ORDER BY id DESC");
?>

<div class="slacker-section">
    <p>This is the section where all the slackers are recorded. If on the list, you are required to pay a fine. If there info is a check mark, it means they are a repeat offender. If you are able to remove the slacker, hit the X button on the right of each slacker. </p>
<?php if($slacker->rowCount() <= 0){ ?>
<div class="slacker-item">
<div class="empty">
    <img src="" alt="">
</div>
</div>
<?php } ?>

<!-- FETCH AND DISPLAY DATA -->

<?php while($slackers = $slacker->fetch(PDO::FETCH_ASSOC)) { ?>

<div class="slacker-item">
    <span id="<?php echo $slackers['id']; ?>"
    class="remove-slacker">x</span>
    <?php if($slackers['checked']){ ?>
        <input type="checkbox"
        class="check-box" 
        data-slacker-id="<?php echo $slackers['id']; ?>"
        checked /> Repeat Offender
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
        <!-- DATE WHEN SLACKER WAS ADDED -->
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