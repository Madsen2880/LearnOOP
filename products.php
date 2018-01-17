<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead">
                <tr>
                    <th scope="col">Navn</th>
                    <th scope="col">Pris</th>
                    <th scope="col">Vare nummer</th>
                    <th scope="col">Beskrivelse</th>
                    <th scope="col">Handling</th>
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
                            <td>
                                <a href="?side=produkt&id=<?=$product->id?>"><button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Vis produkt"><i class="fas fa-external-link-alt"></i> </button></a>
                                <a href="?side=redigerProdukt&id=<?=$product->id?>"><button class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Rediger produkt"><i class="fas fa-edit"></i> </button></a>
                                <a href="?side=sletProdukt&id=<?=$product->id?>"><button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Slet produkt"><i class="fas fa-ban"></i> </button></a>
                            </td>
                        </tr>
                    <?php }
                } else {
                    foreach($products->allProducts() as $product) { ?>
                        <tr>
                            <td><?= $product->name ?></td>
                            <td><?= $product->price ?></td>
                            <td><?= $product->product_number ?></td>
                            <td><?= $product->description ?></td>
                            <td>
                                <a href="?side=produkt&id=<?=$product->id?>"><button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Vis produkt"><i class="fas fa-external-link-alt"></i> </button></a>
                                <a href="?side=redigerProdukt&id=<?=$product->id?>"><button class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Rediger produkt"><i class="fas fa-edit"></i> </button></a>
                                <a href="?side=sletProdukt&id=<?=$product->id?>"><button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Slet produkt"><i class="fas fa-ban"></i> </button></a>
                            </td>
                        </tr>
                    <?php }
                }
                ?>

                </tbody>
            </table>

            <a href="index.php?side=produkter"><button class="btn btn-success">Vis alle produkter</button></a> &nbsp;
            <a href="index.php?side=nytProdukt"><button class="btn btn-primary">Opret nyt produkt</button></a>

        </div>
    </div>
</div>


