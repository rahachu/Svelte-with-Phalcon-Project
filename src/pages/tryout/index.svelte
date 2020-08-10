<script>
  import Cookies from 'js-cookie'
  import CryptoJS from 'crypto-js'
  import { onMount } from 'svelte'
  import { goto } from '@sveltech/routify'
  import { soalStore } from '../../store/tryout/soalStore.js'
  // Library
  import { setEncryptCookie, setDecryptCookie } from "../../library/SetCryptoCookie";

  let timeInMinute = ''
  let subtestId = ''
  let isLoading = true;
  onMount(() => {
    setupSoalState()
  })

  soalStore.subtestId.subscribe( id => {
    subtestId = id;
    setEncryptCookie("SUBTEST", parseInt(subtestId))
  })

  let a = setDecryptCookie("SUBTEST", "number");
  async function setupSoalState(){
    await soalStore.getSoalApi();
    await soalStore.dataSoal.subscribe(tryout => {
      // setting jam sesuai response API (time in minute)
      timeInMinute = tryout.subtest[subtestId].time_in_minute / 60
    })
    isLoading = false;
  }

  function handleKerjakan(){
    soalStore.startTryOut(timeInMinute);
    $goto('/tryout/start-tryout');
  }
</script>
<div>
  {#if isLoading}
    <h5>Loading</h5>
  {:else}
    <button on:click={handleKerjakan}>Kerjakan</button>
  {/if}
</div>