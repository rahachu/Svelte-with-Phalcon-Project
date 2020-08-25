<script>
	import Cookies from 'js-cookie';
	import { onMount } from "svelte"
	import { goto } from '@sveltech/routify'
	import { setDecryptCookie } from "../../library/SetCryptoCookie"

	onMount(() => {
		let checkTryoutTime = Cookies.get("TRYOUTTIME") || false
		if(checkTryoutTime === false){
			$goto('/tryout');
		}
	})

	$:data 	= '';

	let countDown = new Date(`${getCookie("TRYOUTTIME")}`);
	
	let startTime = setInterval(function(){
		let now = new Date().getTime()
		let distance = countDown - now;
		
		let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		let seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
		data = `${hours}Jam : ${minutes}Menit : ${seconds}s`;
			
		if (distance < 0) {
			clearInterval(startTime);
			data = "WAKTU HABIS"
			$goto('/users/siswa/tryout');
		}
	}, 1000)

		
	function getCookie(name){
		let decryptCookie = setDecryptCookie(name, "number")
		return decryptCookie;
	} 
</script>
<p>{data}</p>