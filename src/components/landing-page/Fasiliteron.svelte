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

  .fasiliteron {
    width: 100%;
    background-color: #ffedd9;
    padding: 30px 0;
  }

  .fasiliteron .columns {
    width: 70%;
    margin: auto;
  }

  .column img {
    margin-top: -50px;
  }

  /* mobile */
  @media only screen and (max-width: 768px) {
    .subtitle {
      font-size: 14px;
      text-align: left;
    }
  }
</style>

<svelte:head>
  <link rel="stylesheet" href="./title-styles.css" />
</svelte:head>
<div class="fasiliteron">
  <div class="columns">
    <div class="column is-two-thirds">
      <h3
        id="fasiliteron-title"
        class="title title-feature is-size-4-mobile is-size-3-tablet
        is-size-3-desktop">
        Fasiliteron
      </h3>
      <p class="subtitle has-text-left">
        Fasilitator Pateron, para tutor yang akan siap membantu
      </p>
      <p class="mt-6">
        Fasiliteron adalah para mahasiswa yang diseleksi oleh tim pateron untuk
        menjadi tutor yang akan membantumu dalam mempersiapkan ujian masuk
        perguruan tinggi, mulai dari mengisi materi, memberikan kuis, dan
        pembahasannya.
      </p>
    </div>
    <div class="column">
      <img src="./assets/mentor1.png" alt="mentor1" />
      <!-- <div class="columns fasiliteron-image">
        <div class="column">
          <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="image">
        </div>
        <div class="column">
          <img src="https://images.unsplash.com/photo-1516756587022-7891ad56a8cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="image">
        </div>
      </div> -->
    </div>
  </div>
</div>
