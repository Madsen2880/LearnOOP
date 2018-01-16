<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Navn</th>
        <th scope="col">Pris</th>
        <th scope="col">Vare nummer</th>
        <th scope="col">Beskrivelse</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

<?php


if(isset($_GET['search'])) {
    foreach($products->searchProduct($_GET['search']) as $product) { ?>
    <tr>
        <td><?= $product->name ?></td>
        <td><?= $product->price ?></td>
        <td><?= $product->product_number ?></td>
        <td><?= $product->description ?></td>
        <td><a href="?side=produkt&id=<?=$product->id?>"><button class="btn btn-primary" >Vis Produkt</button></a></td>
    </tr>
        <?php }
} else {
    foreach($products->allProducts() as $product) { ?>
    <tr>
        <td><?= $product->name ?></td>
        <td><?= $product->price ?></td>
        <td><?= $product->product_number ?></td>
        <td><?= $product->description ?></td>
        <td><a href="?side=produkt&id=<?=$product->id?>"><button class="btn btn-primary" >Vis Produkt</button></a></td>
    </tr>
        <?php }
}
?>

    </tbody>
</table>

<a href="index.php?p=products"><button class="btn btn-success">Vis alle produkter</button></a>

