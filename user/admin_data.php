
<?php
include("../login/auth.php");
require '../login/db.php';
$session=$_SESSION['username'];
$id = $_SESSION['id'];
if ($_SESSION['priv'] < 1) {
  header('location: account.php?topic=technology');
}

if (isset($_POST['sugg'])) {
  $query = "SELECT * FROM topic_suggestions INNER JOIN users ON topic_suggestions.sugg_owner = users.id";
  $res = mysqli_query($connection,$query);
  $row = mysqli_num_rows($res);
  if ($row > 0) {
    ?>
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>Suggestion</th>
        <th>Suggested by</th>
        <th>User Id</th>
        <th>Time</th>
        <th>Consider</th>
        <th>Ignore</th>
      </tr>
      <?php
      while ($array = mysqli_fetch_array($res)) {
        echo "<tr>
        <td>".$array['sugg_name']."</td>
        <td>".$array['firstName']." ".$array['lastName']."</td>
        <td>".$array['sugg_owner']."</td>
        <td>".$array['sugg_time']."</td>
        <input id='sugg_name".$array['sugg_id']."' type='text' name='' value='".$array['sugg_name']."' hidden=''>
        <input id='sugg_owner".$array['sugg_id']."' type='text' name='' value='".$array['sugg_owner']."' hidden=''>
        <td onclick='consider()' class='text-center consider' title='Suggestion will be added to the topics'><span class='glyphicon glyphicon-ok'></span></td>
        <td onclick='ignore()' class='text-center ignore' title='Suggestion will be deleted permanently'><span class='glyphicon glyphicon-remove'></span></td>

        </tr>";
        ?>
        <script type="text/javascript">
        function consider() {
          var cont = confirm("Are you sure you want to add \n <?php echo $array['sugg_name']; ?> \n to be one of the topics?");
          if (cont == true) {
            $.post("admin_data.php",{consider:1,name:'<?php echo $array['sugg_name']; ?>', credit:'<?php echo $array['sugg_owner']; ?>'},function(data) {

              load_topics();
              load_sugg();
            });
          }

        }
        function ignore() {
          var cont = confirm("Are you sure you want to remove \n <?php echo $array['sugg_name']; ?> \n permanently?");
          if (cont == true) {
            $.post("admin_data.php",{ignore:1,name:'<?php echo $array['sugg_name']; ?>'},function(data) {

              load_topics();
              load_sugg();
            });
          }

        }
        </script>
        <?php
      }
       ?>
    </table>
    <?php
  } else {
    echo "<div class='jumbotron text-center'><p>Suggestions appear here. <br> No suggestions currently.</p></div>";
  }

}


if (isset($_POST['topic'])) {
  $query = "SELECT * FROM topics INNER JOIN users ON topics.credit = users.id ORDER BY name";
  $res = mysqli_query($connection,$query);
  ?>
  <table class="table table-bordered table-hover table-striped">
    <tr>
      <th>Topic Name</th>
      <th>Topic Credits</th>
      <th>User ID</th>
      <th>Time</th>
    </tr>
    <?php
    while ($array = mysqli_fetch_array($res)) {
      echo "<tr>
      <td>".$array['name']."</td>
      <td>".$array['firstName']." ".$array['lastName']."</td>
      <td>".$array['credit']."</td>
      <td>".$array['time']."</td>


      </tr>";
    }
     ?>
  </table>
  <?php
}

if (isset($_POST['consider'])) {
  $name = $_POST['name'];
  $credit = $_POST['credit'];

  $add_q = "INSERT INTO topics(name,credit) VALUES('$name','$credit')";
  $add_r = mysqli_query($connection, $add_q) or die(mysqli_error($connection));

if ($add_r) {
  $remove_q = "DELETE FROM topic_suggestions WHERE sugg_name = '$name'";
  $remove_r = mysqli_query($connection, $remove_q);
}


}


if (isset($_POST['ignore'])) {
  $name = $_POST['name'];
  //$credit = $_POST['credit'];


  $remove_q = "DELETE FROM topic_suggestions WHERE sugg_name = '$name'";
  $remove_r = mysqli_query($connection, $remove_q);



}
 ?>
