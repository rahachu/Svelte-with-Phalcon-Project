<script>
  import {onMount} from 'svelte' 
  import Cookies from 'js-cookie'
  import TryoutTime from '../../components/tryout/TryoutTime.svelte'
  import { soalStore } from "../../store/tryout/soalStore.js"
  import { jawabanStore } from "../../store/tryout/jawabanStore.js"

  //  data tryout soal dan jawaban
  let dataSoal = [];
  let dataJawaban = [];
  let tandaiSoal = []
  let title = ''
  let listNumber = []

  // soal state
  let soalNo = localStorage.getItem('no_soal') || 1;
  $:currentSoal = soalNo - 1;

  // active state
  let totalSoal = '';
  let activeSoal = false;
  let activeAnswered = false;
  let activeTandaiSoal = false;

  $:activateOption ="";
  onMount(()=> {
    getOptionValue()
    getOptionAnswered()
    getMarkedQuestion(soalNo)
    soalStore.getListNumber();
  })


  // get data soal dari soal store
  soalStore.dataSoal.subscribe(val => {
    dataSoal  = val.subtest.soal;
    title     = val.subtest.judul;
    totalSoal = val.subtest.soal.length
  });  
  
  // get data jawaban dari jawaban store
  jawabanStore.subscribe(val => dataJawaban = val)
  
  // get data tandai soal dari soal store
  soalStore.markQuestion.subscribe(val => tandaiSoal = val);

  soalStore.listNumber.subscribe(val => listNumber = val)

  // disable tombol sebelumnya
  // disable tombol selanjutnya
  // disable tombol submit
  let disabledButtonPrev = false;
  let disabledButtonNext = false;
  let activateSubmitButton = false;
  if(soalNo == 1){
    disabledButtonPrev = true;
  }

  // handle navigation soal
  function handleSoalClick(e){
    soalNo = e.toElement.title
    getOptionValue()
    localStorage.setItem('no_soal', soalNo);
    activateSubmitButton = false;
    if(soalNo == totalSoal){
      activateSubmitButton = true
    }
    if(soalNo == 1){
      disabledButtonPrev = true;
    }else{
      disabledButtonPrev = false;
    }

    getMarkedQuestion(soalNo)
  }

  if(soalNo == totalSoal){
    activateSubmitButton = true
  }

  // handle option
  function handlePilihOption(option){
    const data = {
      soal_no:soalNo,
      option
    }
    jawabanStore.createJawaban(data)
    listNumber.filter((number, i) => {
      if(number.no == data.soal_no){
        listNumber[i].terjawab = true;
      }
    })
    activateOption  = data
  }

  //  get value option untuk navigasi soal
  function getOptionValue(){
    // Pull Option from Jawaban store or Cookies
    let getOption = dataJawaban;
    getOption.filter((data) => {
      if(data.soal_no == soalNo){
        activateOption = data;
      }
    })
  }

  //  get value option untuk tombol sebelumnya dan tombol selanjutnya
  function getOptionValueButton(){
    let getOptionData = dataJawaban;
    let dataNomor = getOptionData.filter((data) => {
      if(data.soal_no == currentSoal+1){
        return activateOption = data
      }else{
        return false
      }
    })
    if(dataNomor.length === 0){
      activateOption = ''
    }else{
      activateOption = dataNomor[0]
    }
    soalNo = currentSoal+1
  }

  // get value tandai soal
  function getMarkedQuestion(no){
    listNumber.filter((number) => {
      return number.no == no;
    }).forEach(e => {
      if(e.tandai_soal){
        activeTandaiSoal = true
      }else{
        activeTandaiSoal = false
      }
    });
  }

  // get soal terjawab
  function getOptionAnswered(){
  }

  // get soal ditandai

  // handle button tombol sebelumnya
  function handlePrev(){
    currentSoal-=1;
    activateSubmitButton = false
    disabledButtonPrev = false;
    if(currentSoal === 0){
      disabledButtonPrev = true;
    }
    getOptionValueButton()
    getMarkedQuestion(soalNo)
    localStorage.setItem('no_soal', soalNo);
  }

  // handle button tombol selanjutnya
  function handleNext(){
    currentSoal+=1;
    disabledButtonPrev = false;
    if(currentSoal == totalSoal-1){
      activateSubmitButton = true
    }
    getOptionValueButton()
    getMarkedQuestion(soalNo)
    localStorage.setItem('no_soal', soalNo);
  }

  // tandai soal
  function handleTandaiSoal(){
    const data = {
      soal_no:parseInt(soalNo)
    }

    if(activeTandaiSoal){
      soalStore.hapusTandaiSoal(data)
    }else{
      soalStore.tandaiSoal(data);
    }
    listNumber.filter((number, i) => {
      if(number.no == data.soal_no){
        listNumber[i].tandai_soal = !number.tandai_soal
      }
    })
  }

  function hapusJawaban(){
    jawabanStore.hapusJawaban(soalNo)
    jawabanStore.subscribe(val => dataJawaban = val)
    activateOption = dataJawaban;
    listNumber.filter((number, i) => {
      if(number.no == soalNo){
        number.terjawab = false
      }
    })
    listNumber = listNumber
  }

  // submit tombol tryout
  function submitTryOut(){
    console.log("SUBMITED")
  }

</script>
<style>

  .tryout-navigation{
    display:flex;
    flex-direction: column;
    justify-content: flex-start;
    padding: 20px;
    background-color: #fff;
    height: 100%;
    box-shadow: 0 1px 5px 1px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
  }

  .tryout-navigation .title{
    color: #fff;
    width: 100%;
    height: 20%;
    padding: 10px 0;
    background-color: var(--blue-color);
  }

  .tryout-navigation .list-number{
    text-align: center;
    display: grid;
    grid-column-gap: 5px;
    grid-template-columns: repeat(auto-fit, minmax(50px, 1fr));
  }

  .items-number{
    position: relative;
    line-height: 60px;
    height: 60px;
    border-radius: 10px;
    background-color: #f7f7f7;
    margin-top: 5px;
    border: 1px solid var(--blue-color);
  }

  .items-number:hover{
    background-color: var(--blue-color);
    color: #fff;
    cursor: pointer;
  }

  .active-answered{
    background-color: orange;
    color: #fff;
  }

  .active-tandai{
    color: #000;
  }

  .active-tandai::after{
    content:'';
    position: absolute;
    right:0;
    top:-1px;
    width:30px;
    height:30px;
    border-top-right-radius: 10px;
    background-color: red;
    /* background-image: url("/assets/flag.svg"); */
    /* background-repeat:no-repeat; */
    clip-path: polygon(0 0, 100% 100%, 100% 0);
  }

  .active-soal{
    background-color: var(--blue-color);
    color: #fff;
    z-index: 10;
  }

  .left-bar, .right-bar{
    background-color: #f8f8f8;
  }

  .tryout-content{
    padding-top: 20px;
  }

  .soal-data{
    background-color: #fff;
    height: 100%;
    box-shadow: 0 1px 5px 1px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
  }

  .action-soal {
    display:flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 20px;
    background-color: var(--blue-color);
  }

  .action-soal .time{
    background-color: orange;
    padding: 10px;
    color: #fff;
    box-sizing: border-box;
    border-radius: 5px;
  }

  .soal{
    padding: 30px;
    display: flex;
    flex-direction: column;
  }

  .no-soal hr{
    margin-top: -15px;
  }

  .soal .soal-text{
    padding: 20px;
    border-radius: 10px;
    padding-top:10px;
    background-color: #f7f7f7;
    width: 100%;
  }

  .jawaban{
    padding: 40px;
    padding-top: 20px;
  }

  .jawaban-items{
    display: flex;
    flex-direction:row;
    margin: 20px 0;
    justify-content: space-between;
    position: relative;
    margin-top: 30px;
  }

  .jawaban-items input{
    width: 20px;
    height: 20px;
  }

  .jawaban-items label {
    font-size: 18px;
  }

  .jawaban-items .option{
    width: 25px;
    height: 25px;
    color: transparent;
    line-height: 25px;
    margin-right: 20px;
    border-radius: 50%;
    text-align:center;
    border: 1px solid #000;
    color: #000;
    font-size: 15px;
    position: absolute;
    z-index: 10;
  }

  .jawaban-items .option-value{
    margin-left: 40px;
  }

  .jawaban-items .option:hover{
    background-color: var(--blue-color);
    color: #fff;
    cursor: pointer;
    border: 1px solid #fff;
  }

  .option-active{
    background-color: var(--blue-color);
    color: #fff;
    border: 1px solid #fff;
  }

  .button-navigation-soal{
    display: flex;
    justify-content: space-between;
    padding: 30px;
  }
</style>
<div>
  <div class="columns">
    <div class="column left-bar is-one-quarter">
      <div class="tryout-navigation">
        <div class="title">
          <h3 class="title has-text-centered is-3">
            TRYOUT
            <p class="title is-5">{title}</p>
          </h3>
        </div>
        <div class="list-number">
        <!-- daftar soal -->
          {#each listNumber as {no, tandai_soal, terjawab}, i}
            <div title={no} 
              on:click={handleSoalClick} 
              class:active-soal={i === currentSoal} 
              class:active-answered={terjawab}
              class:active-tandai={tandai_soal}
              class="items-number">
              {no}
            </div>
          {/each}
        </div>
      </div>
    </div>
    <div class="column right-bar">
      <div class="tryout-content">
        <div class="soal-data">
          <div class="action-soal">
            <div class="time">
              <TryoutTime/>
            </div>
            <div></div>
          </div>
          <div class="soal">
            <div class="no-soal">
              <h3 class="subtitle is-5">Soal Ke <b>{dataSoal[currentSoal].no}/{totalSoal}</b></h3><hr>
            </div>
            <div class="soal-text">
              {@html dataSoal[currentSoal].question}
            </div>
          </div>
          <div class="jawaban">
            <div class="jawaban-items">
              <div class:option-active={soalNo == activateOption.soal_no && activateOption.option == "A"} class="option" on:click={() => handlePilihOption('A')}>A</div>
              <div class="option-value">
                {@html dataSoal[currentSoal].option_a}
              </div>
            </div>
            <div class="jawaban-items">
              <div class:option-active={soalNo == activateOption.soal_no && activateOption.option == "B"} class="option" on:click={() => handlePilihOption('B')}>B</div>
              <div class="option-value">
                {@html dataSoal[currentSoal].option_b}
              </div>
            </div>
            <div class="jawaban-items">
              <div class:option-active={soalNo == activateOption.soal_no && activateOption.option == "C"} class="option" on:click={() => handlePilihOption('C')}>C</div>
              <div class="option-value">
                {@html dataSoal[currentSoal].option_c}
              </div>
            </div>
            <div class="jawaban-items">
              <div class:option-active={soalNo == activateOption.soal_no && activateOption.option == "D"} class="option" on:click={() => handlePilihOption('D')}>D</div>
              <div class="option-value">
                {@html dataSoal[currentSoal].option_d}
              </div>
            </div>
            <div class="jawaban-items">
              <div class:option-active={soalNo == activateOption.soal_no && activateOption.option == "E"} class="option" on:click={() => handlePilihOption('E')}>E</div>
              <div class="option-value">
                {@html dataSoal[currentSoal].option_e}
              </div>
            </div>
            <div class="jawaban-items">
              <label class="checkbox">
                <input type="checkbox" on:change={handleTandaiSoal} bind:checked={activeTandaiSoal}>
                  Tandai Soal
              </label>
              <button on:click={hapusJawaban} class="is-danger button">Hapus Pilihan</button>
            </div>
          </div>
          <div class="button-navigation-soal">
            <button disabled={disabledButtonPrev} on:click={handlePrev} class="button is-link is-outlined">
              <span>Sebelumnya</span>
            </button>
            {#if activateSubmitButton}
              <button on:click={submitTryOut} class="button is-primary">Submit</button>
            {:else}
              <button disabled={disabledButtonNext} on:click={handleNext} class="button is-link is-outlined">
                <span>Selanjutnya</span>
              </button>
            {/if}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>