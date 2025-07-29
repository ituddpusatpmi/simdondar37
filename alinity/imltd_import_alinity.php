<!DOCTYPE html>
<html lang="en">
<?php
require_once('clogin.php');
require_once('config/db_connect.php');
?>
    <head>
        <title>SIMDONDAR ALINITY I</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Creative CSS3 Animation Menus" />
        <meta name="keywords" content="menu, navigation, animation, transition, transform, rotate, css3, web design, component, icon, slide" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="alinity/alinity.css" />
        <link rel="stylesheet" type="text/css" href="alinity/alinity_style.css" />
        <link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css' />
        <style>
            .zoom {
                padding: 20px;
                transition: transform .5s; /* Animation */
                margin: 0 auto;
            }

            .zoom:hover {
                transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
            }
        </style>
    </head>
    <body>
    	<br><br>
        <table border="0" >
        <tr>
        <td width="450px">
            
            <div>

                <ul class="ca-menu">
                    <li>
                        <a href="pmiimltd.php?module=alinitylistkonfirmasi">
                            <span class="ca-icon">&#46</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Konfirmasi</h2>
                                <h3 class="ca-sub">Konfirmasi LIS Alinity i</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pmiimltd.php?module=alinitylistkonfirmasi1">
                            <span class="ca-icon">&#113</span>
                            <div class="ca-content">
                                <h2 class="ca-main">List Data</h2>
                                <h3 class="ca-sub">Data yang sudah Konfirmasi</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pmiimltd.php?module=alinitysampledetail">
                            <span class="ca-icon">&#178</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Detail Sample</h2>
                                <h3 class="ca-sub">Hasil detail sample IMLTD</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pmiimltd.php?module=alinityreagen">
                            <span class="ca-icon">&#90</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Reagen</h2>
                                <h3 class="ca-sub">Reagensia Alinity i</h3>
                            </div>
                        </a>
                    </li>
                    
                </ul>
            </div><!-- content -->
            </td>
                <td>
            	<font size="5" color=00008B><b>Alinity i</b> - Abbott</b></font><br>
            	<div class="zoom">
            		<img src="alinity/alinity.png"></div> 
            	</td>
            </tr>
            </table>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    </body>
</html>
