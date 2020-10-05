<script>
  import { fly } from "svelte/transition";
  import { cubicInOut } from "svelte/easing";

  let visible = true;
  const testimonials = [
    [
      "Berkat bimbel online Pateron yang sangat membantu dalam menghadapi soal-soal UTBK yang sangat rumit menjadi mudah sehingga saya menjadi lebih siap dalam menghadapi UTBK kemaren, untuk adik adik semangat belajar dan berdoa untuk mengejar cita cita setinggi langit. jangan lupa juga gunakan bimbel online Pateron untuk membantu adik adik menjadi lebih siap lagi, tetap semangat !",
      "https://pateron.id/assets/testimonial_1.jpeg",
      "Hasan Nasrulloh"
    ],
    [
      "Belajar di program SAS Pateron itu seru banget sih fix, tentor nya asik asik, bener bener diajarin sampe paham deh pokoknya dan tentunya mantep banget deh belajar di Pateron ini!!!, fix kalian wajib banget sih buat join program SAS Pateron 2021.",
      "https://pateron.id/assets/testimonial_2.jpeg",
      "Rahma Fadila P."
    ],
    [
      "Seneng banget bisa belajar di Pateron bener-bener belajar dari 0 sampe akhirnya bisa nyampe target nilai di TryOut. Temen-temen dan mentornya pun asik semua, bisa diajak diskusi. Cara belajarnya juga sesuai sama cara belajar aku sendiri. Sampe H-3 UTBK juga aku masih ikut Pateron buat ngelatih kemampuan kuantitatif aku, karna jujur ngerasa kurang bgt disitu, dan ternyata tadi skor kuantitatif aku malah jadi paling tinggi dibanding sub tes lainnya. Jadi jujur ngerasa kebantu banget dengan adanya Pateron.",
      "https://pateron.id/assets/testimonial_3.jpeg",
      "Shakeela Wulandari S."
    ],
    [
      "Belajar di Peteron itu seru! Tutornya baik dan ramah, jadi aku bisa ngerti materinya. Ini ngebantu banget persiapan UTBK terutama dimasa pandemi ini. Kelasnya kondusif dan MATERINYA LENGKAP! Pokoknya worth it banget lah!",
      "https://pateron.id/assets/testimonial_5.jpeg",
      "Mia R. Suciana"
    ],
    [
      "Soal-soal HOTS dari modul yang diberikan membutuhkan pemikiran ayng lebih, sehingga mengasah cara berpikir saya untuk menyelesaikan soal-soal UTBK. Selain itu, ditengah COVID-19 ini, modul yang diberikan sanget berguna untuk mengisi waktu dengan belajar!",
      "https://pateron.id/assets/testimonial_7.jpeg",
      "Timothy Brian"
    ]
  ];

  let peoples = [];
  testimonials.forEach(data => {
    let peopleData = [data[1], data[2]];
    peoples.push(peopleData);
  });

  let current = 2;
  $: {
    if (current < 0) {
      current = testimonials.length - 1;
    } else if (current === testimonials.length) {
      current = 0;
    }
  }

  function next() {
    current += 1;
    peoples[peoples.length] = peoples[0];
    peoples.shift();
    visible = false;
    setTimeout(() => {
      visible = true;
    }, 300);
  }

  function prev() {
    current -= 1;
    peoples.splice(0, 0, peoples[peoples.length - 1]);
    peoples.pop();
    peoples = peoples;
    visible = !false;
  }
</script>

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

  .testimoni {
    padding: 20px;
  }

  .comment {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    position: relative;
  }

  .comment .bubble-text {
    position: relative;
    width: 600px;
    padding: 50px;
    border: 8px solid skyblue;
    background-color: #fafafa;
    border-radius: 20px;
  }

  .comment .bubble-text::before {
    content: "";
    width: 0px;
    height: 0px;
    position: absolute;
    border-left: 25px solid transparent;
    border-right: 25px solid transparent;
    border-top: 30px solid #fafafa;
    left: 50%;
    transform: translateX(-50%);
    bottom: -18px;
    z-index: 5;
  }

  .comment .bubble-text::after {
    content: "";
    width: 0px;
    height: 0px;
    position: absolute;
    border-left: 25px solid transparent;
    border-right: 25px solid transparent;
    border-top: 30px solid skyblue;
    left: 50%;
    transform: translateX(-50%);
    bottom: -30px;
  }

  .user-testimonial {
    padding: 20px;
    padding-top: 30px;
    margin-top: -50px;
  }

  .user-testimonial .user-image {
    padding: 5px;
    margin-top: 40px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .user-testimonial .user-image img {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    background-color: skyblue;
    object-fit: cover;
  }

  .user-testimonial .user-image p {
    font-weight: bold;
    font-size: 14px;
  }

  .btn-controller {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    position: absolute;
    width: 100%;
    z-index: 10;
    left: 0;
  }

  button {
    background-color: transparent;
    border: none;
  }

  #left-arrow,
  #right-arrow {
    width: 40px;
    transition: 0.8s;
  }

  #left-arrow:active,
  #right-arrow:active {
    transform: scale(1.3);
  }

  /* tablet */
  @media only screen and (max-width: 1023px) {
    .comment .bubble-text {
      width: 500px;
    }
  }

  /* mobile */
  @media only screen and (max-width: 768px) {
    .subtitle {
      font-size: 14px;
      text-align: left;
    }

    .comment .bubble-text {
      font-size: 12px;
      width: 300px;
      padding: 10px;
      border: 4px solid skyblue;
      margin-bottom: 20px;
    }

    .user-image {
      margin-top: 50px;
      padding: 0;
      background-color: red width;
    }

    .user-testimonial .user-image p {
      font-weight: normal;
      font-size: 14px;
    }

    .btn-controller {
      top: 70px;
    }
  }

  @media only screen and (max-width: 500px) {
    .user-testimonial .user-image p {
      font-size: 8px;
    }
  }
</style>

<div class="testimoni">
  <h3
    class="title has-text-centered title-feature is-size-4-mobile
    is-size-3-tablet is-size-3-desktop mt-6">
    Testimoni
  </h3>
  <p class="subtitle has-text-centered">Apa kata mereka tentang Pateron</p>
  <div class="comment">
    {#if visible}
      <div
        transition:fly={{ delay: 200, y: 100, duration: 300, easing: cubicInOut }}
        class="bubble-text">
        <p class="has-text-centered">{testimonials[current][0]}</p>
      </div>
    {/if}
    <div class="user-testimonial is-gapless columns is-mobile">
      {#each peoples as [image, name]}
        <div class="column">
          <div class="user-image">
            <div>
              <img src={image} width="30px" alt={name} />
            </div>
            <p>{name}</p>
          </div>
        </div>
      {/each}
    </div>
    <div class="btn-controller">
      <button on:click={prev}>
        <img id="left-arrow" src="./assets/left-arrow.png" alt="left-arrow" />
      </button>
      <button on:click={next}>
        <img
          id="right-arrow"
          src="./assets/right-arrow.png"
          alt="right-arrow" />
      </button>
    </div>
  </div>
</div>
