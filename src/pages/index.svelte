<script>
  import Testimoni from "../components/landing-page/Testimoni.svelte"
</script>
<style>
  p{
    font-family: 'Lato', sans-serif;
  }

  a:hover{
    color: #fff;
  }

  button a{
    color: #fff;
  }

  .header-content{
    background-color: grey;
    margin-top: 80px;
    height: 100vh;
  }

  .program-content{
    background-image: url('/assets/bubble_blue.svg');
    padding: 100px 60px;
    margin-top:-60px;
    background-repeat: no-repeat;
    margin-bottom: 100px;
  }

  .pateron-program p{
    margin-top: 20px;
  }

  .btn-pelajari{
    margin-top: 40px;
    background-color: var(--blue-color);
  }

  .title-feature{
    font-family: 'Bebas Neue', cursive;
    font-style: normal;
    font-weight: normal;
    letter-spacing: 0.4em;
    color:var(--blue-color);
  }

  .feature-pateron{
    padding: 20px;
    margin-bottom: 100px;
  }

  .feature-item{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
  }

  .feature-item img{
    width: 100%;
  }

  .user-feature{
    padding: 20px;
    padding-bottom: 100px;
    border-bottom: 2px solid #013183;
  }

  .user-feature img {
    width: 100%;
    height:100%;
  }

  .user-feature-item{
    display: flex;
    flex-direction: column;
    justify-content: space-around;
  }

  .daftar{
    display:flex;
    align-items:center;
    justify-content: center;
  }

  .daftar a{
    margin-top: 100px;
    position: absolute;
  }

  .daftar button{
    width: 150px;
    background-color: var(--blue-color);
  }

  .fasiliteron{
    background-color: #FFEDD9;
    padding: 50px;
    padding-top: 10em;
  }


  .fasiliteron-image .column:nth-child(1){
    margin-top: 100px;
  }

  /* Testimoni */
  .testimoni{
    padding: 20px;
  }

  /* Faq Content */
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
    .program-content{
      background-image: none;
      background-color: #EBF2FA;
    }

    .title-feature{
      letter-spacing: 0.2em;
    }
   
    .faq-text{
      margin-top: 0;
    }

  }

  /* mobile */
  @media only screen and (max-width: 768px) {
    .program-content {
      margin-bottom: 50px;
    }

    .title-feature{
      letter-spacing: 0.1rem;
    }
  }

</style>

<div class="header-content">
  asdas
</div>
<div class="program-content">
  <div class="columns is-variable is-8">
    <div class="column is-half">
      <div class="ilustration-program">
        <img src="./assets/ilustration.svg" alt="">
      </div>
    </div>
    <div class="column">
      <div class="pateron-program ">
        <h3 class="title title-feature is-size-3-mobile is-size-3-tablet is-size-2-desktop">PATERON PROGRAM</h3>
        <p class="is-size-6-mobile">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque quo sit quae cupiditate tenetur corporis. Veniam temporibus quod quos odio, illum, commodi sapiente, impedit error ipsum dolor obcaecati doloremque iusto!
        </p>
        <p class="is-size-6-mobile">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque quo sit quae cupiditate tenetur corporis. Veniam temporibus quod quos odio, illum, commodi sapiente, impedit error ipsum dolor obcaecati doloremque iusto!
        </p>
        <button class="button is-info is-rounded btn-pelajari">Pelajari Lebih Lanjut</button>
      </div>
    </div>
  </div>
</div>
<div class="feature-pateron">
  <h3 class="title has-text-centered title-feature is-size-3-mobile is-size-3-tablet is-size-2-desktop">FITUR PATERON</h3>
  <div class="columns is-desktop">
    <div class="column">
      <div class="feature-item">
        <img src="./assets/feature.png" alt="feature">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime quo omnis culpa nisi! Tempore officia ipsum magnam sunt possimus. Voluptas rerum maxime qui possimus labore magnam. Earum veritatis in dolores.</p>
      </div>
    </div>
    <div class="column">
      <div class="feature-item">
        <img src="./assets/feature.png" alt="feature">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime quo omnis culpa nisi! Tempore officia ipsum magnam sunt possimus. Voluptas rerum maxime qui possimus labore magnam. Earum veritatis in dolores.</p>
      </div>
    </div>
    <div class="column">
      <div class="feature-item">
        <img src="./assets/feature.png" alt="feature">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime quo omnis culpa nisi! Tempore officia ipsum magnam sunt possimus. Voluptas rerum maxime qui possimus labore magnam. Earum veritatis in dolores.</p>
      </div>
    </div>
    <div class="column">
      <div class="feature-item">
        <img src="./assets/feature.png" alt="feature">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime quo omnis culpa nisi! Tempore officia ipsum magnam sunt possimus. Voluptas rerum maxime qui possimus labore magnam. Earum veritatis in dolores.</p>
      </div>
    </div>
  </div>
</div>
<div class="user-feature">
  <h3 class="title has-text-centered title-feature is-size-3-mobile is-size-3-tablet is-size-2-desktop">YANG KAMU DAPATKAN</h3>
  <div class="columns is-desktop">
    <div class="column user-feature-item">
      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque nisi accusamus exercitationem laborum distinctio!
      </p>
      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque nisi accusamus exercitationem laborum distinctio!
      </p>
      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque nisi accusamus exercitationem laborum distinctio!
      </p>    
    </div>
    <div class="column user-feature-item">
      <img src="./assets/feature.png" alt="user-feature">
    </div>
    <div class="column user-feature-item">
      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque nisi accusamus exercitationem laborum distinctio!
      </p>
      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque nisi accusamus exercitationem laborum distinctio!
      </p>
      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque nisi accusamus exercitationem laborum distinctio!
      </p>
    </div>
  </div>
  <div class="daftar">
    <a href="#" class="btn-daftar">
      <button class="button is-info is-rounded ">Daftar</button>
    </a>
  </div>
</div>
<div class="fasiliteron">
  <div class="columns">
    <div class="column is-two-fifths">   
      <h3 id="fasiliteron-title" class="title title-feature is-size-3-mobile is-size-3-tablet is-size-2-desktop">FASILITERON</h3>
      <p class="mt-6">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel nemo dolorum atque repellendus laboriosam quaerat tempora fuga suscipit doloribus nesciunt, iure quas! Aperiam, assumenda enim quaerat asperiores quibusdam error veritatis!
      </p>
      <p class="mt-5">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime provident deleniti repellendus earum fugit ipsam porro iusto cumque delectus, asperiores, nobis quia? Illo reiciendis nemo quas, deserunt repellendus sed odio!
      </p>
    </div>
    <div class="column">
      <div class="columns fasiliteron-image">
        <div class="column">
          <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="image">
        </div>
        <div class="column">
          <img src="https://images.unsplash.com/photo-1516756587022-7891ad56a8cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="image">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="testimoni">
  <h3 class="title has-text-centered title-feature is-size-3-mobile is-size-3-tablet is-size-2-desktop mt-6">TESTIMONI</h3>
  <Testimoni/>
</div>
<img src="./assets/line_blue.svg" alt="">
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