<script>
</script>

<svelte:head>
  <link rel="stylesheet" href="./title-styles.css">
</svelte:head>

<style>
  .title-feature {
    font-weight: 600;
    color: var(--blue-color);
  }

  .subtitle {
    font-weight: 600;
    margin-bottom: 50px;
    font-size: 16px;
  }

  .fasiliteron{
    background-color: #FFEDD9;
    padding: 60px;
    padding-top: 10em;
  }

  .fasiliteron-image .column:nth-child(1){
    margin-top: 100px;
  }

  /* mobile */
  @media only screen and (max-width: 768px) {

    .subtitle {
      font-size: 14px;
      text-align: left;
    }
    
  }
</style>

<div class="fasiliteron">
  <div class="columns">
    <div class="column is-two-fifths">   
      <h3 id="fasiliteron-title" class="title title-feature is-size-4-mobile is-size-3-tablet is-size-3-desktop">Fasiliteron</h3>
      <p class="subtitle has-text-left">
        Fasilitator Pateron, para tutor yang akan siap membantu
      </p>
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