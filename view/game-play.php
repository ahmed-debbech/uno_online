<?php session_start();?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="game-play-theme.css">
    </head>
    <body>
        <center>
            <table id="players" border="3px">
                <tr>
                    <td>Name1 - rest: 5</td>
                    <td>Name2 - rest: 7</td>
                    <td>Name3 - rest: 4</td>
                </td>
                </tr>
            </table>
            <table id="floor" border="3px">
                <tr>
                    <td></td>
                </tr>
            </table>
            <h4>Click on a card to play</h4>
            <table>
                <tr>
                    <td>
                        <input type="button" value="Stack">
                    </td>
                    <td><table border="2px">
                        <tr> <td>
                        <?php
                            foreach($_SESSION as $elem){
                                echo $elem->getName();
                            }
                        ?> </td>
                        </tr>
                    </table></td>
                    <td>
                        You
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>