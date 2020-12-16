<?php

session_start();?>

<script>alert("LOGOUT! BYE~");
</script>
<?php
session_destroy();
?>
<script>
location.replace('./login.php');
</script>