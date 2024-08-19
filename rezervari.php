<?php
session_start();
if (!isset($_SESSION['reservation_details'])) {
    header('Location: index.php');
    exit();
}

$reservation = $_SESSION['reservation_details'];
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Rezervare Confirmată</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
<?php include('includes/header.php'); ?>

<div class="container mt-5">
    <h2 class="text-center mb-5" style="color: #343a40;">Rezervare Confirmată</h2>

    <div class="alert alert-success text-center">
        <h4>Rezervarea ta a fost înregistrată cu succes!</h4>
        <p>Detaliile rezervării tale sunt prezentate mai jos:</p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="summary">
                <div class="row mb-3">
                    <div class="col-md-4 text-center">
                        <i class="fas fa-user-circle fa-2x"></i>
                        <p><strong>Nume client:</strong></p>
                        <p><?php echo htmlspecialchars($reservation['nume_client']); ?></p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-phone fa-2x"></i>
                        <p><strong>Telefon:</strong></p>
                        <p><?php echo htmlspecialchars($reservation['phone']); ?></p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-envelope fa-2x"></i>
                        <p><strong>Email:</strong></p>
                        <p><?php echo htmlspecialchars($reservation['mail']); ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-center">
                        <i class="fas fa-bed fa-2x"></i>
                        <p><strong><?php echo $reservation['type'] == 'room' ? 'Camera rezervată:' : 'Pachet rezervat:'; ?></strong></p>
                        <p><?php echo htmlspecialchars($reservation['room_name'] ?? $reservation['package_name']); ?></p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                        <p><strong>Check-in:</strong></p>
                        <p><?php echo htmlspecialchars($reservation['checkin']); ?></p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                        <p><strong>Check-out:</strong></p>
                        <p><?php echo htmlspecialchars($reservation['checkout']); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                        <p><strong>Preț total:</strong></p>
                        <p><?php echo htmlspecialchars($reservation['price']); ?> RON</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-success">Înapoi la pagina principală</a>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</body>
</html>
