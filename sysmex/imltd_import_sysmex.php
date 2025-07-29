<!DOCTYPE html>
<html lang="en">
<?php
require_once('clogin.php');
require_once('config/db_connect.php');
?>
    <head>
        <title>SIMDONDAR SYSMEX</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Creative CSS3 Animation Menus" />
        <meta name="keywords" content="menu, navigation, animation, transition, transform, rotate, css3, web design, component, icon, slide" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="sysmex/sysmex.css" />
        <link rel="stylesheet" type="text/css" href="sysmex/sysmex_style.css" />
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
                        <a href="pmiimltd.php?module=sysmexlistkonfirmasi">
                            <span class="ca-icon">&#46</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Konfirmasi</h2>
                                <h3 class="ca-sub">Konfirmasi LIS HISCL - 5000</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pmiimltd.php?module=sysmexlistkonfirmasi1">
                            <span class="ca-icon">&#113</span>
                            <div class="ca-content">
                                <h2 class="ca-main">List Data</h2>
                                <h3 class="ca-sub">Data yang sudah Konfirmasi</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pmiimltd.php?module=sysmexsampledetail">
                            <span class="ca-icon">&#178</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Detail Sample</h2>
                                <h3 class="ca-sub">Hasil detail sample IMLTD</h3>
                            </div>
                        </a>
                    </li>
                    <!--<li>
                        <a href="pmiimltd.php?module=sysmexreagen">
                            <span class="ca-icon">&#90</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Reagen</h2>
                                <h3 class="ca-sub">Reagensia HISCL - 800</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="pmiimltd.php?module=sysmexcontrol">
                            <span class="ca-icon">&#83</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Kontrol</h2>
                                <h3 class="ca-sub">Kontrol Reagensia HISCL - 800</h3>
                            </div>
                        </a>
                    </li>-->
                </ul>
            </div><!-- content -->
            </td>
                <td>
            	<font size="5" color=00008B><b>HISCL - 5000</b> Analyzer - Sysmex</b></font><br>
            	<div class="zoom">
            		<img src="sysmex/hiscl-new.png"></div> 
            	</td>
            </tr>
            </table>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    </body>
</html>
