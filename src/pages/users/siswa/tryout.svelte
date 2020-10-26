<script>
  import { goto, url } from "@sveltech/routify";
  let prodReq = fetch(`/dashboard/tryoutsaya`).then(res => res.json());
  import LoaderFullPage from "../../../components/LoaderFullPage.svelte";
</script>

<style>
  .cards {
    padding: 40px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    grid-template-rows: auto;
    grid-gap: 2rem;
    margin-top: -10px;
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

  .card__buttons {
    font-weight: 600;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .card__buttons button {
    width: 100%;
  }

  #empty-state {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    opacity: 0.7;
  }
</style>

{#await prodReq}
  <LoaderFullPage />
{:then data}
  <div class="title is-4 mt-6 ml-4">Tryout Saya</div>
  <div class="cards">
    {#each data as prod}
      <div class="card">
        <div class="card__image">
          <img src={prod.thumbnail_tryout} alt={prod.name} />
        </div>
        <div class="card__data">
          <div class="card__title">
            <div class="title is-4 mb-4">{prod.name}</div>
          </div>
          <ul class="card__description">
            <li>
              <span>
                <i class="far fa-hourglass" />
              </span>
              {prod.tryout_time} menit
            </li>
            <li>
              <span>
                <i class="far fa-calendar-alt" />
              </span>
              {prod.start_time.split(' ')[0]}
            </li>
            <li>
              <span>
                <i class="far fa-file" />
              </span>
              {prod.category}
            </li>
          </ul>
          <hr />
          <div class="card__buttons mt-4">
            {#if prod.worked}
              <button
                class="button is-primary"
                on:click={() => {
                  $goto($url('../nilai', { id: prod.idtryout }));
                }}>
                Lihat nilai
              </button>
            {:else}
              <button
                class="button is-warning"
                on:click={() => {
                  $goto($url('../../../tryout', { id: prod.idtryout }));
                }}>
                Kerjakan
              </button>
            {/if}
          </div>
        </div>
      </div>
    {:else}
      <p id="empty-state" class="title is-5 has-text-centered">
        Belum ada tryout
      </p>
    {/each}
  </div>
{:catch error}
  <p style="color: red">{error.message}</p>
{/await}
