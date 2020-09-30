<script>

</script>

<style>
  .header-content {
    background-image: url("/assets/banner.png");
    background-position: center;
    background-size: cover;
    margin-top: 80px;
    height: 100vh;
    width: 100%;
    position: relative;
    z-index: 1;
  }

  .header-title {
    width: 400px;
    text-align: center;
    position: absolute;
    top: 20%;
    left: 10%;
    color: var(--blue-color);
    font-size: 30px;
    font-weight: 600;
  }

  .header-title .diskon {
    font-size: 50px;
    font-weight: 900;
  }

  .header-title .btn-header-title {
    padding: 0 50px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 20px;
  }

  .header-title .btn-header-title .beli-paket {
    background-color: #fdb5b9;
    color: var(--blue-color);
    border-radius: 10px;
  }

  .header-title .btn-header-title .detail-paket {
    background-color: #3f87cf;
    color: #fff;
    border-radius: 10px;
  }

  /* mobile */
  @media only screen and (max-width: 768px) {
    .header-content {
      background-position: center;
      background-image: none;
      background-color: #ffdbb9;
      transform: none;
    }

    .header-title {
      width: 300px;
      font-size: 20px;
    }

    .header-title .btn-header-title {
      flex-direction: column;
      margin-top: 20px;
      width: 100%;
    }

    .header-title .btn-header-title .detail-paket {
      margin-top: 20px;
    }
  }
</style>

<div class="header-content">
  <div class="header-title">
    <b>Yuk Gabung</b>
    Paket Kelas Bulan September, Ada Diskon Spesial
    <div class="diskon">20%</div>
    <div class="btn-header-title">
      <button class="button is-info beli-paket">Beli Paket Sekarang</button>
      <button class="button is-info detail-paket">Detail Paket</button>
    </div>
  </div>
</div>
