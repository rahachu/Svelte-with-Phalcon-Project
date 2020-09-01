<script>
  import { url } from "@sveltech/routify";
  import { auth } from "../../store/auth.js"

  let y = "";

  let isShadow = false;
  $:if(y > 0){
    isShadow = true;
  } else if(y === 0){
    isShadow = false;
  }

  function logout() {
    fetch(`/logout`);
    auth.refresh();
  }

</script>

<svelte:window bind:scrollY={y}/>

<style>
  a:hover{
    text-decoration: none;
  }

  .navigation{
    background-color: #fff;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 20px;
    position: fixed;
    width: 100%;
    z-index: 100;
    top: 0;
    left: 0;
    border-radius: 0 0 5px 5px;
    transition: .3s ease-in;
  }

  .navigation-shadow {
    box-shadow: 0 2px 15px 0 rgba(0, 0, 0, 0.2);
  }

  .navigation img {
    height: 35px;
  }

  .logo {
    display:flex;
    flex-direction: row;
  }

  .nav-links {
    line-height: 35px;
    margin-left: 40px;
    font-weight: 600;
  }

  .nav-links a{
    margin-right: 40px;
  }

  .accounts{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .login, .registration{
    text-align: center;
    width: 95px;
    box-sizing: border-box;
    padding: 8px 15px;
    border-radius: 18px
  }

  .login{
    color:var(--blue-color);
    border: 2px solid #013183;
  }

  .login:hover{
    color: #fff;
    background-color: var(--blue-color);
  }

  .registration {
    margin-left: 30px;
    color:#fff;
    background-color: var(--blue-color);
  }

  .registration:hover{
    color:var(--blue-color);
    background-color: #fff;
    border: 2px solid #013183;
  }

  /* mobile */
  @media only screen and (max-width: 842px) {
    .nav-links {
      display: none;
    }
  }

</style>

<header class="navigation" class:navigation-shadow={isShadow}>
  <div class="logo">
    <a href={$url('/index')}>
      <img src="/assets/logo.png" alt="logo">
    </a>
    <div class="nav-links">
      <a href="{$url('/index')}">
        Paket Kelas
      </a>
      <a href="{$url('/index')}">
        Paket Try Out
      </a>
      <a href="{$url('/index')}">
        Pateron Blog
      </a>
    </div>
  </div>
  <div class="accounts">
    {#if $auth.login=="wait"}
    <div class="select is-loading"></div>
    {:else if !$auth.login}
    <a href={$url('/accounts/login')} class="login">Masuk</a>
    <a href={$url('/accounts/registration')} class="registration">Daftar</a>
    {:else}
    <div class="dropdown is-right is-hoverable">
      <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
          <span class="is-hidden-touch">Haloo
            {#if $auth.siswa.length !==0}
              {$auth.siswa[0].fullname}
            {:else}
              admin
            {/if}
          </span>
          <span class="icon is-small">
            <i class="fas fa-user" aria-hidden="true"></i>
          </span>
        </button>
      </div>
      <div class="dropdown-menu" id="dropdown-menu" role="menu">
        <div class="dropdown-content">
          <a href="/users/{$auth.siswa.length !==0?"siswa":"admin"}/dashboard" class="dropdown-item">
            Dashboard
          </a>
          <hr class="dropdown-divider">
          <a href="/" on:click={logout} class="dropdown-item">
            logout
          </a>
        </div>
      </div>
    </div>
    {/if}
  </div>
</header>