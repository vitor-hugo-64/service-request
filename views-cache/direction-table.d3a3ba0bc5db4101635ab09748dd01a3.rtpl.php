<?php if(!class_exists('Rain\Tpl')){exit;}?><tr>
  <th>ID</th>
  <th>Descrição</th>
  <th>Sigla</th>
  <th style="width: 75px;"></th>
  <th style="width: 75px;"></th>
</tr>
<?php $counter1=-1;  if( isset($directions) && ( is_array($directions) || $directions instanceof Traversable ) && sizeof($directions) ) foreach( $directions as $key1 => $value1 ){ $counter1++; ?>
<tr>
  <td><?php echo htmlspecialchars( $value1["direction_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  <td><?php echo htmlspecialchars( $value1["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  <td><?php echo htmlspecialchars( $value1["initials"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  <td>
    <a href="/service-request/admin/direction/update/<?php echo htmlspecialchars( $value1["direction_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
      <i class="fa fa-edit"></i>
      Editar
    </a>
  </td>
  <td>
    <a class="text-danger" href="#"  data-toggle="modal" data-target="#modal-delete-<?php echo htmlspecialchars( $value1["direction_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
      <i class="fa fa-trash"></i>
      Excluir
    </a>
  </td>                  
</tr>

<div class="modal fade" id="modal-delete-<?php echo htmlspecialchars( $value1["direction_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-danger">Excluir</h4>
        </div>
        <div class="modal-body">
          <p>Tem certeza que deseja excluir determinada direção?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <a href="/service-request/admin/direction/delete/<?php echo htmlspecialchars( $value1["direction_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="button" class="btn btn-danger">
            Confirmar
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php } ?>