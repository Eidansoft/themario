<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $curso->getId() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $curso->getNombre() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('themario/edit?id='.$curso->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('themario/index') ?>">List</a>
