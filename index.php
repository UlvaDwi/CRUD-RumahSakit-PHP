<?php
session_start();
if(empty($_SESSION['username'])){
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Rumah Sakit Medika</title>

  <!-- Panggil Bootstrap -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
</head>

<body background="gambar/background.jpg">
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
       <!-- Skrip dibawah ini akan aktif ketika posisi mobile -->
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="index.php">Rumah Sakit Medika</a>
     </div>
     <!-- Daftar menu yang diinginkan-->
     <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">

        <li role="presentation" class="dropdown">
          <a href="index.php">
            <span class="glyphicon glyphicon-home"></span> Beranda
          </a>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-folder-open"></span> &nbsp;Master
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">

            <li>
             <a href="index.php?lihat=pasien/index">
               <span class="glyphicon glyphicon-user"></span> &nbsp;Pasien</a>
             </li>

             <li>
               <a href="index.php?lihat=obat/index">
                 <span class="glyphicon glyphicon-hourglass"></span> &nbsp;Obat</a>
               </li>

               <li>
                 <a href="index.php?lihat=kamar/index">
                   <span class="glyphicon glyphicon-bed"></span> &nbsp;Kamar</a>
                 </li>

                 
               </ul>
             </li>

             <li>
              <a href="index.php?lihat=inap/index">
                <span class="glyphicon glyphicon-list-alt"></span> Rawat Inap
              </a>
            </li>
            <li>
              <a href="index.php?lihat=detail_obat/index">
                <span class="glyphicon glyphicon-tag"></span> Detail Obat
              </a>
            </li>
            <li>
              <a href="index.php?lihat=pembayaran/index">
                <span class="glyphicon glyphicon-usd"></span> Pembayaran
              </a>
            </li>
            <li>
              <a href="logout.php">
                <span class=" glyphicon glyphicon-off"></span> Logout
              </a>
            </li>

          </ul>
        </div><!-- #navbar -->
      </div><!-- .container -->
    </nav><!-- .navbar -->


    <div class="container">

      <?php
      /*Skrip dibawah berfungsi memanggil perintah sesuai nama file*/
      if(!empty($_GET['lihat'])){
        include('panggil/'.$_GET['lihat'].'.php');
      }

      else{
        include 'beranda.php';
      }
      ?>

    </div> <!-- .container -->


    <!-- Panggil JavaScript -->
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>    
  </body>

  </html>
