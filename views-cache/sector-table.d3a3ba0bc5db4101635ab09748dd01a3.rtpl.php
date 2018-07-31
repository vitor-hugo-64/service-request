<?php if(!class_exists('Rain\Tpl')){exit;}?><tr>
  <th>ID</th>
  <th>Descrição</th>
  <th>Direção</th>
  <th style="width: 75px;"></th>
  <th style="width: 75px;"></th>
</tr>
<?php $counter1=-1;  if( isset($sectors) && ( is_array($sectors) || $sectors instanceof Traversable ) && sizeof($sectors) ) foreach( $sectors as $key1 => $value1 ){ $counter1++; ?>
<tr>
  <td><?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  <td><?php echo htmlspecialchars( $value1["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  <td><?php echo htmlspecialchars( $value1["description_direction"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  <td>
    <a href="/service-request/admin/sector/update/<?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
      <i class="fa fa-edit"></i>
      Editar
    </a>
  </td>
  <td>
    <a class="text-danger" href="#" data-toggle="modal" data-target="#modal-delete-<?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
      <i class="fa fa-trash"></i>
      Excluir
    </a>
  </td>  
  <!-- modal-content -->
  <div class="modal fade" id="modal-delete-<?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger">Excluir</h4>
          </div>
          <div class="modal-body">
            <p>Tem certeza que deseja excluir determinado setor?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <a href="/service-request/admin/sector/delete/<?php echo htmlspecialchars( $value1["sector_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" type="button" class="btn btn-danger">
              Confirmar
            </a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </tr>

  <?php } ?>