<script>
</script>

<style>
  a:hover{
    color: #fff;
  }

  button a{
    color: #fff;
  }
  .faq-content{
    padding: 50px;
  }

  .ads-space{
    background-color: grey;
    height: 150px;
  }

  .ads-space p{
    line-height: 150px;
  }

  .faq-text{
    margin-top: -100px;
  }

  .btn-faq{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .btn-pertanyaan-lanjut {
    margin-top: 50px;
    width: 300px; 
  }

  .btn-pertanyaan-lanjut a{
    color: var(--blue-color);
  }

  .btn-pertanyaan-lanjut:hover{
    color: #fff;
    background-color: var(--blue-color);
  }

  .btn-pertanyaan-lanjut:hover a{
    color: #fff;
  }

  .btn-daftar-segera{
    margin-top: 20px;
    width: 300px;
    background-color: var(--blue-color);
    color: #fff;
  }

  /* tablet */
  @media only screen and (max-width:1023px){
   
    .faq-text{
      margin-top: 0;
    }

  }
</style>

<div class="faq-content">
  <div class="columns is-variable is-8-desktop">
    <div class="column">
      <div class="ads-space">
        <p class="has-text-centered">
          ADS SPACE
        </p>
      </div>
    </div>
    <div class="column">
      <div class="simple-faq">
        <p class="has-text-centered faq-text">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum aliquid, at nulla error, fugit atque nam totam facere placeat hic ab. Soluta ipsam vitae alias dolor nisi qui consequatur labore?
        </p>
        <div class="btn-faq">
          <button class="button btn-pertanyaan-lanjut is-info is-rounded is-outlined">
            <a href="#">Pertanyaan Lebih Lanjut</a>
          </button>
          <button class="button btn-daftar-segera is-info is-rounded">
            <a href="#">Daftar Segera</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>