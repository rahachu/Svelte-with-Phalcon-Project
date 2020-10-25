<script>
  import { goto, url } from "@sveltech/routify";
  import Nav from "../components/landing-page/Nav.svelte";
</script>

<style>
  .wrapper {
    position: relative;
  }

  .error__content {
    position: absolute;
    left: 50%;
    top: 100px;
    transform: translateX(-50%);
    text-align: center;
  }

  .btn-back {
    background-color: #fd7d00;
    color: #fff;
  }

  .btn-back:hover {
    color: #fff;
    opacity: 0.8;
  }
</style>

<Nav />
<div class="wrapper">
  <div class="error__content">
    <img src="/assets/404_error.png" alt="4040 Error" width="300px" />
    <h1 class="title is-2">404 Not Found</h1>
    <div class="subtitle is-4">Oops, Halaman Tidak ditemukan</div>
    <button class="button btn-back" on:click={() => $goto($url('/'))}>
      Back to Home
    </button>
  </div>
</div>
