<script>
    import {dataTO} from './_store.js';

    let judul = '';
    let time = 0;
    let templateSoal = {
        question : '',
        option_a : '',
        option_b : '',
        option_c : '',
        option_d : '',
        option_e : '',
        kunci : null,
        no : 0
    }

    function addSoal(idSubtest) {
        dataTO.update(n => {
            n.subtest[idSubtest].soal.push({...templateSoal,no : n.subtest[idSubtest].soal.length+1});
            return n;
        })
    }

    function addSubtest(event) {
        dataTO.update(n => {
            n.subtest.push({
                    judul: (judul===''?'Subtest ' + (n.subtest.length+1):judul),
                    time_in_minute: time,
                    soal: [],
                })
            return n;
        })
        judul = '';
        time = 0;
    }

    function delSubtest(id){
        dataTO.update(n => {
            n.subtest.splice(id,1);
            return n;
        })
    }
</script>

<div class="card" style="position: sticky; top: 0; z-index: 1;">
    <div class="columns is-vcentered card-content">
        <div class="column"><input class="input is-large" type="text" placeholder="Judul Tryout"></div>
        <button class="button is-info is-outlined is-large column is-2">save</button>
    </div>
</div>
<div class="container" style="margin-top: 40px">
{#each $dataTO.subtest as sub,i}
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
            {sub.judul} - {sub.time_in_minute} minutes</p>
            <p on:click={()=>delSubtest(i)} class="card-header-icon" aria-label="delete">
            <span class="icon">
                <i class="fas fa-trash has-text-danger" aria-hidden="true"></i>
            </span>
            </p>
        </header>
        <div class="card-content">
            <div class="buttons">
                {#each sub.soal as soal_value}
                    <button class="button is-link is-light">{soal_value.no}</button>
                {:else}
                    <p>Belum ada soal &ensp;</p>
                {/each}
                <button on:click={() => addSoal(i)} class="button is-primary is-outlined"><span class="icon"><i class="fas fa-plus" aria-hidden="true"></i></span></button>
                <button class="button is-danger is-outlined"><span class="icon"><i class="fas fa-trash" aria-hidden="true"></i></span></button>
            </div>
        </div>
    </div>
{:else}
	<div class="card">
        <div class="card-content"><p class="title is-5">Belum ada subtest</p></div>
    </div>
{/each}
    <br>
    <div class="columns is-vcentered is-1" style="align-text: right;">
    <div class="column"></div>
        <div class="column is-3">
            <input class="input" bind:value={judul} type="text" placeholder="Judul subtest">
        </div>
        <div class="column is-3">
            <input class="input" bind:value={time} type=number min=0 placeholder="Waktu dalam menit">
        </div>
        <div class="column is-2">
            <button class="button is-primary is-outlined" on:click={addSubtest}><span class="icon"><i class="fas fa-plus" aria-hidden="true"></i></span> <span>subtest</span></button>
        </div>
    </div>
</div>