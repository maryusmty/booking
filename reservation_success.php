<?php
session_start();

$details = $_SESSION['reservation_details'];

?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Rezervare Confirmată</title>
  
      <!-- font awesome style -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
</head>
<style>
    /* Stilizare generală */
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .card-header {
        background-color: #ffc107;
        color: white;
        border-radius: 10px 10px 0 0;
        padding: 20px;
    }

    .card-title {
        margin-bottom: 10px;
        font-size: 1.8rem;
    }

    .card-text {
        font-size: 1.2rem;
    }

    .card-body .summary p {
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .card-footer {
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 0 0 10px 10px;
    }

    .card-footer .btn {
        padding: 10px 20px;
        font-size: 1.1rem;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .alert-warning {
        background-color: #ffc107;
        color: white;
    }

    .icon-large {
        font-size: 4rem;
        color: #ffc107;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .text-center {
        text-align: center !important;
    }
</style>
<body>
<?php include('includes/header.php'); ?>

<div class="container mt-5">
    <div class="wizard-step active">
        <div class="form-section">
            <div class="card">
                <div class="card-header text-center">
                <i class="fas fa-exclamation-triangle fa-4x"></i>
                    <h4 class="card-title mt-3">Rezervare înregistrată cu succes!</h4>
                    <div class="alert alert-secondary" role="alert">
                    <b>Rezervarea ta a ajuns la noi, pentru a nu exista neplăceri în sejurul dumneavoastră trebuie să analizăm cererea de rezervare. <br>
                    Când rezervarea o să fie confirmată de către un administrator, o să fiți contactat de către un reprezentant.</b> <br>
                    Detaliile rezervarii au fost transmise si pe mail-ul dumneavoastră.
                </div>
                </div>
                <div class="card-body">
                    <!-- Conținutul cardului -->
                    <div class="summary">
                        <!-- Aici sunt detaliile rezervării -->
                        <div class="row mb-3">
                            <div class="col-md-4 text-center">
                                <i class="fas fa-user-circle fa-2x"></i>
                                <p><strong>Nume client:</strong></p>
                                <p><?php echo htmlspecialchars($details['nume_client']); ?></p>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-phone fa-2x"></i>
                                <p><strong>Telefon:</strong></p>
                                <p><?php echo htmlspecialchars($details['phone']); ?></p>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-envelope fa-2x"></i>
                                <p><strong>Email:</strong></p>
                                <p><?php echo htmlspecialchars($details['mail']); ?></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-center">
                                <i class="fas fa-bed fa-2x"></i>
                                <p><strong><?php echo $details['type'] == 'room' ? 'Camera rezervată:' : 'Denumire pachet:'; ?></strong></p>
                                <p><?php echo htmlspecialchars($details['type'] == 'room' ? $details['room_name'] : $details['package_name']); ?></p>
                            </div>
                            
                            <?php 
                                $checkinFormat = date('d/m/Y', strtotime($details['checkin']));
                                $checkoutFormat = date('d/m/Y', strtotime($details['checkout']));
                            ?>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-calendar-alt fa-2x"></i>
                                <p><strong>Perioada rezervată:</strong></p>
                                <p class="text-muted">Inceput - Sfarsit</p>
                                <p><?php echo $checkinFormat.' - '.$checkoutFormat ?></p>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-info-circle fa-2x"></i>
                                <p><strong>Informații suplimentare:</strong></p>
                                <p><?php echo htmlspecialchars($details['clientNotes']); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <i class="fas fa-money-bill-wave fa-2x"></i>
                                <p><strong>Preț total:</strong></p>
                                <p><?php echo htmlspecialchars($details['price']); ?> RON</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="index.php" class="btn btn-success">Înapoi la pagina principală</a>
                    <a href="contact.php" class="btn btn-primary">Contactează-ne</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</body>
</html>
<?php 
//unset($_SESSION['reservation_details']);
?>
