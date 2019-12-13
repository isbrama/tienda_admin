<div class="content-container ">
  <div class="wrapper table-responsive-lg">
    <h2><i class="fa fa-users" aria-hidden="true"></i> Gestion usagers</h2>
    <table id="tableGestion">
      <tr>
        <th hidden>Id</th>
        <th>Nom</th>
        <th>Usager</th>
        <th>Rôle</th>
        <th>Action</th>
      </tr>
      <tbody id="tbodyGestion">
      <?php while($identity = $user->fetch_object()) : ?>
      <tr>
        <td hidden><?=$identity->id ?></td>
        <td><?=$identity->name ?></td>
        <td><?=$identity->email ?></td>
        <td><?=$identity->rol ?></td>
        <td>
          <a href="#usersModal" id="<?=$identity->id?>" class="usersModal" data-toggle="modal" data-target="#usersModal" ><i class="fas fa-user-edit btn btn-info"></i></a>
          <a href="<?=BASE_URL?>users/delete&id=<?=$identity->id?>"><i class="far fa-trash-alt btn btn-danger"></i></a>
        </td>
      </tr>
      <?php endwhile; ?>
      <tr>
        <!-- Button to Open the Modal -->
        <td>
          <a href="#usersModal" class="addUser" data-toggle="modal" data-target="#usersModal"><i class="fas fa-user-plus  btn btn-success"></i></a>
        </td>
      </tr>
    </tbody>
    </table>
  </div><!--wrapper -->

    <!-- The Modal -->
    <div class="modal fade" id="usersModal" >
      <div class="modal-dialog modal-xs">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Ajouter usager</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form id="formModal" action="<?=BASE_URL?>users/add" method="post">
              <input type="text" name="id" id="id" hidden>
              <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" class="form-control" name="name" id="name">
              </div>
            <div class="form-group">
              <label for="email">Courriel:</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="text" class="form-control" name="password" id="password">
            </div>
            <div class="form-group">
             <label for="rol">Rôle:</label>
             <select class="form-control" name="rol" id="rol">
               <option>admin</option>
               <option>user</option>
             </select>
           </div>
            <button type="submit" class="btn btn-success" id="add" name="submit"><i class="fas fa-user-plus"></i></button>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-angle-left"></i></button>
          </div>

        </div>
      </div>

    </div><!-- The Modal -->

</div><!-- content-container  -->
