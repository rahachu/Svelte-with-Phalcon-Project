<script>
  import { url } from "@sveltech/routify";
  import { auth } from "../../store/auth.js";
  import { quintOut } from "svelte/easing";
  import { fade, fly, slide } from "svelte/transition";

  import LoginModal from "../accounts/LoginModal.svelte";

  let y = "";

  let isShadow = false;
  let isActive = false;
  let isEnabled = false;
  let isModalLogin = false;

  $: if (y > 0) {
    isShadow = true;
  } else if (y === 0) {
    isShadow = false;
  }

  function logout() {
    fetch(`/logout`);
    auth.refresh();
  }

  function activateModalLogin() {
    isModalLogin = !isModalLogin;
  }
</script>

<style>
  a:hover {
    text-decoration: none;
  }

  .navigation {
    background-color: #fff;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 10px;
    box-sizing: border-box;
    position: fixed;
    width: 100%;
    z-index: 100;
    top: 0;
    left: 0;
    border-radius: 0 0 5px 5px;
    transition: 0.3s ease-in;
  }

  .navigation-shadow {
    box-shadow: 0 2px 15px 0 rgba(0, 0, 0, 0.2);
  }

  .navigation img {
    height: 35px;
  }

  .logo {
    display: flex;
    flex-direction: row;
  }

  .nav-links {
    line-height: 35px;
    margin-left: 40px;
    font-weight: 600;
  }

  .nav-links a {
    margin-right: 40px;
  }

  #pateron-school {
    color: var(--blue-color);
    margin-right: 20px;
  }

  .accounts {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .login,
  .registration {
    text-align: center;
    width: 95px;
    box-sizing: border-box;
    padding: 8px 15px;
    border-radius: 18px;
  }

  .login {
    color: var(--blue-color);
    border: 2px solid #013183;
  }

  .login:hover {
    color: #fff;
    background-color: var(--blue-color);
  }

  .registration {
    margin-left: 30px;
    color: #fff;
    background-color: var(--blue-color);
  }

  .registration:hover {
    color: var(--blue-color);
    background-color: #fff;
    border: 2px solid #013183;
  }

  .menu,
  .menu-icon {
    display: none;
  }

  /* Modal */
  .login-modal {
    width: 100%;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(176, 190, 217, 0.5);
  }

  /* mobile */
  @media only screen and (max-width: 842px) {
    .nav-links {
      display: none;
    }
  }

  @media only screen and (max-width: 768px) {
    .logo a img {
      width: 50%;
    }

    .accounts,
    .nav-links {
      display: none;
    }

    .menu-icon {
      display: block;
    }

    .menu {
      width: 100%;
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      z-index: 20;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #fff;
    }

    .list-menu {
      text-align: left;
      font-weight: normal;
      font-size: 18px;
      list-style: none;
    }

    .menu-item {
      margin-bottom: 40px;
      cursor: pointer;
    }

    .menu-item a {
      text-decoration: none;
      font-weight: 500;
      color: var(--blue-color);
    }

    .close-menu {
      font-size: 14px;
      text-align: center;
      font-weight: normal;
      cursor: pointer;
      color: rgb(202, 12, 12);
    }

    .button {
      width: 100%;
    }

    .menu-daftar {
      color: #fff !important;
      margin-top: -10px !important;
    }
  }
</style>

<svelte:window bind:scrollY={y} />
<header class="navigation" class:navigation-shadow={isShadow}>
  <div class="logo">
    <a href={$url('/index')}>
      <img src="/assets/logo.png" alt="logo" />
    </a>
    <div class="nav-links">
      <div class="dropdown is-hoverable" id="pateron-school">
        <div class="dropdown-trigger">
          <div aria-haspopup="true" aria-controls="dropdown-menu4">
            <span>Pateron School</span>
            <span class="icon is-small">
              <i class="fas fa-angle-down" aria-hidden="true" />
            </span>
          </div>
        </div>
        <div class="dropdown-menu" id="dropdown-menu4" role="menu">
          <div class="dropdown-content">
            <div class="dropdown-item">
              <ul>
                <li>
                  <a href={$url('/index')}>Paket Kelas</a>
                </li>
                <li>
                  <a href={$url('/paket-tryout')}>Paket Tryout</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <a href={$url('/index')}>Pateron Olym</a>
      <a href={$url('/index')}>Pateron TPB</a>
      <a href={$url('/index')}>Pateron Blog</a>
      <a href={$url('/index')}>Pateron Store</a>
    </div>
  </div>
  <div class="accounts">
    {#if $auth.login == 'wait'}
      <div class="select is-loading" />
    {:else if !$auth.login}
      <button class="login" on:click={activateModalLogin}>Masuk</button>
      <a href={$url('/accounts/registration')} class="registration">Daftar</a>
    {:else}
      <div class="dropdown is-right is-hoverable">
        <div class="dropdown-trigger">
          <button
            class="button"
            aria-haspopup="true"
            aria-controls="dropdown-menu">
            <span class="is-hidden-touch">
              Haloo
              {#if $auth.siswa.length !== 0}
                {$auth.siswa[0].fullname}
              {:else}admin{/if}
            </span>
            <span class="icon is-small">
              <!-- <i class="fas fa-user" aria-hidden="true" /> -->
              <img src={$auth.siswa[0].photo} alt={$auth.siswa[0].fullname} />
            </span>
          </button>
        </div>
        <div class="dropdown-menu" id="dropdown-menu" role="menu">
          <div class="dropdown-content">
            <a
              href="/users/{$auth.siswa.length !== 0 ? 'siswa' : 'admin'}/dashboard"
              class="dropdown-item">
              Dashboard
            </a>
            <hr class="dropdown-divider" />
            <a href="/" on:click={logout} class="dropdown-item">logout</a>
          </div>
        </div>
      </div>
    {/if}
  </div>
  <div class="menu-icon">
    <img
      src="/assets/menu.svg"
      alt="menu"
      on:click={() => (isEnabled = true)} />
  </div>
  {#if isEnabled}
    <div transition:slide={{ duration: 1500, easing: quintOut }} class="menu">
      <ul class="list-menu">
        <li
          transition:fly={{ delay: 800, duration: 500, x: 50, easing: quintOut }}
          class="menu-item"
          on:click={() => {
            isActive = !isActive;
          }}>
          <div class="dropdown" class:is-active={isActive} id="pateron-school">
            <div class="dropdown-trigger">
              <div aria-haspopup="true" aria-controls="dropdown-menu5">
                <span>Pateron School</span>
                {#if isActive}
                  <span class="icon is-small">
                    <i class="fas fa-angle-up" aria-hidden="true" />
                  </span>
                {:else}
                  <span class="icon is-small">
                    <i class="fas fa-angle-down" aria-hidden="true" />
                  </span>
                {/if}
              </div>
            </div>
            <div class="dropdown-menu" id="dropdown-menu5" role="menu">
              <div class="dropdown-content">
                <div class="dropdown-item">
                  <ul>
                    <li>
                      <a href={$url('/index')}>Paket Kelas</a>
                    </li>
                    <li>
                      <a href={$url('/paket-tryout')}>Paket Tryout</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li
          transition:fly={{ delay: 800, duration: 500, x: 50, easing: quintOut }}
          class="menu-item">
          <a
            href="/"
            on:click={() => {
              isEnabled = false;
            }}>
            Pateron Olym
          </a>
        </li>
        <li
          transition:fly={{ delay: 1000, duration: 500, x: 50, easing: quintOut }}
          class="menu-item">
          <a
            href="/"
            on:click={() => {
              isEnabled = false;
            }}>
            Pateron TPB
          </a>
        </li>
        <li
          transition:fly={{ delay: 1200, duration: 500, x: 50, easing: quintOut }}
          class="menu-item">
          <a
            href="/"
            on:click={() => {
              isEnabled = false;
            }}>
            Pateron Blog
          </a>
        </li>
        <li
          transition:fly={{ delay: 1200, duration: 500, x: 50, easing: quintOut }}
          class="menu-item">
          <a
            href="/"
            on:click={() => {
              isEnabled = false;
            }}>
            Pateron Store
          </a>
        </li>
        {#if $auth.login == 'wait'}
          <div class="select is-loading" />
        {:else if !$auth.login}
          <ul>
            <li
              transition:fly={{ delay: 1400, duration: 500, x: 50, easing: quintOut }}
              class="menu-item">
              <a
                href={$url('/accounts/login')}
                class="button is-link is-outlined">
                Masuk
              </a>
            </li>
            <li
              transition:fly={{ delay: 1600, duration: 500, x: 50, easing: quintOut }}
              class="menu-item">
              <a
                href={$url('/accounts/registration')}
                class="button menu-daftar is-info">
                Daftar
              </a>
            </li>
          </ul>
        {:else}
          <div
            class="dropdown is-right is-hoverable"
            transition:fly={{ delay: 1400, duration: 500, x: 50, easing: quintOut }}>
            <div class="dropdown-trigger">
              <button
                class="button"
                aria-haspopup="true"
                aria-controls="dropdown-menu">
                Haloo
                {#if $auth.siswa.length !== 0}
                  {$auth.siswa[0].fullname}
                {:else}admin{/if}
                <span class="is-hidden-touch" />
                <span class="icon is-small">
                  <i class="fas fa-user" aria-hidden="true" />
                </span>
              </button>
            </div>
            <div class="dropdown-menu" id="dropdown-menu" role="menu">
              <div class="dropdown-content">
                <a
                  href="/users/{$auth.siswa.length !== 0 ? 'siswa' : 'admin'}/dashboard"
                  class="dropdown-item">
                  Dashboard
                </a>
                <hr class="dropdown-divider" />
                <a href="/" on:click={logout} class="dropdown-item">logout</a>
              </div>
            </div>
          </div>
        {/if}
        <div
          transition:fly={{ delay: 1600, duration: 500, y: -50, easing: quintOut }}
          class="close-menu"
          on:click={() => (isEnabled = false)}>
          close
        </div>
      </ul>
    </div>
  {/if}

  {#if isModalLogin}
    <div
      class="login-modal"
      transition:fade={{ duration: 1500, easing: quintOut }}>
      <LoginModal activateModal={activateModalLogin} />
    </div>
  {/if}
</header>
