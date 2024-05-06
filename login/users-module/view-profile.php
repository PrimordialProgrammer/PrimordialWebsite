<h3>Provide the Required Information</h3>
<div id="form-block">
<form method="POST" action="processes/process.user.php?action=update">
        <div id="form-block-half">
            <label for="fname">First Name</label>
            <input type="text" id="fname" class="input" name="firstname" value="<?php echo $user->get_user_firstname($id);?>" placeholder="Your name..">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" class="input" name="lastname" value="<?php echo $user->get_user_lastname($id);?>" placeholder="Your last name..">

            <label for="access">Access Level</label>
            <select id="access" name="access">
              <option value="student" <?php if($user->get_user_access($id) == "Student"){ echo "selected";};?>>Student</option>
              <option value="teacher" <?php if($user->get_user_access($id) == "Teacher"){ echo "selected";};?>>Teacher</option>
            </select>
        </div>
        <div id="form-block-half">
            <label for="email">Email</label>
            <input type="email" id="email" class="input" name="email" disabled value="<?php echo $user->get_user_email($id);?>" placeholder="Your email..">
                        
            <input type="hidden" id="userid" name="userid" value="<?php echo $id;?>"/>
            <a href="#">Change Email</a> | 
            <a href="#">Change Password</a> | 
            <?php
            if($user->get_user_status($id) == "1"){
              ?>
            <a href="processes/process.user.php?action=delete&id=<?php echo $id; ?>">Delete User</a>
            
              <?php
            }else{
            ?>
            <a href="processes/process.user.php?action=delete&id=<?php echo $id; ?>">Delete User</a>
            
            <?php
            }
            ?>
            
        </div>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <div id="button-block">
        <input type="submit" value="Update">
        </div>
</form>
</div>