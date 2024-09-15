<header>
    <center>
        <div>
            <a href="/screening/index.php"><img src="/screening/images/LogoJel.png" alt="Logo JEL" class="logo"></a>
            <?php
                echo "<font size=\"8\">".$GLOBALS['titulo']."</font>"; 
            ?>
            <?php
                if (isset($_SESSION['Nombre'])) {
                    echo "<img src='/screening/images/".$_SESSION["Logo"]."' alt='Logo JEL' class='logo'>";    
                }

                // if (isset($_SESSION['Nombre'])) { echo "<br><font size=\"4\">".$_SESSION["Nombre"]."</font>";
                //     } else { echo " - Sesión no inicializada"."</font>"; 
                // }

            ?>
        </div>
    </center>
        <nav>
            <ul class="menu">
            <?php
                if (isset($_SESSION['Nombre'])) {
                    echo "<li><a href=\"/screening/index.php\">Pagina principal</a></li>";
                    echo "<li><a href=\"/screening/_cerrar_session.php\">Cerrar Sesión (".$_SESSION["Nombre"].")</a></li>";
                    if ($_SESSION['Nombre'] == "Admin") {
                        echo "<li><a href=\"/screening/admin/AdminElegirColegio.php\" style=\"color: red;\">Elegir Colegio";
                        if (isset($_SESSION['colegio'])) {
                            echo " (".$_SESSION['colegio'].")";
                        }
                        echo "</a></li>";
                        echo "<li><a href=\"/screening/admin/index.php\" style=\"color: red;\">Admin JEL Aprendizaje</a></li>";
                    }
                } else {
                    echo "<li><a href=\"login/signup.php\">Registrarse</a></li>";
                    echo "<li><a href=\"login/login.php\">Iniciar Sesión</a></li>";
                }
            ?>        
            </ul>
        </nav>
</header>