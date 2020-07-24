<script>
  import { goto } from '@sveltech/routify'
  import Cookies from 'js-cookie'

  function handleKerjakan(){
    let today = new Date();
    let current = ''
    let setJam = ''
    let setDetik = ''
    
      let bulan 	= today.toLocaleString('default', { month: 'short' });
      let tanggal = today.getDate()
      let tahun 	= today.getFullYear()
      let jam 		= today.getHours()
      let menit 	= today.getMinutes()
      let detik 	= today.getSeconds()

    // set time
    setJam = jam + 2;
    setDetik = detik +2

    if(setJam > 24){
      current = setJam-24;
      setJam = 0+current;
      bulan += 1
    }

    let countDown = `${bulan} ${tanggal}, ${tahun} ${setJam}:${menit}:${setDetik}`
    let encrypt = btoa(countDown);
    // document.cookie = `TRYOUTTIME=${encrypt}`
    Cookies.set('TRYOUTTIME', encrypt, { path: '/tryout' })
    Cookies.remove('TRYOUTANSWER', { path: '/start-tryout' }) || false
    $goto('/tryout/start-tryout');
  }
</script>
  <!-- {#each data as {no, question, option_a, option_b, option_c, option_d, option_e}, i}
    {@html question}
  {/each} -->
  <button on:click={handleKerjakan}>Kerjakan</button>
<div>

</div>