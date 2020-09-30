<script>
  import { onMount } from "svelte";
  import { get, post } from "../../library/csrfFetch.js";
  import { goto } from "@sveltech/routify";
  import { NotificationDisplay, notifier } from "@beyonk/svelte-notifications";

  let userRegistration = {
    fullname: "",
    school: "",
    city: "",
    phone: "",
    username: "",
    email: "",
    password: ""
  };

  let asal = {
    provinsi: "",
    kabupaten: ""
  };

  let dataSekolah = {
    sekolah: "",
    jurusan: ""
  };

  let dataProvinsi = "";
  let datakabupaten = "";

  onMount(() => {
    fetchProvinsi();
  });

  let isLoading = false;

  // handle step
  let activeStep = 1;
  let progressbarValue = 30;

  $: console.log(activeStep);

  function handleSubmit(e) {
    e.preventDefault();
    isLoading = true;
    registrationProcess();
  }

  function registrationProcess() {
    Promise.all([
      fetchProvinsiById(asal.provinsi),
      fetchKabupatenBtId(asal.kabupaten)
    ]).then(() => {
      userRegistration.school = `${dataSekolah.sekolah} - Jurusan ${dataSekolah.jurusan}`;
      userRegistration.city = `${asal.provinsi}, ${asal.kabupaten}`;
      post("/register", userRegistration)
        .then(res => res.json())
        .then(res => {
          isLoading = false;
          if (res.error) {
            let i = 0;
            res.error.forEach(msg => {
              setTimeout(() => notifier.danger(msg), i * 250);
              i++;
            });
          }
          if (res.message) {
            notifier.success(res.message);
            setTimeout(() => $goto("/accounts/login"), 3000);
          }
        });
    });
  }

  async function fetchProvinsi() {
    const reqApiProvinsi = await fetch(
      "https://dev.farizdotid.com/api/daerahindonesia/provinsi"
    );
    const resApiProvinsi = await reqApiProvinsi.json();
    dataProvinsi = await resApiProvinsi.provinsi;
  }

  async function fetchKabupaten(id) {
    const reqApiKabupaten = await fetch(
      `https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${id}`
    );
    const resApiKabupaten = await reqApiKabupaten.json();
    datakabupaten = await resApiKabupaten.kota_kabupaten;
  }

  async function fetchProvinsiById(id) {
    const reqProvinsiById = await fetch(
      `https://dev.farizdotid.com/api/daerahindonesia/provinsi/${id}`
    );
    const resProvinsiById = await reqProvinsiById.json();
    asal.provinsi = resProvinsiById.nama;
  }

  async function fetchKabupatenBtId(id) {
    const reqKabupatenById = await fetch(
      `https://dev.farizdotid.com/api/daerahindonesia/kota/${id}`
    );
    const resKabupatenById = await reqKabupatenById.json();
    asal.kabupaten = resKabupatenById.nama;
  }
</script>

<style>
  /* .registration {
    display: flex;
    justify-content: center;
    align-items: center;
  } */

  .left-side {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: var(--blue-color);
  }

  .registration-form {
    padding-top: 50px;
    margin-left: 80px;
  }

  form {
    margin-top: 30px;
    padding: 20px;
    box-shadow: 3px 3px 30px rgba(1, 49, 131, 0.15);
    border-radius: 10px;
  }

  .input-registration {
    background: rgba(253, 125, 0, 0.1);
    border-radius: 10px;
    border: 1px solid blue;
    width: 100%;
  }

  .control {
    margin-bottom: 20px;
  }

  .step-button {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .btn-register {
    border: 2px solid var(--blue-color);
    color: var(--blue-color);
    border-radius: 10px;
    background-color: #fff;
    padding: 8px 10px;
    font-weight: 600;
  }

  .btn-register:hover {
    color: #fff;
    background-color: var(--blue-color);
  }

  #btn-submit-daftar {
    background-color: var(--blue-color);
    color: #fff;
  }

  @media only screen and (max-width: 1023px) {
    .registration-form {
      margin: 0;
      padding: 40px;
    }
  }
</style>

<NotificationDisplay />

<div class="registration">
  <div class="columns">
    <div class="column is-one-quarter left-side is-hidden-mobile">
      <img src="/assets/logo.png" alt="logo" width="200px" />
    </div>
    <div class="column is-6 registration-form">
      <div class="indicator">
        <div class="title is-4">Daftar</div>
        <progress
          class="progress is-warning"
          value={progressbarValue}
          max="90" />
      </div>
      <form on:submit={handleSubmit} method="POST">
        {#if activeStep === 1}
          <div class="field">
            <div class="control">
              <label for="fullname">Nama Lengkap</label>
              <input
                required
                bind:value={userRegistration.fullname}
                class="input input-registration"
                type="text"
                autocomplete="off"
                placeholder="masukan nama lengkap" />
            </div>
          </div>
          <div class="field">
            <div class="control">
              <label for="username">Nama Pengguna</label>
              <input
                required
                bind:value={userRegistration.username}
                class="input input-registration"
                type="text"
                autocomplete="off"
                placeholder="masukan nama pengguna" />
            </div>
          </div>
          <div class="field">
            <div class="control">
              <label for="email">Email</label>
              <input
                required
                bind:value={userRegistration.email}
                class="input input-registration"
                type="email"
                autocomplete="off"
                placeholder="masukan email" />
            </div>
          </div>
          <div class="field">
            <div class="control">
              <label for="password">Password</label>
              <input
                required
                bind:value={userRegistration.password}
                class="input input-registration"
                type="password"
                placeholder="masukan kata sandi" />
            </div>
          </div>
        {/if}

        {#if activeStep === 2}
          <div class="field">
            <div class="control">
              <label for="provisi">Provinsi</label>
              <div class="select" style="width:100%">
                <select
                  required
                  class="input-registration"
                  bind:value={asal.provinsi}
                  on:change={() => fetchKabupaten(asal.provinsi)}
                  on:blur>
                  <option disabled selected>Pilih Provinsi</option>
                  {#each dataProvinsi as { id, nama }}
                    <option value={id}>{nama}</option>
                  {/each}
                </select>
              </div>
            </div>
          </div>
          <div class="field">
            <div class="control">
              <label for="kabupaten">Kota/Kabupaten</label>
              <div class="select" style="width:100%">
                <select
                  required
                  class="input-registration"
                  bind:value={asal.kabupaten}>
                  <option disabled selected>Pilih Kota/Kabupaten</option>
                  {#each datakabupaten as { id, nama }}
                    <option value={id}>{nama}</option>
                  {/each}
                </select>
              </div>
            </div>
          </div>
          <div class="field">
            <div class="control">
              <label for="no_telephone">No Telephone/WhatsApp</label>
              <input
                required
                bind:value={userRegistration.phone}
                class="input input-registration"
                type="number"
                placeholder="masukan no telephone/WhatsApp" />
            </div>
          </div>
        {/if}

        {#if activeStep === 3}
          <div class="field">
            <div class="control">
              <label for="sekolah">Sekolah</label>
              <input
                required
                bind:value={dataSekolah.sekolah}
                class="input input-registration"
                type="text"
                placeholder="masukan asal sekolah" />
            </div>
          </div>
          <div class="field">
            <div class="control">
              <label for="jurusan">Jurusan</label>
              <input
                required
                bind:value={dataSekolah.jurusan}
                class="input input-registration"
                type="text"
                placeholder="masukan jurusan" />
            </div>
          </div>
        {/if}

        <div class="step-button">
          {#if activeStep !== 1}
            <button
              class="btn-register"
              type="button"
              on:click={() => {
                progressbarValue -= 30;
                activeStep--;
              }}>
              Sebelumnya
            </button>
          {:else}
            <div />
          {/if}
          {#if activeStep !== 3}
            <button
              class="btn-register"
              type="button"
              on:click={() => {
                progressbarValue += 30;
                activeStep++;
              }}>
              Selanjutnya
            </button>
          {:else}
            <button
              class="btn-register"
              id="btn-submit-daftar"
              type="submit"
              on:click={console.log('ASASA')}>
              Daftar Sekarang
            </button>
          {/if}
        </div>
      </form>
    </div>
  </div>
</div>
