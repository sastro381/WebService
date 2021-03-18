<?php echo $this->session->flashdata('hasil'); ?>
<table border="1">
    <tr><th>NIM</th><th>NAMA</th><th>ID JURUSAN</th><th>ALAMAT</th><th></th></tr>
    <?php
    foreach ($mahasiswa as $m){
      ?>
      <tr>
        <td><?php echo $m->nim ?></td>
        <td><?php echo$m->nama?></td>
        <td><?php echo$m->nama_jurusan?></td>
        <td><?php echo$m->alamat?></td>
        <td><?php echo anchor('mahasiswa/edit/'.$m->nim,'Edit');?> | <?php echo anchor('mahasiswa/delete/'.$m->nim,'Delete'); ?></td>
      </tr>
      <?php
    }
    ?>
</table>
</br>
<?php echo anchor('mahasiswa/create','Tambah');?>