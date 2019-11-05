<!DOCTYPE html>
<!-- autor: Cledson Ferreira -->
   <div id="content" class="session">
      <form name="FORMLOGIN" method="POST" action="">
        <label>Usuário</label><br/>
        <input name="L_USER" type="text" size="25" maxlength="32"/><br/>
        <br/>
        <label>Senha</label><br/>
        <input name="L_PASS" type="password" size="25" maxlength="32"/><br/>
        <br/>
        <button type="submit">Iniciar sessão</button>
      </form>
      <br/>
      <p>MAS...</p>
      <p>Não tem uma conta? <a href="index.php?page=register">Crie aqui!</a></p>
      <!--<p>Esqueceu a senha? <a href="recover.php">Recupere!</a></p>-->
   </div>

   <?php
        if (isset($_POST["L_USER"])) {
            if (empty($_POST["L_USER"]) || empty($_POST["L_PASS"])) {
                echo "<script>alert('Cadê o usuário e a senha???');</script>";
            } else {
                $link = mysqli_connect("127.0.0.1", "root", "lesh1234", "edtextos");
                mysqli_set_charset($link, "utf8");

                if ($link->connect_error) {
                    echo "<script>alert(\"Falha ao tentar conectar ao banco de dados!\");</script>";
                } else {
                    $usuario = addslashes($_POST["L_USER"]);
                    $senha = addslashes($_POST["L_PASS"]);

                    mysqli_set_charset($link, "utf8");

                    if ($link->connect_error) {
                        die("Falha ao conectar: " . $conn->connect_error);
                    }

                    $querystring = "SELECT * FROM usuarios WHERE username=\"$usuario\" AND password=\"$senha\";";
                    $res = $link->query($querystring);
                    if ($res->num_rows > 0) {
                        while ($linha = $res->fetch_assoc()){
                            $_SESSION["USER"]["ID"] = $linha["id"];
                            $_SESSION["USER"]["NAME"] = $linha["username"];
                            echo '<script>location.href = "index.php";</script>';
                        }
                    } else {
                        echo "<script>alert(\"Usuário ou senha incorretos, tente novamente!\");</script>";
                    }
                    $link->close();
                }
            }
        }
    ?>
