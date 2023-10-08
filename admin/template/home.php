<?php
// Ambil data penjualan dari tabel nota
$sql = "SELECT periode, SUM(total) AS total_penjualan FROM nota GROUP BY periode ORDER BY periode ASC";
$row = $config->prepare($sql);
$row->execute();
$data_penjualan = $row->fetchAll(PDO::FETCH_ASSOC);
?>

<h3>Dashboard</h3>
<br />

<?php
$sql = "SELECT COUNT(*) AS count FROM barang WHERE stok <= 3";
$row = $config->prepare($sql);
$row->execute();
$r = $row->fetch(PDO::FETCH_ASSOC);
$barang_tersedia = $r['count'];

if ($barang_tersedia > 0) {
    echo "
        <div class='alert alert-warning'>
            <span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$barang_tersedia</span> barang yang stok tersisa sudah kurang dari 3 item. Silakan pesan lagi!
            <span class='pull-right'><a href='index.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
        </div>";
}
?>

<div class="row">
    <!-- STATUS cards -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Nama Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <?php
                    $sql = "SELECT COUNT(*) AS count FROM barang";
                    $row = $config->prepare($sql);
                    $row->execute();
                    $hasil_barang = $row->fetch(PDO::FETCH_ASSOC)['count'];
                    ?>
                    <h1><?php echo number_format($hasil_barang); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>Tabel Barang <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
    </div><!-- /col-md-3-->

    <!-- STATUS cards -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Stok Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <?php
                    $sql = "SELECT SUM(stok) AS jml FROM barang";
                    $row = $config->prepare($sql);
                    $row->execute();
                    $stok = $row->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <h1><?php echo number_format($stok['jml']); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>Tabel Barang <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
    </div><!-- /col-md-3-->

    <!-- STATUS cards -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fas fa-upload"></i> Telah Terjual</h6>
            </div>
            <div class="card-body">
                <center>
                    <?php
                    $sql = "SELECT SUM(stok) AS stok FROM penjualan";
                    $row = $config->prepare($sql);
                    $row->execute();
                    $jual = $row->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <h1><?php echo number_format($jual['stok']); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=laporan'>Tabel Laporan <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
    </div><!-- /col-md-3-->

    <!-- STATUS cards -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fa fa-bookmark"></i> Kategori Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <?php
                    $sql = "SELECT COUNT(*) AS count FROM kategori";
                    $row = $config->prepare($sql);
                    $row->execute();
                    $hasil_kategori = $row->fetch(PDO::FETCH_ASSOC)['count'];
                    ?>
                    <h1><?php echo number_format($hasil_kategori); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=kategori'>Tabel Kategori <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
    </div><!-- /col-md-3-->

    <!-- STATUS cards -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fa fa-th"></i> Satuan Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <?php
                    $sql = "SELECT COUNT(*) AS count FROM satuan";
                    $row = $config->prepare($sql);
                    $row->execute();
                    $satuan = $row->fetch(PDO::FETCH_ASSOC)['count'];
                    ?>
                    <h1><?php echo number_format($satuan); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=satuan'>Tabel Satuan <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
    </div><!-- /col-md-3-->

    <!-- STATUS cards -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fa fa-users"></i> Supplier Barang</h6>
            </div>
            <div class="card-body">
                <center>
                    <?php
                    $sql = "SELECT COUNT(*) AS count FROM suplayer";
                    $row = $config->prepare($sql);
                    $row->execute();
                    $supplier = $row->fetch(PDO::FETCH_ASSOC)['count'];
                    ?>
                    <h1><?php echo number_format($supplier); ?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=suplayer'>Tabel Supplier <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
    </div><!-- /col-md-3-->
</div><!-- /row -->

<!-- Bagian Chart Penjualan -->
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="pt-2"><i class="fa fa-chart-line"></i> Grafik Penjualan</h6>
            </div>
            <div class="card-body">
                <canvas id="chartPenjualan"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('chartPenjualan').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php foreach ($data_penjualan as $data) { ?> '<?php echo $data['periode']; ?>',
                <?php } ?>
            ],
            datasets: [{
                label: 'Total Penjualan',
                data: [
                    <?php foreach ($data_penjualan as $data) { ?>
                        <?php echo $data['total_penjualan']; ?>,
                    <?php } ?>
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                    }
                }
            }
        }
    });
</script>