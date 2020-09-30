<script>

</script>

<style>
  .title-feature {
    font-weight: 600;
    color: var(--blue-color);
  }

  .program-content {
    position: relative;
    background-image: url("/assets/bubble_blue.svg");
    padding: 100px 80px;
    margin-top: -60px;
    background-repeat: no-repeat;
    margin-bottom: 50px;
    background-size: cover;
    background-position: -3px 0;
    height: 115%;
    z-index: 5;
  }

  .pateron-program p {
    margin-top: 20px;
  }

  .btn-pateron-program {
    width: 300px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 30px;
  }
  /* tablet */
  @media only screen and (max-width: 1023px) {
    .program-content {
      background-image: none;
      background-color: #fff;
      padding: 50px 30px;
    }
  }

  /* mobile */
  @media only screen and (max-width: 768px) {
    .program-content {
      height: 160%;
      margin-bottom: 100px;
    }

    .btn-pateron-program {
      flex-direction: column;
    }

    .btn-pateron-program a:first-child {
      margin-bottom: 20px;
    }
  }
</style>

<div class="program-content">
  <div class="columns is-variable is-8">
    <div class="column is-half">
      <div class="ilustration-program">
        <img src="./assets/program_ilustration.png" alt="program-ilustration" />
      </div>
    </div>
    <div class="column">
      <div class="pateron-program ">
        <h3
          class="title title-feature is-size-3-mobile is-size-3-tablet
          is-size-3-desktop">
          Program Paket Belajar
          <br />
          ala PATERON
        </h3>
        <p class="is-size-6-mobile">
          Pateron Indonesia memiliki dua produk utama, yaitu paket Kelas dan
          Paket TryOut. Paket kelas memiliki banyak pilihan paket belajar berisi
          berbagai macam fitur yang akan membantumu dalam belajar, seperti
          kumpulan materi dan soal harian yang akan dipandu oleh mentor pilihan.
          Sedangkan paket TryOut merupakan paket yang menyediakan berbagai macam
          soal TryOut yang diselenggarakan dalam skala nasional.
        </p>
        <p class="is-size-6-mobile">
          Ayo pilih paket yang paling kamu butuhkan!
        </p>
        <!-- <button class="button is-info is-rounded btn-pelajari">
        Pelajari Lebih Lanjut
        </button> -->
        <div class="btn-pateron-program">
          <a href="/" class="button is-info is-rounded">Paket Kelas</a>
          <a href="/" class="button is-info is-rounded">Paket Try Out</a>
        </div>
      </div>
    </div>
  </div>
</div>
