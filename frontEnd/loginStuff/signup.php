<?php 

	include '../header.php';

?>

        <form action="https://webtech-ki46.webtech-uva.nl/backEnd/includes/signup.inc.php" method='post'>
            <div class="container">
              <h1>Sign Up</h1>
              <p>Please fill in this form to create an account.</p>
              <hr>
          
              <label for="username"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="username" required>
              
              <label for="email"><b>Email</b></label>
              <input type="email" placeholder="Enter Email" name="email" required>
          
              <label ><b>Password</b></label>
              <input id="password" type="password" placeholder="Enter Password" name="password" required>
          
              <label ><b>Repeat Password</b></label>
              <input id="password-repeat" type="password" placeholder="Repeat Password" name="psw-repeat" required> 
          
              <label id="password-message"></label>
          
              <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
          
              <div class="clearfix">
                <button type="submit" class="signupbtn">Sign Up</button>
              </div>
            </div>
          </form>

    </body>
</html>
