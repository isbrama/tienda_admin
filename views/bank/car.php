<div class="content-container ">
  <div class="wrapper table-responsive-lg">
    <h2><i class="fa fa-boxes" aria-hidden="true"></i> Modifier inventaire</h2>
    <?php if (isset($_SESSION['bank']) && count($_SESSION['bank'])>=1) : ?>
    <table id="tableGestion">
      <tr>
        <th>Image</th>
        <th>Nom</th>
        <th>Prix</th>
        <th>Unités</th>
        <th>Action</th>
      </tr>
      <tbody id="tbodyGestion">
      <tr>
        <?php foreach ($bank as $index =>$element)  :
          $product =  $element['product'];
         ?>
        <td><img src="<?=BASE_URL?>images/<?=$product->image?>" alt=""></td>
        <td><?=$product->name?></td>
        <td><?=$element['total_price_units']?>$</td>
        <td>
          <a href="<?=BASE_URL?>bank/down&index=<?=$index?>"><i class="fas fa-minus btn btn-danger"></i></a>
          <?=$element['units']?>
          <a href="<?=BASE_URL?>bank/up&index=<?=$index?>"><i class="fas fa-plus btn btn-success"></i></a>
        </td>
        <td>
          <a href="<?=BASE_URL?>bank/delete&index=<?=$index?>"><i class="fa fa-trash-alt btn btn-danger"></i></a>
        </td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <td></td><td></td>
        <?php $stats = Utils::statsBank(); ?>
        <td><?=$stats['cost']?>$</td>
        <td><?=$stats['units']?></td>
        <td>
          <!-- Button to Open the Modal -->
          <a href="#bankModal" data-toggle="modal" data-target="#bankModal"><i class="fas fa-plus-circle btn btn-success"></i></a>
          <a href="<?=BASE_URL?>bank/deleteall"><i class="fas fa-trash-alt btn btn-danger"></i></a>
        </td>
      </tr>
    </tbody>
    </table>
</div>
  <!-- The Modal -->
  <div class="modal fade" id="bankModal" >
    <div class="modal-dialog modal-xs">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modifier Inventaire</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="formModal" action="<?=BASE_URL?>orders/add" method="post">
            <input type="text" name="cost" value="<?=$stats['cost']?>" hidden>
            <div class="form-group">
              <label for="company">Équipement obtenue par (Nom):</label>
              <input type="text" class="form-control" name="company">
            </div>

          <button type="submit" class="btn btn-success" name="submit"><i class="fas fa-plus-circle"></i></button>
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-angle-left"></i></button>
        </div>

      </div>
    </div>
  </div><!-- The Modal -->
    <?php else: ?>
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Produit:</strong> Ajouter un produit a la liste pour modifier l'inventaire.
      </div>
    <?php endif; ?>
</div>
