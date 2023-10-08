<?php
session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    // tambah data kategori
    if (!empty($_GET['kategori'])) {
        $nama = htmlentities(htmlentities($_POST['kategori']));
        $tgl = date("j F Y, G:i");
        $data[] = $nama;
        $data[] = $tgl;
        $sql = 'INSERT INTO kategori (nama_kategori,tgl_input) VALUES(?,?)';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
    }
    // tambah data satuan
    if (!empty($_GET['satuan'])) {
        $nama = htmlentities(htmlentities($_POST['satuan']));
        $tgl = date("j F Y, G:i");
        $data[] = $nama;
        $data[] = $tgl;
        $sql = 'INSERT INTO satuan (nama_satuan,tgl_input) VALUES(?,?)';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=satuan&&success=tambah-data"</script>';
    }
    // tambah data suplayer
    if (!empty($_GET['suplayer'])) {
        $tgl = date("j F Y, G:i");
        $nama = htmlentities(htmlentities($_POST['nama_suplayer']));
        $alamat = htmlentities(htmlentities($_POST['alamat_suplayer']));
        $tlp = htmlentities(htmlentities($_POST['tlp']));
        $data[] = $tgl;
        $data = array($nama, $alamat, $tlp, $tgl);
        $sql = 'INSERT INTO suplayer (nama_suplayer, alamat_suplayer, tlp, tgl_input) VALUES (?, ?, ?, ?)';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=suplayer&&success=tambah-data"</script>';
    }
    // tambah data barang
    if (!empty($_GET['barang'])) {
        $id = htmlentities($_POST['id']);
        $kategori = htmlentities($_POST['kategori']);
        $suplayer = htmlentities($_POST['suplayer']);
        $nama = htmlentities($_POST['nama']);
        $merk = htmlentities($_POST['merk']);
        $beli = htmlentities($_POST['beli']);
        $jual = htmlentities($_POST['jual']);
        $satuan = htmlentities($_POST['satuan']);
        $stok = htmlentities($_POST['stok']);
        $tgl = htmlentities($_POST['tgl']);
        $data[] = $id;
        $data[] = $kategori;
        $data[] = $suplayer;
        $data[] = $nama;
        $data[] = $merk;
        $data[] = $beli;
        $data[] = $jual;
        $data[] = $satuan;
        $data[] = $stok;
        $data[] = $tgl;
        $sql = 'INSERT INTO barang (id_barang,id_kategori,id_suplayer,nama_barang,merk,harga_beli,harga_jual,id_satuan,stok,tgl_input)
			    VALUES (?,?,?,?,?,?,?,?,?,?) ';
        $row = $config->prepare($sql);
        $row->execute($data);
        echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
    }
    // tambah data user
    if (!empty($_GET['login'])) {
        $user = htmlentities($_POST['user_name']);
        $pass = md5($_POST['pass']); // Menggunakan fungsi md5() untuk meng-hash password
        $data = array($user, $pass);
        $sql = "INSERT INTO login (user, pass) VALUES (?, ?)";
        $row = $config->prepare($sql);
        $row->execute($data);
        $id_login = $config->lastInsertId();
        $id_member = $id_login;
        $sql = "INSERT INTO member (id_member) VALUES (?)";
        $row = $config->prepare($sql);
        $row->execute(array($id_member));
        $sql = "UPDATE login SET id_member = ? WHERE id_login = ?";
        $row = $config->prepare($sql);
        $row->execute(array($id_member, $id_login));
        echo '<script>window.location="../../index.php?page=login&&success=tambah-data"</script>';
    }
    if (!empty($_GET['jual'])) {
        $id = $_GET['id'];
        // get tabel barang id_barang
        $sql = 'SELECT * FROM barang WHERE id_barang = ?';
        $row = $config->prepare($sql);
        $row->execute(array($id));
        $hsl = $row->fetch();
        if ($hsl['stok'] > 0) {
            $kasir =  $_GET['id_kasir'];
            $jumlah = 1;
            $total = $hsl['harga_jual'];
            $tgl = date("j F Y, G:i");
            $data1[] = $id;
            $data1[] = $kasir;
            $data1[] = $jumlah;
            $data1[] = $total;
            $data1[] = $tgl;
            $sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
            $row1 = $config->prepare($sql1);
            $row1->execute($data1);
            echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
        } else {
            echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../../index.php?page=jual#keranjang"</script>';
        }
    }
}
