<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $cuestionario->getId() ?></td>
    </tr>
    <tr>
      <th>Contenido:</th>
      <td><?php echo $cuestionario->getContenidoId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('cuestionario/edit?id='.$cuestionario->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('cuestionario/index') ?>">List</a>
