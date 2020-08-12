<script>
  import Nav from "../../components/landing-page/Nav.svelte";
</script>

<Nav/>
<div style="height: 80px;"></div>
<aside class="menu is-blue">
  <p class="menu-label">
    Menu
  </p>
  <ul class="menu-list">
    <li><a href="#">Dashboard</a></li>
    <li><a href="#">Tryout Saya</a></li>
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