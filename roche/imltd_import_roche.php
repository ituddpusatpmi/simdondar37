<!DOCTYPE html>
<html lang="en">
<?php
require_once('clogin.php');
require_once('config/db_connect.php');
?>
    <head>
        <title>SIMDONDAR ROCHE</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Creative CSS3 Animation Menus" />
        <meta name="keywords" content="menu, navigation, animation, transition, transform, rotate, css3, web design, component, icon, slide" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="roche/roche.css" />
        <link rel="stylesheet" type="text/css" href="roche/roche_style.css" />
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
                        <a href="pmiimltd.php?module=rochelistkonfirmasi">
                            <span class="ca-icon">&#46</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Konfirmasi</h2>
                                <h3 class="ca-sub">Konfirmasi LIS Cobas 60000</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pmiimltd.php?module=rochelistkonfirmasi1">
                            <span class="ca-icon">&#113</span>
                            <div class="ca-content">
                                <h2 class="ca-main">List Data</h2>
                                <h3 class="ca-sub">Data yang sudah Konfirmasi</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pmiimltd.php?module=rochesampledetail">
                            <span class="ca-icon">&#178</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Detail Sample</h2>
                                <h3 class="ca-sub">Hasil detail sample IMLTD</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pmiimltd.php?module=rochereagen">
                            <span class="ca-icon">&#90</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Reagen</h2>
                                <h3 class="ca-sub">Reagensia Cobas 6000</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pmiimltd.php?module=rochecontrol">
                            <span class="ca-icon">&#83</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Kontrol</h2>
                                <h3 class="ca-sub">Kontrol Reagensia Cobas 6000</h3>
                            </div>
                        </a>
                    </li>
                </ul>
            </div><!-- content -->
            </td>
                <td>
            	<font size="5" color=00008B><b>Cobas 6000</b> Analyzer -Roche Diagnostics</b></font><br>
            	<div class="zoom">
            		<img src="roche/cobas.png"></div> 
            	</td>
            </tr>
            </table>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    </body>
</html>
