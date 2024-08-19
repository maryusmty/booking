<?php 

    require 'admin/db.php'; 

    // Interogare SQL pentru a selecta toate pachetele
    $query = "SELECT * FROM packeges WHERE status = 1 ORDER BY id DESC";
    $query_run = $conn->prepare($query);
    $query_run->execute();

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
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

</head>
<style>
  .price-box {
  margin-top: 10px;
}

.price-box h6 {
  font-size: 18px;
  color: #ffffff;
  font-weight: bold;
}
</style>
<body>

<?php include('includes/header.php'); ?>

<!-- service section -->
<section class="service_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Toate Pachetele Noastre
      </h2>
    </div>
    <div class="row">
      <?php 
        // Verificare dacă există pachete
        if($query_run->rowCount() > 0){
            while($row = $query_run->fetch()){
                $id = $row['id'];
                $denumire_pachet = $row['denumire_pachet'];
                $descriere = $row['descriere'];
                $pret = $row['pret'];
                $checkin = $row['start_date'];
                $checkout = $row['end_date'];

      ?>
      <div class="col-md-6 col-lg-4 mx-auto">
        <div class="box">
          <div class="img-box">
            <img src="admin/packege_images/<?php echo htmlspecialchars($row['imagine']); ?>" alt="Imagine pentru <?php echo htmlspecialchars($denumire_pachet); ?>">
          </div>
          <div class="detail-box">
            <h5>
              <?php echo htmlspecialchars($denumire_pachet); ?>
            </h5>
            <p>
              <?php echo htmlspecialchars($descriere); ?>
            </p>
            <div class="price-box">
              <h6>
                Preț: <?php echo htmlspecialchars($pret); ?> RON
              </h6>
            </div>
            <?php 
            echo '<a href="confirmbooking.php?type=package&package_id=' . $id . '&checkin=' . $checkin . '&checkout=' . $checkout . '" class="btn btn-primary">Rezerva acum</a>';
            ?>
            </div>
        </div>
      </div>
      <?php
            }
        } else {
            echo "<div class='col-12 text-center'><p>Nu există pachete disponibile în acest moment.</p></div>";
        }
      ?>
    </div>
  </div>
</section>

  <!-- end service section -->

  <?php include('includes/footer.php'); ?>

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>

</body>

</html>