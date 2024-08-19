<?php
session_start();
require 'admin/db.php'; 

// Preluarea tipului de rezervare (camera sau pachet)
$type = $_GET['type'] ?? 'room'; // Implicit este 'room' dacă tipul nu este definit

// Preluarea detaliilor relevante pentru rezervare
if ($type == 'room') {
    $id = $_GET['room_id'] ?? null;
    $query = "SELECT * FROM rooms WHERE id = :id";
} else {
    $id = $_GET['package_id'] ?? null;
    $query = "SELECT * FROM packeges WHERE id = :id";
}

$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$details = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificăm dacă detaliile există, dacă nu, aruncăm o eroare
// if (!$details) {
//     $_SESSION['error_message'] = "Rezervarea selectată nu există.";
//     header('Location: rooms.php');
//     exit();
// }

$checkin = $_GET['checkin'] ?? null;
$checkout = $_GET['checkout'] ?? null;
if ($type == 'room') {
    // Calculul numărului de nopți
    $checkinDate = new DateTime($checkin);
    $checkoutDate = new DateTime($checkout);
    $interval = $checkinDate->diff($checkoutDate);
    $nights = $interval->days;

    // Calculul prețului total în funcție de zilele săptămânii și weekend
    $totalPrice = 0;
    $currentDate = $checkinDate;

    while ($currentDate < $checkoutDate) {
        $dayOfWeek = $currentDate->format('N'); // 1 (Luni) -> 7 (Duminică)
        if ($dayOfWeek >= 6) {
            // Zilele de weekend (Sâmbătă, Duminică)
            $totalPrice += $details['pret_weekend'];
        } else {
            // Zilele din săptămână (Luni -> Vineri)
            $totalPrice += $details['pret_saptamana'];
        }
        $currentDate->modify('+1 day');
    }
} else {
    // În cazul unui pachet, folosim prețul predefinit
    $totalPrice = $details['pret'];
}

?>

<!DOCTYPE html>
<html lang="ro">
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="hotel, camere, rezervări, prețuri" />
  <meta name="description" content="Vizualizează și rezervă camerele noastre de hotel, cu prețuri atractive și facilități excelente." />
  <meta name="author" content="Numele hotelului" />
  <link rel="icon" href="images/favicon.png" type="image/gif" />
  <title><?php echo $webPageName; ?></title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />

  <!-- lightbox Gallery-->
  <link rel="stylesheet" href="css/ekko-lightbox.css" />

  <!-- font awesome style -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            padding-top: 20px;
        }

        .bookcontainer {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 30px;
        }

        .form-section {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: all 0.3s ease-in-out;
        }

        .form-section h4 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #3e9598;
            border-bottom: 2px solid #3e9598;
            padding-bottom: 10px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-group input, .form-group textarea {
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            margin-top: 5px;
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: #3e9598;
            outline: none;
        }

        .wizard-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .wizard-navigation button {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .wizard-navigation .btn-primary {
            background-color: #3e9598;
            border: none;
            color: #fff;
        }

        .wizard-navigation .btn-primary:hover {
            background-color: #357d7a;
        }

        .wizard-navigation .btn-secondary {
            background-color: #6c757d;
            border: none;
            color: #fff;
        }

        .wizard-navigation .btn-secondary:hover {
            background-color: #5a6268;
        }

        .step-counter {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .step-counter .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            margin: 0 10px;
            position: relative;
            z-index: 1;
        }

        .step-counter .step.active {
            background-color: #3e9598;
        }

        .step-counter .step::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            width: 40px;
            height: 2px;
            background-color: #ddd;
            transform: translateY(-50%);
            z-index: 0;
        }

        .step-counter .step:last-child::after {
            display: none;
        }

        .wizard-step {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .wizard-step.active {
            display: block;
            opacity: 1;
        }

        .summary p {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #333;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .card-header {
            background-color: #3e9598;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 20px;
        }

        .card-footer {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 0 0 10px 10px;
        }

        .card-footer .btn {
            padding: 10px 20px;
            font-size: 1rem;
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>

<div class="bookcontainer mt-5">
    <h2 class="text-center mb-5">Confirmare Rezervare</h2>
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <!-- Numărătoarea pasului curent -->
    <div class="step-counter">
        <div class="step active" data-step="1">1</div>
        <div class="step" data-step="2">2</div>
        <div class="step" data-step="3">3</div>
    </div>

    <form id="bookingWizardForm" action="functions/process_booking.php" method="POST">
        <input type="hidden" name="<?php echo $type == 'room' ? 'room_id' : 'package_id'; ?>" value="<?php echo $id; ?>">
        <input type="hidden" name="checkin" value="<?php echo $checkin; ?>">
        <input type="hidden" name="checkout" value="<?php echo $checkout; ?>">
        <input type="hidden" name="type" value="<?php echo $type; ?>">
        <input type="hidden" name="price" value="<?php echo htmlspecialchars($totalPrice); ?>">

        <?php 
                $checkinFormat = date('d/m/Y', strtotime($checkin));
                $checkoutFormat = date('d/m/Y', strtotime($checkout));
        
        ?>

        <!-- Pasul 1: Detalii rezervare -->
        <div class="wizard-step active">
            <div class="form-section">
                <h4>Detalii rezervare</h4>
                <div class="summary">
                    <p><strong><?php echo $type == 'room' ? 'Camera:' : 'Pachet:'; ?></strong> <?php echo htmlspecialchars($details['nume_camera'] ?? $details['denumire_pachet']); ?></p>
                    <p><strong>Capacitate:</strong> <?php echo htmlspecialchars($details['capacitate_camera'] ?? 'Tot pachetul'); ?></p>
                    <p><strong>Check-in:</strong> <?php echo htmlspecialchars($checkinFormat); ?></p>
                    <p><strong>Check-out:</strong> <?php echo htmlspecialchars($checkoutFormat); ?></p>
                    <p><strong>Preț total:</strong> <?php echo htmlspecialchars($totalPrice); ?> RON</p>
                </div>
                <div class="wizard-navigation">
                <a href="rooms.php"><button type="button" class="btn btn-secondary">Înapoi</button></a>
                <button type="button" class="btn btn-primary" onclick="changeStep(1)">Înainte</button>
                </div>
            </div>
        </div>

        <!-- Pasul 2: Datele clientului -->
        <div class="wizard-step">
            <div class="form-section">
                <h4>Datele clientului</h4>
                <div class="form-group">
                    <label for="clientName">Nume complet:</label>
                    <input type="text" id="clientName" name="clientName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="clientPhone">Telefon:</label>
                    <input type="tel" id="clientPhone" name="clientPhone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="clientEmail">Email:</label>
                    <input type="email" id="clientEmail" name="clientEmail" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="clientNotes">Indicații pentru rezervare:</label>
                    <textarea id="clientNotes" name="clientNotes" class="form-control" rows="4"></textarea>
                </div>
                <div class="wizard-navigation">
                    <button type="button" class="btn btn-secondary" onclick="changeStep(-1)">Înapoi</button>
                    <button type="button" class="btn btn-primary" onclick="changeStep(1)">Înainte</button>
                </div>
            </div>
        </div>

        <!-- Pasul 3: Confirmarea rezervării -->
        <div class="wizard-step">
            <div class="form-section">
                <h4>Confirmare rezervare</h4>
                <p>Verificați detaliile și confirmați rezervarea.</p>
                <div class="wizard-navigation">
                    <button type="button" class="btn btn-secondary" onclick="changeStep(-1)">Înapoi</button>
                    <?php 
                    if($type == "room"){                    
                        echo '<button type="submit" class="btn btn-primary">Confirmați și Rezervați</button>';
                    }elseif ($type == "package") {
                        echo '<button type="submit" class="btn btn-primary">Confirmați și Rezervați</button>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
let currentStep = 0;
const totalSteps = document.querySelectorAll(".wizard-step").length;

function showStep(step) {
    const steps = document.querySelectorAll(".wizard-step");
    const stepCircles = document.querySelectorAll(".step-counter .step");

    steps.forEach((stepElement, index) => {
        if (index === step) {
            stepElement.classList.add('active');
            enableInputs(stepElement);
        } else {
            stepElement.classList.remove('active');
            disableInputs(stepElement);
        }
    });

    stepCircles.forEach((circle, index) => {
        if (index === step) {
            circle.classList.add('active');
        } else {
            circle.classList.remove('active');
        }
    });
}

function changeStep(n) {
    const steps = document.querySelectorAll(".wizard-step");

    disableInputs(steps[currentStep]);

    currentStep += n;

    if (currentStep >= steps.length) {
        steps.forEach(stepElement => enableInputs(stepElement));
        document.getElementById("bookingWizardForm").submit();
        return;
    }

    showStep(currentStep);
}

function enableInputs(element) {
    const inputs = element.querySelectorAll("input, textarea, select, button");
    inputs.forEach(input => {
        input.disabled = false;
    });
}

function disableInputs(element) {
    const inputs = element.querySelectorAll("input, textarea, select, button");
    inputs.forEach(input => {
        input.disabled = true;
    });
}

showStep(currentStep);

document.getElementById('bookingWizardForm').addEventListener('submit', function(event) {
    document.querySelectorAll(".wizard-step").forEach(stepElement => enableInputs(stepElement));
});
</script>

<?php include('includes/footer.php'); ?>
</body>
</html>
