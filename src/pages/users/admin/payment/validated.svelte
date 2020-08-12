<script>
    let el = {};
    let page=1;
    
    let dataRequest = fetch(`http://${window.location.host}/admin/validation/?page=${page}`).then(res=>res.json());

    let getImage = async (id)=>{
                                let req = await fetch(`http://${window.location.host}/admin/data/image/${id}`);
                                let image = await req.text();
                                return image;
                            }

    function showModal(element) {
        element.classList.add('is-active')
    }
    function closeModal(element) {
        element.classList.remove('is-active')
    }
</script>

{#await dataRequest}
<p>Loading boss...</p>
{:then data}
<div class="container">
    <table class="table" style="width: 100%;">
        <thead>
            <tr>
                <th>Username</th>
                <th>Produk</th>
                <th>Bukti Pembayaran</th>
                <th>divalidasi oleh</th>
            </tr>
        </thead>
        <tbody>
            {#each data.items as item}
            <tr>
                <td>{item.namasiswa}</td>
                <td>{item.produk}</td>
                <td>
                    <div class="columns is-multiline">
                        {#each item.bukti as id}
                        {#await getImage(id)}
                            O
                        {:then image}
                        <div class="column is-2" style="margin-left: 15px" on:click={()=>{showModal(el[id])}}>
                            <img class="image-button" src="{image}" alt="">
                        </div>
                            <div class="modal" bind:this={el[id]}>
                                <div class="modal-background" on:click={()=>{closeModal(el[id])}}></div>
                                <div class="modal-content">
                                    <img src="{image}" alt="">
                                </div>
                                <button class="modal-close is-large" aria-label="close" on:click={()=>{closeModal(el[id])}}></button>
                            </div>
                        {/await}
                        {/each}
                    </div>
                </td>
                <td>Rahachu</td>
            </tr>
            {/each}
        </tbody>
    </table>
</div>
<p class="title is-6">Halaman: <input type=number bind:value={page} min=1 max={data.last}></p>
{:catch error}
<p style="color: red">{error.message}</p>
{/await}

<style>
.image-button{
    object-fit: cover;
    height: 48px;
    width: 48px;
    max-height: 48px;
    min-width: 48px;
}

.image-button:hover{
    opacity: 50%;
}

</style>