<!DOCTYPE html>
<!-- autor: Cledson Cavalcanti -->
    <div id="content" class="app">
        <form name="EditorForm" method="POST" action="">
        <div class="bar">
            <div style>
                <input name="e_titulo" id="titulo" type="text" value="Novo texto"/>
            </div>
            <div id="buttons_editor">
            <div>
                <img onclick="criarTexto()" src="editor/imgs/bt_new_file.png" alt="criar" width="128" height="128"/>
                <p class="bar_buttons_labels">Limpar</p>
            </div>

            <div>
                <img src="editor/imgs/bt_save_file.png" onclick="salvarTexto()" alt="salvar" width="128" height="128"/>
                <p class="bar_buttons_labels">Salvar</p>
            </div>

            <div>
                <a href="index.php"><img src="editor/imgs/bt_close.png" width="128" height="128" alt="fechar"/></a>
                <p>Fechar</p>
            </div>
            </div>
        </div>

        <br/>

        <textarea name="e_texto" id="texto" rows="20"></textarea>
        </form>
    </div>

    <script>
        function criarTexto() {
            var texto = document.getElementById("texto").value;
            var discard=1;
            if (texto!=null){
                if (texto!=""){
                    var ans = prompt("Descartar texto? [\"sim ou \"nao\", sem acento]", "nao");
                    if (ans.toLowerCase()=="sim"){
                        discard=1;
                    } else discard=0;
                }
            }
            if (discard==1){
		location.href = "index.php?opcao=novo_texto";
            }
        }
        function salvarTexto() {
            document.forms["EditorForm"].submit();
        }
    </script>
    <?php
        if ($_GET["opcao"]=="abrir_texto") {
            $id = $_GET["id"];
            $paraAtualizar=1;
            $link = mysqli_connect("127.0.0.1", "root", "lesh1234", "edtextos");
                mysqli_set_charset($link, "utf8");
                if ($link->connect_error) {
                    echo '<script>alert("Falha ao tentar conectar ao banco de dados!");</script>';
                } else {
                    $querystring = "SELECT usuarios_id, titulo, texto FROM textos WHERE id=$id;";
                    $res = $link->query($querystring);
                    if ($res->num_rows > 0) {
                        while($linha = $res->fetch_assoc()){
                            if ($linha["usuarios_id"]==$_SESSION["USER"]["ID"]) {
                                echo '<script>';
                                echo 'document.getElementById("titulo").value="'.addslashes($linha["titulo"]).'";';
                                echo 'document.getElementById("texto").value="'.str_replace("\r", "", str_replace("\n", "\\n", $linha["texto"])).'";';
                            echo "</script>";
                            }
                        }
                    } else {
                        echo '<script>alert("Erro fatal: impossível abrir o texto!");</script>';
                    }
                    $link->close();
                }
        }

        if (isset($_POST["e_titulo"])) {
            if (empty($_POST["e_titulo"])) {
                echo '<script>alert("O texto necessita de um título!");</script>';
            } else {
                $link = mysqli_connect("127.0.0.1", "root", "lesh1234", "edtextos");
                mysqli_set_charset($link,"utf8");
                if ($link->connect_error) {
                    echo '<script>alert("Falha ao tentar conectar ao banco de dados!");</script>';
                } else {
                    $querystring = 'SELECT id FROM textos WHERE usuarios_id='.$_SESSION["USER"]["ID"].' AND id="'.$_GET["id"].'";';
                    $res1 = $link->query($querystring);
                    if ($res1->num_rows > 0) {
                        if($paraAtualizar==1) {
                            $querystring = 'UPDATE textos SET titulo="'.addslashes($_POST["e_titulo"]).'", texto="'.addslashes($_POST["e_texto"]).'" WHERE usuarios_id='.$_SESSION["USER"]["ID"].' AND id='.$_GET["id"].';';
                            if ($link->query($querystring)) {
                                echo '<script>location.href = "index.php?opcao=abrir_texto&id='.$_GET["id"].'"</script>';
                            } else {
                                echo '<script>alert("Falha ao tentar salvar!");</script>';
                            }
                        } else {
                            echo '<script>alert("Tente um título diferente!");</script>';
                        }
                    } else {
                        $querystring = 'INSERT INTO textos(usuarios_id, titulo, texto) VALUES('.$_SESSION["USER"]["ID"].', "'.addslashes($_POST["e_titulo"]).'", "'.addslashes($_POST["e_texto"]).'");';
                        if ($res = $link->query($querystring)) {
                            echo '<script>location.href = "index.php"</script>';
                        } else {
                            echo '<script>alert("Falha ao tentar salvar!");</script>';
                        }
                    }
                }
                $link->close();
            }
        }
     ?>
