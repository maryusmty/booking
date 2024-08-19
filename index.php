<?php require 'admin/db.php'; 
// $webPageName = "Rasfatul RelaxSarii";
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

<body>

<?php include("includes/header.php"); ?>

  <!-- slider section -->
  <section class="slider_section position-relative">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="img_container">
            <div class="img-box">
              <img src="images/slider-bg3.jpg" class="" alt="...">
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="img_container">
            <div class="img-box">
              <img src="images/slider-bg2.jpeg" class="" alt="...">
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="img_container">
            <div class="img-box">
              <img src="images/slider-bg.jpeg" class="" alt="...">
            </div>
          </div>
        </div>
      </div>
      <div class="carousel_btn_box">
        <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="detail-box">
      <div class="col-md-8 col-lg-6 mx-auto">
        <div class="inner_detail-box">
          <h1>
            Rasfatul RelaxSarii
          </h1>
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          </p>
          <div>
            <a href="" class="slider-link">
              REZERVA ACUM
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end slider section -->



  <!-- about section -->

  <section class="about_section layout_padding ">
    <div class="container">
      <div class="row">

        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Despre noi
              </h2>
            </div>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorem eum consequuntur ipsam repellat dolor soluta aliquid laborum, eius odit consectetur vel quasi in quidem, eveniet ab est corporis tempore.
            </p>
            <a href="about.php">
              Vezi povestea noastra
            </a>
          </div>
        </div>

        <div class="col-md-6">
          <div class="img-box">
            <img src="images/about-img.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- gallery section -->

  <!-- <div class="gallery_section layout_padding2">
    <div class="container-fluid">
      <div class="heading_container heading_center">
        <h2>
          Gallery
        </h2>
      </div>
      <div class="row">
        <div class=" col-sm-8 col-md-6 px-0">
          <div class="img-box">
            <img src="images/g1.jpg" alt="">
            <a href="images/g1.jpg" data-toggle="lightbox" data-gallery="gallery">
              <i class="fa fa-picture-o" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-sm-4 col-md-3 px-0">
          <div class="img-box">
            <img src="images/g2.jpg" alt="">
            <a href="images/g2.jpg" data-toggle="lightbox" data-gallery="gallery">
              <i class="fa fa-picture-o" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 px-0">
          <div class="img-box">
            <img src="images/g3.jpg" alt="">
            <a href="images/g3.jpg" data-toggle="lightbox" data-gallery="gallery">
              <i class="fa fa-picture-o" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 px-0">
          <div class="img-box">
            <img src="images/g4.jpg" alt="">
            <a href="images/g4.jpg" data-toggle="lightbox" data-gallery="gallery">
              <i class="fa fa-picture-o" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-sm-4 col-md-3 px-0">
          <div class="img-box">
            <img src="images/g5.jpg" alt="">
            <a href="images/g5.jpg" data-toggle="lightbox" data-gallery="gallery">
              <i class="fa fa-picture-o" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-sm-8 col-md-6 px-0">
          <div class="img-box">
            <img src="images/g6.jpg" alt="">
            <a href="images/g6.jpg" data-toggle="lightbox" data-gallery="gallery">
              <i class="fa fa-picture-o" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="btn-box">
        <a href="">
          View All
        </a>
      </div>
    </div>
  </div> -->

  <!-- end gallery section -->


  <!-- service section -->

  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Pachetele noastre promotionale
        </h2>
      </div>
      <div class="row">
        <?php 
            $carduriPePagina = 3;

            $query = "SELECT * FROM packeges WHERE status = 1 ORDER BY id DESC LIMIT :limita";
            $query_run = $conn->prepare($query);
            $query_run->bindParam(':limita', $carduriPePagina, PDO::PARAM_INT);
            $query_run->execute();

            // Verificare dacă există pachete
            if($query_run->rowCount() > 0){
                while($row = $query_run->fetch()){
                    $id = $row['id'];
                    $denumire_pachet = $row['denumire_pachet'];
                    $descriere = $row['descriere'];
                    $ultima_actualizare = $row['ultima_actualizare'];
                    $status = $row['status'];
                    $pret = $row['pret'];
                    $image = $row['imagine'];
        ?>
                <div class="col-md-6 col-lg-4 mx-auto">
                  <div class="box">
                    <div class="img-box">
                      <img src="admin/packege_images/<?php echo $image;?>" alt="">
                    </div>
                    <div class="detail-box">
                      <h5>
                        <?php echo htmlspecialchars($denumire_pachet); ?>
                      </h5>
                      <p>
                        <?php echo htmlspecialchars($descriere); ?>
                      </p>
                      <a href="offers.php">
                        Detalii
                      </a>
                    </div>
                  </div>
                </div>
        <?php
                }
            } else {
                echo "<div class='col-12'><div class='alert alert-secondary text-center'>Nu există pachete adăugate momentan.</div></div>";
            }

            // Verificare dacă există mai mult de 3 pachete
            $query_total = "SELECT COUNT(*) as total FROM packeges WHERE status = 1";
            $query_total_run = $conn->prepare($query_total);
            $query_total_run->execute();
            $total_pachete = $query_total_run->fetchColumn();

            if($total_pachete > $carduriPePagina){
                echo '<div class="col-12 text-center mt-4">
                      <a href="offers.php" class="btn btn-primary" style="margin-top: 30px;">Vezi toate pachetele noastre</a>
                     </div>';
            }
        ?>
      </div>
    </div>
</section>

  <!-- end service section -->



  <!-- blog section -->

  <!-- <section class="blog_section ">
    <div class="container-fluid">
      <div class="heading_container">
        <h2>
          Latest Blog
        </h2>
      </div>
      <div class="row">
        <div class="col-lg-6 ">
          <div class="box">
            <div class="img-box">
              <img src="images/b1.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Velit tempora molestias quae
              </h5>
              <p>
                Omnis itaque ducimus excepturi dignissimos voluptatibus sequi nisi ut ullam, perspiciatis doloribus! Cum itaque sint quibusdam aut vel. A esse labore.
              </p>
              <a href="">
                Detalii
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 ">
          <div class="box">
            <div class="img-box">
              <img src="images/b2.jpg" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Repudiandae voluptatum quaerat
              </h5>
              <p>
                Totam non minus suscipit, exercitationem deserunt doloribus provident dolor quos nulla impedit, perspiciatis excepturi eius hic vero harum deleniti.
              </p>
              <a href="">
                Detalii
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <!-- end blog section -->

  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Ce spun clienții noștri
            </h2>
        </div>
        <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php 
                    $query = "SELECT * FROM ratings WHERE status = 1 ORDER BY id DESC";
                    $query_run = $conn->prepare($query);
                    $query_run->execute();

                    if ($query_run->rowCount() > 0) {
                        $firstItem = true;
                        while ($row = $query_run->fetch()) {
                            $id = $row['id'];
                            $ratingName = htmlspecialchars($row['nume_client']);
                            $ratingText = htmlspecialchars($row['text_recenzie']);
                            $ratingStars = $row['stele_recenzie'];

                            // Generarea stelelor
                            $stele = '';
                            for($i = 1; $i <= 5; $i++) {
                                if($i <= $ratingStars) {
                                    $stele .= '<i class="fa fa-star text-warning"></i> ';
                                } else {
                                    $stele .= '<i class="fa fa-star text-secondary"></i> ';
                                }
                            }

                            // Afișarea recenziei în carousel
                            ?>
                            <div class="carousel-item <?php echo $firstItem ? 'active' : ''; ?>">
                                <div class="row">
                                    <div class="col-md-11 col-lg-10 mx-auto">
                                        <div class="box">
                                            <div class="detail-box">
                                                <div class="name">
                                                    <h6><?php echo $ratingName; ?></h6>
                                                </div>
                                                <div class="stars">
                                                    <?php echo $stele; ?>
                                                </div>
                                                <p>
                                                    <?php echo $ratingText; ?>
                                                </p>
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
                            <i id="prev" class="fa fa-arrow-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
                                <i id="next" class="fa fa-arrow-right" aria-hidden="true"></i>
                                <span class="sr-only">Next</span>
                            </a>
                            <?php
                            $firstItem = false;
                        }
                    } else {
                        echo "<div class='carousel-item active'><div class='col-12 text-center'><div class='alert alert-secondary'>Nu există recenzii disponibile momentan.</div></div></div>";
                    }
                ?>
            </div>
        </div>
    </div>
</section>





  <!-- end client section -->

<!-- contact section -->
<section class="contact_section layout_padding">
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-lg-6">
        <div class="form_container">
          <div class="heading_container">
            <h2>
              Contactează-ne
            </h2>
          </div>
          <form action="">
            <div>
              <input type="text" placeholder="Your Name" />
            </div>
            <div>
              <input type="text" placeholder="Phone Number" />
            </div>
            <div>
              <input type="email" placeholder="Email" />
            </div>
            <div>
              <input type="text" class="message-box" placeholder="Message" />
            </div>
            <div class="btn_box">
              <button>
                TRIMITE
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-5 col-lg-6">
        <div class="subscribe-box">
          <h3>
            Află primul de ofertele noastre!
          </h3>
          <p>
            Fii la curent cu toate ofertele noastre și nu rata nicio ocazie de a te răsfăța!
          </p>
          <form action="">
            <input type="email" placeholder="Introduceți emailul">
            <button>
              Abonează-te
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end contact section -->




<?php include('includes/footer.php') ?>



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