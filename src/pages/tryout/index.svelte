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
      tanggal += 1
    }

    let countDown = `${bulan} ${tanggal}, ${tahun} ${setJam}:${menit}:${setDetik}`
    let encrypt = btoa(countDown);
    Cookies.set('TRYOUTTIME', encrypt, { path: '/tryout' })
    localStorage.setItem('no_soal', 1);
    // Cookies.remove('TRYOUTANSWER', { path: '/start-tryout' }) || false
    $goto('/tryout/start-tryout');
  }
</script>
  <button on:click={handleKerjakan}>Kerjakan</button>
<div>

</div>