
<script>

</script>

<!-- worldmap -->
<!--<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/maps/jquery-jvectormap-2.0.1.min.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/maps/gdp-data.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/maps/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/maps/jquery-jvectormap-us-aea-en.js"></script>-->

<!-- skycons -->
<script src="<?php echo Plantillas::$url ?>js/skycons/skycons.js"></script>
<script>
  var icons = new Skycons({
    "color": "#73879C"
  }), list = [
    "clear-day", "clear-night", "partly-cloudy-day",
    "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
    "fog"
  ], i;

  for (i = list.length; i--; ) {
    icons.set(list[i], list[i]);
  }
  icons.play();
</script>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

