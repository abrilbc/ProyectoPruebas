<?php

require_once '../../configuracion.php';
require_once '../controller/AbmPersona.php';
require_once '../controller/AbmCarrera.php';
require_once '../model/Persona.php';
require_once '../model/Carrera.php';

use controller\AbmPersona;

$objAbmPersona = new AbmPersona();
$colPersonas = $objAbmPersona->listarPersonas();
$msj = '';

if (count($colPersonas) > 0) {

    $msj = <<<HTML
    <table class="table table-striped table-bordered">
        <thead class="table-success">
            <tr>
                <th>Legajo</th>
                <th>Nombre</th>
                <th>Carrera</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
    HTML;

    foreach ($colPersonas as $persona) {

        $nombreCarreras = $persona->getObjCarrera()->getNombre();
        $nombreRol = $persona->getObjRol()->getNombre();
        $msj .= <<<FILA
        <tr>
            <td>FAI-{$persona->getLegajo()}</td>
            <td>{$persona->getNombre()}</td>
            <td>{$nombreCarreras}</td>
            <td>{$nombreRol}</td>
        </tr>
        FILA;
    }

    $msj .= <<<HTML
        </tbody>
    </table>
    HTML;
} else {
    $msj = <<<HTML
    <div class="alert alert-warning" role="alert">
        No hay personas cargadas.
    </div>
    HTML;
}

include_once 'Estructura/header.php';
?>

<div class="container mt-5">
    <h1 class="text-center">Listar Personas</h1>
    <div class="mt-4">
        <?php if ($msj): ?>
            <?php echo $msj; ?>
        <?php endif; ?>
    </div>
    <div class="d-flex justify-content-center mt-4">
        <a onclick="history.back()" class="btn btn-secondary fs-5">Volver al Inicio</a>
    </div>
</div>

</body>
</html>
