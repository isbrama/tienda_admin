<div class="content-container ">
  <div class="wrapper table-responsive-lg">
    <h2><i class="fa fa-boxes" aria-hidden="true"></i> Modification confirmée</h2>
    <table id="tableGestion">
      <tr>
        <th>Image</th>
        <th>Produit</th>
        <th>Unités</th>
        <th>Prix</th>
      </tr>
      <tbody id="tbodyGestion">
      <?php while ($order = $orders->fetch_object()) :  ?>
        <tr>
        <td><img src="<?=BASE_URL?>images/<?=$order->image?>" alt=""></td>
        <td><?=$order->name?></td>
        <td><?=$order->units?></td>
        <td><?=$order->totalPrice?>$</td>
        </tr>
    <?php endwhile; ?>
        <tr>
          <td><a id="back" href="" ><i class="fas fa-chevron-left btn btn-success"></i></a></td>
        </tr>
    </tbody>
    </table>
  </div>
</div>
