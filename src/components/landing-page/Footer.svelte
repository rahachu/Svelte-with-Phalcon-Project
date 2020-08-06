<style> 
  footer{
    margin-top: 30px;
    position: relative;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #FFDBB9;
  }

  footer h5{
    text-align: center;
    padding: 20px;
    background-color: #FD7D00;
    color: #fff;
  }

  .footer-section{
    display: grid;
    align-items: flex-start;
    text-align: left;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    padding: 40px;
  }

  .footer-section div*{
    padding: 20px;
  }

  .footer-section div ul > li > a{
    color: #000;
  }

  .footer-section div ul > li > a:hover{
    opacity: .7;
  }

  .footer-section div* > h6{
    text-align: center;
  }

  /* social media */
  .social-media{
    padding-left: 0px;
  }

  .social-media a img{
    width: 40px;
    margin-left: -30px;
  }

    /* mobile */
  @media only screen and (max-width: 768px) {
    .footer-section div* > h6{
      text-align: left;
    }
  }
</style>


<footer>
  <div class="footer-section">
    <div class="pateron">
      <img src="./assets/logo-2.png" alt="logo-2" height="40px">
      <p class="has-text-left">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident doloremque dolore obcaecati dignissimos reprehenderit, assumenda repellat molestiae fugit quas at. Quod nobis consectetur vitae sed. At suscipit enim maxime a.
      </p>
      <div class="columns is-mobile social-media">
        <div class="column">
          <a href="#">
            <img src="./assets/line.png" alt="line-logo">
          </a>
        </div>
        <div class="column">
          <a href="#">
            <img src="./assets/instagram.png" alt="instagram-logo">
          </a>
        </div>
        <div class="column">
          <a href="#">
            <img src="./assets/telephone.png" alt="telephone-logo">
          </a>
        </div>
      </div>
    </div>
    <div class="about mt-4">
      <h6 class="title is-4">About</h6>
      <ul>
        <li><a href="#">About Pateron</li>
        <li><a href="#">Carer</li>
      </ul>
    </div>
    <div class="konten mt-4">
      <h6 class="title is-4">Konten</h6>
      <ul>
        <li><a href="#">Program</li>
        <li><a href="#">Fitur</li>
        <li><a href="#">Manfaat</li>
      </ul>
    </div>
    <div class="cs mt-4">
      <h6 class="title is-4">Customer Service</h6>
      <ul>
        <li><a href="#">FAQ</li>
        <li><a href="#">Customer Service</li>
      </ul>
    </div>
  </div>
  <h5>
    Copyright 2020
  </h5>
</footer>