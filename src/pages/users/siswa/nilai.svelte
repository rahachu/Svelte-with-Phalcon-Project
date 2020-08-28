<script>
    let nilaiReq = fetch(`/siswa/mytryout/1`).then(res=>res.json())
    .then(res=>{
        let total = 0;
        res.forEach(nilai => {
            total += nilai.score;
        });
        return {total: total, nilai: res};
    });
</script>

{#await nilaiReq}
<div class="select is-loading"></div>
{:then data}
<div class="container">
    <p class="title is-4">Tryout Gratis</p>
    <table class="table">
        <thead><tr>
            <th>Subtest</th>
            <th>Nilai</th>
            <th></th>
        </tr></thead>
        <tfoot><tr>
            <th>Total</th>
            <th>{data.total}</th>
            <th></th>
        </tr></tfoot>
        <tbody>
	        {#each data.nilai as nilai}
            <tr>
                <td>{nilai.judul}</td>
                <td>{nilai.score}</td>
            </tr>
            {:else}
            <p>Tidak ada penilaian</p>
            {/each}
        </tbody>
    </table>
</div>
{:catch error}
<p style="color: red">{error.message}</p>
{/await}