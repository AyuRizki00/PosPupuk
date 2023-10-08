if (!empty(htmlentities($_GET['satuan']))) {
$id = htmlentities($_GET['id']);
$data[] = $id;
$sql = 'DELETE FROM satuan WHERE id_satuan=?';
$row = $config->prepare($sql);
$row->execute($data);
echo '<script>
    window.location = "../../index.php?page=satuan&&remove=hapus-data"
</script>';
}