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

  .user-feature {
    padding: 60px;
    padding-bottom: 100px;
    border-bottom: 2px solid #013183;
  }

  .user-feature img {
    width: 100%;
    height: 100%;
  }

  .user-feature-item {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
  }

  .daftar {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .daftar a {
    margin-top: 100px;
    position: absolute;
  }

  .daftar button {
    width: 150px;
    background-color: var(--blue-color);
  }

  /* mobile */
  @media only screen and (max-width: 768px) {
    .subtitle {
      font-size: 14px;
      text-align: left;
    }

    .user-feature-item {
      margin-bottom: 30px;
    }

    .user-feature-item p {
      margin-bottom: 20px;
    }

    .manfaat-items {
      text-align: left !important;
    }
  }
</style>

<div class="user-feature">
  <h3
    class="title has-text-centered title-feature is-size-4-mobile
    is-size-3-tablet is-size-3-desktop">
    Manfaat dan Keuntungan bergabung di PATERON
  </h3>
  <p class="subtitle has-text-centered">
    Program yang diusung Pateron memiliki berbagai manfaat dan keuntungan yang
    akan membantumu
    <br />
    dalam mempersiapkan berbagai hal dalam menghadapi persiapan masuk perguruan
    tinggi
  </p>
  <div class="columns is-desktop">
    <div class="column user-feature-item">
      <p class="has-text-right manfaat-items">
        Konsultasi terkait seleksi masuk perguruan tinggi
      </p>
      <p class="has-text-right manfaat-items">
        Penjadwalan belajar yang akan membantumu memaksimalkan waktu belajar
      </p>
      <p class="has-text-right manfaat-items">
        Metode yang efektif dan efisien dalam mempersiapan ujian masuk perguruan
        tinggi
      </p>
    </div>
    <div class="column user-feature-item manfaat-ilustration">
      <img src="./assets/manfaat_ilustration.svg" alt="user-feature" />
    </div>
    <div class="column user-feature-item">
      <p>Silabus materi yang dirancang oleh tim Pateron</p>
      <p>
        Kelas virtual yang interaktif untuk menemanimu dan memotivasimu dalam
        belajar
      </p>
      <p>
        Dibimbing oleh fasilitator yang dipilih dan diseleksi oleh tim Pateron
      </p>
    </div>
  </div>
  <div class="daftar">
    <a href="/" class="btn-daftar">
      <button class="button is-info is-rounded ">Daftar</button>
    </a>
  </div>
</div>
