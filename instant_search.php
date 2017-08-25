<?php session_start(); ?>
<html>
<head>
    <style>
        a:active,
        a:hover,
        a:link,
        a:visited {
        color: #000;
        }

        .btn {
        display: inline-block;
        padding: 10px;
        border-radius: 6px;
        border: 2px solid #000;
        background: #FFF;
        cursor: pointer;
        font-weight: 700;
        vertical-align: middle;
        text-decoration: none;
        box-shadow: inset 0 -2px 0 2px #bbe9dc;
        width: 150px;
        }

        a:hover {
        box-shadow: inset 0 -2px 0 2px #FFEB3B;
        color: red;
        }

        a:visited {
        color: #AAA;
        box-shadow: inset 0 -2px 0 2px #CCC;
        border-color: #CCC
        }
    </style>
</head>

<?php
    
    $temp_arr = $_SESSION["temp_search"];
    $q = $_REQUEST["q"];
    $hint = "";
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);
        foreach($temp_arr as $name) {
            if (stristr($q, substr($name, 0, $len))) {
                if ($hint === "") {
                    $hint = "<button class='btn'>$name</button><br>";
                } else {
                    $hint .= "<button class='btn'>$name</button><br>";
                }
            }
        }
    }
    echo $hint === "" ? "<b><p style='font-weight: 700; padding: 20px; font-size: 2em;'>Did Not Match Any Results !!!" : $hint;
?>
</html>
