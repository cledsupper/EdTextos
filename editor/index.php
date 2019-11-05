<!DOCTYPE html>
<!-- autor: Cledson Cavalcanti -->
    <div id="content" class="app">
        <div class="bar">
            <div style>
                <p id="qtd_textos" style="font-size: 1.2em; text-align: left; font-weight: bold">Nenhum texto</p>
            </div>
            <div id="buttons_home">
            <div>
                <a href="index.php?opcao=novo_texto"><img src="editor/imgs/bt_new_file.png" alt="criar" width="128" height="128"/></a>
                <p class="bar_buttons_labels">Criar</p>
            </div>

            <div>
                <a href="logoff.php"><img src="editor/imgs/bt_close.png" width="128" height="128" alt="sair"/></a>
                <p>Sair</p>
            </div>
            </div>
        </div>

        <br/>

        <div id="editor_content">
            <center>
            <form name="FORMBUSCA" method="POST" action="">
                <label>Buscar: </label>
                <input name="ENTRADA" type="text" size="30" maxlength="50" style="height: 64px;"/>
                <button style="top: 14px;" type="submit"><img src="editor/imgs/bt_help.png" width="64" height="64" alt="pesquisar"/></button>
            </form>
            <br/>
            <?php
                $link = mysqli_connect("127.0.0.1", "root", "lesh1234", "edtextos");
                mysqli_set_charset($link, "utf8");
                if ($link->connect_error) {
                    echo "<script>alert(\"Falha ao tentar conectar ao banco de dados!\");</script>";
                } else {
                    if (isset($_POST["ENTRADA"])) {
                        $querystring = "SELECT id, titulo FROM textos WHERE usuarios_id=".$_SESSION["USER"]["ID"]." AND titulo LIKE \"%".$_POST["ENTRADA"]."%\";";
                    } else $querystring = "SELECT id, titulo FROM textos WHERE usuarios_id=".$_SESSION["USER"]["ID"].";";
                    $res = $link->query($querystring);
                    if ($res->num_rows>0) {
                        while($linha = $res->fetch_assoc()){
                            echo "<div class=\"text\">
                                    <p style=\"top: 40px;\"><a href=\"index.php?opcao=abrir_texto&id=".$linha["id"]."\">".$linha["titulo"]."</a></p>
                                  </div>";
                        }
                        echo "<script>document.getElementById(\"qtd_textos\").innerHTML = \"".$res->num_rows." texto(s) encontrado(s)\";</script>";
                    } else {
                        echo "<script>document.getElementById(\"qtd_textos\").innerHTML = \"Nenhum texto\";</script>";
                    }
                    $link->close();
                }
            ?>
            <!--<div class="text">
                <p style="top: 40px;">FILENAME</p>
            </div>-->
            </center>
        </div>
    </div>
