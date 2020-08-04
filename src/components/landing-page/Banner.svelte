<script>
  let y = "";


</script>

<svelte:window bind:scrollY={y}/>

<style>
  .header-content{
    background-image:url('/assets/banner.png');
    background-position: center;
    background-size:cover;
    margin-top: 80px;
    height: 100vh;
    position:relative;
    z-index: 1;
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

  /* mobile */
  @media only screen and (max-width: 768px) {
    .header-content{
      background-position: center;
      background-image: none;
      background-color: #FFDBB9;
      transform: none;
    }
  }
</style>

<div class="header-content" style="transform: translate({y * 2 / (50 - 1)}px, 0)">
  <div class="header-title" style="transform: translate({-y * 5 / (50 - 1)}px, 0)">
    <b>Yuk Gabung</b> Paket Kelas Bulan September,
    Ada Diskon Spesial
    <div class="diskon">20%</div>
    <div class="btn-header-title">
      <button class="button is-info beli-paket" style="transform: translate(0,{-y * 1 / (50 - 1)}px)">Beli Paket Sekarang</button>
      <button class="button is-info detail-paket" style="transform: translate(0,{-y * 1 / (50 - 1)}px)">Detail Paket</button>
    </div>
  </div>
</div>



