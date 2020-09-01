<script>
  import Cookies from 'js-cookie'
  import CryptoJS from 'crypto-js'
  import { onMount } from 'svelte'
  import { goto,params } from '@sveltech/routify'
  import { soalStore } from '../../store/tryout/soalStore.js'
  import { auth } from '../../store/auth.js'

  // Library
  import { setEncryptCookie, setDecryptCookie } from "../../library/SetCryptoCookie";

  let timeInMinute = ''
  let subtestId = ''
  let isLoading = true;
  let tryoutData = ''
  onMount(() => {
    checkTryOut()
    let getSelesai = Cookies.get("SELESAI") || false
    if(getSelesai){
      $goto("/tryout/selesai-tryout")
    }

    soalStore.subtestId.subscribe( id => {
      subtestId = id;
      setEncryptCookie("SUBTEST", parseInt(subtestId))
    })

    setupSoalState()
  })
  
  function checkTryOut(){
    let tryOutTime = Cookies.get("TRYOUTTIME") || false
    if(tryOutTime){
      $goto("tryout/start-tryout")
    }
  }

  async function setupSoalState(){
    await soalStore.getSoalApi($params.id);
    await soalStore.dataSoal.subscribe(tryout => {
      // setting jam sesuai response API (time in minute)
      timeInMinute = tryout.subtest[subtestId].time_in_minute

      // Set Data Tryout and Subtest
      let name = tryout.name
      let totalSoal = 0
      let totalWaktu = 0
      let subtestData = []
      for (const subtest of tryout.subtest) {
        subtestData.push({
          name:subtest.judul,
          time:subtest.time_in_minute,
          totalSoal:subtest.soal.length
        })
        totalSoal += subtest.soal.length;
        totalWaktu += parseInt(subtest.time_in_minute)
      }

      const data = {
        name,
        totalSoal,
        totalWaktu,
        subtestData
      }

      tryoutData = data
    })
    isLoading = false;
  }

  function handleKerjakan(){
    soalStore.startTryOut(timeInMinute);
    $goto('/tryout/start-tryout');
  }
</script>

<style>
  .wrapper-tryoutdata{
    padding: 40px;
  }

  .tryout-data{
    padding: 20px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .detail-tryout {
    display: flex;
    flex-direction: row;
    justify-content: center;
  }

  .detail-tryout h3{
    font-weight: normal;
    margin-left: 20px;
    color: gray;
  }

  .subtest-data{
    width: 70%;
    margin: 10px auto;
    border-radius: 5px;
    margin: 40px 0;
  }

  .detail-subtest{
    padding: 10px;
    margin-bottom: 10px;
  }

  .btn-kerjakan{
    width: 200px;
    text-align: center;
  }
</style>

<div>
  {#if isLoading}
    <h5>Loading</h5>
  {:else}
    <div class="wrapper-tryoutdata container is-widescreen">
      <div class="tryout-data">
        <div class="title is-3 has-text-centered">{tryoutData.name}</div>
        <div class="detail-tryout">
          <h3>Total Waktu : {tryoutData.totalWaktu} menit</h3>
          <h3>Total Soal : {tryoutData.totalSoal} soal</h3>
        </div>
        <div class="content subtest-data">
          <table class="table is-fullwidth is-hoverable">
            {#each tryoutData.subtestData as { name, time, totalSoal }, i}
            <tr class="detail-subtest">
              <td class="title is-size-6">{i+1}. {name}</td>
              <td>{time} menit</td>
              <td>{totalSoal} soal</td>
            </tr>
            {/each}
          </table>
        </div>
        <div class="buttons">
          <button class="button is-primary btn-kerjakan is-outlined" on:click={() => window.history.back()}>Kembali</button>
          <button class="button is-primary btn-kerjakan" on:click={handleKerjakan}>Mulai Kerjakan</button>
        </div>
      </div>
    </div>
  {/if}
</div>