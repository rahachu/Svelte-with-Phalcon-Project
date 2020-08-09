<script>
    export let value = [];
    let nameFile = [];
    let newFile = null;
    let dropzone;
    
    function uploadFile() {
        const reader = new FileReader();
        reader.onload = e=>{
            value = value.concat(e.target.result);
        }
        nameFile.push(newFile.files[0].name);
        reader.readAsDataURL(newFile.files[0]);
        dropzone.style.backgroundColor = 'transparent';
    }

    function delFile(i) {
        value = value.filter((value,index,arr)=>index!==i);
        nameFile = nameFile.filter((value,index,arr)=>index!==i);
        newFile.value='';
    }
</script>

<div bind:this={dropzone} on:dragover={()=>{dropzone.style.backgroundColor = 'beige'}} on:dragleave={()=>{dropzone.style.backgroundColor = 'transparent'}} class="dropzone">
    <input type="file" accept="image/*" name="img_logo" class="dropzone-file" on:change={uploadFile} bind:this={newFile}>
    <div class="dropzone-content">
        <i class="fa fa-upload title is-4"></i>
        <p>Choose an image file or drag it here</p>
    </div>
</div>
<div class="columns is-multiline">
{#each value as image, i}
<div class="card column is-3">
  <header class="card-header">
    <div class="nowraptext">
      {nameFile[i]}
    </div>
    <p>
      <span class="icon" on:click={()=>{delFile(i)}}>
        <i class="fas fa-times has-text-danger" aria-hidden="true"></i>
      </span>
    </p>
  </header>
    <div class="card-image">
        <img class="image-uploaded" src="{image}" alt="">
    </div>
</div>
{/each}
</div>

<style>
.dropzone{
    border: 1px dashed;
    height: 150px;
}

.dropzone-content{
    height: 100%;
    padding: 30px 30px;
    text-align: center;
}

.dropzone-file,
.dropzone-file:focus {
  position: absolute;
  outline: none !important;
  width: 90%;
  height: 150px;
  cursor: pointer;
  opacity: 0;
}

.dropzone:hover{
    opacity: 0.5;
}

.card{
    margin: 10px;
}

.columns{
    margin: 10px;
}

.icon:hover{
    opacity: 0.5;
}

.nowraptext{
    text-overflow: ellipsis!important;
    width: 88%;
    overflow: hidden;
    white-space: nowrap;
}

@media only screen and (min-width: 769px) {
  .card-image{
        max-height: 250px;
        overflow: hidden;
    }
    
    .nowraptext{
        width: 95%;
    }
}
</style>