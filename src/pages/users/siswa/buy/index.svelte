<script>
    import { params,goto,url } from "@sveltech/routify";
    let produk = fetch(`/dashboard/product/data/${$params.product}`).then(res=>res.json());
</script>

<div class="container">
    <div class="card">
        <div class="card-content">
            {#await produk}
                <div class="select is-loading"></div>
            {:then data}
                <p class="title">{data.name}</p>
                <p class="subtitle has-text-danger">{data.price.replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</p>
                <p class="content">Tryout mantap murah hemat dan berkualitas yang dibuat pateron dengan sepenuh hati bagaikan anak sendiri.</p>
            {:catch error}
            <p style="color: red">{error.message}</p>
            {/await}
            <div class="container" style="text-align: right;">
                <button class="button is-primary" on:click={()=>{$goto($url('../verification',$params))}}>Beli Sekarang</button>
            </div>
        </div>
    </div>
</div>

<style>
.container{
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>