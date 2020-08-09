<script>
    import BuktiBeli from '../../../../components/BuktiBeli.svelte';
</script>

<div class="container">
    <div class="card">
        <div class="card-content">
            <p class="title">Tryout Saintek Agustus 2020</p>
            <p class="subtitle has-text-danger">20.000</p>
            <p class="content">Tryout mantap murah hemat dan berkualitas yang dibuat pateron dengan sepenuh hati bagaikan anak sendiri.</p>
            <div class="message">
                <div class="message-body">
                    <div class="columns">
                        <div class="column">
                            <strong>Selesaikan pembayarann</strong>
                            <p>Lakukan hal berikut</p>
                            <p>Follow instagram bla bla</p>
                            <p>blabla</p>
                            <p>upload screenshoot bukti dibawah ini</p>
                        </div>
                        <div class="column is-2 justdesktop" style="text-align: right;"><button class="button is-primary">Kirim Bukti</button></div>
                    </div>
                    <BuktiBeli/>
                    <div class="justmobile" style="text-align: right;"><button class="button is-primary">Kirim Bukti</button></div>
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