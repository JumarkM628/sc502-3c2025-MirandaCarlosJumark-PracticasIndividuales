<?php
session_start();



if (!isset($_SESSION['transacciones'])) {
    $_SESSION['transacciones'] = [];
}

if (isset($_GET["limpiar"])) {
    $_SESSION['transacciones'] = [];
    header("Location: index.php");
    exit;
}




$totalContado = 0;
foreach ($_SESSION['transacciones'] as $t) {
    $totalContado += $t['monto'];
}

$totalConInteres = ($totalContado * 0.026);
$cashback = $totalContado * 0.001;
$montoFinal = ($totalConInteres - $cashback)+$totalContado;

// Crea archivo
$contenidoTXT = "ESTADO DE CUENTA\n\n";
foreach ($_SESSION['transacciones'] as $t) {
    $contenidoTXT .= "ID: {$t['id']} - {$t['descripcion']} - ₡{$t['monto']}\n";
}
$contenidoTXT .= "\nMonto de contado: ₡$totalContado";
$contenidoTXT .= "\nMonto con interés (2.6%): ₡$totalConInteres";
$contenidoTXT .= "\nCashback (0.1%): ₡$cashback";
$contenidoTXT .= "\nMonto final: ₡$montoFinal";

file_put_contents("estado_cuenta.txt", $contenidoTXT);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estado de Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">Estado de Cuenta</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Agregar Transacción</h5>
        </div>

        <div class="card-body">
            <form class="row" method="post" action="guardar.php">

                <div class="col-md-3">
                    <label class="form-label">ID</label>
                    <input type="number" name="id" class="form-control" required>
                </div>

                <div class="col-md-5">
                    <label class="form-label">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Monto</label>
                    <input type="number" name="monto" class="form-control" step="0.01" required>
                </div>

                <div class="col-12 text-end mt-3">
                    <button class="btn btn-primary">Agregar</button>
                    <a href="?limpiar=1" class="btn btn-danger">Limpiar datos</a>
                </div>

            </form>

            <hr>

            <?php if (!empty($_SESSION['transacciones'])): ?>

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Descripción</th>
                                <th>Monto (₡)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($_SESSION['transacciones'] as $index => $t): ?>
                            <tr>
                                <td><?= $t['id'] ?></td>
                                <td><?= $t['descripcion'] ?></td>
                                <td><?= $t['monto'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php else: ?>

                <div class="alert alert-info">No hay transacciones registradas</div>

            <?php endif; ?>
        </div>
        
    </div>


    <div class="row g-3 justify-content-center">

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total de Contado</h6>
                    <h3 class="text-success">₡<?= $totalContado ?></h3>
                    <hr>
                    <h6 class="text-muted">Intereses 2.6%</h6>
                    <h3 class="text-danger">₡<?= $totalConInteres ?></h3>
                    <hr>
                    <h6 class="text-muted">Cashback 0.1%</h6>
                    <h3 class="text-primary">₡<?= $cashback ?></h3>
                    <hr>
                    <h6>Monto Final a Pagar</h6>
                    <h3>₡<?= $montoFinal ?></h3>
                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-4">
        <a href="estado_cuenta.txt" class="btn btn-dark" download>Descargar archivo</a>
    </div>

</div>

</body>
</html>


