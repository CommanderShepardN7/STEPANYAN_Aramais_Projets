<!DOCTYPE html>
<html>
 <head>
   		<meta charset="UTF-8">
      <title>ONF</title>

      <link rel="stylesheet" type="text/css" href="css/style.css" />
      <!--MAP CSS-->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
        integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin=""/>
      <!-- FIN MAP CSS-->
      <!--CSS pour les formulaires-->
			<link href="css/floating-labels.css" rel="stylesheet">
      <!--bootstrap-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <!-- Material Design Bootstrap -->
      <!--<link href='css/mdb.min.css' rel='stylesheet'>-->
      <!-- MDBootstrap Datatables  -->
      <link href="css/addons/datatables.min.css" rel="stylesheet">

      <!-- SCRIPTS -->
     <!-- JQuery -->
     <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
     <!-- Bootstrap tooltips -->
     <script type="text/javascript" src="js/popper.min.js"></script>
     <!-- Bootstrap core JavaScript -->
     <script type="text/javascript" src="js/bootstrap.min.js"></script>
     <!-- MDB core JavaScript -->
     <script type="text/javascript" src="js/mdb.js"></script>
     <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>

</head>
<body>

  <header>
    <!-- Mise en place de bar de navigation avec des styles dont vient de bootstrap.min.css-->
    <nav class='navbar navbar-expand-md navbar-light bg-light sticky-top'>
      <div class='container-fluid'>
        <a href='#' class='navbar-brad'><img src='img/Logo-ONF.png'></a>

        	<?php
          if (isset ($_SESSION["connected"])){
            bar_navigation_admin();
          }
	        ?>

      </div>
    </nav>
    <!------------------------------------------------------------------------------------------->
  </header>

	<section>
    <?php
      gestionPages();
    ?>
	</section>

</body>
</html>
