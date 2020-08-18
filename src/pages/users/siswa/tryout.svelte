<script>
	import { goto,url } from '@sveltech/routify';
	let prodReq = fetch(`/dashboard/tryoutsaya`).then(res=>res.json());
</script>

{#await prodReq}
<div class="select is-loading"></div>
{:then data}
<div class=""></div>
<div class="flex-box">
	{#each data as prod}
	<div class="card flex-item">
		<div class="card-content">
			<p class="title is-4">{prod.name}</p>
			<div class="button-container"><button class="button is-warning" on:click={()=>{$goto($url('../../../tryout',{id: prod.idtryout}))}}>Kerjakan</button></div>
		</div>
	</div>
	{:else}
	<p>Belum ada tryout</p>
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
.button-container{
	text-align: right;
    position: absolute;
    bottom: 0px;
    margin: 10px;
    padding: 10px;
    width: 80%;
}
.card-content{
	min-height: 140px;
}
</style>