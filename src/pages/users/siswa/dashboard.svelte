<script>
  import { goto, url } from "@sveltech/routify";
  import Schedule from "../../../components/schedule/Schedule.svelte";
  import LoaderFullPage from "../../../components/LoaderFullPage.svelte";
  import Loader from "../../../components/Loader.svelte";

  let rekomendasiPaket = "";
  let loadingPaket = true;

  let prodReq = fetch(`/dashboard/list`)
    .then(res => res.json())
    .then(data => {
      const { product } = data;
      product.sort();
      product.reverse();
      rekomendasiPaket = product.slice(0, 2);
      loadingPaket = false;
    });
  let tryoutSaya = fetch(`/dashboard/tryoutsaya`).then(res => res.json());
</script>

<style>
  .flex-box {
    display: flex;
    flex-wrap: wrap;
  }
  .flex-item {
    flex-basis: 25%;
    margin: 10px;
  }
  @media only screen and (max-width: 769px) {
    .flex-box {
      margin: 0 20px;
    }
    .flex-item {
      flex-basis: 100%;
      margin: 10px;
    }
  }
  .button-container {
    text-align: right;
    position: absolute;
    bottom: 0px;
    margin: 10px;
    padding: 10px;
    width: 80%;
  }

  .paket-dibeli {
    height: 100%;
    background-color: #fcfcfc;
    box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1),
      0 0px 0 1px rgba(10, 10, 10, 0.02);
    border-radius: 5px;
    padding: 20px;
  }

  .header-paket {
    display: flex;
    flex-direction: row;
    align-items: center;
  }

  .header-paket .judul-paket {
    margin-left: 10px;
    font-size: 18px;
    font-weight: 600;
  }

  .paket-dibeli .header-paket .icon {
    background-color: #fce9d6;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    padding: 10px;
    width: 40px;
    height: 40px;
  }

  .card {
    margin-bottom: 20px;
    height: 100%;
  }

  .card-image {
    margin-bottom: -50px;
    height: 200px;
  }

  .card-image img {
    height: 150px;
    object-fit: cover;
  }

  .card-content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .card__buttons__beli {
    width: 100%;
    background-color: #fdb5b9;
    color: var(--blue-color);
    text-align: center;
    border-radius: 10px;
    font-weight: 600;
    padding: 5px;
  }

  .card__buttons__beli:hover {
    cursor: pointer;
    opacity: 0.8;
  }

  .btn-paket {
    width: 100%;
    color: var(--blue-color) !important;
    border: 2px solid orange;
    font-weight: 600;
  }

  @media only screen and (max-width: 425) {
    .card {
      height: 250px;
    }
  }
</style>

{#await tryoutSaya}
  <LoaderFullPage />
{:then data}
  <!-- <div class="" />
  <div class="flex-box">
    {#each data.product as prod}
      <div class="card flex-item">
        <div class="card-content">
          <p class="title is-4">{prod.name}</p>
          <p class="subtitle">
            {prod.tryout_price.replace(/\B(?=(\d{3})+(?!\d))/g, '.')}
          </p>
          <div class="button-container">
            <button
              class="button is-primary"
              disabled={prod.buyed}
              on:click={() => {
                $goto($url('../buy', { product: prod.idtryout }));
              }}>
              {prod.buyed ? 'Menunggu Konfirmasi' : 'Beli'}
            </button>
          </div>
        </div>
      </div>
    {:else}
      <p>Belum ada product</p>
    {/each}
  </div> -->
  <div class="columns">
    <div class="column pt-6">
      <h5 class="title is-5">Dashboard</h5>
      <div class="columns">
        <div class="column is-one-third p-2 rounded">
          <div class="paket-dibeli p-2">
            <div class="header-paket">
              <div class="icon">
                <img
                  src="/assets/icons/writing.svg"
                  alt="writing-logo"
                  width="20px"
                  height="20px" />
              </div>
              <div class="judul-paket">Paket Tryout</div>
            </div>
            <p class="title is-5 mt-4">{data.length} Tryout</p>
            <p class="subtitle is-6">Sudah dibeli</p>
          </div>
        </div>
        <div class="column is-one-third p-2 rounded">
          <div class="paket-dibeli p-2">
            <div class="header-paket">
              <div class="icon">
                <img
                  src="/assets/icons/writing.svg"
                  alt="writing-logo"
                  width="20px"
                  height="20px" />
              </div>
              <div class="judul-paket">Paket Kelas</div>
            </div>
            <p class="title is-5 mt-4">0 Paket Kelas</p>
            <p class="subtitle is-6">Sudah dibeli</p>
          </div>
        </div>
      </div>
      <Schedule />
    </div>
    <div class="column is-one-quarter pt-6 px-2">
      {#if loadingPaket}
        <Loader title="Memuat Paket" />
      {:else}
        <div>
          <h5 class="title is-5">Rekomendasi paket Tryout</h5>
          {#each rekomendasiPaket as paket}
            <div class="card rounded">
              <div class="card-image">
                <figure class="image is-4by3">
                  <img src={paket.thumbnail_tryout} alt={paket.name} />
                </figure>
              </div>
              <div class="card-content">
                <div class="title is-5">{paket.name}</div>
                <div
                  class="card__buttons__beli"
                  on:click={() => $goto($url('../buy', {
                        product: paket.idtryout
                      }))}>
                  Beli
                </div>
              </div>
            </div>
          {/each}
          <a href="/users/siswa/daftar-tryout">
            <button class="button is-warning is-outlined btn-paket">
              Lihat semua paketmu
            </button>
          </a>
        </div>
      {/if}
    </div>
  </div>
{:catch error}
  <p style="color: red">{error.message}</p>
{/await}
