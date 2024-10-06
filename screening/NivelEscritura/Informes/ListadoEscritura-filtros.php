    <!-- FILTROS -->
    <div class="filters-container">
        <!-- Filtro por Nombre -->
        <div class="filter-box">
            <form method="get" action="">
                <label for="nombre"><center>Nombre:</center></label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($filtro_nombre); ?>">
                <input type="hidden" name="apellido" value="<?php echo $filtro_apellido; ?>">
                <input type="hidden" name="grado" value="<?php echo $filtro_grado; ?>">
                <input type="hidden" name="division" value="<?php echo $filtro_division; ?>">
                <input type="hidden" name="trimestre" value="<?php echo $filtro_trimestre; ?>">
                <input type="hidden" name="anio" value="<?php echo $filtro_anio; ?>">
                <input type="hidden" name="items_per_page" value="<?php echo isset($_GET['items_per_page']) ? $_GET['items_per_page'] : 10; ?>">
                <button type="submit">Buscar</button>
            </form>
        </div>

        <!-- Filtro por Apellido -->
        <div class="filter-box">
            <form method="get" action="">
                <label for="apellido"><center>Apellido:</center></label>
                <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($filtro_apellido); ?>">
                <input type="hidden" name="nombre" value="<?php echo $filtro_nombre; ?>">
                <input type="hidden" name="grado" value="<?php echo $filtro_grado; ?>">
                <input type="hidden" name="division" value="<?php echo $filtro_division; ?>">
                <input type="hidden" name="trimestre" value="<?php echo $filtro_trimestre; ?>">
                <input type="hidden" name="anio" value="<?php echo $filtro_anio; ?>">
                <input type="hidden" name="items_per_page" value="<?php echo isset($_GET['items_per_page']) ? $_GET['items_per_page'] : 10; ?>">
                <button type="submit">Buscar</button>
            </form>
        </div>

        <!-- Filtro por Grado y division-->
        <div class="filter-box">
            <form method="get" action="">
                <label for="grado"><center>Grado:</center></label>
                <select name="grado" id="grado" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    <?php foreach ($grados as $grado): ?>
                        <option value="<?php echo $grado; ?>" <?php if ($grado === $filtro_grado) echo 'selected'; ?>>
                            <?php echo $grado; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
  
                <label for="division"><center>División:</center></label>
                <select name="division" id="division" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    <?php foreach ($divisiones as $division): ?>
                        <option value="<?php echo $division; ?>" <?php if ($division === $filtro_division) echo 'selected'; ?>>
                            <?php echo $division; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="nombre" value="<?php echo $filtro_nombre; ?>">
                <input type="hidden" name="apellido" value="<?php echo $filtro_apellido; ?>">
                <input type="hidden" name="trimestre" value="<?php echo $filtro_trimestre; ?>">
                <input type="hidden" name="anio" value="<?php echo $filtro_anio; ?>">
                <input type="hidden" name="items_per_page" value="<?php echo isset($_GET['items_per_page']) ? $_GET['items_per_page'] : 10; ?>">
            </form>
        </div>

        <!-- Filtro por trimestre y anio-->
        <div class="filter-box">
            <form method="get" action="">
                <label for="trimestre"><center>Trimestre:</center></label>
                <select name="trimestre" id="trimestre" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    <?php foreach ($trimestres as $trimestre): ?>
                        <option value="<?php echo $trimestre; ?>" <?php if ($trimestre === $filtro_trimestre) echo 'selected'; ?>>
                            <?php echo $trimestre; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
  
                <label for="anio"><center>Año:</center></label>
                <select name="anio" id="anio" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    <?php foreach ($anios as $anio): ?>
                        <option value="<?php echo $anio; ?>" <?php if ($anio === $filtro_anio) echo 'selected'; ?>>
                            <?php echo $anio; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="nombre" value="<?php echo $filtro_nombre; ?>">
                <input type="hidden" name="apellido" value="<?php echo $filtro_apellido; ?>">
                <input type="hidden" name="grado" value="<?php echo $filtro_grado; ?>">
                <input type="hidden" name="division" value="<?php echo $filtro_division; ?>">
                <input type="hidden" name="items_per_page" value="<?php echo isset($_GET['items_per_page']) ? $_GET['items_per_page'] : 10; ?>">
            </form>
        </div>

        <!-- Combo box para seleccionar cantidad de ítems por página -->
        <div class="filter-box">
            <form method="get" action="">
                <label for="items_per_page"><center>Items /<br> página:</center></label>
                <select name="items_per_page" id="items_per_page" onchange="this.form.submit()">
                    <?php foreach ($items_per_page_options as $option): ?>
                        <option value="<?php echo $option; ?>" <?php if ($results_per_page == $option || ($results_per_page == PHP_INT_MAX && $option === 'todos')) echo 'selected'; ?>>
                            <?php echo ucfirst($option); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="nombre" value="<?php echo $filtro_nombre; ?>">
                <input type="hidden" name="apellido" value="<?php echo $filtro_apellido; ?>">
                <input type="hidden" name="grado" value="<?php echo $filtro_grado; ?>">
                <input type="hidden" name="division" value="<?php echo $filtro_division; ?>">
                <input type="hidden" name="trimestre" value="<?php echo $filtro_trimestre; ?>">
                <input type="hidden" name="anio" value="<?php echo $filtro_anio; ?>">
            </form>
            <!-- <button onclick="window.print()" style="display: inline-block; margin-left: 10px; background: none; border: none; cursor: pointer;"> -->
            <button id="printBtn">
                <i class="fas fa-print" style="font-size: 32px"></i>
            </button>
        </div>
    </div>