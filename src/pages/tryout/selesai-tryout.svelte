<script>
  import Cookies from 'js-cookie'
  import { onMount } from "svelte"

  onMount(() => {
    Cookies.get("MARKQUESTION") ? Cookies.remove("MARKQUESTION") : false
    Cookies.remove("SOALDATA")
    Cookies.remove("SUBTEST")
    Cookies.remove("TRYOUTANSWER")
    Cookies.remove("TRYOUTTIME")
  })
</script>
<h5>Selesai TRYOUT</h5>