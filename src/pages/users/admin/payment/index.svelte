<script>
    import { params,url,isChangingPage } from '@sveltech/routify'
    let el = {};
    let page=1;
    if ($params.page) {
        page = $params.page;
    }
    let dataRequest = req(page);
    let img = {};

    async function req(page) {
        let a = await fetch(`http://${window.location.host}/admin/unvalidation/?page=${page}`);
        let b = await a.json();
        b.items.forEach(item => {
            item.bukti.forEach(id => {
                getImage(id).then(res=>img[id]=res);
            });
        });
        if (a.ok) {
            return b;
        }
        else{
            throw new Error(b);
        }
    }

    let getImage = async (id)=>{
                                let req = await fetch(`http://${window.location.host}/admin/data/image/${id}`);
                                let img = req.text();
                                if (req.ok) {
                                    return img;
                                }
                                else{
                                    throw new Error(img);
                                }
                            }

    function confirm(id) {
        fetch(`http://${window.location.host}/admin/confirm/${id}`,{
        method: 'POST'
        }).then(()=>{refresh()})
    }

    function showModal(element) {
        element.classList.add('is-active')
    }
    function closeModal(element) {
        element.classList.remove('is-active')
    }
    function refresh() {
        dataRequest = req(page);
        img = {};
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
                <th>Validasi</th>
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
                        <div class="column is-2" style="margin-left: 15px" on:click={()=>{showModal(el[id])}}>
                            <img class="image-button" src="{img[id]}" alt="">
                        </div>
                            <div class="modal" bind:this={el[id]}>
                                <div class="modal-background" on:click={()=>{closeModal(el[id])}}></div>
                                <div class="modal-content">
                                    <img src="{img[id]}" alt="">
                                </div>
                                <button class="modal-close is-large" aria-label="close" on:click={()=>{closeModal(el[id])}}></button>
                            </div>
                        {/each}
                    </div>
                </td>
                <td><button class="button is-primary is-small" on:click={()=>{confirm(item.id)}}>validasi</button></td>
            </tr>
            {/each}
        </tbody>
    </table>
    <p class="title is-6">Halaman: <input type=number bind:value={page} min=1 max={data.last}><button class="button" on:click={refresh}>go</button></p>
</div>
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