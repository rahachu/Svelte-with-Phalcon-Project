<script>
  import { isActive, url } from "@sveltech/routify";
  import Nav from "../../components/landing-page/Nav.svelte";
  import { auth } from "../../store/auth.js";
  auth.refresh();

  let sidebarActive = false;

  const siswaLinks = [
    ["/users/siswa/dashboard", "Dashboard", "fas fa-th-large"],
    ["/users/siswa/profile", "Profile", "fas fa-user"],
    [
      "/users/siswa/daftar-tryout",
      "Daftar Paket Tryout",
      "fas fa-clipboard-list"
    ],
    ["/users/siswa/tryout", "Tryout Saya", "fas fa-clipboard-check"],
    ["/users/siswa/kelas", "Kelas Saya", "fas fa-users"]
  ];
</script>

<style>
  .wrapper {
    padding: 20px;
    margin-top: 8px;
  }

  .wrapper-menu {
    width: 265px;
    position: fixed;
    height: 100%;
    background-color: #fff8f0;
    margin-left: -20px;
    padding: 10px;
    padding-top: 60px;
    transition: 1s ease-in-out;
  }

  .columns {
    height: 100vh;
  }

  .profile {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .profile .profile__photo {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 5px solid #fd7d00;
    border-radius: 50%;
  }

  .profile .profile__photo img {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    object-fit: cover;
  }

  .menu {
    list-style: none;
    padding-left: 20px;
  }

  .menu li {
    color: #807c78;
    font-size: 16px;
  }

  .menu li a {
    display: flex;
    align-items: center;
    flex-direction: row;
    margin-bottom: 20px;
    color: #807c78;
  }

  .menu li a span {
    width: 20px;
    font-size: 18px;
    display: flex;
    justify-content: center;
  }

  .menu li a p {
    margin-left: 30px;
    font-size: 18px;
  }

  .active {
    color: #fd7d00;
    font-weight: 600;
  }

  @media only screen and (max-width: 1262px) {
    .wrapper-menu {
      width: 100%;
    }

    .menu-sidebar {
      display: none;
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: 4;
    }
  }

  .sidebar-active {
    display: block;
  }

  .btn-sidebar {
    display: flex;
    justify-content: center;
  }

  .btn-sidebar button {
    width: 50px;
    height: 50px;
    border-radius: 50%;
  }

  .btn-right {
    position: fixed;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    z-index: 2;
    top: 100px;
    left: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0.6;
  }

  .btn-right:hover {
    opacity: 1;
  }
</style>

<Nav />
<button
  class="button is-warning btn-right is-hidden-desktop-only
  is-hidden-widescreen-only"
  on:click={() => (sidebarActive = !sidebarActive)}>
  <i class="fas fa-chevron-circle-right" />
</button>
<div class="columns wrapper">
  <div
    class="column is-one-fifth menu-sidebar"
    class:sidebar-active={sidebarActive}>
    <div class="wrapper-menu">
      {#if $auth.login == 'wait'}
        <div class="select is-loading" />
      {:else if $auth.siswa.length !== 0}
        <div class="profile">
          <div class="profile__photo">
            <img src={$auth.siswa[0].photo} alt={$auth.siswa[0].fullname} />
          </div>
          <div class="title is-3 has-text-centered">
            {$auth.siswa[0].fullname}
          </div>
          <div class="mb-6 has-text-centered subtitle is-6">
            {$auth.siswa[0].school}
          </div>
        </div>
        <ul class="menu">
          {#each siswaLinks as [path, name, icon]}
            <li>
              <a href={$url(path)} class:active={$isActive(path)}>
                <span class:active={$isActive(path)}>
                  <i class={icon} />
                </span>
                <p class:active={$isActive(path)}>{name}</p>
              </a>
            </li>
          {/each}
        </ul>
        <div class="btn-sidebar">
          <button
            class="button is-warning is-rounded is-hidden-desktop-only
            is-hidden-widescreen-only"
            on:click={() => (sidebarActive = !sidebarActive)}>
            <i class="fas fa-chevron-circle-left" />
          </button>
        </div>
      {:else}
        <li>
          <a href="/users/admin/dashboard">Dashboard</a>
        </li>
        <li>
          <a href="/users/admin/payment">Pembelian</a>
        </li>
        <li>
          <a href="/users/admin/payment/validated">Pembelian tervalidasi</a>
        </li>
      {/if}
    </div>
  </div>
  <div class="column">
    <slot />
  </div>
</div>
