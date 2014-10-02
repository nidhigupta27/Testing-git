      
<?php require('xkcd-controller.php'); ?>

<div class="container">

  <div id="image_funnel">
    <img src = "images/xkcd-gen.png" alt="Password Generator"/>
  </div>
   
  <h1>xkcd Password Generator</h1>
         
      <p> Welcome to yet another password generator inspired by a web comic <a href ="http://xkcd.com/936/">xkcd</a>.
          The goal is to create an obscure but memorable passwords.Customize your password by providing inputs like number of words, numbers and symbols options.
          <br><br><strong>Wanna give a try?</strong></p><br>   

      <form action="index.php" method="post" name="frmpass" >
        <div class="form-group">   
            <label># of words in Password: <input type="text" name="pass-length" id="pass-length" size="1" maxlength="1"
                <?php if(isset($_POST['pass-length'])){echo 'value="'.$_POST['pass-length'].'"';}?>/><span class="info"> (Max 9)</span></label><br/>
            <div id="err_words" class="errorMessage"><?=$error_message_words?></div>
        </div>

        <div class="form-group"> 
            <input type="checkbox" name="chknumber" <?php echo empty($_POST['chknumber'])? '': 'checked="checked"'?> />
            <label>Add a number? </label><br/>
        </div>

        <div class="form-group"> 
            <input type="checkbox" id="checksymbol" name="chksymbol" <?php echo empty($_POST['chksymbol'])? '': 'checked="checked"'?>/> 
            <label>Add symbols? </label><br/>
        </div>

        <div class="form-group"> 
            <div id ="Number_symbols" style="display:none" ><label>How many symbols to appear in the password? <input type="text"
                name="number_of_symbols" id ="number_of_symbols" size ="1" <?php if(isset($_POST['number_of_symbols']))
                {echo 'value="'.$_POST['number_of_symbols'].'"';}?> maxlength="1"/><span class="info"> (Max 8)</span></label></div>
            <div id="err_symbols" class="errorMessage"><?=$error_message_symbols?></div>
        </div>

        <div class="form-group">
            <label>Select the seperator:</label>   
            <select name="seperator">
               <option selected="selected" value="">Select the seperator</option> 
               <option value="-" <?php echo(isset($_POST['seperator']) && $_POST['seperator']=="-"?'selected="selected"':'');?>>A Hyphen</option>
               <option value="_"<?php echo(isset($_POST['seperator']) && $_POST['seperator']=="_"?'selected="selected"':'');?>>An Underscore</option>
            <!--   <option value ="" <?php echo(isset($_POST['seperator']) && $_POST['seperator']==""?'selected="selected"':'');?>>No Spaces</option>-->
            </select><span class="info"> (Default is No Space)</span>
        </div>

        <div class="form-group">  
            <label>Select the case:</label>
            <select name="case-selector">
               <option selected="selected" value="">Select the case </option> 
               <option value="All_Uppercase" <?php echo(isset($_POST['case-selector']) && $_POST['case-selector']=="All_Uppercase"?'selected="selected"':'');?>>Upper Case</option>
               <option value="All_Lowercase"<?php echo(isset($_POST['case-selector']) && $_POST['case-selector']=="All_Lowercase"?'selected="selected"':'');?>>Lower Case</option>
          <!--     <option value ="Camel_Case" <?php echo(isset($_POST['case-selector']) && $_POST['case-selector']=="Camel_Case"?'selected="selected"':'');?>>Camel Case</option>-->
            </select><span class="info"> (Default is camel case)</span><br/><br/>
        </div>

            <input type="submit" class="btn btn-primary" name="genpwd" value="Generate Password" /><br/><br/>
      </form>

      <div class=<?=$class?>><?=$password_string;?></div>      
</div>
