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
.facilitati_section .detail-box, 
.facilitati_exterioare_section .detail-box {
  background-color: #f8f9fa;
  padding: 20px;
  border-radius: 10px;
}

.facilitati_section p,
.facilitati_exterioare_section p {
  font-size: 16px;
  color: #333;
  margin-bottom: 15px;
}
.facilitati_section .fas,
.facilitati_exterioare_section .fas {
  color: #000000; /* Albastru pentru a ieși în evidență */
  margin-right: 8px;
}

.facilitati_section .detail-box p,
.facilitati_exterioare_section .detail-box p {
  display: flex;
  align-items: center;
}
.heading_container {
    margin-bottom: 20px;
}
</style>
<body>

<?php include('includes/header.php'); ?>

<!-- facilități interioare section -->
<section class="facilitati_section layout_padding">
  <div class="container" style="margin-bottom: -140px;">
    <div class="heading_container heading_center">
      <h2>
        Facilități Interioare
      </h2>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="box">
          <div class="detail-box">
            <p>
              <i class="fas fa-info-circle"></i> Bucătăria este utilată cu toate electrocasnicele necesare pentru a vă face viața cât mai simplă: aragazul (inclusiv cuptor), chiuvetă cu suport încăpător pentru vasele spălate, cană pentru încalzit apa, cuptor cu microunde, râșniță și aparat pentru cafea, prăjitor pentru pâine, mașină pentru spălat vasele (cui îi place să spele vasele...mai ales  în vacanță), frigiderul cu congelator. Vesela, desigur, împreună cu tacâmurile aferente, pentru toate preparatele.
            </p>
            <p>
              <i class="fas fa-info-circle"></i> Servirea mesei se face în imediată proximitate a bucătăriei (open-space), masa fiind potrivită pentru servirea mesei de către 12 persoane.
            </p>
            <p>
              <i class="fas fa-info-circle"></i> Barul desparte partea de living-room de zona de servire a mesei. Înalt și dotat cu 3 scaune rotative, numai bune de tolănit la o poveste și-un cocktail.
            </p>
            <p>
              <i class="fas fa-info-circle"></i> Living-room-ul este spațios, dotat cu un colțar dintr-o parte în alta a camerei, o măsuță potrivită pentru doritorii de jocuri de masă si un mare televizor LCD cu diagonala de X, numai bun pentru jucat jocuri pe Playstation-ul pus la dispoziție de noi sau pentru vizionarea unor filme la calitate ultra HD.
            </p>
            <p>
              <i class="fas fa-info-circle"></i> Șemineul care tronează în mijlocul camerei poate fi folosit cu încredere, puține senzații fiind mai plăcute și mai satisfăcătoare în serile de iarnă tărzii, la un pahar de vin și un film romantic.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- facilități exterioare section -->
<section class="facilitati_exterioare_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Facilități Exterioare
      </h2>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="box">
          <div class="detail-box">
            <p>
              <i class="fas fa-info-circle"></i> Grill-ul acoperit din 3 părți, având chiar și acoperiș, se prezintă precum o cameră în aer liber, cu mici bucățele de istorie și ceafă de porc fără os sau pizza la vatră.
            </p>
            <p>
              <i class="fas fa-info-circle"></i> De la masa aflată în proximitatea cestuia, părinții își pot urmări îndeaproape copiii în timp ce aceștia sunt la joacă, la facilitățile pentru copiii puse la dispoziție. Aici amintesc groapa cu nisip, toboganul, balansoarul, leagănul, trambulina, mingiuțele și formele pentru nisip, alte jucării specifice momentului sau anotimpului.
            </p>
            <p>
              <i class="fas fa-info-circle"></i> Videoproiectorul vă așteaptă în zona de terasă și, în curând, se va face un loc special pentru proiecție în zona amenajată pentru corturi.
            </p>
            <p>
              <i class="fas fa-info-circle"></i> Tot aici, în terasa amintită mai sus, avem masa pentru ping-pong, unde se pot juca turnee puternice împreună cu prietenii. Boxa pentru karaoke este chiar lângă masa de ping-pong, iar seara începe cu adevărat în momentul în care prindeți într-adevăr curaj pentru o reprezentare... trup, suflet, voce a stării voastre reale.
            </p>
            <p>
              <i class="fas fa-info-circle"></i> Grătarul lu Nelu ar vrea să fumege, dacă și voi ați dori să îl băgați în seamă! Dotat din toate direcțiile, atât cu instrumente pentru întoarcerea cârnii pe grătar, cu lumină pentru supervizarea corectă a mâncării, cu mese întinse și în stânga, și în dreapta, prize pentru pus boxa la încărcat și globul disco la învârtit... Există spațiu suficient în acesta și pentru prepararea unor tocănițe la pirostrii sau unor preparate la disc, timp și jar să aveți.
            </p>
            <p>
              <i class="fas fa-info-circle"></i> Tirul cu arcul este deschis și pentru cei mici, dar si pentru cei mari, având câte o țintă pentru ambele categorii. Arcul pentru copii are săgeata specifică, vârful acesteia fiind din cauciuc, având ventuză care se lipește de țintă.
            </p>
            <p>
              <i class="fas fa-info-circle"></i> Terasa deschisă e potrivită pentru un ceai cald sau un moccacino cu scorțișoară, cel mai probabil împreună cu pisicile, care nu vor conteni să ajungă cu noutățile și miorlăiturile. Desigur, având în vedere balansoarul prezent în terasă, aceasta este și un minunat loc pentru relaxare.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


  <?php include('includes/footer.php'); ?>

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>

</body>

</html>