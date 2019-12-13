  <div class="center">
    <form class="formAdmin" action="<?=BASE_URL?>users/login" method="post">
      <h5 class="text-dark">Panneau d'administration</h5>
      <hr class="hrForm text-dark">
      <div class="form-group ">
        <div class="row">
          <div class="col-sm-12">
            <?php if (isset($_SESSION['error_login']))  : ?>
              <div class="alert alert-danger alert-dismissible" style="margin-top:0px; width:280px;  z-index:3; position:absolute">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                  <strong><i class="fa fa-exclamation-triangle"></i> <?=$_SESSION['error_login'] ?></strong>
              </div>
              <?php endif; ?>
            <input type="email" class="form-control" name="email" placeholder="Nom d'utilisateur" required>
            <span class="fa fa-user-circle ispan"></span>
          </div>
          <div class="col-sm-12">
            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
            <span class="fa fa-key ispan"></span>
          </div>
        </div>
      </div>
      <button type="submit" name="submit" class="btn btn-dark">Se connecter</button>
    </form>
  </div>
    <div class="screw">
      <img class="img1" src="<?=BASE_URL ?>images/screw1.png">
      <img class="img2" src="<?=BASE_URL ?>images/screw3.png">
    </div>
