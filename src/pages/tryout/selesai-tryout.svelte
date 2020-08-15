<script>
  import Cookies from 'js-cookie'
  import { onMount } from "svelte"
  import { goto } from '@sveltech/routify'

  onMount(() => {
    checkTryOut()
  })

  function checkTryOut(){
    let soalData = Cookies.get("SOALDATA") || false
    if(soalData){
      $goto("start-tryout")
    }
  }
</script>
<h5>Selesai TRYOUT</h5>