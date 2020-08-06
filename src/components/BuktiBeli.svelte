<script>
    export let value = [];
    let nameFile = [];
    let newFile = null;
    
    function uploadFile() {
        const reader = new FileReader();
        reader.onload = e=>{
            value = value.concat(e.target.result);
        }
        nameFile.push(newFile.files[0].name);
        reader.readAsDataURL(newFile.files[0])
    }
</script>

<div class="dropzone">
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
    <p class="card-header-title">
      {nameFile[i]}
    </p>
      <span class="icon">
        <i class="fas fa-times has-text-danger" aria-hidden="true"></i>
      </span>
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
    margin: 10px;
    height: 150px;
}

.dropzone-content{
    height: 100%;
    padding: 30px 0;
    text-align: center;
}

.dropzone-file,
.dropzone-file:focus {
  position: absolute;
  outline: none !important;
  width: 100%;
  height: 150px;
  cursor: pointer;
  opacity: 0;
}

.dropzone:hover,
.dropzone.dragover{
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

@media only screen and (min-width: 769px) {
  .card-image{
        max-height: 250px;
        overflow: hidden;
    }
}
</style>