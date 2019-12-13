<?php if (isset($_SESSION['user'])) :  ?>
  <div class="sidebar-container">
    <div class="sidebar-logo">
      <?=$_SESSION['user']->name ?>
    </div>
    <ul class="sidebar-navigation">
      <li class="header">Navigation</li>
      <li>
        <a href="<?=BASE_URL?>principal/home">
          <i class="fa fa-home" aria-hidden="true"></i>Accueil 
        </a>
      </li>
      <li>
        <a href="<?=BASE_URL?>products/list">
          <i class="fa fa-tags" aria-hidden="true"></i>Produits
        </a>
      </li>
      <li>
        <a href="<?=BASE_URL?>bank/car">
          <i class="fas fa-boxes" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Mofier inventaire
          <?php if (isset($_SESSION['bank']) && count($_SESSION['bank'])>=1) : ?>
          <i class="fas fa-arrow-circle-left arrow"></i>
        <?php endif; ?>
        </a>
      </li>
      <li>
          <a href="<?=BASE_URL?>orders/mylist">
          <i class="fas fa-list-alt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Mon historique
        </a>
      </li>

      <li class="header">Autre Menu</li>
      <li>
          <a href="<?=BASE_URL?>users/gestion">
          <i class="fas fa-users-cog" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Gestion Usagers
        </a>
      </li>
      <li>
          <a href="<?=BASE_URL?>category/gestion">
          <i class="fa fa-cog" aria-hidden="true"></i> Gestion Categories
        </a>
      </li>
      <li>
          <a href="<?=BASE_URL?>products/gestion">
          <i class="fa fa-cog" aria-hidden="true"></i> Gestion Produits
        </a>
      </li>
      <li>
          <a href="<?=BASE_URL?>orders/gestion">
          <i class="fa fa-th-list" aria-hidden="true"></i> Les commandes
        </a>
      </li>
      <li>
        <a href="<?=BASE_URL?>principal/disconnect">
          <i class="fa fa-times-circle" aria-hidden="true"></i> Deconnexion
        </a>
      </li>
    </ul>
  </div>
<?php endif; ?>
