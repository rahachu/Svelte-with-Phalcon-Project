<script>
</script>

<style>
  .title-feature {
    font-weight: 600;
    color: var(--blue-color);
  }

  .subtitle {
    font-weight: 600;
    margin-bottom: 50px;
    font-size: 16px;
  }
  
  .feature-pateron{
    padding: 60px;
    margin-bottom: 100px;
  }


  .feature-item{
    padding: 20px;
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .feature-item .feature-ilustration {  
    height: 200px;
    width: 200px;
    box-shadow: 3px 3px 30px rgba(1, 49, 131, 0.15);
    border-radius: 20px;
    padding:30px;
    display:flex;
    justify-content:center;
    align-items:center;
  }

  .feature-item .feature-ilustration img{
    width: 100%;
  }

  .feature-typo{
    padding: 20px;
    text-align: center;
    display:flex;
    align-items:center;
    flex-direction: column;
  }

  .typo-title-feature{
    font-weight: 600;
  }

  .feature-typo p {
    margin-top: -10px;
  }

  /* tablet */
  @media only screen and (max-width:1023px){

    .feature-item .feature-ilustration {
      width: 250px;
      height: 250px;
    }

    .feature-typo p{
      width: 80%;
    }

    .subtitle {
      font-size: 14px;
      text-align: left;
    }

  }

  /* mobile */
  @media only screen and (max-width: 768px) {

    .subtitle{
      font-size: 14px;
      text-align: left;
    }

  }
</style>

<div class="feature-pateron">
  <h3 class="title has-text-centered title-feature is-size-4-mobile is-size-3-tablet is-size-3-desktop">Segala Fitur yang Tersedia di PATERON</h3>
  <p class="subtitle has-text-centered">
    Paket belajar intensif untuk siswa yang menghubungkannya dengan <br> fasilitator terpilih melalui komunitas belajar
  </p>
  <div class="columns is-desktop">
    <div class="column">
      <div class="feature-item">
        <div class="feature-ilustration">
          <img src="./assets/jadwal_belajar_ilustration.png" alt="jadwal_belajar_ilustration">
        </div>
      </div>
      <div class="feature-typo">
        <h5 class="title is-5 typo-title-feature">
          Jadwal Belajar
        </h5>
        <p>Fitur yang dapat membantumu dalam mengatur dan menjadwalkan materi yang akan dipelajari</p>
      </div>
    </div>
    <div class="column">
      <div class="feature-item">
        <div class="feature-ilustration">
          <img src="./assets/komunitas_belajar_ilustration.png" alt="komunitas_belajar_ilustration">
        </div>
      </div>
      <div class="feature-typo">
        <h5 class="title is-5 typo-title-feature">
          Komunitas Belajar
        </h5>
        <p>Lingkaran berisi teman teman yang  sama sama berjuang akan membuatmu lebih semangat dalam belajar </p>
      </div>
    </div>
    <div class="column">
      <div class="feature-item">
        <div class="feature-ilustration">
          <img src="./assets/konsultasi_belajar_ilustration.png" alt="konsultasi_belajar_ilustration">
        </div>
      </div>
      <div class="feature-typo">
        <h5 class="title is-5 typo-title-feature">
          Konsultasi
        </h5>
        <p>Dipandu oleh fasilitator terpilih dalam membimbingmu bukan hanya dalam belajar tapi memilih kampus impian</p>
      </div>
    </div>
    <div class="column">
      <div class="feature-item">
        <div class="feature-ilustration">
          <img src="./assets/to_ilustration.png" alt="to_ilustration">
        </div>
      </div>
      <div class="feature-typo">
        <h5 class="title is-5 typo-title-feature">
          Try Out Online Nasional
        </h5>
        <p>Berbagai Jenis TryOut yang disajikan untuk mengasah kesiapan menghadapi berbagai ujian</p>
      </div>
    </div>
  </div>
</div>

