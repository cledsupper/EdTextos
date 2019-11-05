<!DOCTYPE html>
<!-- autor: Cledson Ferreira -->
   <div id="content" class="session">
      <form name="FORMREGISTER" method="POST" action="">
        <label>Usuário</label><br/>
        <input name="R_USER" type="text" size="25" maxlength="32"/><br/>
        <br/>
        <label>Senha</label><br/>
        <input name="R_PASS" type="password" size="25" maxlength="32"/><br/>
        <br/>
        <button type="submit">Criar conta</button>
      </form>
      <br/>
      <p>OU</p>
      <p>Volte para o <a href="index.php">início</a>.</p>
   </div>

   <?php
        if (isset($_POST["R_USER"])) {
            if (empty($_POST["R_USER"]) || empty($_POST["R_PASS"])) {
                echo "<script>alert('Cadê o usuário e a senha???');</script>";
            } else {
                $usuario = addslashes($_POST["R_USER"]);
                $senha = addslashes($_POST["R_PASS"]);
                $link = mysqli_connect("127.0.0.1", "root", "lesh1234", "edtextos");
                mysqli_set_charset($link, "utf8");
                if ($link->connect_error) {
                    die("Falha ao conectar: " . $link->connect_error);
                }
                $querystring = "INSERT INTO usuarios(username, password) VALUES(\"$usuario\", \"$senha\");";
                if ($link->query($querystring)) {
                    echo '<script>location.href = "index.php";</script>';
                } else {
                    echo "<script>alert('Erro enquanto criava usuário!');</script>";
                }
                $link->close();
            }
        }
    ?>
