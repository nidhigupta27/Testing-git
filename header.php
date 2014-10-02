        
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <!-- Google fonts  -->
  <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville' rel='stylesheet' type='text/css'>

  <link href='http://fonts.googleapis.com/css?family=Lusitana' rel='stylesheet' type='text/css'>
  <!-- Link to my CSS file -->
  <link rel="stylesheet" href="CSS/styles.css">
  <!-- Added CDN for jQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <script type="text/javascript">
               $(document).ready(function(){
 
                         $("#checksymbol").click(function(){
                                
                                 if ($("#checksymbol").prop("checked"))
                                    {
                                      //show the hidden div
                                      $("#Number_symbols").show();
                                    }
                                 else
                                    {
                                     	//hide the div 
                                      $("#Number_symbols").hide();
                                    }
                          });
                          if ($("#checksymbol").prop("checked"))
                               {
                                 //show the hidden div
                                 $("#Number_symbols").show();
                               }
                          else
                               {                         
                                //otherwise, hide it
                               $("#Number_symbols").hide();
                              }

                });
  
   </script>
          
  <title>xkcd Password Generator</title>
      