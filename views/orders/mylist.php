<div class="content-container ">
  <div class="wrapper table-responsive-lg">
    <h2><i class="fa fa-list-alt" aria-hidden="true"></i> Mon historique</h2>
    <?php if($orders->num_rows > 0): ?>
    <table id="tableGestion">
      <tr>
        <th>Id</th>
        <th>Cout</th>
        <th>Date</th>
        <th>Obtenue par</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      <tbody id="tbodyGestion">
      <?php while($order = $orders->fetch_object()): ?>
      <tr>
        <td><?=$order->id ?></td>
        <td><?=$order->cost ?></td>
        <td><?=$order->date ?></td>
        <td><?=$order->company ?></td>
        <td><?=$order->status ?></td>
        <td>
          <a href="<?=BASE_URL?>orders/detail&id=<?=$order->id?>"><i class="fas fa-eye btn btn-info"></i></a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
    <tr>
      <td>
        <div class="input-wrapper">
          <i class="fas fa-search-plus"></i>
          <input id="filterGestion" type="text" placeholder="Commande...">
        </div>
      </td>
    </tr>
    </table>
  </div>
<?php else: ?>
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Inventaire:</strong> Aucun historique de modification.
  </div>
<?php endif; ?>
  </div>
