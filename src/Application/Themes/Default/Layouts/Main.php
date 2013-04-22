<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Facebook Re-connect</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <?php echo $this->headScripts()->appendFile("js/bootstrap.min.js") ?>
    <script type="text/javascript">
    $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });
</script>
    <?php echo $this->headStyles()->appendFile("css/bootstrap.css")->appendFile("css/bootstrap.min.css")->appendFile("css/main.css") ?>
</head>
<body>
    <div class="topbar">
      <div class="topbar-inner">
        <div class="container-fluid">
          <a class="brand" href="#">Facebook Summary</a>
           <ul class="nav pull-right">
            <li class="active">
                <?php
                    if($GLOBALS["registry"]->fb->isAuthorized()) {
                        ?>
                              <a href='<?=$GLOBALS["registry"]->utils->makeLink("Index", "logout")?>'>Logout</a>
                         <?php
                    }
                    else
                    {
                         ?>
                              <a href='<?=$GLOBALS["registry"]->utils->makeLink("Login", "login")?>'>Login with Facebook!</a>
                         <?php
                    }
                ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!--
    <div id="search" class="container">
      <form action="" method="get">
        <div class="input-append">
          <input id="search-field" type="text" name="friend" autocomplete="off" data-provide="typeahead"
          placeholder="Search friend..." value="<?= (isset($_GET['friend']) && $_GET['friend'] != "")? $_GET['friend']: ''; ?>">
        </div>
        <div class="input-append">
          <input id="start-date" type="text" name="startdate" autocomplete="off" data-provide="typeahead"
          placeholder="Starte date" value="<?= (isset($_GET['startdate']) && $_GET['startdate'] != "")? $_GET['startdate']: ''; ?>">
        </div>
        <div class="input-append">
          <input id="end-date" type="text" name="enddate" autocomplete="off" data-provide="typeahead"
          placeholder="End date" value="<?= (isset($_GET['enddate']) && $_GET['enddate'] != "")? $_GET['enddate']: ''; ?>">
        </div>
        <button type="submit" id="search-button" value="Search" class="btn add-on">
          Search <i class="icon-search"></i>
        </button>
      </form>
    </div>
    -->
	<?php
    echo $this->content()
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src='js/main.js' type='text/javascript'></script>
</body>
</html>