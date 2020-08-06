<script>
    let el;
    function showModal(element) {
        element.classList.add('is-active')
    }
    function closeModal(element) {
        element.classList.remove('is-active')
    }
</script>

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
            <tr>
                <td>Rahachu</td>
                <td>Tryout Gratis</td>
                <td>
                    <div class="columns is-multiline">
                        <div class="column is-2" on:click={()=>{showModal(el)}}>
                            <img class="image-button" src="https://gotra.sgp1.cdn.digitaloceanspaces.com/web-upload/1527432374_27-05-2018_photo6077615961109801001.jpg" alt="">
                        </div>
                    </div>
                </td>
                <td>Rahachu</td>
            </tr>
        </tbody>
    </table>
</div>


<div class="modal" bind:this={el}>
    <div class="modal-background" on:click={()=>{closeModal(el)}}></div>
    <div class="modal-content">
        <img src="https://gotra.sgp1.cdn.digitaloceanspaces.com/web-upload/1527432374_27-05-2018_photo6077615961109801001.jpg" alt="">
    </div>
    <button class="modal-close is-large" aria-label="close" on:click={()=>{closeModal(el)}}></button>
</div>

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