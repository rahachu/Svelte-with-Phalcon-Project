<script>
  import TabelNilai from "../../../components/tryout/TabelNilai.svelte"
  import { params } from '@sveltech/routify'
</script>


<TabelNilai idtryout={$params.id}/>