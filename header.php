<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
  <a target="_blank" class="<?php echo basename($_SERVER['PHP_SELF']) == 'api_ocap_sites.php' ? 'active' : ''; ?>" href="api_ocap_sites.php">Get Ocap Sites</a>
  <a target="_blank" class="<?php echo basename($_SERVER['PHP_SELF']) == 'user_api.php' ? 'active' : ''; ?>" href="user_api.php">Get Users</a>
  <a target="_blank" class="<?php echo basename($_SERVER['PHP_SELF']) == 'study.php' ? 'active' : ''; ?>" href="study.php">Get Study</a>
  <a target="_blank" class="<?php echo basename($_SERVER['PHP_SELF']) == 'site_code_empty_api.php' ? 'active' : ''; ?>" href="site_code_empty_api.php">Site Code Empty</a>
</div>




</body>
</html>
