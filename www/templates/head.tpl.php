<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Facebook Re-connect</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" /><!-- Fbootstrapp -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script type="application/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });
</script>
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-custom.css" /> -->
	<link rel="stylesheet" type="text/css" href="css/main.css" />
</head>
<body>
    <div class="topbar">
      <div class="topbar-inner">
        <div class="container-fluid">
          <a class="brand" href="#">Facebook Re-connect</a>
           <ul class="nav pull-right">
            <li class="active"><?= $PAGE_VARS['user_button'] ?></a></li>
          </ul> 
        </div>
      </div>
    </div>
    <div id="search" class="container">
    <form action="" method="get">
      <div class="input-append">
        <input id="search-field" type="text" name="friend" autocomplete="off" data-provide="typeahead" 
        placeholder="<?= (isset($_GET['friend']) && $_GET['friend'] != "")? $_GET['friend']: 'Search friend...'; ?>">
      </div>
      <div class="input-append">
        <input id="start-date" type="text" name="startdate" autocomplete="off" data-provide="typeahead" 
        placeholder="<?= (isset($_GET['startdate']) && $_GET['startdate'] != "")? $_GET['startdate']: 'Start Date'; ?>">
      </div>
      <div class="input-append">
        <input id="end-date" type="text" name="enddate" autocomplete="off" data-provide="typeahead" 
        placeholder="<?= (isset($_GET['enddate']) && $_GET['enddate'] != "")? $_GET['enddate']: 'End Date'; ?>">
      </div>
      <button type="submit" id="search-button" value="Search" class="btn add-on">
        Search <i class="icon-search"></i>
      </button>
    </form>
  </div>