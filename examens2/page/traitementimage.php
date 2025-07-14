<?php
    require("../inc/function.php");

    if (isset($_POST["id_objet"])) 
    {
        $name = upload_image( $_FILES['objet_image'] );
        
        if( $name != false && $name != -1 ) 
        {
            $bool = insert_image( $_POST["id_objet"], $name );

            if ($bool) 
            {
                header('location: home.php');
            }
            else
            {
                die('erreur');
            }
        }
    }
?>