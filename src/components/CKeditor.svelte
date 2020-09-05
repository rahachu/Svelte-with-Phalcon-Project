<script>
  import { onMount } from 'svelte';
  import ClassicEditor from '../library/editor/ckeditor.js';
  export let editor = null;

  const initializeEditor = () => {
  return ClassicEditor
  	.create( editor, {
  		toolbar: {
  			items: [
  				'heading',
  				'|',
  				'bold',
  				'italic',
  				'link',
  				'bulletedList',
  				'numberedList',
  				'|',
  				'indent',
  				'alignment',
  				'outdent',
  				'|',
  				'imageUpload',
  				'blockQuote',
  				'insertTable',
  				'mediaEmbed',
  				'undo',
  				'redo',
  				'MathType',
  				'ChemType'
  			]
  		},
  		image: {
  			toolbar: [
  				'imageTextAlternative',
  				'imageStyle:full',
  				'imageStyle:side'
  			]
  		},
  		table: {
  			contentToolbar: [
  				'tableColumn',
  				'tableRow',
  				'mergeTableCells'
  			]
  		},
  		licenseKey: '',

  	} )
  	.then( edit => {
  		editor = edit;
  	} )
  	.catch( error => {
  		console.error( 'Oops, something gone wrong!' );
  		console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
  		console.warn( 'Build id: nwedg07ue71o-4myfewwpqu4u' );
  		console.error( error );
  	} );
  }

  onMount(()=>{
      initializeEditor();
  })
</script>

<div bind:this="{editor}" class="editor">
    <slot>
		<em>Mulai tulisan disini!</em>
	</slot>
</div>
