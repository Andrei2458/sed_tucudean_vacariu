<head>
	<title>Adapost Animale</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


    <style> 
    /*CSS pentru 
    footer sticky */ 
    body { 
      display: flex; 
      min-height: 100vh; 
      flex-direction: column; 
    } 
  
    main { 
      flex: 1 0 auto; 
    }
    
  </style>

</head>
<body>


<!-- Bara de navigare -->
<div class="navbar-fixed">
    <nav class="nav-wraper">
        <div class="container">
            <a href="index.php" class="brand-logo"><i class="material-icons" style="margin-top: 4px">pets</i>Adăpost Azorel</a>

            <a href="#" class="sidenav-trigger" data-target="mobile-links"> 
                <i class="material-icons">menu</i>
            </a>
            


            <ul class="right hide-on-med-and-down">
                
                <!-- Cauta un animalut -->
                <li><a href="cautare.php"><i class="material-icons left" style="margin-top: 4px">search</i> Caută un animăluț</a></li>

                <!-- Dropdown Trigger Adoptii -->
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Adopții animale<i class="material-icons right" style="margin-top: 4px">keyboard_arrow_down</i></a></li>
                
                <!-- Dropdown Trigger Adoptii -->
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Activități gestiune<i class="material-icons right"style="margin-top: 4px">keyboard_arrow_down</i></a></li>
            </ul>    
        </div>
        
    </nav>
</div>
    <!-- Dropdown Structure pentru Adoptii start varianta desktop -->
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="client.php" class="red-text text-lighten-2">Creare Cont Erou</a></li>
        <li class="divider"></li>
          <li><a href="lista.php" class="red-text text-lighten-2">Listă Eroi</a></li>
        <li class="divider"></li>
        <li><a href="adoptie.php" class="red-text text-lighten-2">Adopție nouă</a></li>
        <li class="divider"></li>
        <li><a href="istoric.php" class="red-text text-lighten-2">Istoric adopții</a></li>
        
    </ul>
    <!--  dropdown structure end -->

    <!-- Dropdown Structure pentru Activitati gestiune start -->
    <ul id="dropdown2" class="dropdown-content">
        <li><a href="add.php" class="red-text text-lighten-2">Adaugă un animăluț</a></li>
        <li class="divider"></li>
        <li><a href="plasare.php" class="red-text text-lighten-2">Plasare în adăpost</a></li>
        <li class="divider"></li>
        <li><a href="situatie.php" class="red-text text-lighten-2">Situație adăpost</a></li>
        
    </ul>
    <!--  dropdown structure end -->


    <!-- Pentru ecrane mici/dispozitive mobile -->
    <ul class="sidenav" id="mobile-links">    
                
        <!-- Cauta un animalut -->
        <li><a href="cautare.php" class="red-text text-lighten-2"><i class="material-icons right red-text text-lighten-2">search</i>Caută un animăluț</a></li>
        <li class="divider"></li>

        <!-- Dropdown Trigger Adoptii -->
        <li><a class="dropdown-trigger red-text text-lighten-2" href="#!" data-target="dropdown3">Adopții animale<i class="material-icons right red-text text-lighten-2">keyboard_arrow_down</i></a></li>
        <li class="divider"></li>

        <!-- Dropdown Trigger Adoptii -->
        <li><a class="dropdown-trigger red-text text-lighten-2" href="#!" data-target="dropdown4">Activități gestiune<i class="material-icons right red-text text-lighten-2">keyboard_arrow_down</i></a></li>        

    </ul>

    <!-- Dropdown Structure pentru Adoptii start pentru mobile-->
    <ul id="dropdown3" class="dropdown-content">
        <li><a href="client.php" class="red-text text-lighten-2">Creare Cont Erou</a></li>
        <li class="divider"></li>
        <li><a href="lista.php" class="red-text text-lighten-2">Listă Eroi</a></li>
        <li class="divider"></li>
        <li><a href="adoptie.php" class="red-text text-lighten-2">Adopție nouă</a></li>
        <li class="divider"></li>
        <li><a href="istoric.php" class="red-text text-lighten-2">Istoric adopții</a></li>
        
    </ul>
    <!--  dropdown structure end -->

    <!-- Dropdown Structure pentru Activitati gestiune start -->
    <ul id="dropdown4" class="dropdown-content">
        <li><a href="add.php" class="red-text text-lighten-2">Adaugă un animăluț</a></li>
        <li class="divider"></li>
        <li><a href="plasare.php" class="red-text text-lighten-2">Plasare în adăpost</a></li>
        <li class="divider"></li>
        <li><a href="situatie.php" class="red-text text-lighten-2">Situație adăpost</a></li>
        
    </ul>
    <!--  dropdown structure end -->
    



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Parte de script pentru navbar pe mobil dropdown si collapsible -->
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $(".dropdown-trigger").dropdown();
            $('.collapsible').collapsible();

        })
    </script>