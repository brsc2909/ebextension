<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>search results</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type = "text/css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="../css/style.css" type = "text/css" media="screen" title="no title" charset="utf-8">

  </head>
  <body>

    <div id="container">
        <div id  = "header">
          <div class = "headTop">
            <div class = "row">
              <div class = "top-right">
                <button id = "newUser" class = "btn btn-primary" name="button1">register</button>
                <button id = "sign-in" class = "btn btn-primary" name="button2">sign in</button>
                <script type="text/javascript">
                 document.getElementById('newUser').onclick = function(){
                    window.open("forms.php","","width = 400, height = 360, status = no, titlebar = no, toolbar = no");
                  }</script>
              </div>
            </div>
          </div>
          <div class = "headBottom">
            <div class="searchbar row">
              <form action="search.php" method="post">
                <div class="col-lg-11">
                    <div class="input-group">
                      <input type="text" class="form-control" name = "Searchtxt" placeholder = "search.." aria-label="...">
                      <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">catagory <span class="caret"></span></button>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#">Catagory</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                          </ul>
                      </div><!-- /btn-group -->
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" name = "search">Search</button>
                      </span>
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->            
              </form>
            </div><!-- /.searchbar -->
          </div><!-- /.headBottom  -->
        </div>
        <!--***********end of header************-->
        <div id ="content">


				<div id ="navi" class = "panel panel-primary">
          <h3 class="navitxt">navigation pane</h3>
          <ul class = "nav nav-pills nav-stacked">
            <li><a href = "../" class = "selected" href=" ">home</a></li>
            <li><a href="#">more</a></li>
            <li><a href="#">about</a></li>
          </ul>
      </div> <!-- /#navi -->

      <div id="main" class = "searchscreen">
          <?php
           include "connection.php";
           $search  = $_POST['Searchtxt'];

           $sql = "SELECT * FROM user where username LIKE '%$search%' OR firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR email LIKE'%$search%'";
           $result = mysqli_query($conn, $sql);

           if (mysqli_num_rows($result) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($result)) {
                $picture  = $row["picture"];
                  echo
                  "<div class = 'panel panel-default'>
                    <div class = 'panel-heading'>
                      <h3 class = 'panel-title'>" . $row["firstname"]. " " . $row["lastname"]."</h3>
                    </div>". // panel title
                    "<div class = 'panel-body userContent'>
                      <button type = 'button' class = 'list-group-item'>
                      <div class = 'userPic'>
                        <img src  = $picture alt  = 'no picture' style = 'width:100px; height:100px'>
                      </div>
                      <div class = 'userDetails'>".
                        " id: " . $row["id"]."<br>".
                        " username: " . $row["username"]."<br>".
                        " D.O.B: " . $row["DOB"]."<br>".
                        " Email: ". $row["email"].
                        "</div>
                      </div>
                    </button>
                  </div>"; //panel
              }
          } else {
              echo "0 results";
          }
          mysqli_close($conn);
        ?>
       </div> <!-- /#main -->

      <div id="footer">
        <div class = "info">
          .
        </div><!-- /.info -->

        <div class "copyright">
          copyright &copy; 2016 brendan scullion 
        </div><!-- /.copyright -->
      </div><!-- /#footer -->
    </div><!-- /#container -->


  </body>
</html>
