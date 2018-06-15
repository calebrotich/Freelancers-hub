<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Eagle Lens | Success</title>
    <?php include '../bootstrap.php'; ?>
<style media="screen">
  h2 {
    color: #f4511e;
  }
  .glyphicon {
    font-size: 60px;
  }
</style>
  </head>
  <body class="text-center jumbotron" onload="success()" bg-color="#f2f2f2">
    <h2 class="glyphicon glyphicon-ok"></h2>
<h2>Your Job has been posted Successfully</h2>
<hr>
<h6>You'll be redirected in a short while</h6>
<script type="text/javascript">
  function success() {
    setTimeout(move,2000);
  }
  function move() {
    window.location.replace("account.php?topic=All topics");
  }
</script>
  </body>
</html>
