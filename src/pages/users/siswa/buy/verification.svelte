<script>
    import BuktiBeli from '../../../../components/BuktiBeli.svelte';
    import { params } from "@sveltech/routify";
    let produk = fetch(`http://${window.location.host}/dashboard/product/data/${$params.product}`).then(res=>res.json());
    let payMethod = fetch(`http://${window.location.host}/dashboard/payment/list`).then(res=>res.json());
    let bukti;
    let selectedPayment;

    function send(){
        let formdata = new FormData();
        bukti.forEach(img => {
            formdata.append("data[]",img);
        });
        fetch(`http://${window.location.host}/dashboard/${$params.product}/${selectedPayment.type_payment_method}`,{
            method: 'POST',
            body: formdata
        }).then(res=>res.text()).then(a=>console.log(a))
    }
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
            <div class="message">
                <div class="message-body">
                    <div class="columns">
                        <div class="column">
                            <p><strong>Metode pembayaran:</strong></p>
                            {#await payMethod}
                                <div class="select is-loading"></div>
                            {:then datas}
                                <div class="select">
                                    <select bind:value={selectedPayment} >
                                        {#each datas as data}
                                        <option value="{data}">{data.type_payment_method}</option>
                                        {/each}
                                    </select>
                                </div><br>
                            <strong>Selesaikan pembayarann</strong>
                            {#if selectedPayment!==undefined}
                                <p>{@html selectedPayment.description}</p>
                            {/if}
                            <p>upload screenshoot bukti dibawah ini</p>
                            {:catch error}
                            <p style="color: red">{error.message}</p>
                            {/await}
                        </div>
                        <div class="column is-2 justdesktop" style="text-align: right;">
                            <button class="button is-primary" on:click={send}>Kirim Bukti</button>
                        </div>
                    </div>
                    <BuktiBeli bind:value={bukti}/>
                    <div class="justmobile" style="text-align: right;"><button class="button is-primary" on:click={send}>Kirim Bukti</button></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.container{
    margin-top: 10px;
    margin-bottom: 10px;
}

@media only screen and (max-width: 769px) {
  .justdesktop{
      display: none;
  }
}

@media only screen and (min-width: 769px) {
  .justmobile{
      display: none;
  }
}
</style>