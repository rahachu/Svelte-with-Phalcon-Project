<script>
  import Testimoni from "../components/landing-page/Testimoni.svelte"
</script>
<style>
  body{
    font-family: 'Source Sans Pro', sans-serif;
  }

  a:hover{
    color: #fff;
  }

  button a{
    color: #fff;
  }

  .header-content{
    background-image:url('/assets/banner.png');
    background-position: center;
    background-size:cover;
    margin-top: 80px;
    height: 100vh;
    position:relative;
  }

  .header-title{
    width:400px;
    text-align:center;
    position: absolute;
    top:20%;
    left:10%;
    color: var(--blue-color);
    font-size: 30px;
    font-weight: 600;
  }

  .header-title .diskon{
    font-size: 50px;
    font-weight:900;
  }

  .header-title .btn-header-title{
    padding: 0 50px;
    display:flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 20px;
  }

  .header-title .btn-header-title .beli-paket{
    background-color: #FDB5B9;
    color: var(--blue-color);
    border-radius: 10px;
  }

  .header-title .btn-header-title .detail-paket{
    background-color: #3F87CF;
    color: #fff;
    border-radius: 10px;
  }

  .program-content{
    background-image: url('/assets/bubble_blue.svg');
    padding: 100px 80px;
    margin-top:-60px;
    background-repeat: no-repeat;
    margin-bottom: 50px;
    background-size: cover;
    background-position: -3px 0;
    height: 115%;
  }

  .pateron-program p{
    margin-top: 20px;
  }

  .btn-pelajari{
    margin-top: 40px;
    background-color: var(--blue-color);
  }

  .btn-pateron-program {
    width: 300px;
    display:flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 30px;
  }

  .title-feature{
    font-weight: 600;
    color:var(--blue-color);
  }

  .feature-pateron{
    padding: 60px;
    margin-bottom: 100px;
  }

  .subtitle{
    font-weight: 600;
    margin-bottom: 50px;
    font-size: 16px;
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

  .user-feature{
    padding: 60px;
    padding-bottom: 100px;
    border-bottom: 2px solid #013183;
  }

  .user-feature img {
    width: 100%;
    height:100%;
  }

  .user-feature-item{
    display: flex;
    flex-direction: column;
    justify-content: space-around;
  }

  .daftar{
    display:flex;
    align-items:center;
    justify-content: center;
  }

  .daftar a{
    margin-top: 100px;
    position: absolute;
  }

  .daftar button{
    width: 150px;
    background-color: var(--blue-color);
  }

  .fasiliteron{
    background-color: #FFEDD9;
    padding: 60px;
    padding-top: 10em;
  }


  .fasiliteron-image .column:nth-child(1){
    margin-top: 100px;
  }

  /* Testimoni */
  .testimoni{
    padding: 20px;
  }

  /* Faq Content */
  .faq-content{
    padding: 50px;
  }

  .ads-space{
    background-color: grey;
    height: 150px;
  }

  .ads-space p{
    line-height: 150px;
  }

  .faq-text{
    margin-top: -100px;
  }

  .btn-faq{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .btn-pertanyaan-lanjut {
    margin-top: 50px;
    width: 300px; 
  }

  .btn-pertanyaan-lanjut a{
    color: var(--blue-color);
  }

  .btn-pertanyaan-lanjut:hover{
    color: #fff;
    background-color: var(--blue-color);
  }

  .btn-pertanyaan-lanjut:hover a{
    color: #fff;
  }

  .btn-daftar-segera{
    margin-top: 20px;
    width: 300px;
    background-color: var(--blue-color);
    color: #fff;
  }

  /* tablet */
  @media only screen and (max-width:1023px){
    .program-content{
      background-image: none;
      background-color: #fff;
    }

    .feature-item .feature-ilustration {
      width: 250px;
      height: 250px;
    }

    .feature-typo p{
      width: 80%;
    }
   
    .faq-text{
      margin-top: 0;
    }

  }

  /* mobile */
  @media only screen and (max-width: 768px) {
    .header-content{
      background-position: center;
      background-position: 600px 10px;
      background-image: none;
      background-color: #FFDBB9;
    }

    .program-content {
      height: 160%;
      margin-bottom: 100px;
    }

    .subtitle{
      font-size: 14px;
      text-align: left;
    }

  }

</style>

<div class="header-content">
  <div class="header-title">
    <b>Yuk Gabung</b> Paket Kelas Bulan September,
    Ada Diskon Spesial
    <div class="diskon">20%</div>
    <div class="btn-header-title">
      <button class="button is-info beli-paket">Beli Paket Sekarang</button>
      <button class="button is-info detail-paket">Detail Paket</button>
    </div>
  </div>
</div>
<div class="program-content">
  <div class="columns is-variable is-8">
    <div class="column is-half">
      <div class="ilustration-program">
        <img src="./assets/program_ilustration.png" alt="program-ilustration">
      </div>
    </div>
    <div class="column">
      <div class="pateron-program ">
        <h3 class="title title-feature is-size-3-mobile is-size-3-tablet is-size-3-desktop">Program Paket Belajar <br> ala PATERON</h3>
        <p class="is-size-6-mobile">
          Pateron Indonesia memiliki dua produk utama, yaitu paket Kelas dan Paket TryOut. Paket kelas memiliki banyak pilihan paket belajar berisi berbagai macam fitur yang akan membantumu dalam belajar, seperti kumpulan materi dan soal harian yang akan dipandu oleh mentor pilihan. Sedangkan paket TryOut merupakan paket yang menyediakan berbagai macam soal TryOut yang diselenggarakan dalam skala nasional.
        </p>
        <p class="is-size-6-mobile">
          Ayo pilih paket yang paling kamu butuhkan!
        </p>
        <!-- <button class="button is-info is-rounded btn-pelajari">
        Pelajari Lebih Lanjut
        </button> -->
        <div class="btn-pateron-program">
          <a href="#" class="button is-info is-rounded">Paket Kelas</a>
          <a href="#" class="button is-info is-rounded">Paket Try Out</a>
        </div>
      </div>
    </div>
  </div>
</div>
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
<div class="user-feature">
  <h3 class="title has-text-centered title-feature is-size-4-mobile is-size-3-tablet is-size-3-desktop">
    Manfaat dan Keuntungan bergabung di PATERON
  </h3>
  <p class="subtitle has-text-centered">
    Program yang diusung Pateron memiliki berbagai manfaat dan keuntungan yang akan membantumu <br> dalam mempersiapkan berbagai hal dalam menghadapi persiapan masuk perguruan tinggi
  </p>
  <div class="columns is-desktop">
    <div class="column user-feature-item">
      <p class="has-text-right">
        Konsultasi terkait seleksi masuk perguruan tinggi
      </p>
      <p class="has-text-right">
        Penjadwalan belajar yang akan membantumu memaksimalkan waktu belajar
      </p>
      <p class="has-text-right">
        Metode yang efektif dan efisien dalam mempersiapan ujian masuk perguruan tinggi
      </p>    
    </div>
    <div class="column user-feature-item">
      <img src="./assets/feature.png" alt="user-feature">
    </div>
    <div class="column user-feature-item">
      <p>
        Silabus materi yang dirancang oleh tim Pateron
      </p>
      <p>
        Kelas virtual yang interaktif untuk menemanimu dan memotivasimu dalam belajar
      </p>
      <p>
        Dibimbing oleh fasilitator yang dipilih dan diseleksi oleh tim Pateron
      </p>
    </div>
  </div>
  <div class="daftar">
    <a href="#" class="btn-daftar">
      <button class="button is-info is-rounded ">Daftar</button>
    </a>
  </div>
</div>
<div class="fasiliteron">
  <div class="columns">
    <div class="column is-two-fifths">   
      <h3 id="fasiliteron-title" class="title title-feature is-size-4-mobile is-size-3-tablet is-size-3-desktop">Fasiliteron</h3>
      <p class="subtitle has-text-left">
        Fasilitator Pateron, para tutor yang akan siap membantu
      </p>
      <p class="mt-6">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel nemo dolorum atque repellendus laboriosam quaerat tempora fuga suscipit doloribus nesciunt, iure quas! Aperiam, assumenda enim quaerat asperiores quibusdam error veritatis!
      </p>
      <p class="mt-5">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime provident deleniti repellendus earum fugit ipsam porro iusto cumque delectus, asperiores, nobis quia? Illo reiciendis nemo quas, deserunt repellendus sed odio!
      </p>
    </div>
    <div class="column">
      <div class="columns fasiliteron-image">
        <div class="column">
          <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="image">
        </div>
        <div class="column">
          <img src="https://images.unsplash.com/photo-1516756587022-7891ad56a8cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="image">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="testimoni">
  <h3 class="title has-text-centered title-feature is-size-4-mobile is-size-3-tablet is-size-3-desktop mt-6">Testimoni</h3>
  <p class="subtitle has-text-centered">
    Apa kata mereka tentang Pateron
  </p>
  <Testimoni/>
</div>
<img src="./assets/line_blue.svg" alt="">
<div class="faq-content">
  <div class="columns is-variable is-8-desktop">
    <div class="column">
      <div class="ads-space">
        <p class="has-text-centered">
          ADS SPACE
        </p>
      </div>
    </div>
    <div class="column">
      <div class="simple-faq">
        <p class="has-text-centered faq-text">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum aliquid, at nulla error, fugit atque nam totam facere placeat hic ab. Soluta ipsam vitae alias dolor nisi qui consequatur labore?
        </p>
        <div class="btn-faq">
          <button class="button btn-pertanyaan-lanjut is-info is-rounded is-outlined">
            <a href="#">Pertanyaan Lebih Lanjut</a>
          </button>
          <button class="button btn-daftar-segera is-info is-rounded">
            <a href="#">Daftar Segera</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>