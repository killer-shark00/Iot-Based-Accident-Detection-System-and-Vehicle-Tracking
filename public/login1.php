 <?php 
   session_start();

   if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) { 
?> 

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Authentication</title>
      <link rel="stylesheet" href="login-style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="bg-img">
         <div class="content">
            <header>Vehicle Management System</header>
            <form action="auth.php" method="post">\
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="username" 
                  name="username"
                  required placeholder="username"
                   value="<?php if(isset($_GET['username'])) echo htmlspecialchars($_GET['username']); ?>">

               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" class="pass-key"  name="password" required placeholder="Password">
                  <span class="show">SHOW</span>
               </div>
               <div class="pass">
                  <!-- <a href="#">Forgot Password?</a> -->
               </div>
               <div class="field">
                  <input type="submit" value="LOGIN">
               </div>
            </form>
            
         </div>
      </div>
      <script>
               const pass_field = document.querySelector('.pass-key');
               const showBtn = document.querySelector('.show');
               showBtn.addEventListener('click', function(){
               if(pass_field.type === "password"){
                  pass_field.type = "text";
                  showBtn.textContent = "HIDE";
                  showBtn.style.color = "#3498db";
               }else{
                  pass_field.type = "password";
                  showBtn.textContent = "SHOW";
                  showBtn.style.color = "#222";
               }
         });
      </script>
   </body>
</html>

<?php 
}else {
   header("Location: login1.php");
}
 ?>