<script>
  import CKeditor from '../../../../components/CKeditor.svelte';
</script>

<div class="card" style="position: sticky;top: 0;z-index: 1;">
    <div class="card-content">
    <div class="level">
        <div class="level-left">
            <p class="subtitle">Tryout 27 Juli 2020 - Biologi - No 69</p>
        </div>
        <div class="level-right">
            <button class="button is-info is-outlined">save</button>
        </div>
    </div>
    </div>
</div>
<div class="container" style="margin-top: 20px;">
    <div class="card">
        <div class="card-content">
            <p class="title is-4">Persoalan</p>
            <CKeditor/>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 20px;">
    <div class="card">
        <div class="card-content">
            <p class="title is-4">Pilihan Jawaban</p>
            <div class="content">
                <ol type="A">
                    <li><CKeditor></CKeditor></li>
                    <li><CKeditor></CKeditor></li>
                    <li><CKeditor></CKeditor></li>
                    <li><CKeditor></CKeditor></li>
                    <li><CKeditor></CKeditor></li>
                </ol>
            </div>
        </div>
    </div>
</div>