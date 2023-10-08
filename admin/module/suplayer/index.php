<h4>Distributor</h4>
<br />
<?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">
        <p>Tambah Data Berhasil!</p>
    </div>
<?php } ?>
<?php if (isset($_GET['success-edit'])) { ?>
    <div class="alert alert-success">
        <p>Update Data Berhasil!</p>
    </div>
<?php } ?>
<?php if (isset($_GET['remove'])) { ?>
    <div class="alert alert-danger">
        <p>Hapus Data Berhasil!</p>
    </div>
<?php } ?>
<?php
if (!empty($_GET['uid'])) {
    $sql = "SELECT * FROM suplayer WHERE id_suplayer = ?";
    $row = $config->prepare($sql);
    $row->execute(array($_GET['uid']));
    $edit = $row->fetch();
?>
    <form method="POST" action="fungsi/edit/edit.php?suplayer=edit">
        <table>
            <tr>
                <td style="width:25pc;"><input type="text" class="form-control" value="<?= $edit['nama_suplayer']; ?>" required name="nama_suplayer" placeholder="Masukkan Nama Distributor">
                    <input type="hidden" name="id_suplayer" value="<?= $edit['id_suplayer']; ?>">
                </td>
            </tr>
            <tr>
                <td style="width:25pc;"><input type="text" class="form-control" value="<?= $edit['alamat_suplayer']; ?>" required name="alamat_suplayer" placeholder="Masukkan Alamat Distributor"></td>
            </tr>
            <tr>
                <td style="width:25pc;"><input type="text" class="form-control" value="<?= $edit['tlp']; ?>" required name="tlp" placeholder="Masukkan No. Telepon"></td>
                <td style="padding-left:10px;"><button id="tombol-simpan" class="btn btn-primary"><i class="fa fa-edit"></i>
                        Ubah Data</button></td>
            </tr>
        </table>
    </form>
<?php } else { ?>
    <form method="POST" action="fungsi/tambah/tambah.php?suplayer=tambah">
        <table>
            <tr>
                <td style="width:25pc;"><input type="text" class="form-control" required name="nama_suplayer" placeholder="Masukkan Nama Distributor"></td>
            </tr>
            <tr>
                <td style="width:25pc;"><input type="text" class="form-control" required name="alamat_suplayer" placeholder="Masukkan Alamat Distributor"></td>
            </tr>
            <tr>
                <td style="width:25pc;"><input type="text" class="form-control" required name="tlp" placeholder="Masukkan No. Telepon"></td>
                <td style="padding-left:10px;">
                    <button id="tombol-simpan" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        Insert Data
                    </button>
                </td>
            </tr>
        </table>
    </form>
<?php } ?>
<br />
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#DFF0D8;color:#333;">
                    <th>No.</th>
                    <th>Nama Distributor</th>
                    <th>Alamat Distributor</th>
                    <th>No. Telepon</th>
                    <th>Tgl Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hasil = $lihat->suplayer();
                $no = 1;
                foreach ($hasil as $isi) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['nama_suplayer']; ?></td>
                        <td><?php echo $isi['alamat_suplayer']; ?></td>
                        <td><?php echo $isi['tlp']; ?></td>
                        <td><?php echo $isi['tgl_input']; ?></td>
                        <td>
                            <a href="index.php?page=suplayer&uid=<?php echo $isi['id_suplayer']; ?>"><button class="btn btn-warning">Edit</button></a>
                            <a href="fungsi/hapus/hapus.php?suplayer=hapus&id=<?php echo $isi['id_suplayer']; ?>" onclick="javascript:return confirm('Hapus Data Suplayer?');"><button class="btn btn-danger">Hapus</button></a>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>