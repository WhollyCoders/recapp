<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>MyBod4God RecApp | <?php echo($page_title);?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/custom.css">
  </head>
  <body>
    <div class="row">
      <header>
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="./index">MyBod4God RecApp</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="./index.php">Dashboard</a></li>
                <li><a href="./competitors.php">Competitors</a></li>
                <li><a href="./teams.php">Teams</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Weigh-Ins <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="weighins.php?week=1">Week 1</a></li>
                    <li><a href="weighins.php?week=2">Week 2</a></li>
                    <li><a href="weighins.php?week=3">Week 3</a></li>
                    <!-- <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Nav header</li> -->
                    <li><a href="weighins.php?week=4">Week 4</a></li>
                    <li><a href="weighins.php?week=5">Week 5</a></li>
                    <li><a href="weighins.php?week=6">Week 6</a></li>
                    <li><a href="weighins.php?week=7">Week 7</a></li>
                    <li><a href="weighins.php?week=8">Week 8</a></li>
                    <li><a href="weighins.php?week=9">Week 9</a></li>
                    <li><a href="weighins.php?week=10">Week 10</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Results <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="results.php?week=1">Week 1</a></li>
                    <li><a href="results.php?week=2">Week 2</a></li>
                    <li><a href="results.php?week=3">Week 3</a></li>
                    <!-- <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Nav header</li> -->
                    <li><a href="results.php?week=4">Week 4</a></li>
                    <li><a href="results.php?week=5">Week 5</a></li>
                    <li><a href="results.php?week=6">Week 6</a></li>
                    <li><a href="results.php?week=7">Week 7</a></li>
                    <li><a href="results.php?week=8">Week 8</a></li>
                    <li><a href="results.php?week=9">Week 9</a></li>
                    <li><a href="results.php?week=10">Week 10</a></li>
                  </ul>
                </li>
                <li><a href="./upload.php">Upload Weigh-in</a></li>
              </ul>
            </div><!--/.nav-collapse -->
        </nav>
      </header>
    </div>
