<script>

</script>

<style>
  a:hover {
    color: #fff;
  }

  button a {
    color: #fff;
  }
  .faq-content {
    padding: 50px;
  }

  .btn-faq {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    margin-top: 40px;
  }

  .column img {
    margin-top: -100px;
  }

  .btn-pertanyaan-lanjut a {
    color: var(--blue-color);
  }

  .btn-pertanyaan-lanjut:hover {
    color: #fff;
    background-color: var(--blue-color);
  }

  .btn-pertanyaan-lanjut:hover a {
    color: #fff;
  }

  .btn-daftar-segera {
    background-color: var(--blue-color);
    color: #fff;
  }

  /* tablet */
  @media only screen and (max-width: 1023px) {
    .faq-text {
      margin-top: 0;
    }
  }

  /* mobile */
  @media only screen and (max-width: 768px) {
    .btn-faq {
      flex-direction: column;
      width: 100%;
    }

    .btn-faq button {
      width: 100%;
    }

    .btn-faq button:first-child {
      margin-bottom: 20px;
    }

    .column img {
      margin-top: 10px;
    }
  }
</style>

<div class="faq-content">
  <div class="columns is-variable">
    <div class="column is-4 is-offset-2">
      <div class="simple-faq">
        <p class="has-text-centered faq-text">
          Pateron Indonesia solusi untuk mu yang ingin belajar dengan efektif,
          efisien dan terjadwal bersama dengan fasilitator terpilih dan terbaik
        </p>
        <div class="btn-faq">
          <button
            class="button btn-pertanyaan-lanjut is-info is-rounded is-outlined">
            <a href="/">Pertanyaan Lebih Lanjut</a>
          </button>
          <button class="button btn-daftar-segera is-info is-rounded">
            <a href="/">Daftar Segera</a>
          </button>
        </div>
      </div>
    </div>
    <div class="column is-4">
      <img src="./assets/cowo1.png" alt="cowo1" height="300px" />
    </div>
  </div>
</div>
