<script>
	import { fly } from 'svelte/transition';
	import { cubicInOut } from 'svelte/easing';

  let visible = true;
  const testimonials = [
    ['In one of the testimonials which accompanied his application to the trustees of Rugby, the writer stated it as his conviction that "if Mr Arnold were elected, he would change the face of education all through the public schools of England."','https://image.flaticon.com/icons/svg/3203/3203725.svg', 'Diana'],
    ['Horsford, in a number of monographs (unfortunately of no historical or scientific value), fixed upon the vicinity of Boston, where now stand a Leif Ericsson statue and Horsford" Norumbega Tower as testimonials to the Norse explorers.','https://image.flaticon.com/icons/svg/3144/3144735.svg', 'Marcel'],
    ['He received large money testimonials (6000 on his silver-wedding day and £5000 on his fiftieth birthday), which he handed over to these institutions.', 'https://image.flaticon.com/icons/svg/3048/3048122.svg', 'Alex'],
    ['Information on how the monitor works, along with product testimonials and instruction video clip, can be found about the Snuza Halo on the product website at Snuza.', 'https://image.flaticon.com/icons/svg/3048/3048163.svg', 'Angel'],
    ['According to testimonials on the company"s website, a number of people who have suffered from migraines for years have experienced a great deal of success with Micranium.','https://image.flaticon.com/icons/svg/3048/3048176.svg', 'Thomas']
  ]

  let peoples = [];
  testimonials.forEach(data => {
    let peopleData = [
      data[1],data[2]
    ]
    peoples.push(peopleData)
  });

  let current = 2;
  $:{
    if(current < 0){
      current = testimonials.length-1
    }else if(current === testimonials.length){
      current = 0
    }
  }

  function next(){
    current += 1;
    peoples[peoples.length] = peoples[0]
    peoples.shift();
    visible = false;
    setTimeout(() => {
      visible = true
    }, 300);
  }

  function prev(){
    current -= 1;
    peoples.splice(0,0, peoples[peoples.length-1])
    peoples.pop()
    peoples = peoples;
    visible = !false;
  }
</script>

<style>
  .comment{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    position: relative;
  }

  .comment .bubble-text{
    position: relative;
    width: 800px;
    padding: 50px;
    border: 8px solid skyblue;
    background-color: #fafafa;
  }

  .comment .bubble-text::before{
    content: "";
    width: 0px;
    height: 0px;
    position: absolute;
    border-left:25px solid transparent;
    border-right: 25px solid transparent;
    border-top: 30px solid #fafafa;
    left: 50%;
    transform: translateX(-50%);
    bottom: -18px;
    z-index: 5;
  }

  .comment .bubble-text::after{
    content: "";
    width: 0px;
    height: 0px;
    position: absolute;
    border-left:25px solid transparent;
    border-right: 25px solid transparent;
    border-top: 30px solid skyblue;
    left: 50%;
    transform: translateX(-50%);
    bottom: -30px;
  }

  .user-testimonial{
    padding: 50px;
    margin-top: -50px;
  }

  .user-testimonial .user-image{
    padding: 20px;
    margin-top: 20px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .user-testimonial .user-image img{
    border-radius: 50%;
    width: 50px;
    background-color: skyblue;
  }

  .user-testimonial .user-image p{
    font-weight: bold;
    font-size: 16px;
  }

  .btn-controller{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    position: absolute;
    width: 100%;
    z-index: 10;
    left: 0;
  }

  button{
    background-color: transparent;
    border: none;
  }

  #left-arrow, #right-arrow{
    width: 40px;
    transition: .8s;
  }

  #left-arrow:active, #right-arrow:active{
    transform: scale(1.3);
  }

    /* tablet */
  @media only screen and (max-width:1023px){
    .comment .bubble-text{
      width: 500px;
    }
  }

  /* mobile */
  @media only screen and (max-width: 768px) {
    .comment .bubble-text{
      width: 400px;
    }

    .user-image{
      margin-top: 50px;
      padding: 0;
    }

    .user-testimonial .user-image p{
      font-weight: normal;
      font-size: 14px;
    }

    .btn-controller{
      top:70px;
    }
  }

  @media only screen and (max-width: 500px) {
    .user-testimonial .user-image p{
      font-size: 8px;
    }
  }


</style>

<div>
  <div class="comment">
  {#if visible}
    <div transition:fly="{{delay: 200, y:100, duration: 300, easing: cubicInOut }}" class="bubble-text">
      <p class="has-text-centered">
        {testimonials[current][0]}
      </p>
    </div>
  {/if}
    <div class="user-testimonial is-gapless columns is-mobile">
      {#each peoples as [image, name]}
      <div class="column">
        <div class="user-image">
          <div>
            <img src={image} width="30px" alt={name}>
          </div>
          <p>
            {name}
          </p>
        </div>
      </div>
      {/each}
    </div>
    <div class="btn-controller">
      <button on:click={prev}>
        <img id="left-arrow" src="./assets/left-arrow.png" alt="left-arrow">
      </button>
      <button on:click={next}>
        <img id="right-arrow" src="./assets/right-arrow.png" alt="right-arrow">
      </button>
    </div>
  </div>
</div>