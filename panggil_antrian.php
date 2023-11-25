<div class="card" style="background: transparent;">
  <div class="card-body">
<?php
$dateNow = date('Y-m-d');

$qryPoli = mysqli_query($koneksidb, "SELECT * FROM poli WHERE nama_poli='$_SESSION[SES_LEVEL]'");
$dataPoli = mysqli_fetch_array($qryPoli);

$jmlAntrian = mysqli_num_rows(mysqli_query($koneksidb, "SELECT * FROM antrian WHERE id_poli='$dataPoli[id]' AND tanggal='$dateNow'"));
$jmlAntrianAktif = mysqli_num_rows(mysqli_query($koneksidb, "SELECT * FROM antrian WHERE id_poli='$dataPoli[id]' AND tanggal='$dateNow' AND status='T'"));

$page = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
$limit = 1; // Jumlah data per halamannya
$limit_start = ($page - 1) * $limit;

$query = mysqli_query($koneksidb, "SELECT pasien.nama_pasien, poli.nama_poli, poli.inisial, poli.nama_dokter,antrian.* FROM antrian
                                   LEFT JOIN pasien ON antrian.id_pasien=pasien.id
                                   LEFT JOIN poli ON antrian.id_poli=poli.id
                                   WHERE antrian.id_poli='$dataPoli[id]' AND antrian.tanggal='$dateNow'
                                   ORDER BY antrian.id ASC LIMIT $limit_start, $limit");
while ($data = mysqli_fetch_array($query)) {
  $loket = trim($data['inisial']);
  // Update antrian yg aktif
  $updateQry1 = mysqli_query($koneksidb,"UPDATE poli SET id_antrian='$data[id]' WHERE id='$data[id_poli]'");
  
	if(isset($_GET['update'])){
		// Update antrian tidak dilayani
		$updateQry3 = mysqli_query($koneksidb,"UPDATE antrian SET status='T' WHERE id='$_GET[update]'");
	}
	elseif(isset($_GET['status'])){
		// Update antrian di layani
		$updateQry2 = mysqli_query($koneksidb,"UPDATE antrian SET status='$_GET[status]' WHERE id='$data[id]' ");
	}
	else{
		// Update antrian di layani
		$updateQry2 = mysqli_query($koneksidb,"UPDATE antrian SET status='Y' WHERE id='$data[id]' ");
	}

?>
    <?php echo date('d F Y', strtotime($data['tanggal'])); ?> <?php echo $data['waktu']; ?><br/>
    <?php echo $data['nama_dokter']; ?>
    <div class="mb-0" style="font-size: 80px; font-weight: bold;">
    <center>
    <?php echo $data['nama_poli']; ?>
   </center>
</div>
    <div style="font-size: 200px; font-weight: bold;">
    <center>
        <?php echo $data['inisial']. $data['nomor_antrian']; ?>
   </center>
</div>
<audio id="suarabel" src="dingdong.wav"></audio>
<audio id="suarabelnomorurut" src="rekaman/nomor-urut.wav"  ></audio>
<!-- <audio id="suarabelsuarabelloket" src="rekaman/loket.wav"  ></audio> -->

<audio id="belas" src="rekaman/belas.wav"  ></audio>
<audio id="sebelas" src="rekaman/sebelas.wav"  ></audio>
<audio id="puluh" src="rekaman/puluh.wav"  ></audio>
<audio id="sepuluh" src="rekaman/sepuluh.wav"  ></audio>
<audio id="ratus" src="rekaman/ratus.wav"  ></audio>
<audio id="seratus" src="rekaman/seratus.wav"  ></audio>
<audio id="suarabelloket<?php echo $loket; ?>" src="rekaman/<?php echo $loket; ?>.wav"  ></audio>

<p>Jumlah antrian : <?php echo $jmlAntrian; ?></p>
<p> Antrian aktif: <?php  echo $jmlAntrianAktif; ?></p>
<?php
$panjang = strlen($data['nomor_antrian']);
    $antrian = $data['nomor_antrian'];

    for ($i = 0; $i < $panjang; $i++) {?>
        <audio id="suarabel<?php echo $i; ?>" src="rekaman/<?php echo substr($antrian, $i, 1); ?>.wav" ></audio>
  <?php }?>
  <div align="center">
    <input class="btn btn-primary" name="play" onclick="mulai();" type="button" value="Panggil" />
  </div>
  <nav aria-label="Page navigation">
    <ul class="pagination">
        <!-- LINK FIRST AND PREV -->
  <?php
if ($page == 1) { // Jika page adalah page ke 1, maka disable link PREV
        ?>
          <li class="disabled page-item"><a href="#" class="page-link">Back</a></li>
        <?php
} else { // Jika page bukan page ke 1
        $link_prev = ($page > 1) ? $page - 1 : 1;
        ?>
          <li class="page-item"><a href="?page=panggil-antrian&hal=<?php echo $link_prev; ?>&status=Y"  class="page-link">Back</a></li>
        <?php
}
    ?>

        <!-- LINK NUMBER -->
        <?php
// Buat query untuk menghitung semua jumlah data
    $sql2 = mysqli_query($koneksidb, "SELECT COUNT(*) AS jumlah FROM antrian WHERE id_poli='$dataPoli[id]' AND tanggal='$dateNow '") or die("Query salah : " . mysqli_erno());
    $get_jumlah = mysqli_fetch_array($sql2);

    $jumlah_page = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
    $jumlah_number = 5; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
    $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link number
    $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

    ?>

        <!-- LINK NEXT AND LAST -->
        <?php
// Jika page sama dengan jumlah page, maka disable link NEXT nya
    // Artinya page tersebut adalah page terakhir
    if ($page == $jumlah_page) { // Jika page terakhir
        ?>
          <li class="disabled page-item"><a href="#" class="page-link">Next</a></li>
		  <li class="page-item"><a class="page-link" href="?page=panggil-antrian&update=<?php echo $data['id']; ?>&status=Y">Lewati</a></li>
        <?php
} else { // Jika Bukan page terakhir
        $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
        ?>
          <li class="page-item"><a class="page-link" href="?page=panggil-antrian&hal=<?php echo $link_next; ?>&status=Y">Next</a></li>
		  <li class="page-item"><a class="page-link" href="?page=panggil-antrian&hal=<?php echo $link_next; ?>&update=<?php echo $data['id']; ?>&status=Y">Lewati</a></li>
        <?php
}
    ?>
      </ul>
     </nav>
<?php }?>
  </div>
</div>
<script type="text/javascript">
function mulai(){
	//MAINKAN SUARA BEL PADA SAAT AWAL
	document.getElementById('suarabel').pause();
	document.getElementById('suarabel').currentTime=0;
	document.getElementById('suarabel').play();
			
	//SET DELAY UNTUK MEMAINKAN REKAMAN NOMOR URUT		
	totalwaktu=document.getElementById('suarabel').duration*1000;	

	//MAINKAN SUARA NOMOR URUT		
	setTimeout(function() {
			document.getElementById('suarabelnomorurut').pause();
			document.getElementById('suarabelnomorurut').currentTime=0;
			document.getElementById('suarabelnomorurut').play();
	}, totalwaktu);
	totalwaktu=totalwaktu+1000;

		setTimeout(function() {
						document.getElementById('suarabelsuarabelloket').pause();
						document.getElementById('suarabelsuarabelloket').currentTime=0;
						document.getElementById('suarabelsuarabelloket').play();
					}, totalwaktu);
		
		totalwaktu=totalwaktu+1000;
		
		setTimeout(function() {
						document.getElementById('suarabelloket<?php echo $loket; ?>').pause();
						document.getElementById('suarabelloket<?php echo $loket; ?>').currentTime=0;
						document.getElementById('suarabelloket<?php echo $loket; ?>').play();
					}, totalwaktu);	
		totalwaktu=totalwaktu+1000;
	<?php
		//JIKA KURANG DARI 10 MAKA MAIKAN SUARA ANGKA1
		if($antrian<10){
	?>
			
			setTimeout(function() {
					document.getElementById('suarabel0').pause();
					document.getElementById('suarabel0').currentTime=0;
					document.getElementById('suarabel0').play();
				}, totalwaktu);
			
			totalwaktu=totalwaktu+1000;
	<?php		
		}elseif($antrian ==10){
			//JIKA 10 MAKA MAIKAN SUARA SEPULUH
	?>  
				setTimeout(function() {
						document.getElementById('sepuluh').pause();
						document.getElementById('sepuluh').currentTime=0;
						document.getElementById('sepuluh').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
		<?php		
			}elseif($antrian ==11){
				//JIKA 11 MAKA MAIKAN SUARA SEBELAS
		?>  
				setTimeout(function() {
						document.getElementById('sebelas').pause();
						document.getElementById('sebelas').currentTime=0;
						document.getElementById('sebelas').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
		<?php		
			}elseif($antrian < 20){
				//JIKA 12-20 MAKA MAIKAN SUARA ANGKA2+"BELAS"
		?>  				
				setTimeout(function() {
						document.getElementById('suarabel1').pause();
						document.getElementById('suarabel1').currentTime=0;
						document.getElementById('suarabel1').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
				setTimeout(function() {
						document.getElementById('belas').pause();
						document.getElementById('belas').currentTime=0;
						document.getElementById('belas').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
		<?php		
			}elseif($antrian < 100){				
				//JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
		?>  
				setTimeout(function() {
						document.getElementById('suarabel0').pause();
						document.getElementById('suarabel0').currentTime=0;
						document.getElementById('suarabel0').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
				setTimeout(function() {
						document.getElementById('puluh').pause();
						document.getElementById('puluh').currentTime=0;
						document.getElementById('puluh').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
				setTimeout(function() {
						document.getElementById('suarabel1').pause();
						document.getElementById('suarabel1').currentTime=0;
						document.getElementById('suarabel1').play();
					}, totalwaktu);
				totalwaktu=totalwaktu+1000;
				
		<?php
			}else{
				//JIKA LEBIH DARI 100 
				//Karena aplikasi ini masih sederhana maka logina konversi hanya sampai 100
				//Selebihnya akan langsung disebutkan angkanya saja 
				//tanpa kata "RATUS", "PULUH", maupun "BELAS"
		?>
		
		<?php 
			for($i=0;$i<$panjang;$i++){
		?>
		
		totalwaktu=totalwaktu+1000;
		setTimeout(function() {
						document.getElementById('suarabel<?php echo $i; ?>').pause();
						document.getElementById('suarabel<?php echo $i; ?>').currentTime=0;
						document.getElementById('suarabel<?php echo $i; ?>').play();
					}, totalwaktu);
		<?php
			}
			}
		?>
		
}
</script>
<script type="text/javascript">
        /*edit data*/

        $(document).ready(function () {
                $(document).on('click', '#edit_data', function () {
                    var id = $(this).data('id');
                    $('#form-update').attr('action','?page=pasien&id='+id);
                  //  alert('{{ url("user/edit/") }}/'+id);
                    $.ajax({
                        url: "json/pasien-edit.php?id="+id,
                        method: "GET",
                       // data: { id: id },
                        dataType: "json",
                        success: function (data) {
                            $('#alamat').val(data.alamat);
                            $('#nama_pasien').val(data.nama_pasien);
                            // $('#update').val("Simpan Perubahan");
                            $('#editData').modal('show');
                        }
                    });
                });

            });

    </script>
