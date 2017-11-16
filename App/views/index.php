<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Task</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/dashboard.css" rel="stylesheet">
    
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">task</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">

            <li><a href="/logout">Logout</a></li>

          </ul>

        </div>
      </div>
    </nav>
        <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

          <ul class="nav nav-sidebar">
            <li><a href="">withdraw</a></li>
            <li><a href="">transactions</a></li>
          </ul>            
        </div> 
 <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main">
     
     

    <form class="form-horizontal" role="form" method="POST" action="/withdraw">
        <div class="form-group">
            <h2>Balance: <?= $balance ?></h2>
        </div>
                                <div class="form-group">
                            <label for="email" class="col-md-2 control-label">Ammount</label>

                            <div class="col-md-4">
                                 <input type="text" class="form-control" name="amount" value="" required autofocus>


                            </div>
                        </div>
       
                                <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Withdraw
                                </button>

                            </div>
                        </div>
    </form>
      
 </div></div></div>

  </body>
</html>