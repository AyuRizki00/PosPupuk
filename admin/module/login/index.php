<h4>User</h4>
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
    $sql = "SELECT * FROM login WHERE id_login = ?";
    $row = $config->prepare($sql);
    $row->execute(array($_GET['uid']));
    $edit = $row->fetch();
?>
    <form method="POST" action="fungsi/edit/edit.php?login=edit">
        <table>
            <tr>
                <td style="width:25pc;">
                    <input type="text" class="form-control" value="<?= $edit['user']; ?>" required name="user" placeholder="Masukkan Nama Pengguna">
                    <input type="hidden" name="id_login" value="<?= $edit['id_login']; ?>">
                </td>
            </tr>
            <tr>
                <td style="width:25pc;">
                    <input type="password" class="form-control" required name="pass" id="password" placeholder="Masukkan Kata Sandi Baru">
                    <br>
                    <input type="checkbox" onclick="togglePasswordVisibility()"> Lihat Kata Sandi
                    <script>
                        function togglePasswordVisibility() {
                            var passwordInput = document.getElementById("password");
                            if (passwordInput.type === "password") {
                                passwordInput.type = "text";
                            } else {
                                passwordInput.type = "password";
                            }
                        }
                    </script>
                </td>
            </tr>
            <tr>
                <td style="padding-left:10px;">
                    <br>
                    <button id="tombol-simpan" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Ubah Data
                    </button>
                </td>
            </tr>
        </table>
    </form>
<?php } else { ?>
    <form method="POST" action="fungsi/tambah/tambah.php?login=tambah">
        <table>
            <tr>
                <td style="width:25pc;"><input type="text" required class="form-control" required name="user_name" placeholder="Masukkan User Name"></td>
                <td style="width:25pc;"><input type="text" required class="form-control" required name="pass" placeholder="Masukkan Password"></td>
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
                    <th>Username</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hasil = $lihat->login();
                $no = 1;
                foreach ($hasil as $isi) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['user']; ?></td>
                        <td><?php echo $isi['pass']; ?></td>
                        <td>
                            <a href="index.php?page=login&uid=<?php echo $isi['id_login']; ?>"><button class="btn btn-warning">Edit</button></a>
                            <a href="fungsi/hapus/hapus.php?login=hapus&id=<?php echo $isi['id_login']; ?>" onclick="javascript:return confirm('Hapus Data login?');"><button class="btn btn-danger">Hapus</button></a>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>