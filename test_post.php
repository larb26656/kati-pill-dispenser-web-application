<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <script src="bootstrap/js/jquery-2.2.0.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h3>Popover Example</h3>
  <p>Popovers are not CSS-only plugins, and must therefore be initialized with jQuery: select the specified element and call the popover() method.</p>
  <a href="#" data-toggle="popover" title="Popover Header" data-content='<form><input type="text"/></form>'>Toggle popover</a>
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>

</body>
</html>