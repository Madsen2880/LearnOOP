<div class="container">
<a href="index.php?side=search"><p>Foretag ny søgning.</p></a>
<?php

$singleProd = $products->singleProduct($_GET['id']);

        ?>
            <img src="http://via.placeholder.com/350x150" alt="">
            <h3><?= $singleProd->name ?></h3><br>
            <p>Pris: <?= $singleProd->price ?></p><br>
            <p>Varenummer: <?= $singleProd->product_number ?></p><br>
            <hr>
            <p><?= $singleProd->description ?></p>

</div>