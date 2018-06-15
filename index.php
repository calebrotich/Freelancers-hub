<span id='lippButton'></span>
<script src='https://www.paypalobjects.com/js/external/api.js'></script>
<script>
paypal.use( ['login'], function (login) {
  login.render ({
    "appid":"REPLACE_WITH_YOUR_APPLICATION_ID",
    "scopes":"openid",
    "containerid":"lippButton",
    "locale":"en-us",
    "returnurl":"REPLACE_WITH_YOUR_RETURN_URL"
  });
});
</script>
