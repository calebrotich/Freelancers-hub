
$(document).ready(function() {

  $('#login').click(function() {

      $.ajax({
          type: "POST",
          url: '../processlogin.php',
          data: {
              username: $("#username").val(),
              password: $("#password").val()
          },
          success: function(data)
          {
              if (data === 'Correct') {
              //  alert(data);
                  window.location.replace('../user/account.php');
              }
              else {
                  document.getElementById("error").innerHTML="WORST ERROR EVER";
              }
          }

      });

  });

});
