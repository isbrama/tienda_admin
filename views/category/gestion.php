<div class="content-container ">
  <div class="wrapper table-responsive-lg">
    <h2><i class="fa fa-cog" aria-hidden="true"></i> Gestion catégorie</h2>
    <table id="tableGestion">
      <tr>
        <th hidden>Id</th>
        <th>Nom</th>
        <th>Action</th>
      </tr>
      <tbody id="tbodyGestion">
      <?php while($cat= $category->fetch_object()) : ?>
      <tr>
        <td hidden><?=$cat->id ?></td>
        <td><?=$cat->name ?></td>
        <td>
          <a href="#categoryModal" id="<?=$cat->id?>" class="categoryModal" data-toggle="modal" data-target="#categoryModal" ><i class="fas fa-edit btn btn-info"></i></a>
          <a href="<?=BASE_URL?>category/delete&id=<?=$cat->id?>"><i class="far fa-trash-alt btn btn-danger"></i></a>
        </td>
      </tr>
      <?php endwhile; ?>
      <tr>
        <!-- Button to Open the Modal -->
        <td><a href="#categoryModal" class="addCategory" data-toggle="modal" data-target="#categoryModal"><i class="fas fa-plus btn btn-success"></i></a></td>
      </tr>
    </tbody>
    </table>
  </div>

    <!-- The Modal -->
    <div class="modal fade" id="categoryModal" >
      <div class="modal-dialog modal-xs">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Ajouter catégorie</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form id="formModal" action="<?=BASE_URL?>category/add" method="post">
              <input type="text" name="id" id="id" hidden>
              <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" class="form-control" name="name" id="name">
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
    <?php if (isset($_SESSION['error_category']))  : ?>
      <div class="alert alert-danger alert-dismissible" style="width:400px; margin:0 auto; text-align:center">
          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
          <strong><i class="fa fa-exclamation-triangle"></i> <?=$_SESSION['error_category']?></strong>
      </div>
    <?php endif; ?>
</div>
