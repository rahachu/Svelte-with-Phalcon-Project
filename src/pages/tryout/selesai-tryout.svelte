<script>
  import Cookies from 'js-cookie'
  import { onMount } from "svelte"
  import { auth } from "../../store/auth.js"
  import { goto, url } from '@sveltech/routify'

  let fullname = ''
  let isLoading = false;

  auth.refresh()
  checkTryOut()
  
  $:if($auth.login =="wait"){
    isLoading = true
  }else{
    fullname = $auth.siswa[0].fullname
    isLoading = false;
  }
  
  function checkTryOut(){
    let soalData = localStorage.getItem("SOALDATA") || []
    if(soalData.length !== 0){
      $goto("start-tryout")
    }
  }

</script>

<style>
  .wrapper{
    background-color: #f8f8f8;
    padding: 20px;
    height: 100vh
  }

  .selesai-tryout{
    background-color: #fff;
    padding: 30px;
  }

  .buttons{
    display: flex;
    justify-content: center;
  }
</style>

{#if isLoading}
  <div class="select is-loading"></div>
{:else}
  <div class="wrapper">
    <div class="container is-fullwidth">
      <div class="selesai-tryout">
        <div class="notification is-primary">
          Tryout selesai dikerjakan
        </div>
        <div class="mt-6 mb-6 has-text-centered is-size-5">
          <p>Hai, <b>{fullname}</b> </p>
          <p>Terimakasih telah mengerjakan Tryout pada hari ini.</p>
          <p>Semoga hasilnya memuaskan dan jangan lupa untuk selalu belajar.</p>
          <br><br>
        </div>
        <div class="buttons">
          <a class="button is-info  is-outlined" href={$url('../../users/siswa/dashboard')}>Kembali ke dashboard</a>
          <a class="button is-info" href={$url("nilai-tryout")}>Lihat Nilai</a>
        </div>
      </div>
    </div>
  </div>
{/if}
