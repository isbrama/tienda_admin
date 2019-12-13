<div class="content-container ">
  <div class="wrapper table-responsive-lg">
    <h2><i class="fa fa-cog" aria-hidden="true"></i> Gestion produits</h2>
    <?php if ($category->num_rows > 0) :?>
    <table id="tableGestion">
      <tr>
        <th hidden>Id</th>
        <th>Produit</th>
        <th>Catégorie</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Stock</th>
        <th>Taille</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
      <tbody id="tbodyGestion">
      <?php while($pro= $product->fetch_object()) : ?>
      <tr>
        <td hidden><?=$pro->id ?></td>
        <td><?=$pro->name ?></td>
        <td><?=$pro->category?></td>
        <td><?=$pro->description ?></td>
        <td><?=$pro->price ?></td>
        <td><?=$pro->stock ?></td>
        <td><?=$pro->size ?></td>
        <td><img src="<?=BASE_URL?>images/<?=$pro->image ?>"></td>
        <td hidden><?=$pro->category_id?></td>
        <td>
          <a href="#productsModal" id="<?=$pro->id?>" class="productsModal" data-toggle="modal" data-target="#productsModal"><i class="fas fa-edit btn btn-info"></i></a>
          <a href="<?=BASE_URL?>products/delete&id=<?=$pro->id?>"><i class="far fa-trash-alt btn btn-danger"></i></a>
        </td>
      </tr>
      <?php endwhile; ?>
        </tbody>
        <tr>
          <!-- Button to Open the Modal -->
          <td><a href="#productsModal" class="addProduct" data-toggle="modal" data-target="#productsModal"><i class="fas fa-plus btn btn-success"></i></a></td>
          <td>
            <div class="input-wrapper">
              <i class="fas fa-search-plus"></i>
              <input id="filterGestion" type="text" placeholder="Produit...">
            </div>
          </td>
        </tr>
    </table>
  </div>

  <!-- The Modal -->
  <div class="modal fade" id="productsModal">
    <div class="modal-dialog modal-xs">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ajouter produit</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="formModal" action="<?=BASE_URL?>products/add" method="post" enctype="multipart/form-data">
            <input type="text" name="id" id="id" hidden>
            <div class="form-group">
              <label for="name">Nom:</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="category">Catégorie:</label>
                <select class="form-control" name="category_id" id="category_id">
                  <?php while ($cat = $category->fetch_object()) : ?>
                  <option value="<?=$cat->id?>"><?=$cat->name?></option>
                  <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
              <label for="name">Description:</label>
              <input type="text" class="form-control" name="description" id="description">
            </div>
            <div class="form-group">
              <label for="name">Prix:</label>
              <input type="number" class="form-control" name="price" id="price">
            </div>
            <div class="form-group">
              <label for="name">Unités:</label>
              <input type="number" class="form-control" name="stock" id="stock">
            </div>
            <div class="form-group">
                <label for="category">Taille:</label>
                <select class="form-control" name="size" id="size">
                  <option value="XSY">XSY</option>
                  <option value="SY">SY</option>
                  <option value="MY">MY</option>
                  <option value="LY">LY</option>
                  <option value="XLY">XLY</option>
                  <option value="XS">XS</option>
                  <option value="S">S</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
                </select>
            </div>
            <div class="custom-file mb-4 mt-3">
              <input type="file" class="custom-file-input" id="image" name="image">
              <label class="custom-file-label" for="customFile">Choisir image:</label>
            </div>

            <button type="submit" class="btn btn-success" id="add" name="submit"><i class="fa fa-plus"></i></button>
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-angle-left"></i></button>
        </div>

      </div>
    </div>
  </div><!-- The Modal -->
  <?php if (isset($_SESSION['error_products']))  : ?>
    <div class="alert alert-danger alert-dismissible" style="width:400px; margin:0 auto; text-align:center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
        <strong><i class="fa fa-exclamation-triangle"></i> <?=$_SESSION['error_products']?></strong>
    </div>
  <?php endif; ?>
<?php else: ?>
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Produit:</strong> Ajouter une catégorie dans la section Gestion catégories avant de créer un produit.
  </div>
<?php endif; ?>
</div>
