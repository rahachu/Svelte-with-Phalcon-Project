<script>
    import CKeditor from '../../../../components/CKeditor.svelte';
    import {dataTO} from './_store.js';
    import { goto,params } from "@sveltech/routify";

    let question,a,b,c,d,e,solution;
    let soal = $dataTO.subtest[$params.subtest].soal[$params.soal];
    let key =  soal.key;

    //Menyimpan soal ke dalam state
    let saveSoal = () => {
        dataTO.update((n)=>{
            n.subtest[$params.subtest].soal[$params.soal].question=question.getData();
            n.subtest[$params.subtest].soal[$params.soal].option_a=a.getData();
            n.subtest[$params.subtest].soal[$params.soal].option_b=b.getData();
            n.subtest[$params.subtest].soal[$params.soal].option_c=c.getData();
            n.subtest[$params.subtest].soal[$params.soal].option_d=d.getData();
            n.subtest[$params.subtest].soal[$params.soal].option_e=e.getData();
            n.subtest[$params.subtest].soal[$params.soal].kunci=key;
            n.subtest[$params.subtest].soal[$params.soal].solution=solution.getData();
            return n;
        })
        $goto('../edit');
    }
</script>

<div class="card" style="position: sticky;top: 0;z-index: 100;">
    <div class="card-content">
    <div class="level">
        <div class="level-left">
            <p class="subtitle">{$dataTO.name} - {$dataTO.subtest[$params.subtest].judul} - No {soal.no}</p>
        </div>
        <div class="level-right">
            <button class="button is-info is-outlined" on:click={saveSoal}>save</button>
        </div>
    </div>
    </div>
</div>
<div class="container" style="margin-top: 20px;">
    <div class="card">
        <div class="card-content">
            <p class="title is-4">Persoalan</p>
            <CKeditor bind:editor='{question}'>{@html soal.question}</CKeditor>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 20px;">
    <div class="card">
        <div class="card-content">
            <p class="title is-4">Pilihan Jawaban</p>
            <div class="control has-icons-left">
                <div class="select">
                    <select bind:value={key}>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                </div>
                <div class="icon is-small is-left">
                    <i class="fas fa-key"></i>
                </div>
            </div>
            <div class="content">
                <ol type="A">
                    <li><CKeditor bind:editor='{a}'>{@html soal.option_a}</CKeditor></li>
                    <li><CKeditor bind:editor='{b}'>{@html soal.option_b}</CKeditor></li>
                    <li><CKeditor bind:editor='{c}'>{@html soal.option_c}</CKeditor></li>
                    <li><CKeditor bind:editor='{d}'>{@html soal.option_d}</CKeditor></li>
                    <li><CKeditor bind:editor='{e}'>{@html soal.option_e}</CKeditor></li>
                </ol>
            </div>
            <p class='title is-5'>Solusi Persoalan</p>
            <CKeditor bind:editor='{solution}'>{@html soal.solution}</CKeditor>
        </div>
    </div>
</div>