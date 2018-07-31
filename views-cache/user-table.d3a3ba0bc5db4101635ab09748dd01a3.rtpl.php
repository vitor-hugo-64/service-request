<?php if(!class_exists('Rain\Tpl')){exit;}?><tr>
  <th style="width: 35px;">ST</th>
  <th>Nome</th>
  <th>Setor</th>
  <th>Email</th>
  <th style="width: 65px;"></th>
</tr>
<?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
<tr>
  <?php if( $value1["is_active"] == s ){ ?>
  <td><i class="fa fa-user text-success " title="Usuário Ativado" data-toggle="tooltip" data-placement="right"></i></td>
  <?php }else{ ?>
  <td><i class="fa fa-user-slash text-danger" title="Usuário Desativado" data-toggle="tooltip" data-placement="right"></i></td>
  <?php } ?>
  <td><?php echo htmlspecialchars( $value1["first_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["last_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  <td><?php echo htmlspecialchars( $value1["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  <td><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  <td>
    <span>
      <a href="/service-request/admin/user/profile/<?php echo htmlspecialchars( $value1["user_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        <i class="fa fa-user-circle"></i>
        Perfil
      </a>
    </span>
  </td>
</tr>
<?php } ?>