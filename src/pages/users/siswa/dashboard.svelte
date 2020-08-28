<script>
	import { goto,url } from '@sveltech/routify';
	let prodReq = fetch(`/dashboard/list`).then(res=>res.json());
</script>

{#await prodReq}
<div class="select is-loading"></div>
{:then data}
<div class=""></div>
<div class="flex-box">
	{#each data.product as prod}
	<div class="card flex-item">
		<div class="card-content">
			<p class="title is-4">{prod.name}</p>
			<p class="subtitle">{prod.tryout_price.replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</p>
			<div class="button-container"><button class="button is-primary" on:click={()=>{$goto($url('../buy',{product: prod.idtryout}))}}>Beli</button></div>
		</div>
	</div>
	{:else}
	<p>Belum ada product</p>
	{/each}
</div>
{:catch error}
<p style="color: red">{error.message}</p>
{/await}

<style>
.flex-box{
	display: flex;
	flex-wrap: wrap;
}
.flex-item{
	flex-basis: 25%;
	margin: 10px;
}
@media only screen and (max-width: 769px) {
  .flex-box{
	  margin: 0 20px;
  }
  .flex-item {
    flex-basis: 100%;
	margin: 10px;
  }
}
.button-container{
	text-align: right;
    position: absolute;
    bottom: 0px;
    margin: 10px;
    padding: 10px;
    width: 80%;
}
</style>