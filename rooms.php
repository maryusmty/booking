<?php
require 'admin/db.php'; 

// Filtrare camere
$where_clauses = [];
$params = [];

if (isset($_GET['price_min']) && isset($_GET['price_max'])) {
    $price_min = intval($_GET['price_min']);
    $price_max = intval($_GET['price_max']);
    
    if ($price_min > 0 && $price_max >= $price_min) {
        $where_clauses[] = 'pret_saptamana BETWEEN :price_min AND :price_max';
        $params[':price_min'] = $price_min;
        $params[':price_max'] = $price_max;
    }
}

if (isset($_GET['capacity'])) {
    $capacities = array_map('intval', $_GET['capacity']);
    
    if (in_array(5, $capacities)) {
        // Dacă 5+ persoane este selectat, includem și camerele cu capacitate mai mare de 5
        $where_clauses[] = '(capacitate_camera IN (' . implode(',', $capacities) . ') OR capacitate_camera >= 5)';
    } else {
        $where_clauses[] = 'capacitate_camera IN (' . implode(',', $capacities) . ')';
    }
}

if (isset($_GET['facilities'])) {
    $facility_ids = implode(',', array_map('intval', $_GET['facilities']));
    $where_clauses[] = 'id IN (SELECT room_id FROM room_facility WHERE facility_id IN (' . $facility_ids . '))';
}

if (isset($_GET['checkin']) && isset($_GET['checkout'])) {
    $checkin = $_GET['checkin'];
    $checkout = $_GET['checkout'];

    if (!empty($checkin) && !empty($checkout)) {
        $where_clauses[] = 'id NOT IN (SELECT room_id FROM booking_rooms WHERE 
                                       (checkin < :checkout AND checkout > :checkin))';
        $params[':checkin'] = $checkin;
        $params[':checkout'] = $checkout;
    }
}

$where_sql = !empty($where_clauses) ? 'WHERE ' . implode(' AND ', $where_clauses) . ' AND status = 1' : 'WHERE status = 1';

$query = "SELECT * FROM rooms $where_sql ORDER BY id DESC";
$query_run = $conn->prepare($query);
$query_run->execute($params);
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

</head>
<style>
    /* Resetări generale pentru a elimina stilurile nedorite */
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        overflow-x: hidden;
    }

    .container-fluid {
        padding: 0 15px;
    }

    /* Asigură-te că headerul nu este afectat de alte stiluri */
    header {
        padding: 10px 0;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .heading_container h2 {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
    }

    .room-box {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 400px; /* Ajustează înălțimea minimă după necesități */
    margin-bottom: 30px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}
.room-box .img-box {
    height: 200px;
    overflow: hidden;
    background-color: #f8f9fa;
}

.room-box .img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.room-box .detail-box {
    padding: 15px;
    background-color: #ffffff;
    flex-grow: 1; /* Extinde acest container pentru a ocupa spațiul disponibil */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Asigură distribuirea conținutului */
}

.room-box .detail-box h5 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #343a40;
}

.room-box .facilities {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 15px;
}

.room-box .price-capacity-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.room-box .price-capacity-box h6 {
    font-size: 18px;
    color: #28a745;
    font-weight: bold;
}

.room-box .price-capacity-box .capacity {
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #343a40;
}

.room-box .price-capacity-box .capacity i {
    margin-right: 5px;
}

.room-box .detail-box a {
    display: block;
    text-align: center;
    padding: 10px 0;
    background-color: #3e9598;
    color: #ffffff;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    margin-top: auto;
}

.room-box .detail-box a:hover {
    background-color: #0056b3;
}


    /* Sidebar fixat și stiluri de filtrare */
    .sidebar {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: sticky;
        margin-top: 20px;
    }

    .sidebar h4 {
        font-size: 20px;
        margin-bottom: 20px;
        color: #343a40;
    }

    .sidebar .form-group {
        margin-bottom: 20px;
    }

    .sidebar .form-group label {
        display: block;
        font-size: 14px;
        color: #343a40;
        margin-bottom: 5px;
    }

    .sidebar .form-group input[type="checkbox"] {
        margin-right: 10px;
    }

    .sidebar .price-slider {
        margin-bottom: 20px;
    }

    .sidebar .btn-filter {
        width: 100%;
        background-color: #3e9598;
        color: #ffffff;
        border-radius: 5px;
        font-weight: bold;
        padding: 10px 0;
    }

    .sidebar .btn-filter:hover {
        background-color: #0056b3;
    }
    .btn-filter:focus{
    outline: 2px solid #0056b3;
}
.room-box .detail-box h5 {
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 10px;
    margin-bottom: 10px;
}
</style>

<body>
<?php include('includes/header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
      <div class="sidebar">
        <h4>Filtrează căutarea</h4>
        <form action="" method="GET">
          <div class="form-group">
            <label for="price">Interval de preț</label>
            <input type="range" class="form-range" min="100" max="2000" step="100" id="price" name="price_min" value="<?php echo isset($_GET['price_min']) ? htmlspecialchars($_GET['price_min']) : '100'; ?>" oninput="this.nextElementSibling.value = this.value">
            <output><?php echo isset($_GET['price_min']) ? htmlspecialchars($_GET['price_min']) : '100'; ?></output> - 
            <input type="range" class="form-range" min="100" max="2000" step="100" id="price" name="price_max" value="<?php echo isset($_GET['price_max']) ? htmlspecialchars($_GET['price_max']) : '2000'; ?>" oninput="this.nextElementSibling.value = this.value">
            <output><?php echo isset($_GET['price_max']) ? htmlspecialchars($_GET['price_max']) : '2000'; ?></output> RON
          </div>

          <div class="form-group">
            <label>Capacitate</label>
            <div>
              <input type="checkbox" name="capacity[]" value="1" <?php echo isset($_GET['capacity']) && in_array(1, $_GET['capacity']) ? 'checked' : ''; ?>> 1 persoană<br>
              <input type="checkbox" name="capacity[]" value="2" <?php echo isset($_GET['capacity']) && in_array(2, $_GET['capacity']) ? 'checked' : ''; ?>> 2 persoane<br>
              <input type="checkbox" name="capacity[]" value="3" <?php echo isset($_GET['capacity']) && in_array(3, $_GET['capacity']) ? 'checked' : ''; ?>> 3 persoane<br>
              <input type="checkbox" name="capacity[]" value="4" <?php echo isset($_GET['capacity']) && in_array(4, $_GET['capacity']) ? 'checked' : ''; ?>> 4 persoane<br>
              <input type="checkbox" name="capacity[]" value="5" <?php echo isset($_GET['capacity']) && in_array(5, $_GET['capacity']) ? 'checked' : ''; ?>> 5+ persoane
            </div>
          </div>

          <div class="form-group">
            <label>Facilități</label>
            <?php
            // Preia toate facilitățile disponibile
            $facilities_query = "SELECT id, denumire_facilitate FROM facilitati";
            $facilities_stmt = $conn->prepare($facilities_query);
            $facilities_stmt->execute();
            $all_facilities = $facilities_stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($all_facilities as $facility) {
                echo '<div><input type="checkbox" name="facilities[]" value="' . $facility['id'] . '" ' . (isset($_GET['facilities']) && in_array($facility['id'], $_GET['facilities']) ? 'checked' : '') . '> ' . htmlspecialchars($facility['denumire_facilitate']) . '</div>';
            }
            ?>
          </div>

          <div class="form-group">
            <label for="checkin">Check-in:</label>
            <input type="date" id="checkin" name="checkin" class="form-control" value="<?php echo isset($_GET['checkin']) ? htmlspecialchars($_GET['checkin']) : ''; ?>">
            </div>

            <div class="form-group">
            <label for="checkout">Check-out:</label>
            <input type="date" id="checkout" name="checkout" class="form-control" value="<?php echo isset($_GET['checkout']) ? htmlspecialchars($_GET['checkout']) : ''; ?>">
            </div>

          <button type="submit" class="btn btn-filter">Aplică filtre</button>
          <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary" style="margin-top: 10px; width: 100%;">Resetează filtrele</a>
        </form>
      </div>
    </div>

 <!-- Camere disponibile -->
 <div class="col-md-9">
 <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>
      <section class="service_section layout_padding">
        <div class="container">
          <div class="heading_container heading_center">
            <h2 class="room-section-title">
              Camere disponibile
            </h2>
          </div>
          <div class="row">
            <?php 
              // Verificare dacă există camere disponibile
              if($query_run->rowCount() > 0){
                  while($row = $query_run->fetch()){
                      $id = $row['id'];
                      $roomName = $row['nume_camera'];
                      $price = $row['pret_saptamana'];
                      $weekendPrice = $row['pret_weekend'];
                      $capacity = $row['capacitate_camera'];
                      $image = $row['imagine'];
                      $images = json_decode($image, true);
                      $mainImage = $images[0]; // Prima imagine din galerie

                      // Obține facilitățile pentru fiecare cameră
                      $facility_query = "SELECT f.denumire_facilitate FROM facilitati f 
                                        INNER JOIN room_facility rf ON f.id = rf.facility_id 
                                        WHERE rf.room_id = :room_id";
                      $facility_stmt = $conn->prepare($facility_query);
                      $facility_stmt->bindParam(':room_id', $id);
                      $facility_stmt->execute();
                      $facilities = $facility_stmt->fetchAll(PDO::FETCH_ASSOC);

                      // Calculul prețului total pe toată perioada selectată
                      $totalPrice = 0;
                      if (isset($checkin) && isset($checkout) && !empty($checkin) && !empty($checkout)) {
                          $checkinDate = new DateTime($checkin);
                          $checkoutDate = new DateTime($checkout);
                          $interval = $checkinDate->diff($checkoutDate);
                          $nights = $interval->days;

                          $currentDate = $checkinDate;

                          while ($currentDate < $checkoutDate) {
                              $dayOfWeek = $currentDate->format('N'); // 1 (Luni) -> 7 (Duminică)
                              if ($dayOfWeek >= 6) {
                                  $totalPrice += $weekendPrice;
                              } else {
                                  $totalPrice += $price;
                              }
                              $currentDate->modify('+1 day');
                          }
                      } else {
                          $totalPrice = $price;
                      }
            ?>
            <div class="col-md-6 col-lg-4">
              <div class="room-box">
              <div id="carouselRoom<?php echo $id; ?>" class="carousel slide" data-ride="carousel" data-interval = "false">
                <div class="carousel-inner">
                    <?php foreach ($images as $index => $image): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="img_container">
                        <img src="admin/room_images/<?php echo htmlspecialchars($image); ?>" class="d-block w-100" alt="Imagine pentru <?php echo htmlspecialchars($roomName); ?>" loading="lazy">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <ol class="carousel-indicators">
                    <?php foreach ($images as $index => $image): ?>
                    <li data-target="#carouselRoom<?php echo $id; ?>" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
                    <?php endforeach; ?>
                </ol>
                <div class="carousel_btn_box">
                    <a class="carousel-control-prev" href="#carouselRoom<?php echo $id; ?>" role="button" data-slide="prev">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselRoom<?php echo $id; ?>" role="button" data-slide="next">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                    </a>
                </div>
                </div>
                <div class="detail-box">
                  <h5>
                    <?php echo htmlspecialchars($roomName); ?>
                  </h5>
                  <div class="facilities">
                    <strong>Facilități:</strong>
                    <ul class="list-unstyled">
                      <?php 
                      if (!empty($facilities)) {
                          foreach ($facilities as $facility) {
                              echo '<li><i class="fas fa-check"></i> ' . htmlspecialchars($facility['denumire_facilitate']) . '</li>';
                          }
                      } else {
                          echo '<li><i class="fas fa-times"></i> Nicio facilitate disponibilă</li>';
                      }
                      ?>
                    </ul>
                  </div>
                  <div class="price-capacity-box">
                    <h6>
                      <?php echo htmlspecialchars($totalPrice); ?> RON
                    </h6>
                    <div class="capacity">
                      <i class="fas fa-users"></i> <?php echo htmlspecialchars($capacity); ?> persoane
                    </div>
                  </div>

                    <?php 
                    if (isset($_GET['checkin']) && isset($_GET['checkout']) && !empty($_GET['checkin']) && !empty($_GET['checkout'])) {
                        $checkin = $_GET['checkin'];
                        $checkout = $_GET['checkout'];
                    
                        // Construim URL-ul cu datele filtrate
                        echo '<a href="confirmbooking.php?type=room&room_id=' . $id . '&checkin=' . $checkin . '&checkout=' . $checkout . '" class="btn btn-filter">Rezervă acum</a>';
                    } else {
                        // Afișăm un buton dezactivat sau un mesaj care să sugereze selectarea datei
                        echo '<p><i class="fas fa-circle-info text-primary"></i> Te rugăm să selectezi datele de check-in și check-out pentru a rezerva.</p>';
                    }
                    ?>
            
                </div>
              </div>
            </div>
            <?php
                  }
              } else {
                  echo "<div class='col-12 text-center'><p>Nu există camere disponibile în acest moment.</p></div>";
              }
            ?>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- lightbox Gallery-->
  <script src="js/ekko-lightbox.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>


</body>

</html>
