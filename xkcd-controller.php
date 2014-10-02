<?php

session_start();
// Checking to see the time when words were last scraped from Paulnoll website. If the time(in seconds) comes out to be more than 15 
// days , a new array is generated by scraping the words from the website.
if(isset($_SESSION['Last_activity']))
{
  if(time() - $_SESSION['Last_activity'] >1296000)

 {
// destroy session
  session_unset();

  session_destroy();
 }
}
/* Create an array of words from the Paulnoll website 
  (1) When running the program for the first time
  (2) It has been more than 15 days since the words were last scraped from the Paulnoll website */

if(!isset($_SESSION['first_time']))
 {
    $url_list = array('http://www.paulnoll.com/Books/Clear-English/words-01-02-hundred.html','http://www.paulnoll.com/Books/Clear-English/words-03-04-hundred.html');

    foreach($url_list as $list)
        {
            $wordlist = file_get_contents("$list");

            $removed_endline=str_replace(PHP_EOL,'',$wordlist);

            $removed_endline=preg_replace('/\t+/','',$removed_endline);

            preg_match_all("/<li>(\w+)<\/li>/",$removed_endline,$out,PREG_SET_ORDER);

            foreach ($out as $match) 
            {
               $word_list[] = $match[1];
            }
        }
 //Serialize the array into a JSON object and write in a .json file
 $fp = fopen('words_file.json','w');

 fwrite($fp,json_encode($word_list));

 fclose($fp);

 $_SESSION['first_time'] = 1;

 $_SESSION['Last_activity'] = time();

 session_write_close();
 }
//Initialize the variables used in the script
 $password_string="";

 $class="password";

 $final_list = array();

 $final_list1 = array();

 $numbers = array(0,1,2,3,4,5,6,7,8,9);

 $error_message_words = "";

 $error_message_symbols="";

 $symbol = array("!","@","#","$","%","&","^","*");

//Unserialize the JSON object back into an array
 $file = "words_file.json";

 $final_list =json_decode(file_get_contents($file),true);

//When the submit button is clicked, validate the form inputs first
 if(isset($_POST['genpwd']))
 {
   $password_length = trim($_POST['pass-length']);

    if(empty($password_length))
      {
          $error_message_words = "Please enter the number of words in your password";
      }
    else if(!is_numeric($password_length) || $password_length < 1 || $password_length>9)
     {
          $error_message_words = "Number of words should be a number between 1 and 9";
     }
    if(isset($_POST['chksymbol']))
     {
          $symbol_length = trim($_POST['number_of_symbols']);

          if(empty($symbol_length))
           {
             $error_message_symbols = "Please enter the number of symbols in the password";
           }
          else if(!is_numeric($symbol_length) || $symbol_length < 1 || $symbol_length > 8)
           {
            $error_message_symbols = "Please enter the number of symbols between 1 and 8";
           }
    }
//check to see if any error messages were generated, proceed only when no errors
    if(!$error_message_words && !$error_message_symbols)
      {
        //Randomely pick words(number of words picked equal to the number in the form input) from an array of words and generate a
        //new array 
         $words = $_POST['pass-length'];

         $rand_keys = array_rand($final_list, $words);
          
           if($words>1)
              {
                foreach($rand_keys as $key => $val)
                    {
                       $final_list1[] =  $final_list[$val];
                    }
              }
           else
              {
                $final_list1[]= $final_list[$rand_keys];
              }
          //check to see if case selector option in the form input is selected by the user. If selected,the case of the array elements
          // generated in the previous step is converted into the appropiate case 
         
           if(isset($_POST['genpwd']) && isset($_POST['case-selector']))
              {
                 $case_selector = $_POST['case-selector'];
               
                 if($case_selector == "All_Uppercase")
                   {
                      $final_list1 = array_map('strtoupper',$final_list1);
                   }
                 else if($case_selector == "All_Lowercase")
                   {
                      $final_list1 = array_map('strtolower',$final_list1);
                   }
                 else 
                   {
                      $final_list1 = array_map('ucfirst',$final_list1);
                   }

              }
         //check to see if the checkbox for a number in the form input is checked by the user. If checked,a random number is picked
         // from an array of numbers(0-9) and appended to any random array element. 

           if(isset($_POST['genpwd']) && isset($_POST['chknumber']))
             {
                //index of the number picked randomely from number array  
                $num = array_rand($numbers,1);
                //random positon is computed using rand() function
                $random_pos_number = rand(0,count($final_list1)-1);

                foreach($final_list1 as $key => $val)
                     {
                        if($key == $random_pos_number)
                            {
                              $final_list1[$key] = $final_list1[$key].$num;
                            
                            }  
                     } 

             }
         //check to see if the checkbox for a symbol in the form input is checked by the user. If checked,a random symbol is picked
         // from an array of symbols and appended to any random array element.Also the number of symbols to be added to the password 
         // is taken from the form input and added to the password.

          if(isset($_POST['genpwd']) && isset($_POST['chksymbol']))
             {         
               $num_symbol = $_POST['number_of_symbols'];
               //indexes of the symbol picked randomely from the symbol array
               $sym = array_rand($symbol,$num_symbol);
               // If more than one symbols then loop through each symbol randomely picked from the symbol array
               // and append to the array of words at random positions
               if(count($sym)>1)
                 {
                    foreach($sym as $index_sym => $result_sym)
                       {
                          $random_pos_symbol = rand(0,count($final_list1)-1);

                           foreach($final_list1 as $key => $val )
                               {
                                 if($key==$random_pos_symbol)
                                   {
                                     $final_list1[$key]=$final_list1[$key].$symbol[$result_sym];
                                   }
                
                               }

                        }
                  }
                // If number of symbols given by the user is one then randomely picked  symbol from the symbol array
                // is appended to the array of words at random positions
               else
                  {
                   $random_pos_symbol = rand(0,count($final_list1)-1);


                   foreach($final_list1 as $key => $val )
                       {
                         if($key==$random_pos_symbol)
                             {
                                  $final_list1[$key]=$final_list1[$key].$symbol[$sym];
                            }
                       }
                   }
             }
           //check to see if the seperator option in the form input is selected by the user. If selected,a seperator is inserted while
           //converting an array into a string using implode function of php. Default is no spaces between words. 

          if(isset($_POST['genpwd']) && isset($_POST['seperator']))
            {
              $seperator = $_POST['seperator'];
            }
          else
            {
             $seperator ="";
            }
          $password_string = implode($seperator,$final_list1);
        
        // If the check symbol is not checked then the text box for number of symbols should be assigned an empty string.
         if(!isset($_POST['chksymbol']))
          {
            $_POST['number_of_symbols'] = "";
          }
     }
       // If the form input validation resulted in an error, then alert the user with an error message in place of a password string!
    else
     {
      $password_string="Please correct the errors above!";
      
      $class="password_error";
     }
}
   //If the page is loaded first time and generate password is not clicked, inform the user with a welcome message.
 else
 {
    $password_string="Please enter your password inputs above";  
 }

