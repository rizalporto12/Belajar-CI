<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<div class="row">
  <div class="col-md-2">1</div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">Presensi masuk</div>
      <div class="card-body">
        <div class="tanggal"><?= date('d F Y') ?></div>
        <div class="parent-clock">
          <div id="jam-masuk"></div>
          <div id="menit-masuk"></div>
          <div id="detik-masuk"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">3</div>
  <div class="col-md-2">4</div>
</div>

<script>
  window.setInterval("waktuMasuk()", 1000);

  function waktuMasuk(){
    const waktu = new Date();
  document.getElementById("jam-masuk").innerHTML = formatWaktu(waktu.getHours());
  document.getElementById("menit-masuk").innerHTML = formatWaktu(waktu.getMinutes());
  document.getElementById("detik-masuk").innerHTML = formatWaktu(waktu.getSeconds());
  }

  function formatWaktu(waktu) {
    if(waktu < 10){
      return "0" + waktu;
    }else{
      return waktu;
    }
  }
  
</script>

<?= $this->endSection() ?>