<!DOCTYPE html>
<html>    
    <head>
        <meta charset="utf-8">
        <title>3SCode Academy Manager</title>       
        <link rel="stylesheet" href="recursos/css/style.css">
        <link rel="stylesheet" href="recursos/css/wellcome.css"> 
    </head>
    <body>
    <?php include("recursos/html/header.html"); ?>
        <div class="main-container">            
            <div id="wellcome-msg">
                <div><h1>Test page</h1><div>
            <div>
                <span>
                    <?php
                        foreach($_POST as $data){
                            echo('<div>'. $data.'</div>');
                        }                        
                    ?>
                </span>
            </div>            
        </div>
        <?php include("recursos/html/footer.html"); ?>      
    </body>         
</html>