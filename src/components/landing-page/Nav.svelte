<script>
  import { url } from "@sveltech/routify";
</script>

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
    box-shadow: 0 0 20px 5px rgba(0, 0, 0, 0.2);
    position: fixed;
    width: 100%;
    z-index: 100;
    top: 0;
    left: 0;
    border-radius: 0 0 5px 5px;
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

<header class="navigation">
  <div class="logo">
    <a href={$url('/index')}>
      <img src="./assets/logo.png" alt="logo">
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
    <a href={$url('/accounts/login')} class="login">Masuk</a>
    <a href={$url('/accounts/registration')} class="registration">Daftar</a>
  </div>
</header>