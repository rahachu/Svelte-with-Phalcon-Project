<script>
    import { goto } from "@sveltech/routify";

    let formNewTO = {name:'',tryout_price:''}
    let listTO = fetch(`http://${window.location.host}/tryout/datalist`).then(res=>res.json());
    let addTO = null;
    let delTO = null;

    let addTOclick = () => {
        addTO = fetch(`http://${window.location.host}/tryout/create`,{
        method: 'POST',
        body: JSON.stringify(formNewTO)
        }).then(res=>res.json());
        formNewTO = {name:'',tryout_price:''};
        refreshList();
    }

    let delTOclick = (id) => {
        delTO = fetch(`http://${window.location.host}/tryout/create`,{
            method: 'DELETE',
            body: JSON.stringify({"idtryout":id})
        });
        refreshList();
    }

    let refreshList = () => {
        listTO = fetch(`http://${window.location.host}/tryout/datalist`).then(res=>res.json());
    }

    let publishTO = (id) => {
        fetch(`http://${window.location.host}/tryout/publish/${id}`,{method: 'POST'})
        .then(()=>refreshList())
    }

    let unpublishTO = (id) => {
        fetch(`http://${window.location.host}/tryout/unpublish/${id}`,{method: 'POST'})
        .then(()=>refreshList())
    }
</script>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Harga</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {#await listTO}
            <p>...loading boss</p>
            {:then list}
                {#each list as to}
                    <tr>
                        <td>{to.name}</td>
                        <td>{to.tryout_price.replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                        <td><button class="button is-info is-small" on:click={()=>{$goto('./tryout/edit',{idtryout:to.idtryout})}}>Edit</button></td>
                        {#if to.publish_time==null}
                        <td><button class="button is-link is-small" on:click={()=>{publishTO(to.idtryout)}}>Publish</button></td>
                        {:else}
                        <td><button class="button is-danger is-small" on:click={()=>{unpublishTO(to.idtryout)}}>Unpublish</button></td>
                        {/if}
                        <td><button class="button is-danger is-small" on:click={()=>{delTOclick(to.idtryout)}}>Hapus</button></td>
                    </tr>
                {:else}
                <p>Belum ada tryout</p>
                {/each}
            {:catch error}
                <p style="color: red">{error.message}</p>
            {/await}
        </tbody>
        <tfoot>
            <td><input class="input" type="text" placeholder="Judul Tryout" bind:value={formNewTO.name}></td>
            <td><input class="input" type="text" placeholder="Harga" bind:value={formNewTO.tryout_price}></td>
            {#await addTO}
            <td colspan="3"><button class="button is-primary is-loading">Tambah Tryout</button></td>
            {:then nothing}
            <td colspan="3"><button class="button is-primary" on:click={addTOclick}>Tambah Tryout</button></td>
            {:catch error}
            <td colspan="3"><button class="button is-primary" on:click={addTOclick}>Tambah Tryout</button></td>
            {/await}
        </tfoot>
    </table>
</div>