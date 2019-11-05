<?php
   session_start();
?>
<!-- autor: Cledson Ferreira -->
<html>
<head>
   <title id="titulo1">EdTextos</title>
   <meta charset="utf-8"/>
   <link rel="stylesheet" type="text/css" href="estilo.css"/>
   <link href="favicon-64.png" rel="icon" type="image/png" />
</head>
<body>
   <?php
        if (isset($_SESSION["USER"])) {
            // esta variável é apenas para o site saber qual título deve colocar
            $arquivo = "editor/index.php";
            if (isset($_GET["opcao"])) {
                if ($_GET["opcao"]=="novo_texto" || $_GET["opcao"]=="abrir_texto") {
                    include 'editor/editor.php';
                }
            } else {
                include 'editor/index.php';
            }
        } else if (empty($_GET)){
            include 'login.php';
            $arquivo = "login.php";
        } else if ($_GET["page"]=="register"){
            include 'register.php';
            $arquivo = "register.php";
        } else {
            include '404.php';
            $arquivo = "404.php";
        }
    ?>
    <div id="bar_top">
      <img src="favicon-64.png" width="64px" height="64px" style="top: 4px;"/>
      <h3 id="titulo2" style="top: -10px;">EdTextos</h3>
   </div>

   <!-- apenas para a funcionalidade da barra de títulos -->
   <?php
        if ($arquivo == "login.php") {
            echo "<script>
                    document.getElementById(\"titulo2\").innerHTML =
                        document.getElementById(\"titulo1\").innerHTML =
                        \"EdTextos: iniciar sessão\";
                    </script>";
        }
        if ($arquivo == "register.php") {
                echo "<script>
                    document.getElementById(\"titulo2\").innerHTML =
                        document.getElementById(\"titulo1\").innerHTML =
                        \"EdTextos: criar conta\";
                    </script>";
        }
        if ($arquivo == "editor/index.php") {
                echo "<script>
                    document.getElementById(\"titulo2\").innerHTML =
                        document.getElementById(\"titulo1\").innerHTML =
                        \"EdTextos". (isset($_SESSION["USER"]) ? ": ".$_SESSION["USER"]["NAME"] : "") ."\";
                    </script>";
        }
        if ($arquivo == "404.php") {
                echo "<script>
                    document.getElementById(\"titulo2\").innerHTML =
                        document.getElementById(\"titulo1\").innerHTML =
                        \"EdTextos: erro 404: página não encontrada!\";
                    </script>";
        }
    ?>
</body>
</html>
