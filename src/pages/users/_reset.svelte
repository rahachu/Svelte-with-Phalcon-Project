<script>
  import Nav from "../../components/landing-page/Nav.svelte";
  import { auth } from "../../store/auth.js"
</script>

<Nav/>
<div style="height: 80px;"></div>
<aside class="menu is-blue">
  <p class="menu-label">
    Menu
  </p>
  <ul class="menu-list">
    {#if $auth.login=="wait"}
    <div class="select is-loading"></div>
    {:else if $auth.siswa.length !==0}
    <li><a href="/users/siswa/dashboard">Dashboard</a></li>
    <li><a href="/users/siswa/tryout">Tryout Saya</a></li>
    <li><a href="/users/disclaimer">Disclaimer</a></li>
    {:else}
    <li><a href="/users/admin/dashboard">Dashboard</a></li>
    <li><a href="/users/admin/payment">Pembelian</a></li>
    <li><a href="/users/admin/payment/validated">Pembelian tervalidasi</a></li>
    {/if}
  </ul>
</aside>
<main><slot/></main>

<style>
aside{
  float: left;
  height: 80%;
  width: 17%;
  margin: 2%;
  position: sticky;
  top: 0;
}
main{
  float: right;
  width: 75%;
}
</style>