<div class="content-container">
  <div class="wrapper table-responsive-lg">
    <h2><i class="fa fa-tags" aria-hidden="true"></i> Produits</h2>
    <ul class="nav nav-pills mb-3 justify-content-center text-center" id="pills-tab" role="tablist">
      <?php if($category->num_rows>0): ?>
        <?php $counter = 0?>
        <?php $catArray = array(); ?>
          <?php while ($cat = $category->fetch_object()) : ?>
            <?php $catArray [] = $cat->id; ?>
              <?php if($counter==0) : ?>
                <?php $pane = 'active'; ?>
              <?php else: ?>
                <?php $pane = ''; ?>
              <?php endif; ?>
              <li class="nav-item">
                <a class="nav-link <?=$pane?> btn-sm "  data-toggle="pill" href="#pills-<?=$catArray [$counter]?>" role="tab" aria-controls="pills-<?=$catArray [$counter]?>" aria-selected="true"><?=$cat->name ?></a>
              </li>
              <?php $counter++;?>
            <?php endwhile; ?>
          <?php endif; ?>
    </ul> <!--fin ul -->
    <?php if(isset($catArray)): ?>
    <div class="tab-content" id="pills-tabContent">
      <?php for ($i=0; $i <= count($catArray)-1; $i++) : ?>
        <?php if ($i == 0) :  ?>
          <?php $pane = 'show active' ; ?>
        <?php else: ?>
          <?php $pane = '' ; ?>
        <?php endif; ?>
        <div class="tab-pane fade <?=$pane ?>" id="pills-<?=$catArray[$i]?>" role="tabpanel" >
          <div class="row">
            <?php
              $products= new Products();
              $products = $products->productsByCategory($catArray[$i]);
             ?>
             <?php if ($products->num_rows>0) : ?>
               <?php while ($product = $products->fetch_object()): ?>
                 <div class="col-lg-3 col-sm-4 d-flex align-items-stretch">
                   <div class="card mx-auto">
                     <img src="<?=BASE_URL?>images/<?=$product->image?>" class="card-img-top">
                     <div class="card-body">
                       <h5 class="card-title"><?=$product->name?></h5>
                       <p class="card-text">Stock: <?=$product->stock?></p>
                       <p class="card-text">Taille: <?=$product->size?></p>
                       <p class="card-text">Prix: <?=$product->price?>$</p>
                       <a href="<?=BASE_URL?>bank/add&id=<?=$product->id?>" ><i class="fas fa-plus btn btn-success"></i></a>
                     </div>
                   </div>
                 </div>
               <?php endwhile; ?>
             <?php endif; ?>
          </div><!--fin row-->
        </div>
      <?php endfor; ?>
    </div><!--tab-content-->
  </div><!--fin wrapper-->
<?php else: ?>
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Produit:</strong> Créer un produit dans la section Gestion produits pour modifier l'inventaire.
  </div>
<?php endif; ?>
</div><!--fin content-container-->
