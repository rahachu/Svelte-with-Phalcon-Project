<script>
    import {dataTO} from './_store.js';
    import { goto,params } from "@sveltech/routify";

    let judul = '';
    let name = '';
    let time = 0;
    let loading = false;
    const templateSoal = {
        question : 'Masukan disini!',
        option_a : 'Masukan disini!',
        option_b : 'Masukan disini!',
        option_c : 'Masukan disini!',
        option_d : 'Masukan disini!',
        option_e : 'Masukan disini!',
        key : 'A',
        no : 0,
        solution: 'Masukan solusi persoalan disini'
    }
    let isDirty = true;

    let loadFullData = null;

    if ($dataTO===null) {
        loadFullData = fetch(`/tryout/fulldata/${$params.idtryout}`)
        .then(res=>res.json()).then((json)=>{
            dataTO.update(n => json);
            name = json.name;
        });
    }
    else{
        name = $dataTO.name;
    }

    function addSoal(idSubtest) {
        dataTO.update(n => {
            n.subtest[idSubtest].soal.push({...templateSoal,no : n.subtest[idSubtest].soal.length+1});
            return n;
        })
    }

    function delSoal(idSubtest) {
        dataTO.update(n => {
            n.subtest[idSubtest].soal.pop();
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

    function saveTO() {
        loading = true;
        let saveData = $dataTO;
        saveData.name = name;
        fetch(`/tryout/save`,{
        method: 'POST',
        body: JSON.stringify(saveData)
        })
        .then(()=>{
            $goto('../../dashboard');
        })
        .catch(e=>console.log(e.message))
    }
</script>

{#if loading}
<div class="modal is-active">
  <div class="modal-background"></div>
  <div class="modal-content">
    <p class="has-text-white">menyimpan data tryout...</p>
  </div>
</div>
{/if}

{#await loadFullData}
loading boss...
{:then data}
<div class="card" style="position: sticky; top: 0; z-index: 1;">
    <div class="columns is-vcentered card-content">
        <div class="column"><input class="input is-large" type="text" placeholder="Judul Tryout" bind:value={name}></div>
        <button class="button is-info is-outlined is-large column is-2" on:click={saveTO}>save</button>
    </div>
</div>
<div class="container" style="margin-top: 40px">
{#each $dataTO.subtest as sub,i}
    <div class="card">
        <header class="card-header">
            <p class="card-header-title" style="flex-grow: 0;">
            {sub.judul} - </p><input style="width: 60px;" type=number bind:value={sub.time_in_minute} min=1><p class="card-header-title">minutes</p>
            <p on:click={()=>delSubtest(i)} class="card-header-icon" aria-label="delete">
            <span class="icon">
                <i class="fas fa-trash has-text-danger" aria-hidden="true"></i>
            </span>
            </p>
        </header>
        <div class="card-content">
            <div class="buttons">
                {#each sub.soal as soal_value,j}
                    <button on:click={(event) => {
                        $goto('../soal',{subtest:i,soal:j});
                    }} class="button is-link is-light">{soal_value.no}</button>
                {:else}
                    <p>Belum ada soal &ensp;</p>
                {/each}
                <button on:click={() => addSoal(i)} class="button is-primary is-outlined"><span class="icon"><i class="fas fa-plus" aria-hidden="true"></i></span></button>
                <button on:click={() => delSoal(i)} class="button is-danger is-outlined"><span class="icon"><i class="fas fa-trash" aria-hidden="true"></i></span></button>
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
{:catch error}
<p style="color: red">{error.message}</p>
{/await}