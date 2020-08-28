<script>
    export let idtryout = null;
    let nilaiReq = fetch(`/siswa/mytryout/${idtryout}`).then(res=>res.json())
    .then(res=>{
        let total = 0;
        res.forEach(nilai => {
            total += nilai.score;
        });
        return {total: total, nilai: res};
    });
</script>

<style>
  .tabel-nilai{
    padding: 20px;
  }
</style>

{#await nilaiReq}
<div class="select is-loading"></div>
{:then data}
<div class="container tabel-nilai">
  <h3 class="title is-3">Hasil Tryout</h3>
  <table class="table is-bordered is-narrow is-hoverable is-fullwidth">
    <thead>
      <tr class="has-text-centered">
        <th>Nama Subtest</th>
        <th class="is-primary">Benar</th>
        <th class="is-danger">Salah</th>
        <th>Total Soal</th>
        <th>Jumlah Poin</th>
      </tr>
    </thead>
    <tbody>
      {#each data.nilai as nilai}
      <tr>
        <td>{nilai.judul}</td>
        <td align="center">{nilai.benar}</td>
        <td align="center">{nilai.salah}</td>
        <td align="center">{nilai.jumlahSoal}</td>
        <td>{nilai.score}</td>
      </tr>
      {:else}
      <p>Tidak ada penilaian</p>
      {/each}
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4">Jumlah</td>
        <td>{data.total}</td>
      </tr>
    </tfoot>
  </table>
</div>
{:catch error}
<p style="color: red">{error.message}</p>
{/await}