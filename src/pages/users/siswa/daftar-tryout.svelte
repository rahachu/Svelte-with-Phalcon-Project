<script>
  import { goto, url } from "@sveltech/routify";
  import LoaderFullPage from "../../../components/LoaderFullPage.svelte";
  import convertRp from "../../../library/convertRp.js";

  let fetchPaketTryout = fetch(`/dashboard/list`).then(data => data.json());

  let paketTryoutId = "";
  let isModalActive = false;
  function getPaketTryoutId(id) {
    fetchPaketTryout.then(data => {
      paketTryoutId = data.product.find(paket => {
        return paket.idtryout == id;
      });
      isModalActive = true;
    });
  }
</script>

<style>
  .banner {
    background-image: url("/assets/banner-paket-tryout.png");
    margin-top: 50px;
    width: 100%;
    height: 400px;
    position: relative;
    background-repeat: no-repeat;
    background-position: -200px 0;
  }

  .banner__description {
    position: absolute;
    top: 30%;
    right: 10%;
    z-index: 2;
    width: 500px;
  }

  .banner__description h3 {
    color: var(--blue-color);
    letter-spacing: 10px;
  }

  .cards {
    padding: 40px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    grid-template-rows: auto;
    grid-gap: 2rem;
  }

  .card {
    border-radius: 10px;
  }

  .card__data {
    padding: 20px;
  }

  .card__description {
    list-style: none;
    color: var(--blue-color);
  }

  .card__description li span {
    margin-right: 5px;
    color: var(--blue-color);
  }

  .card__price {
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
    color: var(--blue-color);
  }

  .card__buttons {
    font-weight: 600;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .card__buttons__detail,
  .card__buttons__beli {
    margin: 10px;
    border-radius: 10px;
    text-align: center;
    padding: 5px;
    cursor: pointer;
  }

  .card__buttons__detail:hover,
  .card__buttons__beli:hover {
    opacity: 0.8;
  }

  .card__buttons__detail {
    width: 100%;
    border: 1px solid #3f87cf;
    color: var(--blue-color);
  }

  .card__buttons__beli {
    width: 100%;
    background-color: #fdb5b9;
    color: var(--blue-color);
  }

  .modal-card-foot {
    font-weight: 600;
    display: flex;
    justify-content: space-between;
  }

  .modal-card-foot div {
    width: 300px;
    margin: 10px;
  }

  @media only screen and (max-width: 768px) {
    .banner__description {
      display: none;
    }
  }
</style>

<div class="wrapper">
  <div class="banner">
    <div class="banner__description">
      <h3 class="title is-3">Paket Tryout</h3>
      <p>
        Pateron Indonesia memiliki dua produk utama, yaitu paket Kelas dan Paket
        TryOut. Paket kelas memiliki banyak pilihan paket belajar berisi
        berbagai macam fitur yang akan membantumu dalam
      </p>
    </div>
  </div>
</div>
{#await fetchPaketTryout}
  <LoaderFullPage />
{:then dataPaket}
  <div class="cards">
    {#each dataPaket.product as paket}
      <div class="card">
        <div class="card__image">
          <img src={paket.thumbnail_tryout} alt={paket.name} />
        </div>
        <div class="card__data">
          <div class="card__title">
            <div class="title is-4 mb-4">{paket.name}</div>
          </div>
          <ul class="card__description">
            <li>
              <span>
                <i class="far fa-hourglass" />
              </span>
              {paket.tryout_time} menit
            </li>
            <li>
              <span>
                <i class="far fa-calendar-alt" />
              </span>
              {paket.start_time.split(' ')[0]}
            </li>
            <li>
              <span>
                <i class="far fa-file" />
              </span>
              {paket.category}
            </li>
          </ul>
          <hr />
          <div class="card__price">
            <h5 class="title is-5">Rp. {convertRp(paket.tryout_price)}</h5>
          </div>
          <div class="card__buttons mt-4">
            <div
              class="card__buttons__detail"
              on:click={() => getPaketTryoutId(paket.idtryout)}>
              Detail
            </div>
            <div
              class="card__buttons__beli"
              on:click={() => $goto($url('../buy', {
                    product: paket.idtryout
                  }))}>
              Beli
            </div>
          </div>
        </div>
      </div>
    {/each}
  </div>
{:catch error}
  <p style="color: red">{error.message}</p>
{/await}

{#if isModalActive}
  <div class="modal" class:is-active={isModalActive}>
    <div class="modal-background" />
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Detail Paket Tryout</p>
        <button
          class="delete"
          aria-label="close"
          on:click={() => (isModalActive = false)} />
      </header>
      <section class="modal-card-body">
        <h4 class="title is-4">{paketTryoutId.name}</h4>
        <ul class="card__description">
          <li>
            <span>
              <i class="far fa-hourglass" />
            </span>
            {paketTryoutId.tryout_time} menit
          </li>
          <li>
            <span>
              <i class="far fa-calendar-alt" />
            </span>
            {paketTryoutId.start_time.split(' ')[0]}
          </li>
          <li>
            <span>
              <i class="far fa-file" />
            </span>
            {paketTryoutId.category}
          </li>
        </ul>
        <div class="mt-4">
          <h5 class="title is-5">Deskripsi</h5>
          <p>{paketTryoutId.description}</p>
        </div>
      </section>
      <footer class="modal-card-foot">
        <div class="title is-3 modal-card-foot__price">
          Rp. {convertRp(paketTryoutId.tryout_price)}
        </div>
        <div
          class="card__buttons__beli"
          on:click={() => $goto($url('../buy', {
                product: paketTryoutId.idtryout
              }))}>
          Beli
        </div>
      </footer>
    </div>
  </div>
{/if}
